<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',       // Tindakan yang dilakukan (create, update, delete)
        'model_type',   // Tipe model yang terlibat
        'model_name',     // ID dari model yang terlibat
        'user_name',
        'changes'      // ID pengguna yang melakukan tindakan
    ];

    // Relasi ke model User (untuk mencatat siapa yang melakukan tindakan)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_name', 'name');
    }
}
