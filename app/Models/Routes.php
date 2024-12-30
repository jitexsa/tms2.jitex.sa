<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Routes extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'location', 'location_map', 'place_id', 'isactive', 'workspace_id', 
    ];

    function getRoute(){
        return Routes::select('routes.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'routes.workspace_id')
        ->get();
    }
}
