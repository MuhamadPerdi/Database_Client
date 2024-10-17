<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class RecordHistory
{
    use Dispatchable, SerializesModels;

    public $action;
    public $modelType;
    public $modelId;
    public $userId;

    public function __construct($action, $modelType, $modelId, $userId)
    {
        $this->action = $action;
        $this->modelType = $modelType;
        $this->modelId = $modelId;
        $this->userId = $userId;
    }
}
