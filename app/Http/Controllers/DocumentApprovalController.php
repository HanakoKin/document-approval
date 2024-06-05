<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\DocumentApproval;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DocumentApprovalController extends Controller
{
    public function __invoke(Request $request, Document $document)
    {
        $approver_id = $request->id;

        // Lakukan proses approval disini
        $data = DocumentApproval::where('approver_id', $approver_id)->where('doc_id', $document->id)->first();
        $approvers_queue = $data->approvers_queue;
        $nextData = DocumentApproval::where('approvers_queue', $approvers_queue + 1)->where('doc_id', $document->id)->get();

        $data->update([
            'approval_status' => $request->approval_status,
            'approval_date' => Carbon::now(), // Menggunakan waktu saat ini
            'disposisi_status' => $request->disposisi_status == 1 ? true : false,
            'response' => $request->response,
        ]);

        $statusData = $data->approval_status;

        // Kalau data diApprove
        if ($statusData === 'Approved' && $request->signature !== null) {
            $oldSignature = Document::where('id', $document->id)->first();
            $arrOldSignature = explode(' --- ', $oldSignature->signature);
            $result = array_merge($arrOldSignature, $request->signature);

            $signatureString = '';

            // Loop untuk setiap nilai dalam kolom
            foreach ($result as $index => $value) {
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
            $document->requirement->update([
                'required_approvers' => $document->requirement->required_approvers - 1
            ]);

            if ($document->disposisi->count() > 0){
                $data->update([
                    'disposisi_status' => false,
                ]);
            }

            // $disposisi_status = false;

            // if($data->disposisi_status == true){
            //     $disposisi_status = true;
            // }

            if($data->disposisi_status == true){
                $document->update([
                    'status' => 'Disposisi',
                ]);

                return redirect()->route('list-data', 'approval')->with('success', 'Document is ' . $statusData . ' and sent to ADMIN');
            }

            // Jika semua persyaratan persetujuan telah disetujui, maka status dokumen menjadi 'Published'
            if ($document->requirement->required_approvers === 0 && ($document->status === 'Approved' || $document->status === 'Pending')) {
                $document->update([
                    'status' => 'Published',
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
        return redirect()->route('list-data', 'approval')->with('success', 'Document is ' . $statusData);
    }
}
