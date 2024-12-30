<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleMaker extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['make_name'];

    function getMaker(){
        return VehicleMaker::where('is_deleted', 1)->get();
    }
}
