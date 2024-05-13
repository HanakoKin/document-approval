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

        $category = 'receive';

        if ($category == 'receive') {

            $title = 'All Received Memos';

            if (Auth::user()->jabatan === 'ADMIN') {
                $memos = Memo::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"memos" AS source'));

                $documents = Document::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'))->where('status', '=', 'Approval');

                $result = $memos->union($documents)->orderBy('newest_time', 'desc')->get();


            } else {
                $memos = Memo::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"memos" AS source'))
                ->where(function ($query) {
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
                });

                $documents = Document::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'))->where('status', '=', 'Approval')->where('receiver_id', '=', Auth::user()->id);

                $result = $memos->union($documents)->orderBy('newest_time', 'desc')->get();
            }
        } else if ($category == 'sent') {

            $title = 'All Sent Memos';

            if (Auth::user()->jabatan === 'ADMIN') {
                // $memos = "test";
                $memos = Memo::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"memos" AS source'));

                $documents = Document::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'));

                $result = $memos->union($documents)->orderBy('newest_time', 'desc')->get();
            } else {
                $memos = Memo::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"memos" AS source'))
                ->where('sender_id', '=', Auth::user()->id);

                $documents = Document::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'))->where('status', '=', 'Approval')->where('sender_id', '=', Auth::user()->id);

                $result = $memos->union($documents)->orderBy('newest_time', 'desc')->get();
            }
        } else if ($category === 'approval') {

            $title = 'All Documents Approval';

            $boxTitle = 'Approvement';

            if (Auth::user()->jabatan === 'ADMIN') {
                $result = Document::select('*', DB::raw('"documents" AS source'))->get();
            } else {
                $result = Document::whereHas('approvals', function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('receiver_id', Auth::user()->id)->where('status', 'Approve');
                    });
                })->select('*', DB::raw('"documents" AS source'))->get();
            }
        }

        return view('pages.dashboard', compact('title', 'result', 'category'));
    }

    public function show($category)
    {
        // dd($category);
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
                $query->select('*', DB::raw('"documents" AS source'))->orderBy('created_at');
            } else {
                $query->whereHas('approvals', function ($query) {
                    $query->where('approver_id', Auth::user()->id)
                        ->where(function ($subQuery) {
                            $subQuery->where('approvers_queue', 1)->where('approval_status', 'Unchecked')
                                ->orWhere('approval_status', 'Pending');
                        });
                })->select('*', DB::raw('"documents" AS source'));
            }

            $result = $query->orderBy('created_at')->get();

        }

        // dd($result);

        return view('pages.show', compact('title', 'result', 'category', 'boxTitle'));
    }

}
