<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Models\License as ModelsLicense;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class License extends Component
{

    /**
     * form fields
     * @var string[]
     */
    public $license_name, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $license =  new ModelsLicense();
        $this->rec = $license->getLicense();
        return view('employee-management.license.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'license_name' => 'required'
         ]);
         try {
         $validated['workspace_id'] = Auth::user()->workspace_id;
         ModelsLicense::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/employee/license'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsLicense::select('license_name')
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
         'license_name' => 'required'
    ]);

      try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsLicense::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
      $this->redirect('/employee/license'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsLicense::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/employee/license'); 
    }
}

