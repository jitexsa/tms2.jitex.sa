<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreightCustomer extends Model
{
    use HasFactory;

    protected $connection = 'freight';

    protected $table = 'tblcustomer_admins';
}
