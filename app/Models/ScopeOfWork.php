<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ScopeOfWork extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'workspace_id', 'name'
    ];

    function getSOW(){
        return ScopeOfWork::select('scope_of_works.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'scope_of_works.workspace_id')
        ->get();
    }
}
