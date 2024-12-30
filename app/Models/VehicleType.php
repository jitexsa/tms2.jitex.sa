<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VehicleType extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'workspace_id', 'type_name'
    ];

    function getVehicleType(){
        return VehicleType::select('vehicle_types.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'vehicle_types.workspace_id')
        ->get();
    }
}
