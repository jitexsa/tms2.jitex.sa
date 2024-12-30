<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    protected $table = 'workspace';

    public $timestamps = true;
    protected $fillable = [
        'workspace_name', 'workspace_email', 'workspace_phone_number', 'workspace_status', 'vehicle_block', 
        'trip_block', 'remainder', 'trip_status_block', 'vehicle_map_tracking'
    ];
}
