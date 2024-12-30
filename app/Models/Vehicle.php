<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vehicle extends Model
{
    use HasFactory;
    
    public $timestamps = true;
    protected $fillable = [
        'licence_plate_no', 'subcontractor', 'service_start_date', 'truck_image', 'vehicle_type', 'division',
         'driver_id', 'workspace_id'
    ];

    function vehicleSync(){
        return Vehicle::select('vehicles.*', 'drivers.driver_name', 'workspace.workspace_name')
        ->leftJoin('drivers', 'drivers.id', '=', 'vehicles.driver_id')
        ->leftJoin('workspace', function($join){
            $join->whereRaw("FIND_IN_SET(workspace.id, vehicles.workspace_id)");
        })
        ->whereNotNull('vehicles.vehicle_api_data')
        ->orderBy('vehicles.id', 'asc')
        ->get();
    }

    //get all vehicle by workspace
    public function getVehicle()
	{
        $vehicle  = Vehicle::select('vehicles.*', 'divisions.division_name', 
         'vehicle_types.type_name', 'vehicle_makers.make_name',
         'vehicle_models.model_name', 'workspace.workspace_name', 'locations.location_name',
          'drivers.driver_name', 'sub_contractors.transporter_name')
         ->leftJoin('divisions', 'divisions.id', '=', 'vehicles.division')
        ->leftJoin('vehicle_makers', 'vehicle_makers.id', '=', 'vehicles.vehicleMake')
        ->leftJoin('vehicle_models', 'vehicle_models.id', '=', 'vehicles.vehicleModel')
        ->leftJoin('vehicle_types', 'vehicle_types.id', '=', 'vehicles.vehicle_type')
        ->leftJoin('locations', 'locations.id', '=', 'vehicles.location')
        ->leftJoin('drivers', 'drivers.id', '=', 'vehicles.driver_id')
        ->leftJoin('sub_contractors', 'sub_contractors.id', '=', 'vehicles.subcontractor')
        ->join("workspace", "workspace.id", "=",  "vehicles.workspace_id");
        $where = "FIND_IN_SET(". Auth::user()->workspace_id.", vehicles.workspace_id)";
        $vehicle = $vehicle->whereRaw($where);
        if(Auth::user()->division_id){
            $division_id = explode(',', Auth::user()->division_id);
            $vehicle = $vehicle->whereIn('vehicles.division',$division_id);
        }
        $vehicle = $vehicle->groupBy('vehicles.licence_plate_no')
        ->orderBy('vehicles.id', 'desc')
        ->get();
        return $vehicle;
	}


    public function dashboardVehicle($show_trip_vehicle, $vehicle_type = 0)
	{
        if($show_trip_vehicle == 'yes'){
            $join = 'inner';
        }
        else{
            $join = 'left';
        }
        $vehicle = Vehicle::select('vehicles.gps_vehicle_id',
         'vehicles.licence_plate_no', 'vehicle_types.type_name', 'drivers.driver_name',
          'drivers.mobile')
        ->join('vehicle_types', 'vehicle_types.id',  '=', 'vehicles.vehicleType')
        ->leftJoin('drivers', 'drivers.id', '=', 'vehicles.driver_id')
        ->where('vehicles.gps_vehicle_id', '!=', 0);
        $where = "FIND_IN_SET(". Auth::user()->workspace_id.", vehicles.workspace_id)";
        $vehicle = $vehicle->whereRaw($where);
        if($vehicle_type){
            $vehicle = $vehicle->where('vehicle_types.id', $vehicle_type);
        }
        $vehicle = $vehicle->orderBy('vehicles.id', 'asc')
        ->get();
        return $vehicle;
	}
}
