<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSetting extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'smtp_host', 'smtp_port', 'smtp_password', 'protocol', 'sender'
    ];

    function getEmailSetting(){
        return EmailSetting::select('id',  'smtp_host', 'smtp_port',
         'smtp_password', 'protocol', 'sender')->first()->toArray();
    }
}
