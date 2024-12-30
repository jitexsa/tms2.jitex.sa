<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['make_id', 'model_name'];

    function getModels(){
        return VehicleModel::select('vehicle_models.*', 'vehicle_makers.make_name')
        ->join('vehicle_makers', 'vehicle_makers.id', '=', 'vehicle_models.make_id')
        ->where('vehicle_models.is_deleted', 1)
        ->where('vehicle_models.is_deleted', 1)->get();
    }
}
