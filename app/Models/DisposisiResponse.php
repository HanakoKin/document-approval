<?php

namespace App\Models;

use App\Models\User;
use App\Models\Disposisi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DisposisiResponse extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function disposisi()
    {
        return $this->belongsTo(Disposisi::class, 'disposisi_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'response_sender');
    }


}
