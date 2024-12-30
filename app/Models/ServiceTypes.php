<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ServiceTypes extends Model
{
    use HasFactory;
    
    public $timestamps = true;
    protected $fillable = [
        'name', 'workspace_id', 
    ];

    function getServiceTypes(){
        return ServiceTypes::select('service_types.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'service_types.workspace_id')
        ->get();
    }
}
