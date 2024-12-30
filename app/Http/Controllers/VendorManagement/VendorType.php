<?php

namespace App\Http\Controllers\VendorManagement;

use App\Models\VendorType as ModelsVendorType;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VendorType extends Component
{
        /**
     * form fields
     * @var string[]
     */
    public $vendor_type, $vendor_category, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $vendor_type = new ModelsVendorType();
        $this->rec = $vendor_type->getVendorType();
        return view('vendor-management.type.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'vendor_type' => 'required',
             'vendor_category' => 'required'
         ]);
         try {
            $validated['workspace_id'] = Auth::user()->workspace_id;
            ModelsVendorType::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/vendor/vendor-type'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsVendorType::select('workspace_id', 'vendor_type', 'vendor_category')
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
        'vendor_category' => 'required'
    ]);

      try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsVendorType::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error',  $e->getMessage());
    }
        $this->redirect('/vendor/vendor-type'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsVendorType::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/vendor/vendor-type'); 
    }
}
