<?php

namespace App\Http\Controllers\TripManagement;

use App\Models\Trip;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TripArchive extends Component
{
    public $rec;
    public function render()
    {
        $this->rec = getTrip(array('trips.is_delete' => 1, 'trips.workspace_id' => Auth::user()->workspace_id));
        return view('trip-management.trip.trip-archive');
    }

    /**
     * restore trip
     */
    function restore($id){
        try {
            $postData = array(
                'is_delete' => 0
            );
            Trip::whereId($id)->update($postData);
            session()->flash('success', 'The data has been restored successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
          $this->redirect('/trip/archive');
    }

     /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            Trip::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/trip/archive'); 
    }
}
