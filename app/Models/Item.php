<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'category_id', 'item_name', 'item_price', 'workspace_id', 
    ];

    function getItems(){
        return Item::select('items.*', 'workspace.workspace_name', 'categories.name')
        ->where('items.workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'items.workspace_id')
        ->join('categories', 'categories.id', '=', 'items.category_id')
        ->get();
    }

    function getItemByCategory($id) {
        return Item::select('items.*')
        ->where('items.category_id', $id)
        ->get();
    }
}
