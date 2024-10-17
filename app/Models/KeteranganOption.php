<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganOption extends Model
{
    use HasFactory;
    protected $table = 'keterangan_options';

    protected $fillable = ['name'];
    public function monitoring()
    {
        return $this->hasMany(Monitoring::class, 'keterangan_id');
    }
}
