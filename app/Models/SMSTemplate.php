<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SMSTemplate extends Model
{
    use HasFactory;

    protected $table = 'sms_templates';
    public $timestamps = true;
    protected $fillable = [
        'template_id', 'description', 'workspace_id', 
    ];

    function getSMS(){
        return SMSTemplate::select('sms_templates.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'sms_templates.workspace_id')
        ->get();
    }
}
