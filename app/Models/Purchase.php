<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Purchase extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'vendor_id', 'trip_id', 'purchase_date', 'purchase_amount', 'invoice',
        'qb_project', 'qb_invoice', 'attachments', 'workspace_id'
    ];


    function getPurchase(){
        return Purchase::select('purchases.*', 'vendors.vendor_name', 'trips.waybill_no',
         'workspace.workspace_name')
        ->join('vendors', 'vendors.id', '=', 'purchases.vendor_id')
        ->join('trips', 'trips.id', '=', 'purchases.trip_id')
        ->join('workspace', 'workspace.id', '=', 'purchases.workspace_id')
        ->where('purchases.workspace_id', Auth::user()->workspace_id)
        ->get();
    }
}
