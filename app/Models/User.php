<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi dengan dokumen yang dikirim
    public function sentDocuments()
    {
        return $this->hasMany(Document::class, 'sender_id');
    }

    // Relasi dengan dokumen yang diterima
    public function receivedDocuments()
    {
        return $this->belongsToMany(Document::class, 'receiver_id');
    }

    // Relasi dengan persetujuan dokumen
    public function documentApprovals()
    {
        return $this->hasMany(DocumentApproval::class, 'approver_id');
    }

    // Relasi dengan persyaratan persetujuan dokumen
    public function approvalRequirements()
    {
        return $this->hasMany(DocumentApprovalRequirement::class, 'approver_id');
    }
}
