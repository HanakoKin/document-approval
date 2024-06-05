<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\DisposisiResponse;
use App\Models\Document;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function disposition(Request $request)
    {
        $disposisi = new Disposisi();

        $fillableAttributes = ['doc_id', 'sender_id', 'receiver_id', 'disposisi'];
        foreach ($fillableAttributes as $attribute) {
            if ($request->has($attribute)) {
                $disposisi->$attribute = $request->$attribute;
            }
        }

        $disposisi->save();
        return to_route('document.show', ['type' => 'disposisi', 'id' => $request->doc_id]);
    }

    public function response(Request $request, $id)
    {
        $disposisi = new DisposisiResponse();
        $disposisi->disposisi_id = $id;
        $disposisi->response_sender = auth()->user()->id;
        $disposisi->response = $request->response;
        $disposisi->save();

        return back();
    }

    public function publish($id)
    {

        $document = Document::where('id', $id)->first();

        foreach ($document->approvals as $approval) {
            if ($approval->approval_status === 'Approved') {
                $document_status = 'Approved'; // Jika semua approver sudah approve
            } else {
                $document_status = 'Pending'; // Jika ada approver yang belum approve
            }
        }

        if ($document_status === 'Approved' && $document->requirement->required_approvers === 0) {
            $document->update([
               'status' => 'Published',
            ]);
        } else {
            $document->update([
               'status' => 'Approved',
            ]);
        }

        return to_route('list-data', 'disposisi')->with('success', 'Document is ' . $document->status);
    }


}
