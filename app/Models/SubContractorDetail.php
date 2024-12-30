<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubContractorDetail extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'user_id', 'contractor_id', 'fleet_type', 'no_of_vehicles', 'location', 'remarks'
    ];

    function getSubContractorDetail($contract_id){

     return SubContractorDetail::select('sub_contractor_details.*', 'vehicle_types.type_name',
     'routes.location')
      ->join('vehicle_types','vehicle_types.id', '=', 'sub_contractor_details.fleet_type')
      ->join('routes', 'routes.id', '=', 'sub_contractor_details.location')
      ->where('sub_contractor_details.contractor_id', $contract_id)->get();
    }
}
