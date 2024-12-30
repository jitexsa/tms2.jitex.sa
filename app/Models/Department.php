<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Department extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'workspace_id', 'department_name'
    ];

    function getDepartment(){
        return Department::select('departments.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'departments.workspace_id')
        ->get();
    }
}
