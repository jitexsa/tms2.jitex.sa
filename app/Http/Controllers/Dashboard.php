<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\TripStatus;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Dashboard extends Controller
{
    
    function index(){
        $trip_status = new TripStatus();
        $data['status_list'] = $trip_status->getWorkspaceStatus();
        $data['workspace_data'] = getValue('workspace', "id = ". Auth::user()->workspace_id);
        return view('dashboard', $data);
    }

    function vehicleSyncWithGoogleMap(Request $request){
        $refresh = $request['refresh'];
         if($refresh == 1){
             unset($_SESSION['tracking_list']);
         }
         $vehicle  = new Vehicle();
        $rec = $vehicle->dashboardVehicle($request['show_trip_vehicle'], $request['vehicle_type']);
        $tracking_list = [];
        if($rec and !isset($_SESSION['tracking_list'])){
            $token = Session::get('token');
            if (empty($token)) {
                GpsAPILogin();
            }
            $gps_api_data = getAllVehicleGPSAPI();
            if($gps_api_data) {
                foreach ($rec as $key => $val) {
                    $gps = getTrackingInfo($val->gps_vehicle_id, $gps_api_data);
                    $tracking_list[$key] = $gps;
                    $tracking_list[$key]['driver_mobile'] = $val->mobile;
                    $tracking_list[$key]['driver_name'] = $val->driver_name;
                    $tracking_list[$key]['plate_no'] = $val->licence_plate_no ;
                    $tracking_list[$key]['show_clock'] = 0;
                    $tracking_list[$key]['mode'] = '';
                    $tracking_list[$key]['mode_date'] = '';
                    $tracking_list[$key]['type'] = $val->type_name;
                }
            }
        }
        if($request['show_trip_vehicle'] == 'no') {
            $external_vehicle_tracking = externalVehicleTracking($request['vehicle_type']);
            if ($external_vehicle_tracking) {
                $key = count($tracking_list);
                foreach ($external_vehicle_tracking as $val) {
                    $index = array_search($val->licence_plate_no, array_column($tracking_list, 'plate_no'));
                    if($index and $index >= 0 and $val->created_at >= $tracking_list[$index]['created_at']){
                        $tracking_list[$index]['lat'] = $val->lat;
                        $tracking_list[$index]['lng'] = $val->lng;
                    }
                   else
                   {
                       $driver_mode = $mode_created_date = '';
                       $show_clock = 0;
                       $mode = getValue('logs', array('log_type_id' => $val->id,
                           'log_type' => 'tracking'), "id desc");
                       if($mode) {
                           $log = json_decode($mode->log_content);
                           $driver_mode =  ' - ' . $log->mode;
                           $mode_created_date = $log->created_date;
                           $show_clock = 1;
                       }

                       $tracking_list[$key]['lat'] = $val->lat;
                       $tracking_list[$key]['lng'] = $val->lng;
                       $tracking_list[$key]['driver_name'] = $val->driver_name;
                       $tracking_list[$key]['driver_mobile'] = $val->mobile;
                       $tracking_list[$key]['display_name'] = $val->display_name;
                       $tracking_list[$key]['plate_no'] = $val->licence_plate_no .$driver_mode;
                       $tracking_list[$key]['show_clock'] = $show_clock;
                       $tracking_list[$key]['mode'] = str_replace(' - ','',$driver_mode);
                       $tracking_list[$key]['mode_date'] = $mode_created_date;
                       $tracking_list[$key]['type'] = $val->type_name;
                       $tracking_list[$key]['speed'] = $tracking_list[$key]['direction'] = '';
                   }
                    $key++;
                }
            }
        }
        Session::put('tracking_list', json_encode($tracking_list));
        $load_vehicle =  view('partials.vehicle-list', array('vehicle_info' => $tracking_list))->render();
        echo json_encode(array('vehicle' => $load_vehicle, 'tracking_list' => Session::get('tracking_list')));
    }

    function waybillList(Request $request){
        $rec = Trip::select('trips.*', 'trip_statuses.name', 'drivers.driver_name', 'drivers.mobile',
         'a.location as loading', 'b.location as delivery',
		'vehicles.licence_plate_no', 'customers.mobile as customer_mobile')
        ->join('trip_statuses', 'trip_statuses.id', '=', 'trips.status')
        ->leftJoin('drivers','drivers.id', '=', 'trips.driver')
        ->leftJoin('routes as a','a.id', '=', 'trips.loading_at')
        ->leftJoin('routes as b','b.id', '=', 'trips.delivery_at')
        ->join('vehicles','vehicles.id', '=', 'trips.vehicle')
        ->join('customers','customers.id', '=', 'trips.client')
        ->where(array('trips.status' => $request['status'],
        'trips.workspace_id' => Auth::user()->workspace_id))
        ->where('trips.is_delete', 0)
        ->get();
        echo view('partials.waybill-log', array('waybill_log' => $rec))->render();
    }
}
