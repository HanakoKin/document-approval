<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Memo;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{

    public function listData($category)
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

            $documents = Document::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'));

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
                    })
                    ->orWhereHas('disposisi', function ($query) {
                        $query->where('receiver_id', Auth::user()->id);
                    }
                )->where('status', 'Published');
            }

            $statuses = (clone $documents)->select('id', 'status')->get();

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

            $statuses = (clone $documents)->select('id', 'status')->get();

            $result = $memos->union($documents)->orderBy('newest_time', 'desc')->get();

        } else if ($category === 'approval') {

            $title = 'All Documents Approval';
            $boxTitle = 'Approvement';

            $query = Document::query();

            if (Auth::user()->jabatan === 'ADMIN') {
                $query->select('*', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'));
            } else {
                $query->whereHas('approvals', function ($query) {
                    $query->where('approver_id', Auth::user()->id);
                        // ->where(function ($subQuery) {
                        //     $subQuery->where('approvers_queue', 1)
                        //         ->where('approval_status', 'Unchecked')
                        //         ->orWhere('approval_status', 'Pending');
                        // });
                })->select('*', DB::raw('"documents" AS source'), DB::raw('created_at AS newest_time'));
            }

            $result = $query->where('status', '!=', 'Published')->orderBy('newest_time', 'desc')->get();

            // dd($result);

        } else if ($category === 'disposisi') {
            $title = 'All Disposisi';
            $boxTitle = 'Disposisi';

            $query = Document::query();

            if (Auth::user()->jabatan === 'ADMIN') {
                $query->select('*', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'));
            } else {
                $query->whereHas('disposisi', function ($query) {
                    $query->where('receiver_id', Auth::user()->id);
                })->select('*', DB::raw('"documents" AS source'), DB::raw('created_at AS newest_time'));
            }

            $result = $query->where('status', '!=', 'Published')->orderBy('created_at', 'desc')->get();
            // dd($result);
        }

        return view('pages.list-data', [
            'title' => $title,
            'result' => $result,
            'category' => $category,
            'boxTitle' => $boxTitle,
            'statuses' => isset($statuses) ? $statuses : null
            ]);
    }

    public function previewData($dataType, $dataId)
    {
        if ($dataType === 'memos') {
            $result = Memo::find($dataId);
        } else if ($dataType === 'documents') {
            $result = Document::find($dataId);
        } else {
            // Jika tipe data tidak valid, kembalikan respons error
            return response()->json(['error' => 'Invalid data type'], 400);
        }

        // Pastikan ada hasil yang ditemukan sebelum mengakses properti
        $date = Carbon::parse($result->created_at)->locale('en')->timezone('Asia/Jakarta');
        $formattedDate = $date->translatedFormat('j F Y, g:i A');

        if ($result) {
            return response()->json([
                'id' => $result->id,
                'no_doc' => $result->no_doc,
                'path' => $result->path,
                'subject' => $result->subject,
                'description' => $result->description,
                'document_text' => $result->document_text,
                'placeNdate' => $result->placeNdate,
                'filename' => $result->filename,
                'sender' => $result->sender->name,
                'sender_username' => $result->sender->username,
                'datetime' => $formattedDate
            ]);
        } else {
            // Jika tidak ada hasil yang ditemukan, kembalikan respons error
            return response()->json(['error' => 'Data not found'], 404);
        }
    }

    public function filterData($category, $dataType)
    {
        if($category === 'receive'){
            if($dataType === 'memos'){
                $result = Memo::select('*', DB::raw('created_at AS newest_time'), DB::raw('"memos" AS source'));

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
            } else if ($dataType === 'documents'){
                $result = Document::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', 'receiver_id', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'));

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
                        })
                        ->orWhereHas('disposisi', function ($query) {
                            $query->where('receiver_id', Auth::user()->id);
                        }
                    )->where('status', 'Published');
                }
            }
        } else if($category === 'sent'){
            if($dataType === 'memos'){
                $result = Memo::select('*', DB::raw('created_at AS newest_time'), DB::raw('"memos" AS source'));

                if(Auth::user()->jabatan !== 'ADMIN'){
                    $result->whereExists(function ($subquery) {
                        $subquery->where('sender_id', Auth::user()->id);
                    });
                }
            } else if ($dataType === 'documents'){
                $result = Document::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', 'receiver_id', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'));

                if(Auth::user()->jabatan !== 'ADMIN'){
                    $result->where('sender_id', Auth::user()->id);
                }
            }
        }

        $result = $result->get();

        foreach ($result as $index => $data) {
            $date = Carbon::parse($result[$index]->newest_time)->locale('en')->timezone('Asia/Jakarta');
            $formattedDate = $date->translatedFormat('j F Y, g:i A');
            $result[$index]->formattedDate = $formattedDate;

            $result[$index]->source = $dataType;
            $result[$index]->category = $category;
            $result[$index]->sender_name = $data->sender->name;
        }

        if ($result) {
            $responseData = [];

            // Lakukan pengulangan terbalik untuk mengambil data dari yang paling akhir
            for ($i = count($result) - 1; $i >= 0; $i--) {
                $finalData = $result[$i];

                $responseData[] = [
                    'id' => $finalData->id,
                    'no_doc' => $finalData->no_doc,
                    'subject' => $finalData->subject,
                    'description' => $finalData->description,
                    'document_text' => $finalData->document_text,
                    'placeNdate' => $finalData->placeNdate,
                    'filename' => $finalData->filename,
                    'sender' => $finalData->sender_name,
                    'sender_username' => $finalData->sender->username,
                    'datetime' => $finalData->formattedDate,
                    'source' => $finalData->source,
                    'category' => $finalData->category,
                    // Tambahkan properti lainnya di sini sesuai kebutuhan
                ];
            }

            return response()->json($responseData);
        } else {
            return response()->json(['error' => 'Data not found'], 404);
        }

    }

    public function chartData($year)
    {
        $targetYear = $year;

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $jenisInsiden = [
            'Documents',
            'Memos',
            'Both',
        ];

        foreach ($months as $monthIndex => $month) {
            $targetMonth = ($monthIndex % 12) + 1;

            foreach ($jenisInsiden as $insidenIndex => $type) {
                if($type == 'Documents'){
                    $documentQuery = Document::whereYear(DB::raw("CONVERT_TZ(created_at, '+00:00', '+07:00')"), $targetYear)
                    ->whereMonth(DB::raw("CONVERT_TZ(created_at, '+00:00', '+07:00')"), $targetMonth);

                    $documentData = $documentQuery->pluck('created_at')->toArray();

                    $dataKey = 'data' . $jenisInsiden[$insidenIndex];
                    $data[$dataKey][] = [
                        'label' => "Data {$jenisInsiden[$insidenIndex]} Bulan " . ($monthIndex + 1),
                        'data' => $documentData,
                    ];
                }

                if($type == 'Memos'){
                    $memoQuery = Memo::whereYear(DB::raw("CONVERT_TZ(created_at, '+00:00', '+07:00')"), $targetYear)
                    ->whereMonth(DB::raw("CONVERT_TZ(created_at, '+00:00', '+07:00')"), $targetMonth);

                    $memoData = $memoQuery->pluck('created_at')->toArray();

                    $dataKey = 'data' . $jenisInsiden[$insidenIndex];
                    $data[$dataKey][] = [
                        'label' => "Data {$jenisInsiden[$insidenIndex]} Bulan " . ($monthIndex + 1),
                        'data' => $memoData,
                    ];
                }
            }
        }

        return response()->json($data);
    }

    public function shortcutData($year)
    {
        $targetYear = $year;

        $documents = Document::select('*', DB::raw('"documents" AS source'))->whereYear(DB::raw("CONVERT_TZ(created_at, '+00:00', '+07:00')"), $targetYear);
        $memos = Memo::select('*', DB::raw('"documents" AS source'))->whereYear(DB::raw("CONVERT_TZ(created_at, '+00:00', '+07:00')"), $targetYear);

        if (Auth::user()->jabatan === 'ADMIN') {
            $memos_received = (clone $memos)->get();
            $memos_sent = (clone $memos)->get();
            $documents_approved = (clone $documents)->where('status', 'Published')->get();
            $documents_pending = (clone $documents)->where('status', '!=' ,'Published')->get();
            $documents_need_approval = (clone $documents)->where('status','Pending')->get();;
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

            $documents_approved = (clone $documents)->where('status', 'Published')->where('sender_id', Auth::user()->id)->get();
            $documents_pending = (clone $documents)->where('status', '!=', 'Published')->where('sender_id', Auth::user()->id)->get();
            $documents_need_approval = (clone $documents)->whereHas('approvals', function ($query) {
                    $query->where('approver_id', Auth::user()->id)
                        ->where(function ($subQuery) {
                            $subQuery->where('approvers_queue', 1)->where('approval_status', 'Unchecked')
                                ->orWhere('approval_status', 'Pending');
                        });
            })->where('status', '!=', 'Published')->get();
            $documents_received = (clone $documents)->where('status', '=', 'Published')->where('receiver_id', Auth::user()->id)->orWhere(function ($query) {
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
            })->whereYear(DB::raw("CONVERT_TZ(created_at, '+00:00', '+07:00')"), $targetYear)->get();
        }

        return response()->json([
            'memos_received' => $memos_received,
            'memos_sent' => $memos_sent,
            'documents_approved' => $documents_approved,
            'documents_pending' => $documents_pending,
            'documents_need_approval' => $documents_need_approval,
            'documents_received' => $documents_received,
        ]);

    }

}
