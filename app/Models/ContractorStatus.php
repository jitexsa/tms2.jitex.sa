<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ContractorStatus extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'name', 'user_id', 'ordering', 'workspace_id', 
    ];

    function getContractorStatus(){
        return ContractorStatus::select('contractor_statuses.*', 'workspace.workspace_name')
        ->where('contractor_statuses.workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'contractor_statuses.workspace_id')
        ->get();
    }
}
