<?php

namespace App\Http\Controllers\Contractor;

use App\Models\ContractorStatus as ModelsContractorStatus;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ContractorStatus extends Component
{
 /**
     * form fields
     * @var string[]
     */
    public $name, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model = new ModelsContractorStatus();
        $this->rec = $model->getContractorStatus();
        return view('contractor.contractor-status.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'name' => 'required'
         ]);
         try {
            $validated['workspace_id'] = Auth::user()->workspace_id;
            $validated['user_id'] = Auth::user()->id;
            ModelsContractorStatus::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
            $this->redirect('/subcontractor/contractor-status');  
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsContractorStatus::where('id', $id)->first()->toArray();
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
        'name' => 'required'
    ]);

      try {
        $validated['user_id'] = Auth::user()->id;
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsContractorStatus::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error',  $e->getMessage());
    }
        $this->redirect('/subcontractor/contractor-status'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsContractorStatus::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/subcontractor/contractor-status'); 
    }
}
