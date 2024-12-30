<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Division extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'division_name', 'workspace_id', 
    ];

    function getDivision(){
        return Division::select('divisions.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'divisions.workspace_id')
        ->get();
    }
}
