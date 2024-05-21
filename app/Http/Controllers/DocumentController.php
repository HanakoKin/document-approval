<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\DocumentApproval;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\DocumentApprovalRequirement;

class DocumentController extends Controller
{
    public function index($category)
    {

        $type = $category;

        if ($category === 'receive') {

            $title = 'All Received Documents';

            if (Auth::user()->jabatan === 'ADMIN') {
                $documents = Document::all();
            } else {
                $documents = Document::where('status', 'Approved')->whereHas('approvals', function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('receiver_id', Auth::user()->id);
                    });
                })->get();
            }
        } else if ($category === 'sent') {

            $title = 'All Sent Documents';

            if (Auth::user()->jabatan === 'ADMIN') {
                $documents = Document::all();
            } else {
                $documents = Document::whereHas('approvals', function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('sender_id', Auth::user()->id);
                    });
                })->get();
            }
        } else if ($category === 'approval') {

            $title = 'All Documents Approval';

            if (Auth::user()->jabatan === 'ADMIN') {
                $documents = Document::all();
            } else {
                $documents = Document::whereHas('approvals', function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('receiver_id', Auth::user()->id)->where('status', 'Approve');
                    });
                })->get();
            }
        }

        $totals = $documents->count();

        return view('pages.documents.document', compact('title', 'documents', 'totals', 'category', 'type'));
    }

    public function create()
    {

        $title = 'Add new Document';

        $users = User::whereNot('name', Auth::user()->name)->get();

        return view('pages.documents.addDocument', compact('users', 'title'));
    }

    public function store(Request $request)
    {

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

        // dd($request->all());

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

        if($request->has('no_doc')){
            $document->no_doc = $request->no_doc;
        }

        if($request->has('description')){
            $document->description = $request->description;
        }

        if($request->has('placeNdate')){
            $document->placeNdate = $request->placeNdate;
        }

        if($request->has('revision_count')){
            $document->revision_count = $request->revision_count;
        }

        // Simpan dokumen
        $document->subject = $request->subject;
        $document->signature = $request->signature;
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
                    'approval_status' => 'Unchecked' // Atur status persetujuan sesuai kebutuhan
                ]);
            }

            // Simpan informasi persyaratan persetujuan
            DocumentApprovalRequirement::create([
                'doc_id' => $document->id,
                'required_approvers' => $request->approval_count
            ]);
        }

        // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
        return redirect()->route('show', 'sent')->with('success', 'Success send a document.');
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
            // Ambil data user berdasarkan approver_id dari tabel Documentapprover
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

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'document' => 'required|file|max:10240',
        ]);

        $path = $request->file('document')->store('public/documents');

        $document = Document::findOrFail($id);
        $documentApproval = DocumentApproval::where('doc_id', $id)->where('approval_status', 'Need Revision')->first();

        $document->name = $request->file('document')->getClientOriginalName();
        $document->path = $path;
        $document->status = 'Pending';
        $document->save();

        $documentApproval->approval_status = 'Unchecked';
        $documentApproval->approval_date = NULL;
        $documentApproval->save();

        return redirect()->route('documents', 'sent')->with('success', 'Success send a revision document.');
    }
}
