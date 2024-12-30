<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Company extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'company_name', 'workspace_id', 
    ];

    function getCompanies(){
        return Company::select('companies.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'companies.workspace_id')
        ->get();
    }
}
