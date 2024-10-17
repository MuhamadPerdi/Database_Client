<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_options extends Model
{
    use HasFactory;
    protected $fillable = ['jenis'];

    public function client()
    {
        return $this->hasMany(Client::class, 'jenis_id');
    }
}
