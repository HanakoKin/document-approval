<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Memo;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function previewData($dataType, $dataId) {
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

    public function filterData($category, $dataType){

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
                $result = Document::select('id', 'no_doc', 'subject', 'description', 'placeNdate', 'filename', 'document_text', 'path', 'sender_id', 'receiver_id', DB::raw('created_at AS newest_time'), DB::raw('"documents" AS source'))->where('status', 'Approved');

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

}
