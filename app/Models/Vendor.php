<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Vendor extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'vendor_type', 'vendor_name', 'phone_number', 'address', 'cr_attachment',
        'vat_certificate', 'bank_name', 'account_number', 'branch_code', 'iban_no', 'workspace_id'
    ];

    function getVendor(){

        return Vendor::select('vendors.*', 'vendor_types.vendor_type', 'workspace.workspace_name')
        ->where('vendors.workspace_id', Auth::user()->workspace_id)
        ->join('vendor_types', 'vendor_types.id', '=', 'vendors.vendor_type')
        ->join('workspace', 'workspace.id', '=', 'vendors.workspace_id')
        ->get();
    }

    function getFuelVendor(){

        return Vendor::select('vendors.*', 'vendor_types.vendor_type', 'workspace.workspace_name')
        ->where('vendors.workspace_id', Auth::user()->workspace_id)
        ->where('vendor_types.vendor_category', 1)
        ->join('vendor_types', 'vendor_types.id', '=', 'vendors.vendor_type')
        ->join('workspace', 'workspace.id', '=', 'vendors.workspace_id')
        ->get();
    }
}
