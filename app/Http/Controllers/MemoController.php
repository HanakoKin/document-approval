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
    public function index($category)
    {

        $type = $category;

        if ($category === 'receive') {

            $title = 'All Received Memos';

            if (Auth::user()->jabatan === 'ADMIN') {
                $memos = Memo::all();
            } else {
                $memos = Memo::where('status', 'Approved')->whereHas('approvals', function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('receiver_id', Auth::user()->id);
                    });
                })->get();
            }
        } else if ($category === 'sent') {

            $title = 'All Sent Memos';

            if (Auth::user()->jabatan === 'ADMIN') {
                $memos = Memo::all();
            } else {
                $memos = Memo::whereHas('approvals', function ($query) {
                    $query->where(function ($subQuery) {
                        $subQuery->where('sender_id', Auth::user()->id);
                    });
                })->get();
            }
        }

        $totals = $memos->count();

        return view('pages.memos.memo-list', compact('title', 'memos', 'totals', 'category', 'type'));
    }

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
            'no_doc' => 'nullable|unique:memos|string',
            'subject' => 'required|string',
            'description' => 'nullable|string',
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

            // Menghapus spasi ekstra dan tanda "-" dari akhir path
            $path = rtrim($path, ' - ');

            $memo->path = $path;

        } else {

            $memo->filename = '-';
            $memo->document_text = $request->document_text;

        }

        if($request->has('no_doc')){
            $memo->no_doc = $request->no_doc;
        }

        if($request->has('description')){
            $memo->description = $request->description;
        }

        if($request->has('placeNdate')){
            $memo->placeNdate = $request->placeNdate;
        }

        if($request->has('lampiran')){
            $memo->lampiran = $request->lampiran;
        }

        // Simpan dokumen
        $memo->subject = $request->subject;
        $memo->signature = $request->signature;
        $memo->sender_id = $request->sender;
        $memo->save();

        // Simpan tembusan
        $tembusan = $request->input('carbonCopy', []);
        $memo->tembusan()->sync($tembusan);

        // Simpan penerima
        $receivers = $request->input('receivers', []);
        $memo->receiver()->sync($receivers);

        // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
        return redirect()->route('show', 'sent')->with('success', 'Success send a memo.');
    }

    public function show($type, $id)
    {

        if ($type === 'sent') {

            $title = 'Memo Sent Page';

            $memo = Memo::find($id);

        } else if ($type === 'receive') {

            $title = 'Memo Receive Page';

            $memo = Memo::find($id);

        }

        // dd($memo->subject);

        if($memo->subject === 'MEMO INTERN'){
            return view('pages.memos.memo', compact('title', 'memo', 'type'));
        } else if ($memo->subject === 'SURAT TUGAS'){
            return view('pages.memos.surat-tugas', compact('title', 'memo', 'type'));
        } else if ($memo->subject === 'PENGUMUMAN'){
            return view('pages.memos.pengumuman', compact('title', 'memo', 'type'));
        } else {
            abort(404);
        }

    }

}
