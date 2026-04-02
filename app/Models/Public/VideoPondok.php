<?php

namespace App\Models\Public;

use Illuminate\Database\Eloquent\Model;

class VideoPondok extends Model
{
    protected $table = 'video_pondok';

    protected $fillable = [
        'judul',
        'deskripsi',
        'thumbnail',
        'link_yt'
    ];
}