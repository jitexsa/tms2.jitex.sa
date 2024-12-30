<?php

namespace App\Http\Controllers\TripManagement;

use App\Models\TripStatus as ModelsTripStatus;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripStatus extends Component
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
        $trip_status =  new ModelsTripStatus();
        $this->rec = $trip_status->getTripStatus();
        return view('trip-management.trip-status.index');
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
        $validated['is_default'] = 2;
        $validated['workspace_id'] = Auth::user()->workspace_id;
         ModelsTripStatus::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/trip/status'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsTripStatus::select('name')
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
        $validated['is_default'] = 2;
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsTripStatus::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
      $this->redirect('/trip/status'); 
  }

    /**
       * status disable
    */
  public function disable($id)
  {
      try {
        $postData = array(
            'is_disable' => 1
        );
        ModelsTripStatus::whereId($id)->update($postData);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
      $this->redirect('/trip/status'); 
  }

   /**
       * status enable
    */
    public function enable($id)
    {
        try {
          $postData = array(
              'is_disable' => 0
          );
          ModelsTripStatus::whereId($id)->update($postData);
          session()->flash('success', 'The data has been updated successfully.');
      } catch (\Exception $e) {
          session()->flash('error', $e->getMessage());
      }
        $this->redirect('/trip/status'); 
    }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsTripStatus::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/trip/status'); 
    }
}