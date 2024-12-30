<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FuelType extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'type_name', 'workspace_id'
    ];

    function getFuelType(){

        return FuelType::select('fuel_types.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'fuel_types.workspace_id')
        ->get();
    }
}
