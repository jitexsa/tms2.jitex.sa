<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Employee extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
       'workspace_id', 'emp_name', 'payroll_type', 'department', 'designation', 'emp_nid', 'emp_phone',
        'emp_email', 'join_date', 'dob', 'location', 'picture', 'isactive',
    ];

    function getEmployee(){
       return Employee::select('employees.*', 'workspace.workspace_name', 'locations.location_name')
        ->leftJoin('locations', 'locations.id', '=', 'employees.location')
        ->join("workspace", "workspace.id", "=", "employees.workspace_id")
        ->where('employees.workspace_id', Auth::user()->workspace_id)
        ->orderBy('employees.id', 'desc')->get();
    }
}
