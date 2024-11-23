<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = ['nama_kategori'];

    public function buku()
    {
        return $this->belongsToMany(Buku::class, 'buku_kategori', 'kategori_id', 'buku_id');
    }
}
