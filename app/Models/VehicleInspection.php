<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VehicleInspection extends Model
{
    use HasFactory;
    public $timestamps = true;
    
    protected $fillable = [
      'vehicle', 'inspection_date', 'kms_in', 'datetime_in', 'datetime_out', 'petrol_card', 'petrol_card_text',
    'invertor', 'invertor_text', 'int_damage', 'int_damage_text', 'ext_car', 'ext_car_text', 'ladder',
    'ladder_text', 'power_tool', 'power_tool_text', 'head_light', 'head_light_text', 'windows',
    'windows_text', 'oil_chk', 'oil_chk_text', 'tool_box', 'tool_box_text', 'inspected_by',
    'vehicle_inspection_image', 'reg_no', 'lights', 'lights_text', 'car_mats', 'car_mats_text',
    'int_lights', 'int_lights_text', 'tyre', 'tyre_text', 'leed', 'leed_text', 'ac', 'ac_text',
    'lock', 'lock_text', 'condition', 'condition_text', 'suspension', 'suspension_text', 'workspace_id'
    ];

    function getInspection(){
      return VehicleInspection::select("vehicle_inspections.*", "vehicles.licence_plate_no", 
        "vehicles.vehicleRegistration", "drivers.driver_name", 
        "users.firstname", "users.lastname",
        \DB::raw("CONCAT(inspection.firstname,' ',inspection.lastname) as inspected"),
        "workspace.workspace_name")
       ->join('vehicles','vehicles.id', '=', 'vehicle_inspections.vehicle')
       ->leftJoin('drivers', 'drivers.id', '=', 'vehicles.driver_id')
       ->join('users','users.id', '=', 'vehicle_inspections.user_id')
       ->leftJoin('users as inspection','inspection.id', '=', 'vehicle_inspections.inspected_by')
       ->join('workspace', 'workspace.id', '=', 'vehicle_inspections.workspace_id')
       ->where('vehicle_inspections.workspace_id', Auth::user()->workspace_id)->get();
    }

     //vehicle inspection get by id
     public function vehicleInspectionInfo($id){
      return VehicleInspection::select("vehicle_inspections.*", "vehicles.licence_plate_no", 
        "vehicles.vehicleRegistration", "drivers.driver_name", 
        "users.firstname", "users.lastname",
        \DB::raw("CONCAT(inspection.firstname,' ',inspection.lastname) as inspected"),
        "workspace.workspace_name", "vehicle_types.type_name")
       ->join('vehicles','vehicles.id', '=', 'vehicle_inspections.vehicle')
       ->leftJoin('drivers', 'drivers.id', '=', 'vehicles.driver_id')
       ->join('users','users.id', '=', 'vehicle_inspections.user_id')
       ->leftJoin('users as inspection','inspection.id', '=', 'vehicle_inspections.inspected_by')
       ->join('vehicle_types', 'vehicle_types.id', '=', 'vehicles.vehicle_type')
       ->join('workspace', 'workspace.id', '=', 'vehicle_inspections.workspace_id')
       ->where('vehicle_inspections.id', $id)->first();
  }
}
