<?php

namespace App\Http\Controllers\VendorManagement;

use App\Models\Vendor as ModelsVendor;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Vendor extends Component
{
    use WithFileUploads;
      /**
     * form fields
     * @var string[]
     */
    public $vendor_type, $vendor_name, $phone_number, $address, $cr_attachment,
    $vat_certificate, $bank_name, $account_number, $branch_code, $iban_no, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model = new ModelsVendor();
        $this->rec = $model->getVendor();
        return view('vendor-management.vendor.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'vendor_type' => 'required',
             'vendor_name' => 'required'
         ]);
         try {
            // $cr_attachment = $this->cr_attachment->store(path: getenv('UPLOADS'));
            // $vat_certificate = $this->vat_certificate->store(path: getenv('UPLOADS'));
            $validated['phone_number'] = $this->phone_number;
            $validated['address'] = $this->address;
            $validated['cr_attachment'] = $this->cr_attachment;
            $validated['vat_certificate'] = $this->vat_certificate;
            $validated['bank_name'] = $this->bank_name;
            $validated['account_number'] = $this->account_number;
            $validated['branch_code'] = $this->branch_code;
            $validated['iban_no'] = $this->iban_no;
            $validated['workspace_id'] = Auth::user()->workspace_id;
            ModelsVendor::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/vendor'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsVendor::select('vendor_type', 'vendor_name', 'phone_number',
        'address', 'cr_attachment', 'vat_certificate', 'bank_name', 'account_number',
        'branch_code',  'iban_no', 'workspace_id')
         ->where('id', $id)->first()->toArray();
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
        'vendor_type' => 'required',
        'vendor_name' => 'required'
    ]);
    try {
        $validated['phone_number'] = $this->phone_number;
        $validated['address'] = $this->address;
        $validated['cr_attachment'] = $this->cr_attachment;
        $validated['vat_certificate'] = $this->vat_certificate;
        $validated['bank_name'] = $this->bank_name;
        $validated['account_number'] = $this->account_number;
        $validated['branch_code'] = $this->branch_code;
        $validated['iban_no'] = $this->iban_no;
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsVendor::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error',  $e->getMessage());
    }
        $this->redirect('/vendor'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsVendor::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/vendor'); 
    }
}
