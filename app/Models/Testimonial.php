<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    // sesuaikan fillable dengan kolom di DB
    protected $fillable = [
        'name',
        'email',
        'rating',
        'content',     // kolom lama yang sudah ada (sebelumnya 'content')
        'photo',
        'published_at',
        'status',
    ];

    // kalau kamu mau, helper untuk menampilkan snippet teks
    public function getShortContentAttribute()
    {
        return \Illuminate\Support\Str::limit($this->content, 80);
    }
}
