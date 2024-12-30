<?php

namespace App\Http\Controllers\VehicleManagement;

use App\Models\LegalDocument as ModelsLegalDocument;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LegalDocument extends Component
{
/**
     * form fields
     * @var string[]
     */
    public $document_id, $vehicle, $last_issue_date, $expire_date, $document, $rec, $id;
    public $create = false;

    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model = new ModelsLegalDocument();
        $this->rec = $model->getLegalDocument();
        return view('vehicle-management.legal-document.index');
    }

    /**
      * save workspace
      */
      public function save()
      {
          $validated = $this->validate([
              'document_id' => 'required',
              'vehicle' => 'required',
              'last_issue_date' => 'required',
              'expire_date' => 'required'
          ]);
          try {
            $validated['last_issue_date'] = dateFormat($this->last_issue_date,'datedesc');
            $validated['expire_date'] = dateFormat($this->expire_date,'datedesc');
            $validated['workspace_id'] = Auth::user()->workspace_id;
            ModelsLegalDocument::create($validated);
             session()->flash('success', 'The data has been saved successfully.');
         } catch (\Exception $e) {
             session()->flash('error', $e->getMessage());
         }
          $this->redirect('/vehicle/legal-document'); 
      }
 
 
       /**
        * edit
        */
       function edit($id){
         $this->id = $id;
         $edit = ModelsLegalDocument::where('id', $id)->first()->toArray();
          foreach($edit as $key => $v){
            if(in_array($key, ['last_date', 'exp_date'])){
               $v = dateFormat($v,'report');
            }
            $this->{$key} = $v;
          }
         $this->create = true;
   }
 
   /**
    * update
    */
   public function update()
   {
 
    $validated = $this->validate([
        'document_id' => 'required',
        'vehicle' => 'required',
        'last_issue_date' => 'required',
        'expire_date' => 'required'
    ]);
    try {
        $validated['last_issue_date'] = dateFormat($this->last_issue_date,'datedesc');
        $validated['expire_date'] = dateFormat($this->expire_date,'datedesc');
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsLegalDocument::whereId($this->id)->update($validated);
         session()->flash('success', 'The data has been updated successfully.');
     } catch (\Exception $e) {
         session()->flash('error', $e->getMessage());
     }
       $this->redirect('/vehicle/legal-document'); 
   }
 
       /**
      * delete specific data from the listing
      * @param mixed $id
      * @return void
      */
     public function delete($id)
     {
         try{
            ModelsLegalDocument::find($id)->delete();
             session()->flash('success',"The selected data has been deleted successfully!!");
         }catch(\Exception $e){
             session()->flash('error', $e->getMessage());
         }
         $this->redirect('/vehicle/legal-document'); 
     }
 } 

