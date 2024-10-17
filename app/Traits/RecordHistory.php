<?php

namespace App\Traits;

use App\Events\RecordHistory;
use Illuminate\Support\Facades\Auth;

trait RecordsHistory
{
    protected static function bootRecordsHistory()
    {
        // Event saat model dibuat
        static::created(function ($model) {
            event(new RecordHistory('created', get_class($model), $model->id, Auth::id()));
        });

        // Event saat model diperbarui
        static::updated(function ($model) {
            event(new RecordHistory('updated', get_class($model), $model->id, Auth::id()));
        });

        // Event saat model dihapus
        static::deleted(function ($model) {
            event(new RecordHistory('deleted', get_class($model), $model->id, Auth::id()));
        });
    }
}
