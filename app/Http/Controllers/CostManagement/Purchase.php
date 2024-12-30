<?php

namespace App\Http\Controllers\CostManagement;

use App\Models\Purchase as ModelsPurchase;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Purchase extends Component
{
    
    use WithFileUploads;
    /**
   * form fields
   * @var string[]
   */
  public $vendor_id, $trip_id, $purchase_date, $purchase_amount, $invoice,
  $qb_project, $qb_invoice, $attachments, $rec, $id;
  public $category_id = [], $item = [], $quantity = [], $rate = [], $total_price = [];
  public $create = false;

  /**
   * render view layout
   */
  public function render(Request $request)
  {
      if($request->route()->getName() == 'add'){
          $this->create = true;
      }
      $model = new ModelsPurchase();
      $this->rec = $model->getPurchase();
      return view('cost-management.purchase.index');
    }

   /**
    * save workspace
    */
   public function save()
   {
       $validated = $this->validate([
           'vendor_id' => 'required',
           'trip_id' => 'required',
           'category_id' =>'required',
           'item' => 'required',
           'quantity' =>'required',  
           'rate' => 'required'
       ]);
       dd($validated);
       try {
          $validated['workspace_id'] = Auth::user()->workspace_id;
          ModelsPurchase::create($validated);
          session()->flash('success', 'The data has been saved successfully.');
      } catch (\Exception $e) {
          session()->flash('error', $e->getMessage());
      }
       $this->redirect('/cost/purchase'); 
   }


    /**
     * edit
     */
    function edit($id){
      $this->id = $id;
      $edit = ModelsPurchase::select('vendor_type', 'vendor_name', 'phone_number',
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
      $validated['workspace_id'] = Auth::user()->workspace_id;
      ModelsPurchase::whereId($this->id)->update($validated);
      session()->flash('success', 'The data has been updated successfully.');
  } catch (\Exception $e) {
      session()->flash('error',  $e->getMessage());
  }
      $this->redirect('/cost/purchase'); 
}

    /**
   * delete specific data from the listing
   * @param mixed $id
   * @return void
   */
  public function delete($id)
  {
      try{
        ModelsPurchase::find($id)->delete();
          session()->flash('success',"The selected data has been deleted successfully!!");
      }catch(\Exception $e){
          session()->flash('error', $e->getMessage());
      }
      $this->redirect('/cost/purchase'); 
  }
}