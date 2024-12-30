<?php

namespace App\Http\Controllers\TripManagement;

use App\Models\Trip as ModelsTrip;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Trip extends Component
{
    /**
     * form fields
     * @var string[]
     */
    public $trip_date, $job_no, $port, $terminal, $warehouse, $others, $client, $sow_id,
    $request_by, $status, $wessel, $voyage, $awb, $request_date, $contact_person,
    $telephone, $loading_at, $delivery_at, $temperature, $vehicle, $driver, $arrival_time,
    $arrival_date, $loaded_time, $loaded_date, $exit_time, $exit_date, 
    $name_of_receiver, $delivery_time, $delivery_date, $unloaded_time, $unloaded_date,
    $delivery_exit_time, $delivery_exit_date, $labor, $labor_qty, $marks_no, 
    $cargo_desc, $qty, $weight, $remarks, $loading_image, $unloading_image, $waybill_no, $created_by,
    $rec, $id;
    public $i = 1;
    public $additional_detail = [];
    public $create = false;

    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $this->rec = getTrip(array('trips.is_delete' => 0, 'trips.workspace_id' => Auth::user()->workspace_id));
        return view('trip-management.trip.index');
    }
     /**
      * save workspace
      */
      public function save()
      {
          $validated = $this->validate([
              'trip_date' => 'required',
              'job_no' => 'required',
              'client' => 'required',
              'sow_id' => 'required',
              'request_by' => 'required',
              'status' => 'required',
              'request_date' => 'required',
              'contact_person' => 'required',
              'telephone' => 'required',
              'loading_at' => 'required',
              'delivery_at' => 'required',
              'vehicle' => 'required',
              'driver' => 'required'
          ]);
          try {
            
            if(isset($this->labor)) {
                print_r($this->labor);
                die;
                foreach ($this->additional_detail as $key => $v) {

                }
            }     

            $validated['port'] = $this->port;
            $validated['terminal'] = $this->terminal;
            $validated['warehouse'] = $this->warehouse;
            $validated['others'] = $this->others;
            $validated['wessel'] = $this->wessel;
            $validated['voyage'] = $this->voyage;
            $validated['temperature'] = $this->temperature;
            $validated['trip_date'] = ($this->trip_date)?dateFormat($this->trip_date,'datedesc'):'';
            $validated['request_date'] = ($this->request_date)?dateFormat($this->request_date,'datedesc'):'';
            $validated['arrival_time'] = $this->arrival_time;
            $validated['arrival_date'] = ($this->arrival_date)?dateFormat($this->arrival_date,'datedesc'):'';
            $validated['loaded_time'] = $this->loaded_time;
            $validated['loaded_date'] = ($this->loaded_date)?dateFormat($this->loaded_date,'datedesc'):'';
            $validated['exit_time'] = $this->exit_time;
            $validated['exit_date'] = ($this->exit_date)?dateFormat($this->exit_date,'datedesc'):'';
            $validated['name_of_receiver'] = $this->name_of_receiver;
            $validated['delivery_time'] = $this->delivery_time;
            $validated['delivery_date'] = ($this->delivery_date)?dateFormat($this->delivery_date,'datedesc'):'';
            $validated['unloaded_time'] = $this->unloaded_time;
            $validated['unloaded_date'] = ($this->unloaded_date)?dateFormat($this->unloaded_date,'datedesc'):'';
            $validated['delivery_exit_time'] = $this->delivery_exit_time;
            $validated['delivery_exit_date'] = $this->delivery_exit_date;
            $validated['waybill_no'] = tripWaybill();
            $validated['created_by'] = Auth::user()->id;
            $validated['workspace_id'] = Auth::user()->workspace_id;
            ModelsTrip::create($validated);
             session()->flash('success', 'The data has been saved successfully.');
         } catch (\Exception $e) {
             session()->flash('error', $e->getMessage());
         }
          $this->redirect('/trip'); 
      }
 
 
       /**
        * edit
        */
       function edit($id){
         $this->id = $id;
         $edit = ModelsTrip::where('id', $id)->first()->toArray();
          foreach($edit as $key => $v){
            if(in_array($key, ['trip_date', 'request_date', 'arrival_date', 
            'loaded_date', 'exit_date', 'delivery_date', 'unloaded_date', 'delivery_exit_date'])){
               $v = dateFormat($v,'report');
            }
            $this->{$key} = $v;
          }
         $this->create = true;
   }
 
   /**
    * update
    */
   public function update()
   {
            $validated = $this->validate([
                'trip_date' => 'required',
                'job_no' => 'required',
                'client' => 'required',
                'sow_id' => 'required',
                'request_by' => 'required',
                'status' => 'required',
                'request_date' => 'required',
                'contact_person' => 'required',
                'telephone' => 'required',
                'loading_at' => 'required',
                'delivery_at' => 'required',
                'vehicle' => 'required',
                'driver' => 'required'
            ]);
            try {
            $validated['port'] = $this->port;
            $validated['terminal'] = $this->terminal;
            $validated['warehouse'] = $this->warehouse;
            $validated['others'] = $this->others;
            $validated['wessel'] = $this->wessel;
            $validated['voyage'] = $this->voyage;
            $validated['temperature'] = $this->temperature;
            $validated['trip_date'] = ($this->trip_date)?dateFormat($this->trip_date,'datedesc'):'';
            $validated['request_date'] = ($this->request_date)?dateFormat($this->request_date,'datedesc'):'';
            $validated['arrival_time'] = $this->arrival_time;
            $validated['arrival_date'] = ($this->arrival_date)?dateFormat($this->arrival_date,'datedesc'):'';
            $validated['loaded_time'] = $this->loaded_time;
            $validated['loaded_date'] = ($this->loaded_date)?dateFormat($this->loaded_date,'datedesc'):'';
            $validated['exit_time'] = $this->exit_time;
            $validated['exit_date'] = ($this->exit_date)?dateFormat($this->exit_date,'datedesc'):'';
            $validated['name_of_receiver'] = $this->name_of_receiver;
            $validated['delivery_time'] = $this->delivery_time;
            $validated['delivery_date'] = ($this->delivery_date)?dateFormat($this->delivery_date,'datedesc'):'';
            $validated['unloaded_time'] = $this->unloaded_time;
            $validated['unloaded_date'] = ($this->unloaded_date)?dateFormat($this->unloaded_date,'datedesc'):'';
            $validated['delivery_exit_time'] = $this->delivery_exit_time;
            $validated['delivery_exit_date'] = $this->delivery_exit_date;
            $validated['workspace_id'] = Auth::user()->workspace_id;
            ModelsTrip::whereId($this->id)->update($validated);
            session()->flash('success', 'The data has been updated successfully.');
     } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
     }
        $this->redirect('/trip'); 
   }
 
       /**
      * delete specific data from the listing
      * @param mixed $id
      * @return void
      */
     public function delete($id)
     {
         try{
            ModelsTrip::find($id)->delete();
             session()->flash('success',"The selected data has been deleted successfully!!");
         }catch(\Exception $e){
             session()->flash('error', $e->getMessage());
         }
         $this->redirect('/trip'); 
     }

     function addRow($i){
        $i = $i + 1;
        $this->i = $i;
        array_push($this->additional_detail ,$i);
     }

     public function removeRow($i)
    {
        unset($this->additional_detail[$i]);
    }
}
