<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class configurasi extends Model
{
    use HasFactory;
    
    protected $table = 'configurasis'; // Nama tabel

    protected $fillable = [
        'title',
        'logo',
        'favicon',
        'email',
        'email2',
        'phone',
        'alamat',
        'map',
        'footer',
        'instagram',
        'facebook',
        'twitter',
        'youtube',
        'whatsapp',
        'linkedin',
        'overview',
        'metakeyword',
        'metadeskripsi',
    ];
}
