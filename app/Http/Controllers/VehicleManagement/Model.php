<?php

namespace App\Http\Controllers\VehicleManagement;

use App\Models\VehicleModel;
use Livewire\Component;
use Illuminate\Http\Request;

class Model extends Component
{
   /**
     * form fields
     * @var string[]
     */
    public $make_id, $model_name, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model = new VehicleModel();
        $this->rec = $model->getModels();
        return view('vehicle-management.model.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'make_id' => 'required',
             'model_name' => 'required'
         ]);
         try {
            VehicleModel::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/vehicle/model'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = VehicleModel::select('make_id', 'model_name')
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
         'make_id' => 'required',
         'model_name' => 'required'
    ]);

      try {
        VehicleModel::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
      $this->redirect('/vehicle/model'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            VehicleModel::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/vehicle/model'); 
    }
}

