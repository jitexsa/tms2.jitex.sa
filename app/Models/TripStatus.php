<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TripStatus extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'user_id', 'name', 'is_default', 'ordering', 'is_disable', 'workspace_id', 
    ];

    function getTripStatus(){
        return TripStatus::select('trip_statuses.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'trip_statuses.workspace_id')
        ->get();
    }

    function getWorkspaceStatus(){
        return TripStatus::select('trip_statuses.id', 'trip_statuses.name')
        ->selectRaw(
        '(select COUNT(trips.id) from trips where trips.status = trip_statuses.id 
        and trips.is_delete = 0 and trips.workspace_id = '.Auth::user()->workspace_id.') 
        as total_waybill_status')
        ->whereIn('trip_statuses.workspace_id', array(Auth::user()->workspace_id, 1))
        ->where('is_disable', 0)
        ->orderBy('trip_statuses.ordering', 'asc')
        ->get();
    }
}
