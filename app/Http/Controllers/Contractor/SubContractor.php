<?php

namespace App\Http\Controllers\Contractor;

use App\Models\SubContractor as ModelsSubContractor;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubContractor extends Component
{
     /**
     * form fields
     * @var string[]
     */
    public $transporter_name, $contact_person, $cr_number, $landline_no, $division, $document_attachment,
    $status, $onboarding_date, $email, $contact_no, $vat_no, $location, $company, $website, $rec, $id;
    public $create = false;

    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model = new ModelsSubContractor();
        $this->rec = $model->getSubContractor();
        return view('contractor.sub-contractor.index');
    }


    /**
      * save workspace
      */
      public function save()
      {
          $validated = $this->validate([
            'transporter_name' => 'required',
            'contact_person' => 'required',
            'division' => 'required',
            'status' => 'required',
            'onboarding_date' => 'required',
            'contact_no' => 'required',
            'location' => 'required',
            'company' => 'required'
          ]);
          try {
             $validated['onboarding_date']  = dateFormat( $validated['onboarding_date'],'datedesc');
             $validated['cr_number'] = $this->cr_number;
             $validated['landline_no'] = $this->landline_no;
             $validated['email'] = $this->email;
             $validated['vat_no'] = $this->vat_no;
             $validated['website'] = $this->website;
             $validated['workspace_id'] = Auth::user()->workspace_id;
             $validated['user_id'] = Auth::user()->id;
             ModelsSubContractor::create($validated);
             session()->flash('success', 'The data has been saved successfully.');
         } catch (\Exception $e) {
             session()->flash('error', $e->getMessage());
         }
             $this->redirect('/subcontractor');  
      }
 
 
       /**
        * edit
        */
       function edit($id){
         $this->id = $id;
         $edit = ModelsSubContractor::where('id', $id)->first()->toArray();
          foreach($edit as $key => $v){
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
        'transporter_name' => 'required',
        'contact_person' => 'required',
        'division' => 'required',
        'status' => 'required',
        'onboarding_date' => 'required',
        'contact_no' => 'required',
        'location' => 'required',
        'company' => 'required'
      ]);
      try {
         $validated['onboarding_date']  = dateFormat( $validated['onboarding_date'],'datedesc');
         $validated['cr_number'] = $this->cr_number;
         $validated['landline_no'] = $this->landline_no;
         $validated['email'] = $this->email;
         $validated['vat_no'] = $this->vat_no;
         $validated['website'] = $this->website;
         $validated['workspace_id'] = Auth::user()->workspace_id;
         $validated['user_id'] = Auth::user()->id;
         ModelsSubContractor::whereId($this->id)->update($validated);
         session()->flash('success', 'The data has been updated successfully.');
     } catch (\Exception $e) {
         session()->flash('error',  $e->getMessage());
     }
         $this->redirect('/subcontractor'); 
   }
 
       /**
      * delete specific data from the listing
      * @param mixed $id
      * @return void
      */
     public function delete($id)
     {
         try{
            ModelsSubContractor::find($id)->delete();
             session()->flash('success',"The selected data has been deleted successfully!!");
         }catch(\Exception $e){
             session()->flash('error', $e->getMessage());
         }
         $this->redirect('/subcontractor'); 
     }
 }