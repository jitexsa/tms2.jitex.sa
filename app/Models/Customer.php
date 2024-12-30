<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'customer_name', 'mobile', 'address', 'country_id', 'division_id', 
        'cr_number', 'email', 'city', 'company_id', 'is_sms', 'workspace_id', 'is_active'
    ];


    function getCustomer(){

       $query =  Customer::select('customers.*', 'divisions.division_name',
       'countries.country_name', 'companies.company_name', 'workspace.workspace_name')
       ->where('customers.workspace_id', Auth::user()->workspace_id)
       ->join('countries', 'countries.country_id', '=', 'customers.country_id')
       ->join('divisions', 'divisions.id', '=', 'customers.division_id')
       ->join('companies', 'companies.id', '=', 'customers.company_id')
       ->join('workspace', 'workspace.id', '=', 'customers.workspace_id');
       
        if(Auth::user()->company_id){
            $company_id = explode(',', Auth::user()->company_id);
            $query = $query->whereIn('customers.company_id', $company_id);
        }
        if(Auth::user()->division_id){
            $division_id = explode(',', Auth::user()->division_id);
            $query= $query->whereIn('customers.division_id', $division_id);
        }
            
      return  $query->get();
    }
}
