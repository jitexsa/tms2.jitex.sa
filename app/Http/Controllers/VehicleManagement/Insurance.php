<?php

namespace App\Http\Controllers\VehicleManagement;

use App\Models\Insurance as ModelsInsurance;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Insurance extends Component
{
    
 /**
     * form fields
     * @var string[]
     */
    public $company, $vehicle, $recurring_period, $recurring_date, $start_date, $end_date, $policy_number,
    $policy_document, $rec, $id;
    public $create = false;

    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model = new ModelsInsurance();
        $this->rec = $model->getInsurance();
        return view('vehicle-management.insurance.index');
    }

    /**
      * save workspace
      */
      public function save()
      {
          $validated = $this->validate([
              'company' => 'required',
              'vehicle' => 'required',
              'recurring_period' => 'required',
              'recurring_date' => 'required',
              'start_date' => 'required',
              'end_date' => 'required',
              'policy_number' => 'required'
          ]);
          try {
            $validated['recurring_date'] = dateFormat($this->recurring_date,'datedesc');
            $validated['start_date'] = dateFormat($this->start_date,'datedesc');
            $validated['end_date'] = dateFormat($this->end_date,'datedesc');
            $validated['policy_document'] = $this->policy_document;
            $validated['workspace_id'] = Auth::user()->workspace_id;
            ModelsInsurance::create($validated);
             session()->flash('success', 'The data has been saved successfully.');
         } catch (\Exception $e) {
             session()->flash('error', $e->getMessage());
         }
          $this->redirect('/vehicle/insurance'); 
      }
 
 
       /**
        * edit
        */
       function edit($id){
         $this->id = $id;
         $edit = ModelsInsurance::where('id', $id)->first()->toArray();
          foreach($edit as $key => $v){
            if(in_array($key, ['recurring_date', 'start_date', 'end_date'])){
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
        'company' => 'required',
        'vehicle' => 'required',
        'recurring_period' => 'required',
        'recurring_date' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'policy_number' => 'required'
    ]);
    try {
        $validated['recurring_date'] = dateFormat($this->recurring_date,'datedesc');
        $validated['start_date'] = dateFormat($this->start_date,'datedesc');
        $validated['end_date'] = dateFormat($this->end_date,'datedesc');
        $validated['policy_document'] = $this->policy_document;
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsInsurance::whereId($this->id)->update($validated);
         session()->flash('success', 'The data has been updated successfully.');
     } catch (\Exception $e) {
         session()->flash('error', $e->getMessage());
     }
       $this->redirect('/vehicle/insurance'); 
   }
 
       /**
      * delete specific data from the listing
      * @param mixed $id
      * @return void
      */
     public function delete($id)
     {
         try{
            ModelsInsurance::find($id)->delete();
             session()->flash('success',"The selected data has been deleted successfully!!");
         }catch(\Exception $e){
             session()->flash('error', $e->getMessage());
         }
         $this->redirect('/vehicle/insurance'); 
     }
 } 
