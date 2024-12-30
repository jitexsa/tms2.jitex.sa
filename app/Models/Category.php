<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'name', 'workspace_id', 
    ];

    function getCategory(){
        return Category::select('categories.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'categories.workspace_id')
        ->get();
    }
}
