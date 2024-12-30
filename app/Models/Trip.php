<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Trip extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'trip_date', 'waybill_no', 'job_no', 'port', 'terminal', 'warehouse', 'others', 'client', 'sow_id',
    'request_by', 'status', 'wessel', 'voyage', 'awb', 'request_date', 'contact_person',
    'telephone', 'loading_at', 'delivery_at', 'temperature', 'vehicle', 'driver', 'arrival_time',
    'arrival_date', 'loaded_time', 'loaded_date', 'exit_time', 'exit_date', 
    'name_of_receiver', 'delivery_time', 'delivery_date', 'unloaded_time', 'unloaded_date',
    'delivery_exit_time', 'delivery_exit_date', 'labor', 'labor_qty', 'marks_no', 
    'cargo_desc', 'qty', 'weight', 'remarks', 'loading_image', 'unloading_image', 'created_by',
    'workspace_id', 
    ];
    

    function unTrackTrip()
    {
      return Trip::select('trips.*', 'drivers.driver_name', 'drivers.mobile', 'drivers.iqama_image',
      'drivers.license_image', 'drivers.license_number', 'a.location as loading',
      'a.location_map as loading_map', 'a.place_id as loading_place_id', 
      'b.location as delivery', 'b.location_map as delivery_map', 'b.place_id as delivery_place_id',
      'vehicles.licence_plate_no', 'vehicles.truck_image', 'users.firstname', 'users.lastname',
      'customers.customer_name', 'vehicle_types.type_name', 'c.name as scope_name',
      'workspace.workspace_name', 'r.name as request_name')
      ->join('trip_live_trackings', 'trip_live_trackings.trip_id', '!=', 'trips.id')
        ->leftJoin('drivers','drivers.id', '=', 'trips.driver') 
        ->leftJoin('routes as a','a.id', '=', 'trips.loading_at')
        ->leftJoin('routes as b','b.id', '=', 'trips.delivery_at')
        ->leftJoin('scope_of_works as c','c.id', '=', 'trips.sow_id')
        ->leftJoin('requested_by as r','r.id', '=', 'trips.request_by')
        ->join('vehicles','vehicles.id', '=', 'trips.vehicle')
        ->join('users','users.id', '=', 'trips.created_by')
        ->join('customers','customers.id', '=', 'trips.client')
        ->join('vehicle_types', 'vehicle_types.id', '=', 'vehicles.vehicle_type')
        ->join('workspace', 'workspace.id', '=', 'trips.workspace_id')
        ->where('trips.is_delete', 0)
        ->where('vehicles.gps_vehicle_id', 0)
        ->where('trips.workspace_id', Auth::user()->workspace_id)
        ->whereNotIn('trips.status', array(4,19))
        ->orderBy('trips.id', 'asc')
        ->groupBy('trips.id')->get();
    }
}
