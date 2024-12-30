<?php

namespace App\Http\Controllers\Contractor;

use App\Models\SubContractorDetail as ModelsSubContractorDetail;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubContractorDetail extends Component
{
    /**
     * form fields
     * @var string[]
     */
    public $contractor_id, $fleet_type, $no_of_vehicles, $location, $remarks, $contractor, $rec, $id;
    public $create = false;

    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        if(isset($request->route()->parameters['id'])){
            $contractor_id = $request->route()->parameters['id'];
        }
        else{
            $contractor_id = $this->contractor_id;
        }
            $this->contractor_id = $contractor_id;
            $model = new ModelsSubContractorDetail();
            $this->rec = $model->getSubContractorDetail($contractor_id);
            $this->contractor = getValue('sub_contractors', 'transporter_name', array('id' =>$contractor_id));
        return view('contractor.sub-contractor-detail.index');
    }
/**
      * save workspace
      */
      public function save()
      {
          $validated = $this->validate([
            'fleet_type' => 'required',
            'no_of_vehicles' => 'required',
            'location' => 'required'
          ]);
          try {
             $validated['contractor_id'] = $this->contractor_id;
             $validated['remarks'] = $this->remarks;
             $validated['user_id'] = Auth::user()->id;
             ModelsSubContractorDetail::create($validated);
             session()->flash('success', 'The data has been saved successfully.');
         } catch (\Exception $e) {
             session()->flash('error', $e->getMessage());
         }
             $this->redirect('/subcontractor/detail/'.$this->contractor_id);  
      }
 
 
       /**
        * edit
        */
       function edit($id){
         $this->id = $id;
         $edit = ModelsSubContractorDetail::where('id', $id)->first()->toArray();
          foreach($edit as $key => $v){
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
        'fleet_type' => 'required',
        'no_of_vehicles' => 'required',
        'location' => 'required'
      ]);
      try {
         $validated['contractor_id'] = $this->contractor_id;
         $validated['remarks'] = $this->remarks;
         $validated['user_id'] = Auth::user()->id;
         ModelsSubContractorDetail::whereId($this->id)->update($validated);
         session()->flash('success', 'The data has been updated successfully.');
     } catch (\Exception $e) {
         session()->flash('error',  $e->getMessage());
     }
        $this->redirect('/subcontractor/detail/'.$this->contractor_id);  
    }
 
       /**
      * delete specific data from the listing
      * @param mixed $id
      * @return void
      */
     public function delete($id, $contractor_id)
     {
         try{
            ModelsSubContractorDetail::find($id)->delete();
             session()->flash('success',"The selected data has been deleted successfully!!");
         }catch(\Exception $e){
             session()->flash('error', $e->getMessage());
         }
         $this->redirect('/subcontractor/detail/'.$contractor_id); 
     }
 }
