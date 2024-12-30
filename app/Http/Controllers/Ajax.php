<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Item;
use App\Models\VehicleInspection;
use App\Models\Routes;
use App\Models\FreightCustomer;
use App\Models\RequestedBy as ModelsRequestedBy;
use App\Models\Shipping;
use App\Models\SalesActivity;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Ajax extends Controller {

    function ChangeWorkspace(Request $request){
        $user = getValue('users', 'id ='. Auth::user()->id);
        if($request->workspace_id == ''){
            $user->workspace_id = 1;
        }
        else{
            $user->workspace_id = $request->workspace_id;
        }
        Auth::guard('web')->setUser($user);
    }

    function getItem(Request $request){
         $model = new Item();
         $rec = $model->getItemByCategory($request->cat_id);
         echo json_encode($rec);
    }

    function getCompanyVehicle(Request $request){
        $vehicle = getCompanyVehicles(Auth::user()->workspace_id);
        echo json_encode(array('vehicle' => $vehicle));
    }

    function vehicleInspectionDetail(Request $request){
        $model = new VehicleInspection();
        $data['rec'] = $model->vehicleInspectionInfo($request->id);
        $returnHTML = view('vehicle-management.inspection.detail', $data)->render();
        return response()->json( array('html'=> $returnHTML) );
    }

    function saveRoute(Request $request){
        try {
            $post['location'] = $request->location;
            $post['location_map'] = $request->location_map;
            $post['place_id'] = $request->place_id;
            $post['isactive'] = 1;
            $post['workspace_id'] = Auth::user()->workspace_id;
            Routes::create($post);
            $loading  = 'loading_at';
            if($request->location_type == 2){
                $loading  = 'delivery_at';
            }
            $html = view('layouts.dropdown.route', array('name' => $loading))->render();
            return json_encode(array('successfully' => true,
             'message' => 'The data has been saved successfully.', 
            'html' => $html));
        } catch (\Exception $e) {
            return json_encode(array('successfully' => true, 'message' => $e->getMessage()));
        }
    }

    function saveRequest(Request $request){
        try {
            $post['name'] = $request->name;
            $post['user_id'] = Auth::user()->id;
            $post['workspace_id'] = Auth::user()->workspace_id;
            ModelsRequestedBy::create($post);
            $html = view('layouts.dropdown.requested-by')->render();
            return json_encode(array('successfully' => true,
             'message' => 'The data has been saved successfully.', 
            'html' => $html));
        } catch (\Exception $e) {
            return json_encode(array('successfully' => true, 'message' => $e->getMessage()));
        }
    }

    function getSaleman(Request $request){
        $rec = FreightCustomer::select('tblstaff.*')
        ->join('tblstaff', 'tblstaff.staffid', '=', 'tblcustomer_admins.staff_id')
        ->where('customer_id', $request->customer)->first();
        return json_encode($rec);
    }

    function saveShipping(Request $request){
            $data = $request->all();
            $reference_number = generateNewShipmentReferenceNumber($request['direction']);
            $data['rel_id'] = $data['userid'] = $data['clientid'];
            $data['shipment_reference_number'] = $reference_number;
            $data['hash'] = generateHash();
            $data['rel_type'] = 'customer';
            $data['contractual_shipments'] = 1;
            $data['edit_route_info'] = 1;
            $data['edit_package_info'] = 1;
            $data['datecreated'] = date('Y-m-d H:i:s');
            $data['date'] = date('Y-m-d H:i:s');
            $insert_id = Shipping::insertGetId($data);
           SalesActivity::insert([
                'description' => '☑) New shipping detail added from TMS.',
                'date' => date('Y-m-d H:i:s'),
                'rel_id' => $insert_id,
                'rel_type' => 'shipping',
                'staffid' => '',
                'full_name' => Auth::user()->firstname. ' '.Auth::user()->lastname,
                'additional_data' => '',
                'category' => 'dashboard'
            ]);
            $html = view('layouts.dropdown.shipping')->render();
            return json_encode(array('successfully' => true, 'job_no' => $reference_number,
             'message' => 'The data has been saved successfully.', 'html' => $html));
    }

    function getVehicle(Request $request){
        if( $request->vehicle_id){
        $vehicle_info = getValue('vehicles', 'id = '.$request->vehicle_id);
        $vehicle_info->plate_no = trim(preg_replace("/[A-za-z]/i", '', $vehicle_info->licence_plate_no));
        $vehicle_info->plate_alphabet = trim(preg_replace("/[0-9]/i", '', $vehicle_info->licence_plate_no));
        }
        else{
            $vehicle_info = array();
        }
        return view('layouts.modals.add-vehicle', array('vehicle_info' =>  $vehicle_info, true))->render();
    }

    function saveVehicle(Request $request){
        $workspace_id = Auth::user()->workspace_id;
        $plate_no = $request['licence_plate_no'];
        
        if($request['id']){
         $plate_no_validate =  Rule::unique('vehicles')->where(function ($query) use($workspace_id, $plate_no) {
                $query->where('licence_plate_no', $plate_no)
                    ->whereRaw("FIND_IN_SET(".$workspace_id.", vehicles.workspace_id)");
            });
        }
        else{
            $plate_no_validate =  Rule::unique('vehicles')->where(function ($query) use($workspace_id, $plate_no) {
                $query->where('licence_plate_no', $plate_no)
                    ->whereRaw("FIND_IN_SET(".$workspace_id.", vehicles.workspace_id)");
            })->ignore($request['id']);
        }
        $data = [
            'subcontractor' => 'required',
            'service_start_date' => 'required',
            'driver_id' => 'required',
            'vehicle_type' => 'required',
            'division' => 'required',
            'licence_plate_no' => ['required', $plate_no_validate]
        ];
          $validated = validator::make($request->all(), $data);
          if($validated->fails()){
            return json_encode(array('successfully' => false, 'error' => $validated->errors()->all()));
          }
          else{
            $validated = $validated->validated();
            $validated['service_start_date'] = ($request['service_start_date'])?dateFormat($request['service_start_date'],'datedesc'):'';
            $validated['truck_image'] = $request['truck_image'];
            $validated['workspace_id'] = $workspace_id;
          if($request['id']){
            Vehicle::whereId($request['id'])->update($validated);
          }
          else{
            Vehicle::create($validated);
          }
          $html = view('layouts.dropdown.vehicle', array('skip' => true))->render();
          return json_encode(array('successfully' => true, 'plate_no' => $validated['licence_plate_no'],
           'message' => 'The data has been saved successfully.', 'html' => $html));
        }
    }

    function saveDriver(Request $request){
        $workspace_id = Auth::user()->workspace_id;
        $license_number = $request['license_number'];
        $data = [
            'driver_name' => 'required',
            'mobile' => 'required',
            'company' => 'required',
            'division' => 'required',
            'license_number' => ['required', Rule::unique('drivers')->where(function ($query) 
            use($workspace_id, $license_number) {
               $query->where('license_number', $license_number)
                  ->where('workspace_id', $workspace_id);
           })]
        ];
          $validated = validator::make($request->all(), $data);
         
          if($validated->fails()){
            return json_encode(array('successfully' => false, 'error' => $validated->errors()->all()));
          }
          else{
            $validated = $validated->validated();
            $validated['picture'] = $request['picture'];
            $validated['license_image'] = $request['license_image'];
            $validated['workspace_id'] = Auth::user()->workspace_id;
            Driver::create($validated);
            $html = view('layouts.dropdown.driver')->render();
            return json_encode(array('successfully' => true, 'driver' => $request['driver_name'],
             'message' => 'The data has been saved successfully.', 'html' => $html));
        }
       
  }
}