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

class DocumentApprovalController extends Controller
{

    public function index()
    {
        $title = 'Approvement Page';

        $type = 'approval';

        if (Auth::user()->unit === 'ADMIN') {
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

        // dd($type);

        if ($type === 'sent') {

            $title = 'Document Sent Page';

            if(Auth::user()->unit === 'ADMIN'){

                $document = Document::where('id', $id)->first();

            } else {

                $document = Document::where('id', $id)->where('sender_id', Auth::user()->id)->first();

            }

        } else if ($type === 'receive') {

            $title = 'Document Receive Page';

            if(Auth::user()->unit === 'ADMIN'){

                $document = Document::where('id', $id)->first();

            } else {

                $document = Document::where('id', $id)->where('receiver_id', Auth::user()->id)->first();

            }

        } else if ($type === 'approval'){

            $title = 'Approvement Page';

            if(Auth::user()->unit === 'ADMIN'){

                $document = Document::where('id', $id)->whereHas('approvals')->first();

            } else {

                $document = Document::where('id', $id)->whereHas('approvals', function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('approver_id', Auth::user()->id);
                    });
                })->first();

            }

            $approval = $document->approvals->count();

        }

        // dd($document);

        return view('pages.approvement.approvement', compact('title', 'document', 'type', 'approval'));
    }

    public function approve(Request $request, Document $document)
    {

        $approver_id = $request->id;
        // Lakukan proses approval disini

        // dd($document);

        $data = DocumentApproval::where('approver_id', $approver_id)->where('doc_id', $document->id)->get();
        $approvers_queue = $data->first()->approvers_queue;

        $nextData = DocumentApproval::where('approvers_queue', $approvers_queue + 1)->where('doc_id', $document->id)->get();

        foreach ($data as $approval) {
            $approval->update([
                'approval_status' => $request->approval_status,
                'approval_date' => Carbon::now(), // Menggunakan waktu saat ini
            ]);
        }

        $statusData = $data->first()->approval_status;

        if ($statusData === 'Approved') {
            foreach ($nextData as $updateStatus) {
                $updateStatus->update([
                    'approval_status' => 'Pending',
                ]);
            }

            // Mengambil jumlah persyaratan persetujuan setelah diubah
            $required_approver = $data->where('approval_status', 'Approved')->count();

            DocumentApprovalRequirement::where('doc_id', $document->id)->update(['required_approvers' => DB::raw('required_approvers - 1')]);

            $document->requirement->update([
                'required_approvers' => $document->requirement->required_approvers - $required_approver
            ]);

            if ($document->requirement->required_approvers === 0) {
                $document->update([
                    'status' => 'Approved',
                    'approval_required' => 0,
                ]);
            }
        } else {

            $document->update([
                'status' => $statusData,
            ]);
        }



        // Redirect atau tampilkan pesan sukses
        return redirect('/list-approval')->with('success', 'Document is ' . $statusData);
    }
}
