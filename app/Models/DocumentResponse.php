<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentResponse extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi dengan dokumen
    public function document()
    {
        return $this->belongsTo(Document::class, 'doc_id');
    }

}
