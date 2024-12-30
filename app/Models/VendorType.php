<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class VendorType extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'vendor_type', 'vendor_category', 'workspace_id'
    ];

    function getVendorType(){

        return VendorType::select('vendor_types.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'vendor_types.workspace_id')
        ->get();
    }
}
