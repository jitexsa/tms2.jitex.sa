<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 'date', 'rel_id', 'rel_type', 'staffid', 'full_name',
        'additional_data', 'category'
    ];

    protected $connection = 'freight';
    
    protected $table = 'tblsales_activity';
}
