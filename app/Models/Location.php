<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Location extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'workspace_id', 'location_name'
    ];

    function getLocation(){
        return Location::select('locations.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'locations.workspace_id')
        ->get();
    }
}
