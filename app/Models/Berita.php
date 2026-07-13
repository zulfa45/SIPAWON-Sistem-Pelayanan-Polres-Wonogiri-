<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'kategori_berita_id',
        'user_id',
        'judul',
        'slug',
        'ringkasan',
        'isi',
        'thumbnail',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
