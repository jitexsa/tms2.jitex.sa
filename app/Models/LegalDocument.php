<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LegalDocument extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'document_id', 'vehicle', 'last_issue_date', 'expire_date', 'document', 'workspace_id'
    ];

    function getLegalDocument(){
        return LegalDocument::select('legal_documents.*', 'document_types.document_name',
         'vehicles.licence_plate_no', 'workspace.workspace_name')
        ->leftJoin('document_types','document_types.id', '=', 'legal_documents.document_id')
        ->leftJoin('vehicles','vehicles.id', '=', 'legal_documents.vehicle')
        ->join('workspace', 'workspace.id', '=', 'legal_documents.workspace_id')
        ->where('legal_documents.workspace_id', Auth::user()->workspace_id)
        ->orderBy('legal_documents.id', 'desc')
        ->get();
    }
}
