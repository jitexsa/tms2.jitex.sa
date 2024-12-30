<?php

namespace App\Http\Controllers\SystemSetting;

use App\Models\Log;
use Livewire\Component;

class SystemLog extends Component
{
    public $log_type, $log_type_id, $action, $log_content, $rec;

    public function render()
    {
        $model = new Log();
        $this->rec = $model->getLogs();
        return view('system-setting.logs.index');
    }
}
