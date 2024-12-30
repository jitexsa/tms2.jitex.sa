<?php

namespace App\Http\Controllers\VehicleManagement;

use App\Models\VehicleLeasing as ModelsVehicleLeasing;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleLeasing extends Component
{
     /**
     * form fields
     * @var string[]
     */
    public $customer_id, $company, $lease_type, $vehicle, $start_date, $end_date, $attachments,
    $vehicles, $rec, $id;
    public $create = false;

    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $this->end_date = $this->start_date = date('d-m-Y');
        $model = new ModelsVehicleLeasing();
        $this->rec = $model->getVehicleLeasing();
        return view('vehicle-management.leasing.index');
    }
    
    /**
      * save workspace
      */
      public function save()
      {
          $validated = $this->validate([
                'customer_id' => 'required',
                'company' => 'required',
                'vehicle' => 'required',
                'lease_type' => 'required',
                'start_date' => 'required',
                'end_date' => 'required'
          ]);
          try {
            $validated['start_date'] = dateFormat($this->start_date,'datedesc');
            $validated['end_date'] = dateFormat($this->end_date,'datedesc');
            $validated['attachments'] = $this->attachments;
            $validated['workspace_id'] = Auth::user()->workspace_id;
            ModelsVehicleLeasing::create($validated);
             session()->flash('success', 'The data has been saved successfully.');
         } catch (\Exception $e) {
             session()->flash('error', $e->getMessage());
         }
          $this->redirect('/vehicle/leasing'); 
      }
 
 
       /**
        * edit
        */
       function edit($id){
         $this->id = $id;
         $edit = ModelsVehicleLeasing::where('id', $id)->first()->toArray();
          foreach($edit as $key => $v){
            if(in_array($key, ['start_date', 'end_date'])){
               $v = dateFormat($v,'report');
            }
            $this->{$key} = $v;
          }
          $this->vehicles = getCompanyVehicles(Auth::user()->workspace_id, $this->vehicle);
         $this->create = true;
   }
 
   /**
    * update
    */
   public function update()
   {
 
    $validated = $this->validate([
        'customer_id' => 'required',
        'company' => 'required',
        'vehicle' => 'required',
        'lease_type' => 'required',
        'start_date' => 'required',
        'end_date' => 'required'
    ]);
    try {
        $validated['start_date'] = dateFormat($this->start_date,'datedesc');
        $validated['end_date'] = dateFormat($this->end_date,'datedesc');
        $validated['attachments'] = $this->attachments;
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsVehicleLeasing::whereId($this->id)->update($validated);
         session()->flash('success', 'The data has been updated successfully.');
     } catch (\Exception $e) {
         session()->flash('error', $e->getMessage());
     }
       $this->redirect('/vehicle/leasing'); 
   }
 
       /**
      * delete specific data from the listing
      * @param mixed $id
      * @return void
      */
     public function delete($id)
     {
         try{
            ModelsVehicleLeasing::find($id)->delete();
             session()->flash('success',"The selected data has been deleted successfully!!");
         }catch(\Exception $e){
             session()->flash('error', $e->getMessage());
         }
         $this->redirect('/vehicle/leasing'); 
     }
 }