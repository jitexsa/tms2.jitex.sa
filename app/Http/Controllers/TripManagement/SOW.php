<?php

namespace App\Http\Controllers\TripManagement;

use App\Models\ScopeOfWork;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SOW extends Component
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
        $sow =  new ScopeOfWork();
        $this->rec = $sow->getSOW();
        return view('trip-management.sow.index');
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
        ScopeOfWork::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/trip/sow'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ScopeOfWork::select('name')
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
         'name' => 'required'
    ]);

      try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ScopeOfWork::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
      $this->redirect('/trip/sow'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ScopeOfWork::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/trip/sow'); 
    }
}
