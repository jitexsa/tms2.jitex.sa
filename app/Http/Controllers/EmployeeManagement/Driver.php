<?php

namespace App\Http\Controllers\EmployeeManagement;

use App\Models\Driver as ModelsDriver;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Driver extends Component
{
 /**
     * form fields
     * @var string[]
     */
    public $driver_name, $mobile, $passport_no, $passport_expiry, $nationality, $location, $picture,
    $join_date, $company, $status, $division, $workspace_id, $subcontractor, $port_id_number,
    $port_id_end_date, $port_attachment, $national_id, $iqama_expiry_date, $iqama_image, $license_type,
    $license_number, $license_expiry_date, $license_issue_date, $license_image, $rec, $id;
    public $create = false;

    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model = new ModelsDriver();
        $this->rec = $model->getDriver();
        return view('employee-management.driver.index');
    }

    /**
      * save driver
      */
      public function save()
      {
          $workspace_id = ($this->workspace_id)?$this->workspace_id:Auth::user()->workspace_id;
          $validated = $this->validate([
              'driver_name' => 'required',
              'mobile' => 'required',
              'company' => 'required',
              'division' => 'required',
              'license_number' => ['required', Rule::unique('drivers')->where(function ($query) use($workspace_id) {
                $query->where('license_number', $this->license_number)
                   ->where('workspace_id', $workspace_id);
            })]
          ]);
          try {
            $validated['status'] = $this->status;
            $validated['passport_no'] = $this->passport_no;
            $validated['company'] = $this->company;
            $validated['picture'] = $this->picture;
            $validated['subcontractor'] = $this->subcontractor;
            $validated['port_id_number'] = $this->port_id_number;
            $validated['port_attachment'] = $this->port_attachment;
            $validated['national_id'] = $this->national_id;
            $validated['iqama_image'] = $this->iqama_image;
            $validated['license_type'] = $this->license_type;
            $validated['license_image'] = $this->license_image;
            $validated['license_expiry_date'] = ($this->license_expiry_date)?dateFormat($this->license_expiry_date,'datedesc'):'';
            $validated['license_issue_date'] = ($this->license_issue_date)?dateFormat($this->license_issue_date,'datedesc'):'';
            $validated['join_date'] = ($this->join_date)?dateFormat($this->join_date,'datedesc'):'';
            $validated['passport_expiry'] = ($this->passport_expiry)?dateFormat($this->passport_expiry,'datedesc'):'';
            $validated['port_id_end_date'] = ($this->port_id_end_date)?dateFormat($this->port_id_end_date,'datedesc'):'';
            $validated['iqama_expiry_date'] = ($this->iqama_expiry_date)?dateFormat($this->iqama_expiry_date,'datedesc'):'';
            $validated['location'] = $this->location;
            $validated['nationality'] = $this->nationality;
            $validated['workspace_id'] = $workspace_id;
            ModelsDriver::create($validated);
             session()->flash('success', 'The data has been saved successfully.');
         } catch (\Exception $e) {
             session()->flash('error', $e->getMessage());
         }
          $this->redirect('/employee/driver'); 
      }
 
 
       /**
        * edit
        */
       function edit($id){
         $this->id = $id;
         $edit = ModelsDriver::where('id', $id)->first()->toArray();
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
        $workspace_id = ($this->workspace_id)?$this->workspace_id:Auth::user()->workspace_id;
        $validated = $this->validate([
            'driver_name' => 'required',
            'mobile' => 'required',
            'company' => 'required',
            'division' => 'required',
            'license_number' => ['required', Rule::unique('drivers')->where(function ($query) use($workspace_id) {
                $query->where('license_number', $this->license_number)
                   ->where('workspace_id', $workspace_id);
            })->ignore($this->id)]
        ]);
        try {
            $validated['status'] = $this->status;
            $validated['passport_no'] = $this->passport_no;
            $validated['company'] = $this->company;
            $validated['picture'] = $this->picture;
            $validated['subcontractor'] = $this->subcontractor;
            $validated['port_id_number'] = $this->port_id_number;
            $validated['port_attachment'] = $this->port_attachment;
            $validated['national_id'] = $this->national_id;
            $validated['iqama_image'] = $this->iqama_image;
            $validated['license_type'] = $this->license_type;
            $validated['license_image'] = $this->license_image;
            $validated['license_expiry_date'] = ($this->license_expiry_date)?dateFormat($this->license_expiry_date,'datedesc'):'';
            $validated['license_issue_date'] = ($this->license_issue_date)?dateFormat($this->license_issue_date,'datedesc'):'';
            $validated['join_date'] = ($this->join_date)?dateFormat($this->join_date,'datedesc'):'';
            $validated['passport_expiry'] = ($this->passport_expiry)?dateFormat($this->passport_expiry,'datedesc'):'';
            $validated['port_id_end_date'] = ($this->port_id_end_date)?dateFormat($this->port_id_end_date,'datedesc'):'';
            $validated['iqama_expiry_date'] = ($this->iqama_expiry_date)?dateFormat($this->iqama_expiry_date,'datedesc'):'';
            $validated['location'] = $this->location;
            $validated['nationality'] = $this->nationality;
            $validated['workspace_id'] = $workspace_id;
            ModelsDriver::whereId($this->id)->update($validated);
            session()->flash('success', 'The data has been updated successfully.');
     } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
     }
        $this->redirect('/employee/driver'); 
   }
 
       /**
      * delete specific data from the listing
      * @param mixed $id
      * @return void
      */
     public function delete($id)
     {
         try{
            ModelsDriver::find($id)->delete();
             session()->flash('success',"The selected data has been deleted successfully!!");
         }catch(\Exception $e){
             session()->flash('error', $e->getMessage());
         }
         $this->redirect('/employee/driver'); 
     }
 } 