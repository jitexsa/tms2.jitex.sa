<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Models\Department as ModelsDepartment;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Department extends Component
{

     /**
     * form fields
     * @var string[]
     */
    public $department_name, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $position =  new ModelsDepartment();
        $this->rec = $position->getDepartment();
        return view('employee-management.department.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'department_name' => 'required'
         ]);
         try {
         $validated['workspace_id'] = Auth::user()->workspace_id;
         ModelsDepartment::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/employee/department'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsDepartment::select('department_name')
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
         'department_name' => 'required'
    ]);

      try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsDepartment::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
      $this->redirect('/employee/department'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsDepartment::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/employee/department'); 
    }
}
