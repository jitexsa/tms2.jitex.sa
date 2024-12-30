<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Models\Position as ModelsPosition;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Position extends Component
{
     /**
     * form fields
     * @var string[]
     */
    public $position_name, $position_details, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $position =  new ModelsPosition();
        $this->rec = $position->getPosition();
        return view('employee-management.position.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'position_name' => 'required',
             'position_details' => 'required'
         ]);
         try {
         $validated['workspace_id'] = Auth::user()->workspace_id;
         ModelsPosition::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/employee/position'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsPosition::select('position_name', 'position_details')
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
         'position_name' => 'required',
         'position_details' => 'required'
    ]);

      try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsPosition::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
      $this->redirect('/employee/position'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsPosition::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/employee/position'); 
    }
}
