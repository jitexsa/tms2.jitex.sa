<?php

namespace App\Http\Controllers\SystemSetting;

use App\Models\Vehicle;
use Livewire\Component;

class VehicleSync extends Component
{
    public $rec;

    public function render()
    {
        $model = new Vehicle();
        $this->rec = $model->vehicleSync();
        return view('system-setting.vehicle-sync.view');
    }
}
