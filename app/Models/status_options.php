<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status_options extends Model
{
    use HasFactory;
    protected $fillable = ['status'];

    public function client()
    {
        return $this->hasMany(Client::class, 'status_id');
    }
}
