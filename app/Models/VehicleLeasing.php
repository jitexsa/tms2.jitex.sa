<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VehicleLeasing extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
      'customer_id', 'company', 'lease_type', 'vehicle', 'start_date', 'end_date',
      'attachments', 'workspace_id'
    ];

    function getVehicleLeasing(){
        return VehicleLeasing::select('vehicle_leasings.*','companies.company_name',
        'vehicles.licence_plate_no', 'workspace.workspace_name', 'customers.customer_name')
        ->leftJoin('companies','companies.id', '=', 'vehicle_leasings.company')
        ->leftJoin('vehicles','vehicles.id', '=', 'vehicle_leasings.vehicle')
        ->leftJoin('customers','customers.id', '=', 'vehicle_leasings.customer_id')
        ->join('workspace', 'workspace.id', '=', 'vehicle_leasings.workspace_id')
        ->where('vehicle_leasings.workspace_id', Auth::user()->workspace_id)
        ->orderBy('vehicle_leasings.id', 'desc')
        ->get();
    }
}
