<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = ['judul_buku', 'autor_buku', 'tanggal_terbit_buku', 'member_id'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class, 'buku_kategori', 'buku_id', 'kategori_id');
    }
}
