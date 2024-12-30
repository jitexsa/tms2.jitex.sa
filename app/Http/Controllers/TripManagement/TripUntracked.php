<?php

namespace App\Http\Controllers\TripManagement;

use App\Models\Trip;
use Livewire\Component;

class TripUntracked extends Component
{
    public $rec;
    public function render()
    {
        $model = new Trip();
        $this->rec = $model->unTrackTrip();
        return view('trip-management.trip.trip-untracked');
    }
}
