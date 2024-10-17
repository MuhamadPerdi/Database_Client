<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjekOption extends Model
{
    use HasFactory;
    protected $table = 'projek_options';
    protected $fillable = ['name'];

    public function monitoring()
    {
        return $this->hasMany(Monitoring::class, 'projek_id');
    }
}
