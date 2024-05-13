<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
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
        return $this->belongsToMany(User::class, 'memo_receiver');
    }

    public function tembusan()
    {
        return $this->belongsToMany(User::class, 'tembusan_user');
    }

}
