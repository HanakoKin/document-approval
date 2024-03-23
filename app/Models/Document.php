<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relasi dengan penerima
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Relasi dengan persetujuan dokumen
    public function approvals()
    {
        return $this->hasMany(DocumentApproval::class, 'doc_id');
    }

    // Relasi dengan persyaratan persetujuan dokumen
    public function requirement()
    {
        return $this->hasOne(DocumentApprovalRequirement::class, 'doc_id');
    }
}
