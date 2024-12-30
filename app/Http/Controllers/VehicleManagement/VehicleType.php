<?php

namespace App\Http\Controllers\VehicleManagement;

use App\Models\VehicleType as ModelsVehicleType;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleType extends Component
{
   
/**
     * form fields
     * @var string[]
     */
    public $type_name, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $vehicle_type =  new ModelsVehicleType();
        $this->rec = $vehicle_type->getVehicleType();
        return view('vehicle-management.type.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'type_name' => 'required'
         ]);
         try {
            $validated['workspace_id'] = Auth::user()->workspace_id;
            ModelsVehicleType::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/vehicle/type'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsVehicleType::select('type_name')
         ->where('id', $id)->first()->toArray();
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
         'type_name' => 'required'
    ]);

      try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsVehicleType::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
      $this->redirect('/vehicle/type'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsVehicleType::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/vehicle/type'); 
    }
}
