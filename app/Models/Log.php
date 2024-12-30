<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Log extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'log_type', 'log_type_id', 'action', 'log_content', 'workspace_id' 
    ];

    function getLogs(){
        return Log::select('logs.*', 'workspace.workspace_name')
        ->where('logs.workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'logs.workspace_id')
        ->get();
    }
}
