<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubContractor extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'transporter_name', 'contact_person', 'cr_number', 'landline_no', 'division', 'document_attachment',
        'status', 'onboarding_date', 'email', 'contact_no', 'vat_no', 'location', 'company', 'website', 'user_id',
        'workspace_id'
    ];

    function getSubContractor(){

     return SubContractor::select('sub_contractors.*',  
       'routes.location', 'divisions.division_name', 'companies.company_name',
        'contractor_statuses.name', 'workspace.workspace_name')
       ->selectRaw('(select sum(no_of_vehicles) from sub_contractor_details 
       where sub_contractor_details.contractor_id = sub_contractors.id) as total_vehicle')
       ->join('workspace', 'workspace.id', '=', 'sub_contractors.workspace_id')
       ->join('routes','routes.id', '=', 'sub_contractors.location')
      ->join('divisions', 'divisions.id', '=', 'sub_contractors.division')
      ->join('companies', 'companies.id', '=', 'sub_contractors.company')
      ->join('contractor_statuses', 'contractor_statuses.id', '=', 'sub_contractors.status')
      ->where('sub_contractors.workspace_id', Auth::user()->workspace_id)->get();
    }
}
