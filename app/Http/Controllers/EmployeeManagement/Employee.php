<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Models\Employee as ModelsEmployee;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Employee extends Component
{
      /**
     * form fields
     * @var string[]
     */
    public $emp_name, $payroll_type, $department, $designation, $emp_nid, $emp_phone, $emp_email,
    $join_date, $dob, $location, $picture, $isactive, $address, $rec, $id;
    public $create = false;

    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model = new ModelsEmployee();
        $this->rec = $model->getEmployee();
        return view('employee-management.employee.index');
    }
/**
      * save workspace
      */
      public function save()
      {
          $validated = $this->validate([
              'emp_name' => 'required',
              'emp_email' => 'required',
              'dob' => 'required',
              'emp_nid' => 'required',
              'emp_phone' => 'required',
              'isactive' => 'required',
              'department' => 'required',
              'designation' => 'required',
              'payroll_type' => 'required',
              'join_date' => 'required'
          ]);
          try {
            $validated['join_date'] = dateFormat($this->join_date,'datedesc');
            $validated['dob'] = dateFormat($this->dob,'datedesc');
            $validated['location'] = $this->location;
            $validated['address'] = $this->address;
            $validated['workspace_id'] = Auth::user()->workspace_id;
            ModelsEmployee::create($validated);
             session()->flash('success', 'The data has been saved successfully.');
         } catch (\Exception $e) {
             session()->flash('error', $e->getMessage());
         }
          $this->redirect('/employee'); 
      }
 
 
       /**
        * edit
        */
       function edit($id){
         $this->id = $id;
         $edit = ModelsEmployee::where('id', $id)->first()->toArray();
          foreach($edit as $key => $v){
            if(in_array($key, ['dob', 'join_date'])){
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
            'emp_name' => 'required',
            'emp_email' => 'required',
            'dob' => 'required',
            'emp_nid' => 'required',
            'emp_phone' => 'required',
            'isactive' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'payroll_type' => 'required',
            'join_date' => 'required'
        ]);
        try {
        $validated['join_date'] = dateFormat($this->join_date,'datedesc');
        $validated['dob'] = dateFormat($this->dob,'datedesc');
        $validated['location'] = $this->location;
        $validated['address'] = $this->address;
        $validated['workspace_id'] = Auth::user()->workspace_id;
         ModelsEmployee::whereId($this->id)->update($validated);
         session()->flash('success', 'The data has been updated successfully.');
     } catch (\Exception $e) {
         session()->flash('error', $e->getMessage());
     }
       $this->redirect('/employee'); 
   }
 
       /**
      * delete specific data from the listing
      * @param mixed $id
      * @return void
      */
     public function delete($id)
     {
         try{
            ModelsEmployee::find($id)->delete();
             session()->flash('success',"The selected data has been deleted successfully!!");
         }catch(\Exception $e){
             session()->flash('error', $e->getMessage());
         }
         $this->redirect('/employee'); 
     }
 } 
