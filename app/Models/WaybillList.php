<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaybillList extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'waybill_no', 'user_id', 'workspace_id', 'is_used'
    ];
}
