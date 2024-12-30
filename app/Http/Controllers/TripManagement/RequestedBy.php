<?php

namespace App\Http\Controllers\TripManagement;

use App\Models\RequestedBy as ModelsRequestedBy;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestedBy extends Component
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
        $data =  new ModelsRequestedBy();
        $this->rec = $data->getRequestBy();
        return view('trip-management.requested-by.index');
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
        $validated['user_id'] = Auth::user()->id;
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsRequestedBy::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/trip/requested-by'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsRequestedBy::select('name')
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
        $validated['user_id'] = Auth::user()->id;
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsRequestedBy::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
      $this->redirect('/trip/requested-by'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsRequestedBy::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/trip/requested-by'); 
    }
}