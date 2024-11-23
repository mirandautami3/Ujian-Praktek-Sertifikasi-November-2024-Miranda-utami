<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';

    protected $fillable = ['nama_member', 'no_telepon', 'tanggal_bergabung'];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'member_id');
    }
}
