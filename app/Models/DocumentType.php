<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DocumentType extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'document_name', 'workspace_id', 
    ];

    function getDocumentTypes(){
        return DocumentType::select('document_types.*', 'workspace.workspace_name')
        ->where('workspace_id', Auth::user()->workspace_id)
        ->join('workspace', 'workspace.id', '=', 'document_types.workspace_id')
        ->get();
    }
}
