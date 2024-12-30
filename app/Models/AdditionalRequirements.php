<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AdditionalRequirements extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = ['name', 'labor_type', 'workspace_id'];

    function getData(){
        return AdditionalRequirements::select('additional_requirements.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'additional_requirements.workspace_id')
        ->get();
    }
}
