<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'transport', 'shipment_type', 'direction', 'clientid', 'assigned', 'rel_id',
        'userid', 'shipment_reference_number', 'hash', 'rel_type', 'contractual_shipments',
        'edit_route_info', 'edit_package_info', 'datecreated', 'date'
    ];

    protected $connection = 'freight';

    protected $table = 'tblshippings';
}
