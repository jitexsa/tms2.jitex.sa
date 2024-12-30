<?php

namespace App\Http\Controllers\TripManagement;

use App\Models\AdditionalRequirements as ModelsAdditionalRequirements;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdditionalRequirements extends Component
{
   
/**
     * form fields
     * @var string[]
     */
    public $name, $labor_type, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $data =  new ModelsAdditionalRequirements();
        $this->rec = $data->getData();
        return view('trip-management.additional-requirements.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
            'name' => 'required',
            'labor_type' => 'required'
         ]);
         try {
         $validated['workspace_id'] = Auth::user()->workspace_id;
         ModelsAdditionalRequirements::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/trip/additional-requirements'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsAdditionalRequirements::select('name', 'labor_type')
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
         'name' => 'required',
         'labor_type' => 'required'
    ]);

      try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsAdditionalRequirements::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
      $this->redirect('/trip/additional-requirements'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsAdditionalRequirements::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/trip/additional-requirements'); 
    }
}