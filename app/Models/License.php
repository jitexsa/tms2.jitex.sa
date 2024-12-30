<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class License extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'workspace_id', 'license_name'
    ];

    function getLicense(){
        return License::select('licenses.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'licenses.workspace_id')
        ->get();
    }
}
