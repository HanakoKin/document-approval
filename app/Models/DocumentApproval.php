<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentApproval extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi dengan dokumen
    public function document()
    {
        return $this->belongsTo(Document::class, 'doc_id');
    }

    // Relasi dengan pemberi persetujuan (user)
    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
