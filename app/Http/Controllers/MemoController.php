<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MemoController extends Controller
{
    public function create()
    {
        $title = 'Add new Memo';
        $users = User::whereNot('name', Auth::user()->name)->get();

        return view('pages.memos.addMemo', compact('users', 'title'));
    }

    public function store(Request $request)
    {

        $request['signature'] = $request['signature'][0];

        // Validasi data
        $validator = Validator::make($request->all(), [
            'no_doc' => 'nullable|string',
            'subject' => 'required|string',
            'description' => 'nullable|string',
            'lampiran' => 'nullable|string',
            'placeNdate' => 'nullable|string',
            'receivers' => 'array|required',
            'receivers.*' => 'required|exists:users,id',
            'sender' => 'required|exists:users,id',
            'carbonCopy' => 'array|required',
            'carbonCopy.*' => 'required|exists:users,id',
            'signature' => 'required|string'
        ]);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $memo = new Memo();

        $fillableAttributes = ['no_doc', 'subject', 'description', 'placeNdate', 'signature', 'lampiran'];
        foreach ($fillableAttributes as $attribute) {
            if ($request->has($attribute)) {
                $memo->$attribute = $request->$attribute;
            }
        }

        $memo->sender_id = $request->sender;

        if($request->hasFile('document_upload')){
            $path = '';
            foreach($request->file('document_upload') as $file) {
                if($file->getSize() > 10485760){
                    return back()->with('error', 'File is too large')->withInput();
                }
                $currentPath = $file->store('public/documents');
                $path .= $currentPath . ' - '; // Memisahkan path dokumen dengan " - "
                $memo->filename = $file->getClientOriginalName();
            }
            $path = rtrim($path, ' - ');
            $memo->path = $path;
        } else {
            $memo->filename = '-';
            $memo->document_text = $request->document_text;
        }

        $memo->save();
        $memo->tembusan()->sync($request->input('carbonCopy', []));
        $memo->receiver()->sync($request->input('receivers', []));

        return redirect()->route('list-data', 'sent')->with('success', 'Success send a memo.');
    }

    public function show($type, $id)
    {

        try {
            if ($type === 'sent') {
                $title = 'Memo Sent Page';
                $memoQuery = Memo::where('id', $id);

                if (Auth::user()->jabatan == 'ADMIN'){
                    $memo = $memoQuery->first();
                } else {
                    $memo = $memoQuery->where('sender_id', Auth::user()->id)->first();
                }

            } else if ($type === 'receive') {
                $title = 'Memo Receive Page';
                $memoQuery = Memo::where('id', $id);

                if (Auth::user()->jabatan !== 'ADMIN') {
                    $memoQuery->orWhere(function ($query) {
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

                $memo = $memoQuery->first();

            }

            if($memo->subject === 'MEMO INTERN'){
                return view('pages.memos.memo', compact('title', 'memo', 'type'));
            } else if ($memo->subject === 'SURAT TUGAS'){
                return view('pages.memos.surat-tugas', compact('title', 'memo', 'type'));
            } else if ($memo->subject === 'PENGUMUMAN'){
                return view('pages.memos.pengumuman', compact('title', 'memo', 'type'));
            } else {
                abort(404);
            }
        } catch (\Throwable $th) {
            abort(404);
        }

    }

}
