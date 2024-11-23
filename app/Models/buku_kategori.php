<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BukuKategori extends Model
{
    use HasFactory;
    
    protected $table = 'buku_kategori';
    protected $fillable = ['buku_id', 'kategori_id'];
}
