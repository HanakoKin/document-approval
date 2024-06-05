<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShortcutController extends Controller
{
    // For Shortcut in Dashboard
    public function __invoke($type, $category, $year)
    {
        $targetYear = $year;

        $memos = Memo::select('*', DB::raw('created_at AS newest_time'), DB::raw('"memos" AS source'));
        $documents = Document::select('*', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'));

        if ($type == 'memo') {

            $result = $memos;

            if($category == 'receive'){

                $title = 'All Received Memos';
                $boxTitle = "Memos Received";

                if (Auth::user()->jabatan !== 'ADMIN') {
                    $result->orWhere(function ($query) {
                        $query->whereExists(function ($subquery) {
                            $subquery->from('tembusan_user')
                                ->whereColumn('tembusan_user.memo_id', 'memos.id')
                                ->where('tembusan_user.user_id', Auth::user()->id);
                        })->orWhereExists(function ($subquery) {
                            $subquery->from('memo_receiver')
                                ->whereColumn('memo_receiver.memo_id', 'memos.id')
                                ->where('memo_receiver.user_id', Auth::user()->id);
                        });
                    });
                }

            } else if ($category == 'sent') {

                $title = 'All Sent Memos';
                $boxTitle = "Memos Sent";

                if(Auth::user()->jabatan !== 'ADMIN'){
                    $result->where('sender_id', Auth::user()->id);
                }

            }

        } else if ($type == 'document') {

            $result = $documents;

            if($category == 'receive'){

                $title = 'All Received Documents';
                $boxTitle = "Documents Received";

                $result = $result->where('status', 'Published');

                if (Auth::user()->jabatan !== 'ADMIN') {
                    $result->where('receiver_id', Auth::user()->id)
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
                        })->orWhereHas('disposisi', function ($query) {
                            $query->where('receiver_id', Auth::user()->id);
                        }
                    );
                }

            } else if ($category == 'approved') {

                $title = 'All Approved Documents';
                $boxTitle = "Documents Approved";

                $result->where('status', 'Published');

                if(Auth::user()->jabatan !== 'ADMIN'){
                    $result->where('sender_id', Auth::user()->id);
                }

            } else if ($category == 'pending') {

                $title = 'All Pending Documents';
                $boxTitle = "Documents Pending";

                $result->where('status', '!=', 'Published');

                if(Auth::user()->jabatan !== 'ADMIN'){
                    $result->where('sender_id', Auth::user()->id);
                }

            } else if ($category == 'approval') {

                $title = 'All Documents Approval';
                $boxTitle = "Documents Approval";

                if(Auth::user()->jabatan === 'ADMIN'){
                    $result->where('status', 'Approved')->orWhere('status', 'Pending');
                } else {
                    $result->whereHas('approvals', function ($query) {
                        $query->where('approver_id', Auth::user()->id)
                            ->where(function ($subQuery) {
                                $subQuery->where('approvers_queue', 1)->where('approval_status', 'Unchecked')
                                    ->orWhere('approval_status', 'Pending');
                            });
                    })->where('status', '!=' , 'Published');
                }
            }

        }

        $result = $result->orderBy('newest_time', 'desc')->whereYear(DB::raw("CONVERT_TZ(created_at, '+00:00', '+07:00')"), $targetYear)->get();

        return view('pages.list-data', compact('title', 'result', 'category', 'boxTitle'));
    }
}
