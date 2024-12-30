<?php
/**
 * Helper function file
 * @author Capps Solutions
 */

use App\Models\AdditionalRequirements;
use App\Models\Category;
use App\Models\Company;
use App\Models\ContractorStatus;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Division;
use App\Models\DocumentType;
use App\Models\Driver;
use App\Models\Fuel;
use App\Models\FuelType;
use App\Models\License;
use App\Models\Location;
use App\Models\Position;
use App\Models\RequestedBy;
use App\Models\Routes;
use App\Models\ScopeOfWork;
use App\Models\Shipping;
use App\Models\SubContractor;
use App\Models\Trip;
use App\Models\TripStatus;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleLeasing;
use App\Models\VehicleMaker;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use App\Models\Vendor;
use App\Models\VendorType;
use App\Models\WaybillList;
use App\Models\Workspace;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * get different date format
 * @param $date
 * @param null $type
 * @return false|string
 */

if(!function_exists('dateFormat')) {
    function dateFormat($date, $type = NULL)
    {
        if ($date == '0000-00-00 00:00:00' or $date == '0000-00-00') {
            return NULL;
        } else {
            $datetime = strtotime($date);
            if ($type == 'full') {
                return date("Y-m-d H:i:s", $datetime);
            } else if ($type == 'shortdate') {
                return date("d-M-y", $datetime);
            } else if ($type == 'date') {
                return date("d-M-Y", $datetime);
            } else if ($type == 'slashdate') {
                return date("d/M/Y", $datetime);
            } else if ($type == 'datedesc') {
                return date("Y-m-d", $datetime);
            } else if ($type == 'inbox') {
                return date("M d", $datetime);
            } else if ($type == 'time') {
                return date("g:i A", $datetime);
            } else if ($type == 'num') {
                return date("m-d-Y", $datetime);
            } else if ($type == 'js') {
                return date("M d, Y", $datetime);
            } else if ($type == 'report') {
                return date("d-m-Y", $datetime);
            }
        }
    }
}

/**
 * date old date pass interval day
 * @param $day
 * @param $format
 * @return string
 */
if(!function_exists('oldDate')) {
    function oldDate($day, $format = 'd-m-Y')
    {
        return date($format, strtotime(date($format) . '-' . $day . ' DAY'));
    }
}


/**
 * date next date pass add day
 * @param $date
 * @param $day
 * @return string
 */
if(!function_exists('nextDate')) {
    function nextDate($date, $day)
    {
        return date('d-m-Y', strtotime($date . '+' . $day . ' DAY'));
    }
}

/**
 * @param $length
 * @return string
 */

if (!function_exists('getUniqueCode')) {
    function getUniqueCode($length = "")
    {
        $code =  \Illuminate\Support\Str::random( $length);
        return $code;
    }
}

/**
 * function set the css files
 *
 * @param array $files , boolean $cssFolder
 */
if(!function_exists('setCss')) {
    function setCss(array $files = array()): void
    {
        if ($files) {
            foreach ($files as $file) {
                $file = $file.'.css';
                $is_file = str_replace(env('APP_URL'), 'public', env('ASSETS_CSS') . '/' .$file);
                if(file_exists($is_file)){
                    echo '<link rel="stylesheet" type="text/css" href="' .env('ASSETS_CSS').'/' . $file . '?v=' .env('VERSION') . '" rel=preload>';
                }
            }
        }
    }
}
/**
 * function set the js files
 *
 * @param array $files , boolean $jsFolder
 */
if(!function_exists('setJs')) {
    function setJs(array $files = array()): void
    {
        if ($files) {
            foreach ($files as $file) {
                $file = $file.'.js';
                $is_file = str_replace(env('APP_URL'), 'public', env('ASSETS_JS') . '/' .$file);
                if(file_exists($is_file)){
                    echo  '<script src="' .env('ASSETS_JS').'/'. $file . '?v=' . env('VERSION'). '" rel=preload></script>';
                }
            }
        }
    }
}
/**
 * function set the images
 *
 * @param string $image , boolean $imageFolder
 */
if(!function_exists('setImage')) {
    function setImage(string $image)
    {
        if ($image) {
            $is_image = str_replace(env('APP_URL'), 'public', env('ASSETS_IMAGE') . '/' .$image);
            if(file_exists($is_image)){
                return env('ASSETS_IMAGE').'/'.$image . '?v=' . env('VERSION');
            }
        }
    }
}
/**
 * @param $val
 * @param $selected
 * @return string
 * drop down selected value
 * return selected if both parameters are same
 */
if(!function_exists('getSelected')) {
    function getSelected($val, $selected)
    {
        if($selected) {
            if (is_array($selected) and in_array($val, $selected)) {
                return "selected";
            } else if ($val == $selected) {
                return "selected";
            }
        }
    }
}

/**
 * @return string
 * getChecked()
 * return checked if both parameter are same
 */
if (!function_exists('getChecked')) {
    function getChecked($row, $status)
    {
        if ($row == $status) {
            return "checked=\"checked\"";
        }
    }
}

/**
 * set the base url using function
 */
if(!function_exists('baseURL')){
    function baseURL($path=''): string
    {
        if($path){
            return getenv('APP_URL').'/'.$path;
        }else{
            return getenv('APP_URL');
        }
    }
}

/**
 * check the page or dir is existing
 * @param $type is (file or dir)
 */
if(!function_exists('path')){
    function path($paths, $type = 'file'): bool
    {
        $status = false;
        if($type == 'dir'){
            if(in_array(basename(\Request::segment(1)), $paths)){
                $status = true;
            }
        }else{
            if(in_array(basename(\Request::path()), $paths)){
                $status = true;
            }
        }
        return $status;
    }
}

/**
 * get dynamic title
 * @param $title
 */
if(!function_exists('title')){
    function title($title=''){
        $newTitle = config('app.name').' | '.config('app.tagline');
        if(!empty($title)){
            $newTitle = ucfirst($title).' | '.$newTitle;
        }
        return $newTitle;
    }
}

/**
 * get value from selected table and where clause for single row
 * @param $table
 * @param $where
 * @return array
 */
if(!function_exists('getValue')) {
    function getValue($table,  $where)
    {
        return \DB::table($table)->whereRaw($where)->first();
    }
}

/**
 * get customer
 * @return array
 */
if(!function_exists('getCustomer')) {
    function getCustomer()
    {
        $query =Customer::where('workspace_id', Auth::user()->workspace_id)
        ->where('customers.is_active',1);
        if(Auth::user()->company_id){
            $company_id = explode(',', Auth::user()->company_id);
            $query = $query::whereIn('customers.company_id',$company_id);
        }
        if(Auth::user()->division_id){
            $division_id = explode(',', Auth::user()->division_id);
            $query = $query::whereIn('customers.division',$division_id);
        }
        return $query->get();
    }
}

/**
 * get country list
 */
if(!function_exists('getCountry')){
    function getCountry(){
        return Country::where('status',  '1')->get();
    }
}


/**
 * get company list 
 * @param workspace_id
 * @param type
 */
if(!function_exists('getCompany')){

    function getCompany($workspace_id = '', $type= 'workspace_id'){
      
        if($type == 'workspace_id') {
           $query = Company::where('workspace_id', ($workspace_id) ? $workspace_id : Auth::user()->workspace_id);
            if(Auth::user()->company_id){
                $company_id = explode(',', Auth::user()->company_id);
                $query = $query::whereIn('companies.company_id',$company_id);
            }
        }
        else{
            //company list for user list
            $query = Company::whereIn('company_id', [$workspace_id]);
        }
        return $query->get();
    }
}


/**
 * get division list
 * @param workspace_id
 * @param type
 */
if(!function_exists('getDivision')){
    function getDivision($workspace_id = '', $type= 'workspace_id'){

        if($type == 'workspace_id') {
            $query = Division::where('workspace_id', ($workspace_id) ? $workspace_id : Auth::user()->workspace_id);
             if(Auth::user()->division_id){
                 $division_id = explode(',', Auth::user()->division_id);
                 $query = $query::whereIn('divisions.division_id',$division_id);
             }
         }
         else{
             //company list for user list
             $query = Division::whereIn('division_id', [$workspace_id]);
         }
         return $query->get();
    }
}


/**
 * remove underscore in string and capitalize the string words.
 * @param $string
 * @return void
 */
function removeUnderScore($string){
        return ucwords(preg_replace('/_/', ' ', $string));
}

/**
 * @param $key
 * @return string
 */
if(!function_exists('listingStatus')) {
    function listingStatus($key = 2)
    {
        $active = array(
            '1' => 'Active',
            '0' => 'Inactive'
        );
        if($key != 2) {
            return array_key_exists($key, $active)? $active[$key]:'';
        }
        else{
            return $active;
        }
    }
}

/**
 * @param $key
 */
if(!function_exists('vendorCategory')) {
    function vendorCategory($key)
    {
        $arr = array(
            '1' => 'Fuel',
            '2' => 'Maintenance',
            '3' => 'Other'
        );
        return $arr[$key];
    }
}

/**
 * getVehicleMaker 
 */
if(!function_exists('getVehicleMaker')){
    function getVehicleMaker(){
        $make = new VehicleMaker();
        return $make->getMaker();
    }
}

if(!function_exists('getVehicleModel')){
    function getVehicleModel(){
        $make = new VehicleModel();
        return $make->getModels();
    }
}


/**
 * @param $type
 * @return array
 */
if(!function_exists('laborType')) {
    function laborType($type = '')
    {
        $list = array(1 => 'Manpower', 2 => 'Equipment');
        if($type) {
            return $list[$type];
        }
        else{
            return $list;
        }
    }
}

/**
 * get category by workspace
 */

 if(!function_exists('getCategory')){
    function getCategory(){
    $category = new Category();
    return $category->getCategory();
    }
 }

 /**
  * sms template list
  */
 if (!function_exists('TplList')) {

    function TplList($ele = '')
    {
        $arr = array('2' => 'Scheduled',
            '3' => 'Enroute',
            '4' => 'Delivered '
        );
        if($ele){
            return $arr[$ele];
        }else{
            return $arr;
        }
    }
}

/**
 * sms shortcode
 */
if(! function_exists('smsShortcode')){
    function smsShortcode($shortcode = ''){
        $arr =  array('Truck Type' => '[Truck Type]',
            'Truck Plate' => '[Truck Plate]',
            'Driver Name' => '[Driver Name]',
            'Driver Mobile Number' => '[Driver Mobile Number]',
            'Waybill URL' => '[Waybill URL]'
        );
        if($shortcode){
            return $arr[$shortcode];
        }else{
            return $arr;
        }
    }
}

/**
 * get vendor type by workspace
 */

 if(!function_exists('getVendorType')){
    function getVendorType(){
    $model = new VendorType();
    return $model->getVendorType();
    }
 }

 /**
  * get vendor list
  */

  if(!function_exists('getVendor')){
    function getVendor($type = 0){
    $model = new Vendor();
    return $model->getVendor();
    }
 }

  /**
  * get Fuel vendor list
  */

  if(!function_exists('getFuelVendor')){
    function getFuelVendor($type = 0){
    $model = new Vendor();
    return $model->getFuelVendor();
    }
 }

 /**
  * get trip data
  */

  if(!function_exists('getTrip')){
 function getTrip($where = '')
 {
    $trip = Trip::select('trips.*', 'drivers.driver_name', 'drivers.mobile', 'drivers.iqama_image',
     'drivers.license_image', 'drivers.license_number', 'a.location as loading',
     'a.location_map as loading_map', 'a.place_id as loading_place_id',
     'b.location as delivery', 'b.location_map as delivery_map', 'b.place_id as delivery_place_id',
     'vehicles.licence_plate_no', 'vehicles.truck_image', 'users.firstname', 'users.lastname',
     'customers.customer_name', 'vehicle_types.type_name', 'c.name as scope_name', 
     'workspace.workspace_name', 'r.name as request_name', 'divisions.division_name',
     'sub_contractors.transporter_name')
     ->leftJoin('drivers','drivers.id', '=', 'trips.driver')
     ->leftJoin('routes as a','a.id', '=', 'trips.loading_at')
     ->leftJoin('routes as b','b.id', '=', 'trips.delivery_at')
     ->leftJoin('scope_of_works as c','c.id', '=', 'trips.sow_id')
     ->leftJoin('requested_by as r','r.id', '=', 'trips.request_by')
     ->join('vehicles','vehicles.id', '=', 'trips.vehicle')
     ->join('users','users.id', '=', 'trips.created_by')
     ->join('customers','customers.id', '=', 'trips.client')
     ->join('vehicle_types', 'vehicle_types.id', '=', 'vehicles.vehicle_type')
     ->join('divisions', 'divisions.id', '=', 'vehicles.division')
     ->leftJoin('sub_contractors', 'sub_contractors.id', '=', 'vehicles.subcontractor')
     ->join("workspace", 'workspace.id', '=', 'trips.workspace_id')
     ->orderBy('trips.id', 'asc');
     if($where) {
        $trip = $trip->where($where);
     }
     return $trip->get();
 }
}

  /**
  * get Fuel type list
  */

  if(!function_exists('getFuelType')){
    function getFuelType(){
    $model = new FuelType();
    return $model->getFuelType();
    }
 }

 /**
  * get vehicle list by workspace / company id
  * skip vehicle true / false 
  * vehicle id which we want to skip
  */
 if(!function_exists('getVehicle')) {
    function getVehicle($workspace_id,  $skip = false, $vehicle = '')
    {
        $select = "vehicles.*, vehicle_types.type_name, vehicle_makers.make_name,
         vehicle_models.model_name, drivers.driver_name, drivers.id as driverid,
        drivers.license_number, drivers.mobile";

        if($skip){
            $select .= ", trips.status";
        }
       $query = Vehicle::selectRaw($select)
        ->leftJoin('vehicle_makers','vehicle_makers.id', '=', 'vehicles.vehicle_make')
        ->leftJoin('vehicle_models','vehicle_models.id', '=', 'vehicles.vehicle_model')
        ->join('vehicle_types', 'vehicle_types.id', '=', 'vehicles.vehicle_type')
        ->leftJoin('drivers','drivers.id', '=', 'vehicles.driver_id');
        if($skip){
            $query = $query->leftJoin('trips','trips.vehicle', '=', 'vehicles.id');
        }
        $query = $query->whereRaw("FIND_IN_SET(".$workspace_id.", vehicles.workspace_id)");
        if(Auth::user()->division_id){
            $division_id = explode(',', Auth::user()->division_id);
            $query = $query::whereIn('vehicles.division',$division_id);
        }
        $rec = $query->groupBy('vehicles.licence_plate_no')
        ->orderBy('vehicles.id', 'asc')->get()->toArray();
        if($skip) {
            return array_filter($rec, function ($val) use($vehicle) {
                if($vehicle){
                    return (in_array($val['status'], array(4, 19)) || $val['status'] == '')
                        || in_array($val['id'], array($vehicle));
                }
                else{
                    return in_array($val['status'], array(4, 19)) || $val['status'] == '';
                }
            });
        }
        else{
            return $rec;
        }
    }
}

/**
 * get vehicle type
 */
if(!function_exists('getVehicleType')){
    function getVehicleType(){
        return VehicleType::where('workspace_id', Auth::user()->workspace_id)->get();
    }
}

 /**
     * @return mixed
     * get contractor status by workspace
      */
if(!function_exists('contractorStatus')) {
   
    function contractorStatus()
    {
        return ContractorStatus::whereIn('workspace_id',array(1,Auth::user()->workspace_id))->get();
    }
}

// Route List
if(!function_exists('routeList')) {
    function routeList()
    {
       return Routes::where('workspace_id', Auth::user()->workspace_id)->orderBy('id', 'desc')->get();
    }
}

/**
 * check subcontractor linked with trip or not
 * @param $subcontractor_id
 * @return mixed
 */
if(!function_exists('linkWithTrip')) {
    function linkWithTrip($subcontractor_id)
    {
        return Vehicle::select('trips.trip_date', 'trips.waybill_no', 'trips.job_no')
        ->join('trips', 'trips.vehicle', '=', 'vehicles.id')
        ->where('vehicles.subcontractor',$subcontractor_id)->get();
       
    }
}

/**
 * location list
 */
if(!function_exists('locationList')) {
    function locationList()
    {
        return Location::where('workspace_id', Auth::user()->workspace_id)->get();
    }
}


/**
 * employee designation
 */

 if(!function_exists('designation')){
function designation()
	{
        return Position::select('positions.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'positions.workspace_id')
        ->get();
	}
}

/**
 * get department
 */

 if(!function_exists('department')){
function department()
	{
        return Department::select('departments.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'departments.workspace_id')
        ->get();
	}
}

/**
 * get document type by workspace
 */
if(!function_exists('getDocumentType')) {
    function getDocumentType()
    {
        return DocumentType::select('document_types.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'document_types.workspace_id')
        ->orderBy('document_types.id', 'desc')
        ->get();
	}
}

// workspace List
if(!function_exists('workspaceList')) {
    function workspaceList()
    {
        return Workspace::where('workspace_status', 1)->get();
    }
}

/**
 * @return mixed
 * get subcontractor by workspace
 */
if(!function_exists('subContractor')) {
    function subContractor()
    {
       return SubContractor::where('workspace_id', Auth::user()->workspace_id)->get();
    }
}

/**
 * @return mixed
 * get subcontractor by workspace
 */
if(!function_exists('subContractor')) {
    function subContractor()
    {
       return SubContractor::where('workspace_id', Auth::user()->workspace_id)->get();
    }
}

/**
 * get license type by workspace
 */
if(!function_exists('getLicenseType')) {
    function getLicenseType()
    {
        return License::select('licenses.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'licenses.workspace_id')
        ->orderBy('licenses.id', 'desc')
        ->get();
	}
}

/**
 * @param $type
 * @return string
 */
if(!function_exists('logType')) {
    function logType($type)
    {
        return ucwords(str_replace('-', ' ', $type));
    }
}

if(!function_exists('getVehicleDriver')){
    function getVehicleDriver($not_skip = 0){
        $vehicle = getVehicle(Auth::user()->workspace_id);
        $driver_list = array();
        if($vehicle){
            foreach($vehicle as $val){
                if($val['driver_id'] and $val['driver_id'] != $not_skip) {
                    $driver_list[] = $val['driver_id'];
                }
            }
        }
         $query =  Driver::where('drivers.workspace_id', Auth::user()->workspace_id);
        if(Auth::user()->company_id){
            $company_id = explode(',', Auth::user()->company_id);
            $query = $query::whereIn('drivers.company',$company_id);
        }
        if(Auth::user()->division_id){
            $division_id = explode(',', Auth::user()->division_id);
            $query = $query::whereIn('drivers.division',$division_id);
        }
            $query = $query->groupBy('drivers.license_number');
        // if($driver_list){
        //     $query = $query->whereNotIn('drivers.id', $driver_list);
        // }
         return $query->get();
    }
}

/**
 * get company vehicles by workspace, company and skip used vehicle 
 */
if(!function_exists('getCompanyVehicles')){
    function getCompanyVehicles($workspace_id, $not_skip = 0){
        $leasing_list = VehicleLeasing::select('vehicle_leasings.vehicle')
        ->where('vehicle_leasings.workspace_id', Auth::user()->workspace_id)->get()->toArray();
        $vehicle = getVehicle($workspace_id);
        $vehicle_list = array();
        foreach($vehicle as $val){
            if(!in_array($val->id, $leasing_list) or $val->id == $not_skip) {
                $vehicle_list[] = $val;
            }
        }
        return $vehicle_list;
    }
}

/**
 * get employee list from employee table against to selected workspace
 * @return mixed
 */
if(!function_exists('getUsersList')) {
    function getUsersList()
    {
        return User::where(['users.workspace_id' =>  Auth::user()->workspace_id,
            'users.driver_id' => 0])->get();
    }
}

/**
 * inspection status
 */
if(!function_exists('inspectionStatus')){
    function inspectionStatus($status){
        if($status == 1){
            return 'Yes';
        }
        else if($status == 0){
            return 'No';
        }
        else{
            return '';
        }
    }
}

/**
 * inspection status for pdf
 */
if(!function_exists('inspectionStatusPdf')){
    function inspectionStatusPdf($status, $val){
        if($status == $val and $status == 1){
            return 'Yes';
        }
        else if($status == $val and $status == 0){
            return 'No';
        }
        else{
            return '';
        }
    }
}


/**
 * vehicle fuel type
 */
if(!function_exists('fuelType')){
    function fuelType($status){
        if($status == 0){
            return '1/4';
        }
        else if($status == 1){
            return '1/2';
        }
        else if($status == 2){
            return '3/4';
        }
        else if($status == 3){
            return 'Full Tank ';
        }
        else{
            return '';
        }
    }
}

/**
 * trip stats by status
 * @return string
 */
if(!function_exists('tripStatusStats')) {
    function tripStatusStats()
    {
        $rec = TripStatus::select("trip_statuses.name,  
        (select COUNT(trips.id) from trips where trips.status = trip_statuses.id 
         and trips.is_delete = 0 and trips.workspace_id = ".Auth::user()->workspace_id.") 
         as status_count")
         ->where('workspace_id', array(1,Auth::user()->workspace_id))
         ->get();
        $arr = array();
        if ($rec)
        {
            foreach ($rec as $v)
            {
                $arr[] = array('label' => $v->name, 'y' => intval($v->status_count));
            }
        }
        return $arr;
    }
}


/**
 * @param $status
 * @param $workspace
 * @return string
 */
if(!function_exists('tripStatus')) {
    function tripStatus($status = '', $workspace = true)
    {
        $query = \DB::table('trip_statuses');
        if($workspace) {
          $query =  $query->whereIn('workspace_id', array(1, Auth::user()->workspace_id));
        }
        if($status) {
            $query = $query->where('id', $status)->first()->name;
        }
        else{
            $query = $query->where('is_disable', 0)
            ->orderBy('ordering', 'asc')
            ->get();
        }
       return $query;
    }
}


/*
 * get shipping data from freight db
 */
if(!function_exists('getShipping')) {
    function getShipping()
    {
        return Shipping::select('shipment_reference_number')->get();
    }
}

/**
 * get scope of work list
 */
if(!function_exists('sowList')) {
    function sowList()
    {
         return  ScopeOfWork::where('workspace_id', Auth::user()->workspace_id)
        ->orderBy('id', 'desc')->get();
    }
}

/**
 * get labor type list
 */
if(!function_exists('getLaborType')){
    function getLaborType(){
         $model = new AdditionalRequirements();
         return $model->getData();
    }
}

/**
 * @param $id
 * @return array
 */
if(!function_exists('tripRequested')) {
    function tripRequested($id = '')
    {
        $model = new RequestedBy();
        $data = $model->getRequestBy($id);
        if($id)
        {
            return $data->name;
        }
        return $data;
    }
}

/**
 * time dropdown
 */
if(!function_exists('timeDropdown')) {
    function timeDropdown()
    {
        $startTime = strtotime("00:00");
        $endTime   = strtotime("23:30");
        $returnTimeFormat = "H:i:s";
        $current   = time();
        $addTime   = strtotime('+30 minutes', $current);
        $diff      = $addTime - $current;
        $times = array();
        while ($startTime < $endTime) {
            $times[] = date($returnTimeFormat, $startTime);
            $startTime += $diff;
        }
        $times[] = date($returnTimeFormat, $startTime);
        return $times;
    }
}

/**
 * trip waybill generate
 */
if(!function_exists('tripWaybill')){
    function tripWaybill(){

        $rec = WaybillList::select('waybill_lists.waybill_no', 'waybill_lists.id')
        ->whereRaw("waybill_lists.waybill_no NOT IN (select trips.waybill_no FROM trips)")
        ->where("waybill_lists.is_used", "1")
        ->orderBy('waybill_lists.id', 'desc')->first();
        if($rec){
            WaybillList::whereId( $rec->id)->update(array('is_used' => 2));
            return $rec->waybill_no;
        }
        else{
            $rec = WaybillList::orderBy('id', 'desc')->first();
            $post['waybill_no'] = (int)$rec->waybill_no+1;
            $post['user_id'] = Auth::user()->id;
            $post['workspace_id'] = Auth::user()->workspace_id;
            $post['is_used'] = 2;
            WaybillList::create($post);
            return $post['waybill_no'];
        }
    }
}


/**
 * get freight app customer
 * @return mixed
 */
if(!function_exists('getCustomerFromFreight')) {
    function getCustomerFromFreight()
    {
       return Client::where('is_project', 0)->get();
    }
}

/**
 * @param $direction
 * @return string
 */
if(!function_exists('generateNewShipmentReferenceNumber'))
{
    function generateNewShipmentReferenceNumber($direction)
    {
        $t = 'L';
        switch ($direction) {
            case 'import':
                $d = 'I';
                break;
            case 'export':
                $d = 'E';
                break;
            case 'domestic':
                $d = 'L';
                break;
            case 'cts':
                $d = 'CTS';
                break;
        }

        return "JIT$t$d-SP-" . date('y') . sprintf("%'.03d", getNextId());
    }
}

/**
 * get next shipping table id  from freight db
 * @return mixed
 */
if(!function_exists('getNextId'))
{
    function getNextId()
    {

        $query = Shipping::select('id')->orderBy('id', 'desc')->first();
        return $query->id + 1;
    }
}

/**
 * Generate md5 hash
 * @return string
 */
if(!function_exists('generateHash'))
{
    function generateHash()
    {
        return md5(rand() . microtime() . time() . uniqid());
    }
}

function GpsAPILogin(){
    $curl = curl_init();

    $arr = json_encode(array(
        "username" => env('GPS_USERNAME'),
        "password" => env('GPS_PASSWORD')
    ));

    curl_setopt_array($curl, array(
        CURLOPT_URL => env('GPS_API').'/login',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $arr,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    if($response){
        Session::put('token', json_decode($response,true)['token']);
    }
    return $response;
}

function GpsAPI($api){
    if(Session::get('token')) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('GPS_API') . $api,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer '.Session::get('token')
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        if ($response) {
            return json_decode($response, true);
        }
        return $response;
    }
    return false;
}

function getAllVehicleGPSAPI(){
    return GpsAPI('/vehicles/settings?withloc=1');
}

function getVehicleTracking($vehicle_id){
    return GpsAPI('/vehicles/settings/'.$vehicle_id.'?withloc=1');
}

/**
 * @param $gps_vehicle_id
 * @return void
 */
if(!function_exists('getTrackingInfo')){
    function getTrackingInfo($gps_vehicle_id, $gps_api_data)
    {
        $key = array_search($gps_vehicle_id, array_column($gps_api_data, 'VehicleID'));
        $rec = $gps_api_data[$key];
        $arr['lat'] = $rec['Latitude'];
        $arr['lng'] = $rec['Longitude'];
        $arr['display_name'] = $rec['DisplayName'];
        $arr['created_at'] = dateFormat($rec['RecordDateTime'], 'db_date');
        $arr['speed'] = $rec['Speed'];
        $arr['direction'] = $rec['Direction'];
        return $arr;
    }
}

if(!function_exists('externalVehicleTracking')){
    function externalVehicleTracking($vehicle_type = 0){
       $trips = Trip::select('trips.id', 'trips.waybill_no', 'trip_live_trackings.lat', 'trip_live_trackings.lng', 
        'vehicles.licence_plate_no', 'vehicles.display_name', 'drivers.driver_name',  'drivers.mobile',
         'vehicle_types.type_name', 'trip_live_trackings.created_at')
        ->join('trip_live_trackings', 'trip_live_trackings.trip_id', '=', 'trips.id')
        ->join('vehicles', 'vehicles.id', '=', 'trips.vehicle')
        ->join('drivers', 'drivers.id', '=', 'trips.driver')
        ->join('vehicle_types', 'vehicle_types.id', '=', 'vehicles.vehicle_type')
        ->where('trips.workspace_id',  Auth::user()->workspace_id)
        ->where('vehicles.gps_vehicle_id', 0)
        ->where('trips.is_delete', 0)
        ->whereNotIn('trips.status', array(4,19));
        $trips = $trips->whereRaw('trip_live_trackings.id IN (select max(trip_live_trackings.id) from trip_live_trackings where trip_live_trackings.trip_id = trips.id group by trip_live_trackings.trip_id)');
        if($vehicle_type){
            $trips = $trips->where('vehicle_types.id', $vehicle_type);
        }
        $trips = $trips->groupBy('trip_live_trackings.trip_id')
        ->get();
        return $trips;
    }
}


if(!function_exists('getDriver')){
    function getDriver($workspace_id){
        $query = Driver::where('workspace_id', $workspace_id);
        if(Auth::user()->company_id){
            $company_id = explode(',', Auth::user()->company_id);
            $query = $query::whereIn('drivers.company',$company_id);
        }
        if(Auth::user()->division_id){
            $division_id = explode(',', Auth::user()->division_id);
            $query = $query::whereIn('drivers.division',$division_id);
        }
        $query = $query->groupBy('drivers.license_number');
        return $query->get();
    }
}