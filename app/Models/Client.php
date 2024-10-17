<?php

namespace App\Models;

use App\Events\RecordHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tanggal',
        'jenis_id',
        'kebutuhan',
        'no_telp',
        'alamat',
        'sumber',
        'keterangan',
        'status_id',
        'user_name'
    ];

    public function jenis()
    {
        return $this->belongsTo(jenis_options::class, 'jenis_id');
    }

    public function status()
    {
        return $this->belongsTo(status_options::class, 'status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_name');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($client) {
            event(new RecordHistory('created', self::class, $client->id, Auth::id()));
        });

        static::updated(function ($client) {
            event(new RecordHistory('updated', self::class, $client->id, Auth::id()));
        });

        static::deleted(function ($client) {
            event(new RecordHistory('deleted', self::class, $client->id, Auth::id()));
        });
    }
}
