<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $title = 'Dashboard Page';

        // $documents = Document::select('*', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'));
        // $memos = Memo::select('*', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'));

        // if (Auth::user()->jabatan === 'ADMIN') {
        //     $memos_received = (clone $memos)->get();
        //     $memos_sent = (clone $memos)->get();
        //     $documents_approved = (clone $documents)->where('status', 'Published')->get();
        //     $documents_pending = (clone $documents)->where('status', '!=' ,'Published')->get();
        //     $documents_need_approval = (clone $documents)->where('status','Pending')->get();;
        //     $documents_received = $documents_approved;
        // } else {

        //     $memos_received = (clone $memos)->where(function ($query) {
        //         $query->whereExists(function ($subquery) {
        //             $subquery->select(DB::raw(1))
        //                 ->from('tembusan_user')
        //                 ->whereColumn('tembusan_user.memo_id', 'memos.id')
        //                 ->where('tembusan_user.user_id', '=', Auth::user()->id);
        //         })->orWhereExists(function ($subquery) {
        //             $subquery->from('memo_receiver')
        //                 ->whereColumn('memo_receiver.memo_id', 'memos.id')
        //                 ->where('memo_receiver.user_id', Auth::user()->id);
        //         });
        //     })->get();

        //     $memos_sent = (clone $memos)->where('sender_id', Auth::user()->id)->get();
        //     $documents_approved = (clone $documents)->where('status', 'Published')->where('sender_id', Auth::user()->id)->get();
        //     $documents_pending = (clone $documents)->where('status', '!=', 'Published')->where('sender_id', Auth::user()->id)->get();
        //     $documents_need_approval = (clone $documents)->where('status', 'Pending');
        //     $documents_need_approval = $documents_need_approval->whereHas('approvals', function ($query) {
        //             $query->where('approver_id', Auth::user()->id)
        //                 ->where(function ($subQuery) {
        //                     $subQuery->where('approvers_queue', 1)->where('approval_status', 'Unchecked')
        //                         ->orWhere('approval_status', 'Pending');
        //                 });
        //     })->get();
        //     $documents_received = (clone $documents)->where('receiver_id', '=', Auth::user()->id)
        //     ->orWhere(function ($query) {
        //         $query->whereExists(function ($subquery) {
        //             $subquery->from('document_approvals')
        //                 ->whereColumn('document_approvals.doc_id', 'documents.id')
        //                 ->where('document_approvals.approver_id', Auth::user()->id);
        //         })
        //         ->whereNotExists(function ($lastquery) {
        //             $lastquery->from('document_approvals as da2')
        //                 ->whereColumn('da2.doc_id', 'documents.id')
        //                 ->whereNotIn('da2.approval_status', ['Approved']);
        //         });
        //     })->where('status', 'Published')->get();
        // }

        // return view('pages.dashboard', compact('title', 'memos_received', 'memos_sent', 'documents_approved', 'documents_pending', 'documents_need_approval', 'documents_received'));

        return view('pages.dashboard', compact('title'));
    }

}
