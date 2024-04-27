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

            if (Auth::user()->unit === 'ADMIN') {
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

            if (Auth::user()->unit === 'ADMIN') {
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

            if (Auth::user()->unit === 'ADMIN') {
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

        $approval_count = count($request->input('approvers'));

        $request->merge((['approval_count' => $approval_count]));

        // Validasi data
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string',
            'receiver' => 'required|exists:users,id',
            'sender' => 'required|exists:users,id',
            'approval_count' => 'required|integer|min:0',
            'approvers' => 'array|required_if:approval_count,>0',
            'approvers.*' => 'required|exists:users,id',
            'approvers_queue' => 'array|required_if:approval_count,>0'
        ]);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $document = new Document();

        // dd($request->file('document_upload'));

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



        // Simpan dokumen
        $document->subject = $request->subject;
        $document->sender_id = $request->sender;
        $document->receiver_id = $request->receiver;
        $document->status = 'Pending'; // Atur status dokumen sesuai kebutuhan
        $document->approval_required = $request->approval_count > 0;
        $document->save();

        // dd($document);

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
        return redirect()->route('documents', 'sent')->with('success', 'Success send a document.');
    }

    public function edit($id)
    {

        $title = 'Edit Document';

        $users = User::whereNot('name', Auth::user()->name)->get();

        $document = Document::findOrFail($id);

        $approvers = DocumentApproval::where('doc_id', $id)->get();

        $approverNames = [];

        foreach ($approvers as $approver) {
            // Ambil data user berdasarkan approver_id dari tabel Documentapprover
            $approver = User::find($approver->approver_id);

            // Jika user ditemukan, tambahkan nama ke dalam array
            if ($approvers) {
                $approverNames[] = $approver->name;
            }
        }

        // Gabungkan semua nama menjadi satu string dengan koma sebagai pemisah
        $approverNamesString = implode(', ', $approverNames);

        return view('pages.documents.editDocument', compact('users', 'title', 'document', 'approverNamesString'));
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
