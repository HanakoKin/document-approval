<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\DocumentApproval;
use App\Http\Controllers\Controller;
use App\Models\Disposisi;
use App\Models\DisposisiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\DocumentApprovalRequirement;

use function Laravel\Prompts\error;

class DocumentController extends Controller
{

    public function show($type, $id)
    {

        try {
            $documentQuery = Document::where('id', $id);

            if ($type === 'sent') {

                $title = 'Document ' . ucfirst($type) . ' Page';

                if (Auth::user()->jabatan == 'ADMIN'){
                    $document = $documentQuery->first();
                } else {
                    $document = $documentQuery->where('sender_id', Auth::user()->id)->first();
                }

                $notes = $document->approvals->where('response', '!=', null);

            } else if ($type === 'receive') {

                $title = 'Document Received Page';

                if (Auth::user()->jabatan !== 'ADMIN') {
                    $documentQuery->where(function ($query) {
                        $query->where('receiver_id', Auth::user()->id)
                            ->orWhere(function ($query) {
                                $query->whereExists(function ($subquery) {
                                    $subquery->from('document_approvals')
                                        ->whereColumn('document_approvals.doc_id', 'documents.id')
                                        ->where('document_approvals.approver_id', Auth::user()->id);
                                })
                                ->whereNotExists(function ($lastquery) {
                                    $lastquery->from('document_approvals as da2')
                                        ->whereColumn('da2.doc_id', 'documents.id')
                                        ->whereNotIn('da2.approval_status', ['Approved']);
                                });
                            })
                            ->orWhereHas('disposisi', function ($query) {
                                $query->where('receiver_id', Auth::user()->id);
                            });
                    });
                }

                $document = $documentQuery->where('status', 'Published')->where('id', $id)->first();

            } else if ($type === 'approval'){

                $title = 'Approvement Page';

                if(Auth::user()->jabatan === 'ADMIN'){
                    $document = $documentQuery->whereHas('approvals')->first();
                } else {
                    $document = $documentQuery->whereHas('approvals', function ($query) {
                        $query->where(function ($subQuery) {
                            $subQuery->where('approver_id', Auth::user()->id);
                            // ->where(function ($subQuery) {
                            //     $subQuery->where('approvers_queue', 1)
                            //         ->where('approval_status', 'Unchecked')
                            //         ->orWhere('approval_status', 'Pending');
                            // });
                        });
                    })->first();
                }
            } else if ($type === 'disposisi'){
                $title = 'Disposisi Page';

                $users = User::all();

                if (Auth::user()->jabatan === 'ADMIN') {
                    $document = $documentQuery;
                } else {
                    $document = $documentQuery->whereHas('disposisi', function ($query) {
                        $query->where('receiver_id', Auth::user()->id);
                    });
                }

                $document = $document->where('status', '!=', 'Published')->first();
            }

            $dispositions = Disposisi::where('doc_id', $id)->get();

            $total_approval = $document->approvals->count();
            $current_progress = (clone $document)->approvals->where('approval_date', '!=', null)->count();
            $percentage = ($current_progress / $total_approval) * 100;

            $approver_name = (clone $document)->approvals->where('approval_status', '!=', 'Approved')->first();
            $repellent = (clone $document)->approvals->where('approval_status', '!=', 'Approved')->where('approval_date', null)->first();

            $compact = [
                'total_approval' => $total_approval,
                'current_progress' => $current_progress,
                'percentage' => $percentage,
                'approver_name' => isset($approver_name) ? $approver_name->approver->name : null,
                'repellent' => isset($repellent) ? $repellent : null
            ];

            $signature = explode(' --- ', $document->signature);
            $approval = $document->approvals->count();

            return view('pages.documents.document', [
                'title' => $title,
                'document' => $document,
                'type' => $type,
                'approval' => $approval,
                'signature' => $signature,
                'calculation' => isset($compact) ? $compact : null,
                'notes' => isset($notes) ? $notes : null,
                'users' => isset($users) ? $users : null,
                'dispositions' => isset($dispositions) ? $dispositions : null
            ]);
        } catch (\Throwable $th) {
            abort(404);
        }

    }

    public function create()
    {
        $title = 'Add new Document';
        $users = User::whereNot('name', Auth::user()->name)->get();
        return view('pages.documents.addDocument', compact('users', 'title'));
    }

    public function store(Request $request)
    {
        // Untuk memisal approvers dan approvers_queue dari bentuk array menjadi bentuk object
        if (count($request->approvers) === 1 && count($request->approvers_queue) === 1) {
            $approvers = explode(',', $request->approvers[0]);
            $approvers_queue = explode(',', $request->approvers_queue[0]);

            // Hilangkan spasi yang tidak perlu di sekitar elemen
            $approvers = array_map('trim', $approvers);
            $approvers_queue = array_map('trim', $approvers_queue);

            $request->merge([
                'approvers' => $approvers,
                'approvers_queue' => $approvers_queue
            ]);

        }

        $signatureValues = $request->signature ?? [];
        $signatureString = '';

        if (!empty($signatureValues) && isset($request->signature[0])) {

            foreach ($signatureValues as $index => $value) {
                $signatureString .= ($request->signature[$index] ?? '-') . ' --- ';;
            }

        }

        $signatureString = rtrim($signatureString, ' --- ');
        $request->merge(['signature' => $signatureString]);
        $approval_count = count($request->input('approvers'));
        $request->merge(['approval_count' => $approval_count]);

        // Validasi data
        $validator = Validator::make($request->all(), [
            'no_doc' => 'nullable|string',
            'subject' => 'required|string',
            'description' => 'required|string',
            'placeNdate' => 'nullable|string',
            'receiver' => 'required|string',
            'sender' => 'required|exists:users,id',
            'approval_count' => 'required|integer|min:0',
            'approvers' => 'array|required_if:approval_count,>0',
            'approvers.*' => 'required|exists:users,id',
            'approvers_queue' => 'array|required_if:approval_count,>0',
            'signature' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $document = new Document();
        $fillableAttributes = ['no_doc', 'description', 'placeNdate', 'revision_count', 'subject', 'signature'];
        foreach ($fillableAttributes as $attribute) {
            if ($request->has($attribute)) {
                $document->$attribute = $request->$attribute;
            }
        }
        if($request->hasFile('document_upload')){

            $path = '';

            foreach($request->file('document_upload') as $file) {

                if($file->getSize() > 10485760){
                    return back()->with('error', 'File is too large')->withInput();
                }

                $currentPath = $file->store('public/documents');
                $path .= $currentPath . ' - '; // Memisahkan path dokumen dengan " - "
                $document->filename = $file->getClientOriginalName();
            }

            // Menghapus spasi ekstra dan tanda "-" dari akhir path
            $path = rtrim($path, ' - ');

            $document->path = $path;

        } else {

            $document->filename = '-';
            $document->document_text = $request->document_text;

        }

        $document->sender_id = $request->sender;
        $document->receiver_id = $request->receiver;
        $document->status = 'Pending';
        $document->approval_required = $request->approval_count > 0;
        $document->save();

        // Jika persetujuan diperlukan, simpan informasi persetujuan
        if ($request->approval_count > 0) {
            foreach ($request->approvers as $index => $approver) {
                DocumentApproval::create([
                    'doc_id' => $document->id,
                    'approver_id' => $approver,
                    'approvers_queue' => $request->approvers_queue[$index],
                    'approval_status' => 'Unchecked', // Atur status persetujuan sesuai kebutuhan
                    'disposisi_status' => false,
                ]);
            }

            // Simpan informasi persyaratan persetujuan
            DocumentApprovalRequirement::create([
                'doc_id' => $document->id,
                'required_approvers' => $request->approval_count
            ]);
        }

        return redirect()->route('list-data', 'sent')->with('success', 'Success send a document.');
    }

    public function edit($id)
    {

        $title = 'Edit Document';
        $function = 'edit';
        $users = User::whereNot('name', Auth::user()->name)->get();
        $document = Document::findOrFail($id);
        $approvals = DocumentApproval::where('doc_id', $id)->get();
        $approverNames = [];
        $approverIds = [];
        $approversQueue = [];

        foreach ($approvals as $index => $approval) {
            $approver = User::find($approval->approver_id);

            // Jika user ditemukan, tambahkan nama ke dalam array
            if ($approvals) {
                $approverIds[] = (clone $approver)->id;
                $approverNames[] = (clone $approver)->name;
                $approversQueue[] = $approval->approvers_queue;
            }
        }

        // Gabungkan semua nama menjadi satu string dengan koma sebagai pemisah
        $approverNamesString = implode(', ', $approverNames);
        $approverIdsString = implode(', ', $approverIds);
        $approversQueueString = implode(',', $approversQueue);

        return view('pages.documents.addDocument', compact('users', 'title', 'document', 'approverNamesString', 'approverIdsString', 'approversQueueString', 'function'));
    }

}
