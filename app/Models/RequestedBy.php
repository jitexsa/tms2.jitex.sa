<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RequestedBy extends Model
{
    use HasFactory;

    protected $table = 'requested_by';

    public $timestamps = true;
    protected $fillable = [
        'user_id', 'name', 'workspace_id', 
    ];

    function getRequestBy($id = ''){
        $query = RequestedBy::select('requested_by.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'requested_by.workspace_id');
        if($id)
        {
            return $query->where('id' , $id) ->first();
        }
       return $query->get();
    }
}
