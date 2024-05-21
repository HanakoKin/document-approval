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
    public function index()
    {
        $title = 'Dashboard Page';

        $documents = Document::select('*', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'));
        $memos = Memo::select('*', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'));

        if (Auth::user()->jabatan === 'ADMIN') {
            $memos_received = (clone $memos)->get();
            $memos_sent = (clone $memos)->get();
            $documents_approved = (clone $documents)->where('status', 'Approved')->get();
            $documents_pending = (clone $documents)->where('status', '!=' ,'Approved')->get();
            $documents_need_approval = $documents_pending;
            $documents_received = $documents_approved;
        } else {

            $memos_received = (clone $memos)->where(function ($query) {
                $query->whereExists(function ($subquery) {
                    $subquery->select(DB::raw(1))
                        ->from('tembusan_user')
                        ->whereColumn('tembusan_user.memo_id', 'memos.id')
                        ->where('tembusan_user.user_id', '=', Auth::user()->id);
                })->orWhereExists(function ($subquery) {
                    $subquery->from('memo_receiver')
                        ->whereColumn('memo_receiver.memo_id', 'memos.id')
                        ->where('memo_receiver.user_id', Auth::user()->id);
                });
            })->get();

            $memos_sent = (clone $memos)->where('sender_id', Auth::user()->id)->get();
            $documents_approved = (clone $documents)->where('status', 'Approved')->where('sender_id', Auth::user()->id)->get();
            $documents_pending = (clone $documents)->where('status', '!=', 'Approved')->where('sender_id', Auth::user()->id)->get();
            $documents_need_approval = (clone $documents)->whereHas('approvals', function ($query) {
                    $query->where('approver_id', Auth::user()->id)
                        ->where(function ($subQuery) {
                            $subQuery->where('approvers_queue', 1)->where('approval_status', 'Unchecked')
                                ->orWhere('approval_status', 'Pending');
                        });
            })->get();
            $documents_received = (clone $documents)->where('status', '=', 'Approved')->where('receiver_id', '=', Auth::user()->id)->orWhere(function ($query) {
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
            })->get();
        }

        return view('pages.dashboard', compact('title', 'memos_received', 'memos_sent', 'documents_approved', 'documents_pending', 'documents_need_approval', 'documents_received'));;
    }

    // Document dan Memo digabung
    public function show($category)
    {
        if ($category == 'receive') {

            $title = 'All Received Memos';

            $boxTitle = 'Inbox';

            $memos = Memo::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"memos" AS source'));

            if (Auth::user()->jabatan !== 'ADMIN') {
                $memos->orWhere(function ($query) {
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

            $documents = Document::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'))->where('status', 'Approved');

            if (Auth::user()->jabatan !== 'ADMIN') {
                $documents->where('receiver_id', Auth::user()->id)
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
                    });
            }

            $result = $memos->union($documents)->orderBy('newest_time', 'desc')->get();

        } else if ($category == 'sent') {

            $title = 'All Sent Memos';

            $boxTitle = 'Sent';

            $memos = Memo::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"memos" AS source'));

            if(Auth::user()->jabatan !== 'ADMIN'){
                $memos->where('sender_id', Auth::user()->id);
            }

            $documents = Document::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'));

            if(Auth::user()->jabatan !== 'ADMIN'){
                $documents->where('sender_id', Auth::user()->id);
            }

            $result = $memos->union($documents)->orderBy('newest_time', 'desc')->get();
        } else if ($category === 'approval') {

            $title = 'All Documents Approval';
            $boxTitle = 'Approvement';

            $query = Document::query();

            if (Auth::user()->jabatan === 'ADMIN') {
                $query->select('*', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'))->where('status', '!=', 'Approved');
            } else {
                $query->whereHas('approvals', function ($query) {
                    $query->where('approver_id', Auth::user()->id)
                        ->where(function ($subQuery) {
                            $subQuery->where('approvers_queue', 1)->where('approval_status', 'Unchecked')
                                ->orWhere('approval_status', 'Pending');
                        });
                })->select('*', DB::raw('"documents" AS source'), DB::raw('created_at AS newest_time'));
            }

            $result = $query->orderBy('newest_time', 'desc')->get();

        }

        return view('pages.show', compact('title', 'result', 'category', 'boxTitle'));
    }

    // Document dan Memo dipisah
    public function each($type, $category)
    {

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

            if($category == 'receive'){

                $title = 'All Received Documents';
                $boxTitle = "Documents Received";

                $result = $documents->where('status', 'Approved');

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
                        });
                }

            } else if ($category == 'sent') {

                $title = 'All Sent Documents';
                $boxTitle = "Documents Sent";

                $result = $documents;

                if(Auth::user()->jabatan !== 'ADMIN'){
                    $result->where('sender_id', Auth::user()->id);
                }

            } else if ($category == 'approved') {

                $title = 'All Approved Documents';
                $boxTitle = "Documents Approved";

                $result = $documents->where('status', 'Approved');

                if(Auth::user()->jabatan !== 'ADMIN'){
                    $result->where('sender_id', Auth::user()->id);
                }

            } else if ($category == 'pending') {

                $title = 'All Pending Documents';
                $boxTitle = "Documents Pending";

                $result = $documents->where('status', '!=', 'Approved');

                if(Auth::user()->jabatan !== 'ADMIN'){
                    $result->where('sender_id', Auth::user()->id);
                }

            } else if ($category == 'approval') {

                $title = 'All Documents Approval';
                $boxTitle = "Documents Approval";

                $result = $documents;

                if(Auth::user()->jabatan === 'ADMIN'){
                    $result->where('status', '!=', 'Approved');
                } else {
                    $result->whereHas('approvals', function ($query) {
                        $query->where('approver_id', Auth::user()->id)
                            ->where(function ($subQuery) {
                                $subQuery->where('approvers_queue', 1)->where('approval_status', 'Unchecked')
                                    ->orWhere('approval_status', 'Pending');
                            });
                    });
                }
            }

        }

        $result = $result->orderBy('newest_time', 'desc')->get();

        return view('pages.show', compact('title', 'result', 'category', 'boxTitle'));
    }

}
