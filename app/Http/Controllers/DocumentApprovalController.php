<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\DocumentApproval;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\DocumentApprovalRequirement;
use App\Models\DocumentResponse;

class DocumentApprovalController extends Controller
{

    public function index()
    {
        $title = 'Approvement Page';

        $type = 'approval';

        if (Auth::user()->jabatan === 'ADMIN') {
            $documents = Document::all();
        } else {
            $documents = Document::whereHas('approvals', function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('approver_id', Auth::user()->id)
                        ->where('approvers_queue', 1)->where('approval_status', 'Unchecked');
                })->orWhere(function ($subQuery) {
                    $subQuery->where('approver_id', Auth::user()->id)
                        ->where('approval_status', 'Pending');
                });
            })->get();
        }

        $totals = $documents->count();

        return view('pages.approvement.list-approvement', compact('title', 'type', 'documents', 'totals'));
    }

    public function showDocument($type, $id)
    {

        if ($type === 'sent') {

            $title = 'Document Sent Page';
            $document = Document::find($id);

        } else if ($type === 'receive' || $type === 'approved') {

            if($type === 'approved'){
                $title = 'Document Approved Page';
            }else{
                $title = 'Document Received Page';
            }

            $document = Document::where('id', $id)->where('status', 'Approved')->first();

        } else if ($type === 'pending') {

            $title = 'Document Pending Page';
            $document = Document::where('id', $id)->where('status', '!=', 'Approved')->first();

            $total_approval = $document->approvals->count();
            $current_progress = (clone $document)->approvals->where('approval_date', '!=', null)->count();
            $percentage = ($current_progress / $total_approval) * 100;

            $approver_name = (clone $document)->approvals->where('approval_status', '!=', 'Approved')->first();
            $approver_name = $approver_name->approver->name;

            $repellent = (clone $document)->approvals->where('approval_status', '!=', 'Approved')->where('approval_date', null)->first();

            $compact = [
                'total_approval' => $total_approval,
                'current_progress' => $current_progress,
                'percentage' => $percentage,
                'approver_name' => $approver_name,
                'repellent' => isset($repellent) ? $repellent : null
            ];

        } else if ($type === 'approval'){

            $title = 'Approvement Page';

            if(Auth::user()->jabatan === 'ADMIN'){

                $document = Document::where('id', $id)->whereHas('approvals')->first();

            } else {

                $document = Document::where('id', $id)->whereHas('approvals', function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('approver_id', Auth::user()->id);
                    });
                })->first();

            }

        }

        $signature = explode(' --- ', $document->signature);
        $approval = $document->approvals->count();

        return view('pages.approvement.approvement', [
            'title' => $title,
            'document' => $document,
            'type' => $type,
            'approval' => $approval,
            'signature' => $signature,
            'calculation' => isset($compact) ? $compact : null
        ]);
    }

    public function approve(Request $request, Document $document)
    {

        $approver_id = $request->id;

        // Lakukan proses approval disini
        $data = DocumentApproval::where('approver_id', $approver_id)->where('doc_id', $document->id)->get();

        $approvers_queue = $data->first()->approvers_queue;

        $nextData = DocumentApproval::where('approvers_queue', $approvers_queue + 1)->where('doc_id', $document->id)->get();

        foreach ($data as $approval) {
            $approval->update([
                'approval_status' => $request->approval_status,
                'approval_date' => Carbon::now(), // Menggunakan waktu saat ini
            ]);
        }

        if($request->has('catatan')){
            DocumentResponse::create([
                'doc_id' => $document->id,
                'catatan' => $request->catatan,
            ]);
        }

        $statusData = $data->first()->approval_status;

        // Kalau data diApprove
        if ($statusData === 'Approved' && $request->signature !== null) {

            $oldSignature = Document::where('id', $document->id)->first();

            $arrOldSignature = explode(' --- ', $oldSignature->signature);

            $result = array_merge($arrOldSignature, $request->signature);

            $signatureString = '';

            // Loop untuk setiap nilai dalam kolom
            foreach ($result as $index => $value) {
                // Tambahkan index dan nilai ke dalam string
                $signatureString .= ($result[$index] ?? '-') . ' --- ';;
            }

            // Hapus koma terakhir dari string
            $signatureString = rtrim($signatureString, ' --- ');

            $request->merge(['signature' => $signatureString]);

            $document->update([
                'signature' => $request->signature,
            ]);

            // Ubah approval_status urutan selanjutnya yang semula 'Unchecked' menjadi 'Pending'
            foreach ($nextData as $updateStatus) {
                $updateStatus->update([
                    'approval_status' => 'Pending',
                ]);
            }

            // Mengambil jumlah persyaratan persetujuan setelah diubah
            $required_approver = $data->where('approval_status', 'Approved')->count();

            $document->requirement->update([
                'required_approvers' => $document->requirement->required_approvers - $required_approver
            ]);

            if ($document->requirement->required_approvers === 0) {
                $document->update([
                    'status' => 'Approved',
                    'approval_required' => 0,
                ]);
            }
        } else if ($statusData === 'Need Revision') {

            $revisions = DocumentApproval::where('doc_id', $document->id)->get();

            foreach ($revisions as $revision){
                $revision->update([
                    'approval_status' => $statusData,
                ]);
            }

            DocumentApproval::where('doc_id', $document->id)->where('approver_id', Auth::user()->id)
                ->update([
                    'approval_date' => null,
                ]);

            $document->requirement->update([
                'required_approvers' => $revisions->count()
            ]);

            $document->update([
                'status' => $statusData,
            ]);

        } else {

            $rejects = DocumentApproval::where('doc_id', $document->id)->get();

            foreach ($rejects as $reject){
                $reject->update([
                    'approval_status' => $statusData,
                ]);
            }

            DocumentApproval::where('doc_id', $document->id)->where('approver_id', Auth::user()->id)
                ->update([
                    'approval_date' => null,
                ]);

            $document->requirement->update([
                'required_approvers' => 0,
            ]);

            $document->update([
                'approval_required' => false,
                'status' => $statusData
            ]);

        }

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('show', 'approval')->with('success', 'Document is ' . $statusData);
    }
}
