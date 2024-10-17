<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;
    protected $table = 'monitorings';
    protected $casts = [
        'mulai' => 'datetime',
        'selesai' => 'datetime',
    ];
    protected $fillable = [
        'name', 'projek_id', 'bidang', 'mulai', 'selesai', 'domain', 'keterangan_id','user_name'
    ];

    public function projek()
    {
        return $this->belongsTo(ProjekOption::class, 'projek_id');
    }

    public function keterangan()
    {
        return $this->belongsTo(KeteranganOption::class, 'keterangan_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_name');
    }
}
