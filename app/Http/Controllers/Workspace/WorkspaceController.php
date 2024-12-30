<?php

namespace App\Http\Controllers\Workspace;

use App\Models\Workspace;
use Livewire\Component;
use Illuminate\Http\Request;

class WorkspaceController extends Component
{

        /**
     * form fields
     * @var string[]
     */
    public $workspace_name, $workspace_email, $workspace_phone_number, $workspace_status, $vehicle_block,
     $trip_block, $remainder, $trip_status_block, $vehicle_map_tracking, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $this->rec = Workspace::all();
        return view('workspace.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'workspace_name' => 'required',
             'workspace_status' => 'required',
             'vehicle_block' => 'required',
             'trip_block' => 'required',
             'remainder' => 'required',
             'trip_status_block' => 'required',
             'vehicle_map_tracking' => 'required'
         ]);
         try {
         $validated['workspace_email'] = $this->workspace_email;
         $validated['workspace_phone_number'] = $this->workspace_phone_number;
         Workspace::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
         $this->redirect('/workspace'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = Workspace::select('id', 'workspace_name', 'workspace_email', 'workspace_phone_number', 
         'workspace_status','vehicle_block', 'trip_block', 'remainder', 'trip_status_block',
         'vehicle_map_tracking')
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
        'workspace_name' => 'required',
        'workspace_status' => 'required',
        'vehicle_block' => 'required',
        'trip_block' => 'required',
        'remainder' => 'required',
        'trip_status_block' => 'required',
        'vehicle_map_tracking' => 'required'
    ]);

      try {
        $validated['workspace_email'] = $this->workspace_email;
        $validated['workspace_phone_number'] = $this->workspace_phone_number;
        Workspace::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
      $this->redirect('/workspace'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            Workspace::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/workspace'); 
    }
}
