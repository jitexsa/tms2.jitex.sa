<?php

namespace App\Http\Controllers\VehicleManagement;

use App\Models\VehicleMaker;
use Livewire\Component;
use Illuminate\Http\Request;

class Maker extends Component
{

/**
     * form fields
     * @var string[]
     */
    public $make_name, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $maker =  new VehicleMaker();
        $this->rec = $maker->getMaker();
        return view('vehicle-management.maker.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'make_name' => 'required'
         ]);
         try {
            VehicleMaker::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/vehicle/maker'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = VehicleMaker::select('make_name')
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
         'make_name' => 'required'
    ]);

      try {
        VehicleMaker::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
      $this->redirect('/vehicle/maker'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            VehicleMaker::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/vehicle/maker'); 
    }
}

