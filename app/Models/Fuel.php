<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Fuel extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'vehicle', 'vendor_id', 'refueling_date', 'fuel_type_id', 'start_meter', 'qty', 'reference', 'cost', 
        'state',  'note', 'slip', 'request_by', 'status', 'workspace_id'
    ];

    function getFuel(){

        return Fuel::select('fuels.*', 'fuel_types.type_name', 'workspace.workspace_name',
        'vehicles.licence_plate_no', 'users.firstname', 'users.lastname', 'vendors.vendor_name')
        ->where('fuels.workspace_id', Auth::user()->workspace_id)
        ->join('fuel_types', 'fuel_types.id', '=', 'fuels.fuel_type_id')
        ->join('workspace', 'workspace.id', '=', 'fuels.workspace_id')
        ->join('vehicles','vehicles.id', '=', 'fuels.vehicle')
        ->join('users','users.id', '=', 'fuels.request_by')
        ->leftJoin('vendors','vendors.id', '=', 'fuels.vendor_id')
        ->get();
    }
}
