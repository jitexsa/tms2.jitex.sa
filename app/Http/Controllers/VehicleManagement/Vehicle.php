<?php

namespace App\Http\Controllers\VehicleManagement;

use App\Models\Vehicle as ModelsVehicle;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Vehicle extends Component
{
     /**
     * form fields
     * @var string[]
     */
    public $licence_plate_no, $plate_no, $plate_alphabet, $vehicle_color, $vehicle_make, $model_year, $chassis_no, $subcontractor,
    $country_of_origin, $service_start_date, $driver_id, $truck_sketch, $display_name, $vehicle_type,
    $vehicle_model, $vehicle_registration, $registration_date, $workspace_id, $registration_expiry_date, $division, $sequence_no,
    $location, $odo, $truck_image, $last_mvpi_date, $mvpi_expiry_date, $mvpi_document, $insurance_start_date,
    $insurance_end_date, $insurance_policy, $insurance_document, $rec, $id;
    public $vehicle_inspection, $vehicle_leasing = '';
    public $create = false;

    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model = new ModelsVehicle();
        $this->rec = $model->getVehicle();
        return view('vehicle-management.vehicle.index');
    }
    
    /**
      * save workspace
      */
      public function save()
      {
          $workspace_id = ($this->workspace_id)?$this->workspace_id:Auth::user()->workspace_id;
          $this->licence_plate_no = $this->plate_no . ' ' . $this->plate_alphabet;
          $validated = $this->validate([
              'subcontractor' => 'required',
              'service_start_date' => 'required',
              'driver_id' => 'required',
              'vehicle_type' => 'required',
              'division' => 'required',
              'licence_plate_no' => ['required', Rule::unique('vehicles')->where(function ($query) use($workspace_id) {
                $query->where('licence_plate_no', $this->licence_plate_no)
                    ->whereRaw("FIND_IN_SET(".$workspace_id.", vehicles.workspace_id)");
            })]
          ]);
          try {
            $validated['licence_plate_no'] = $this->licence_plate_no;
            $validated['vehicle_color'] = $this->vehicle_color;
            $validated['vehicle_make'] = $this->vehicle_make;
            $validated['model_year'] = $this->model_year;
            $validated['chassis_no'] = $this->chassis_no;
            $validated['country_of_origin'] = $this->country_of_origin;
            $validated['truck_sketch'] = $this->truck_sketch;
            $validated['display_name'] = $this->display_name;
            $validated['vehicle_model'] = $this->vehicle_model;
            $validated['service_start_date'] = ($this->service_start_date)?dateFormat($this->service_start_date,'datedesc'):'';
            $validated['vehicle_registration'] = $this->vehicle_registration;
            $validated['registration_date'] = ($this->registration_date)?dateFormat($this->registration_date,'datedesc'):'';
            $validated['registration_expiry_date'] = ($this->registration_expiry_date)?dateFormat($this->registration_expiry_date,'datedesc'):'';
            $validated['sequence_no'] = $this->sequence_no;
            $validated['location'] = $this->location;
            $validated['odo'] = $this->odo;
            $validated['truck_image'] = $this->truck_image;
            $validated['last_mvpi_date'] = ($this->last_mvpi_date)?dateFormat($this->last_mvpi_date,'datedesc'):'';
            $validated['mvpi_expiry_date'] = ($this->mvpi_expiry_date)?dateFormat($this->mvpi_expiry_date,'datedesc'):'';
            $validated['mvpi_document'] = $this->mvpi_document;
            $validated['insurance_start_date'] = ($this->insurance_start_date)?dateFormat($this->insurance_start_date,'datedesc'):'';
            $validated['insurance_end_date'] = ($this->insurance_end_date)?dateFormat($this->insurance_end_date,'datedesc'):'';
            $validated['insurance_policy'] = $this->insurance_policy;
            $validated['insurance_document'] = $this->insurance_document;
            $validated['workspace_id'] = $workspace_id;
            ModelsVehicle::create($validated);
             session()->flash('success', 'The data has been saved successfully.');
         } catch (\Exception $e) {
             session()->flash('error', $e->getMessage());
         }
          $this->redirect('/vehicle'); 
      }
 
 
       /**
        * edit
        */
       function edit($id){
         $this->id = $id;
         $edit = ModelsVehicle::where('id', $id)->first()->toArray();
          foreach($edit as $key => $v){
            if(in_array($key, ['dob', 'join_date'])){
               $v = dateFormat($v,'report');
            }
            if($key == 'licence_plate_no'){
                $this->plate_no = trim(preg_replace("/[A-za-z]/i",'', $v));
                $this->plate_alphabet = trim(preg_replace("/[0-9]/i",'', $v)); 
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
        $this->licence_plate_no = $this->plate_no . ' ' . $this->plate_alphabet;
        $validated = $this->validate([
            'subcontractor' => 'required',
            'service_start_date' => 'required',
            'driver_id' => 'required',
            'vehicle_type' => 'required',
            'division' => 'required',
            'licence_plate_no' => ['required', Rule::unique('vehicles')->where(function ($query) use($workspace_id) {
            $query->where('licence_plate_no', $this->licence_plate_no)
                ->whereRaw("FIND_IN_SET(".$workspace_id.", vehicles.workspace_id)");
        })->ignore($this->id)]
        ]);
        try {
        $validated['licence_plate_no'] = $this->licence_plate_no;
        $validated['vehicle_color'] = $this->vehicle_color;
        $validated['vehicle_make'] = $this->vehicle_make;
        $validated['model_year'] = $this->model_year;
        $validated['chassis_no'] = $this->chassis_no;
        $validated['country_of_origin'] = $this->country_of_origin;
        $validated['truck_sketch'] = $this->truck_sketch;
        $validated['display_name'] = $this->display_name;
        $validated['vehicle_model'] = $this->vehicle_model;
        $validated['service_start_date'] = ($this->service_start_date)?dateFormat($this->service_start_date,'datedesc'):'';
        $validated['vehicle_registration'] = $this->vehicle_registration;
        $validated['registration_date'] = ($this->registration_date)?dateFormat($this->registration_date,'datedesc'):'';
        $validated['registration_expiry_date'] = ($this->registration_expiry_date)?dateFormat($this->registration_expiry_date,'datedesc'):'';
        $validated['sequence_no'] = $this->sequence_no;
        $validated['location'] = $this->location;
        $validated['odo'] = $this->odo;
        $validated['truck_image'] = $this->truck_image;
        $validated['last_mvpi_date'] = ($this->last_mvpi_date)?dateFormat($this->last_mvpi_date,'datedesc'):'';
        $validated['mvpi_expiry_date'] = ($this->mvpi_expiry_date)?dateFormat($this->mvpi_expiry_date,'datedesc'):'';
        $validated['mvpi_document'] = $this->mvpi_document;
        $validated['insurance_start_date'] = ($this->insurance_start_date)?dateFormat($this->insurance_start_date,'datedesc'):'';
        $validated['insurance_end_date'] = ($this->insurance_end_date)?dateFormat($this->insurance_end_date,'datedesc'):'';
        $validated['insurance_policy'] = $this->insurance_policy;
        $validated['insurance_document'] = $this->insurance_document;
        $validated['workspace_id'] = $workspace_id;
        ModelsVehicle::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
        $this->redirect('/vehicle'); 
   }
 
       /**
      * delete specific data from the listing
      * @param mixed $id
      * @return void
      */
     public function delete($id)
     {
         try{
            ModelsVehicle::find($id)->delete();
             session()->flash('success',"The selected data has been deleted successfully!!");
         }catch(\Exception $e){
             session()->flash('error', $e->getMessage());
         }
         $this->redirect('/vehicle'); 
     }	
 } 
