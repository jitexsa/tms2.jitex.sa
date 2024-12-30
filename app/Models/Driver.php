<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Driver extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'driver_name', 'mobile', 'passport_no', 'passport_expiry', 'nationality', 'location', 'picture',
        'join_date', 'company', 'status', 'division', 'workspace', 'subcontractor', 'port_id_number',
        'port_id_end_date', 'port_attachment', 'national_id', 'iqama_expiry_date', 'iqama_image',
        'license_type', 'license_number', 'license_expiry_date', 'license_issue_date', 'license_image',
        'workspace_id'
    ];

    function getDriver(){

       $driver = Driver::select('drivers.*','divisions.division_name', 'companies.company_name',
        'workspace.workspace_name', 'locations.location_name', 'vehicles.licence_plate_no', 
        'trips.waybill_no', 'sub_contractors.transporter_name')
        ->leftJoin('divisions', 'divisions.id', '=', 'drivers.division')
        ->leftJoin('companies', 'companies.id', '=', 'drivers.company')
        ->leftJoin('locations', 'locations.id', '=', 'drivers.location')
        ->leftJoin('vehicles', 'vehicles.driver_id', '=', 'drivers.id')
        ->leftJoin('trips', 'trips.driver', '=', 'drivers.id')
        ->leftJoin('sub_contractors', 'sub_contractors.id', '=', 'drivers.subcontractor')
        ->join("workspace", "workspace.id", "=", "drivers.workspace_id")
        ->where('drivers.workspace_id', Auth::user()->workspace_id);
        if(Auth::user()->company_id){
            $company_id = explode(',', Auth::user()->company_id);
            $driver = $driver->whereIn('drivers.company',$company_id);
        }
        if(Auth::user()->division_id){
            $division_id = explode(',', Auth::user()->division_id);
            $driver = $driver->whereIn('drivers.division',$division_id);
        }
        $driver = $driver->groupBy('drivers.license_number')
        ->orderBy('drivers.id', 'desc')
        ->get();
        return $driver;
    }
}
