<?php

namespace App\Http\Controllers\Fuel;

use App\Models\FuelType as ModelsFuelType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use Livewire\Component;

class FuelType extends Component
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
        $model = new ModelsFuelType();
        $this->rec = $model->getFuelType();
        return view('fuel.type.index');
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
            ModelsFuelType::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
            $this->redirect('/fuel/fuel-type');  
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsFuelType::select('type_name')
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
        ModelsFuelType::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error',  $e->getMessage());
    }
        $this->redirect('/fuel/fuel-type'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsFuelType::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/fuel/fuel-type'); 
    }
}

