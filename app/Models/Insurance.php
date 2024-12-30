<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Insurance extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'company', 'vehicle', 'recurring_period', 'recurring_date', 'start_date', 
        'end_date', 'policy_number', 'policy_document', 'workspace_id', 'status'
    ];

    function getInsurance(){
         return Insurance::select('insurances.*', 'companies.company_name',
         'vehicles.licence_plate_no', 'workspace.workspace_name')
        ->leftJoin('companies','companies.id', '=', 'insurances.company')
        ->leftJoin('vehicles','vehicles.id', '=', 'insurances.vehicle')
        ->join('workspace', 'workspace.id', '=', 'insurances.workspace_id')
        ->where('insurances.workspace_id', Auth::user()->workspace_id)
        ->orderBy('insurances.id', 'desc')
        ->get();
    }
}
