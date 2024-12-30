<?php

namespace App\Http\Controllers\VehicleManagement;

use App\Models\Routes;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Route extends Component
{
    /**
     * form fields
     * @var string[]
     */
    public $location, $location_map, $place_id, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model = new Routes();
        $this->rec = $model->getRoute();
        return view('vehicle-management.route.index');
    }
 /**
      * save workspace
      */
      public function save()
      {
          $validated = $this->validate([
              'location' => 'required'
          ]);
          try {
             $validated['location_map'] = $this->location_map;
             $validated['place_id'] = $this->place_id;
             $validated['isactive'] = 1;
             $validated['workspace_id'] = Auth::user()->workspace_id;
             Routes::create($validated);
             session()->flash('success', 'The data has been saved successfully.');
         } catch (\Exception $e) {
             session()->flash('error', $e->getMessage());
         }
          $this->redirect('/vehicle/route'); 
      }
 
 
       /**
        * edit
        */
       function edit($id){
         $this->id = $id;
         $edit = Routes::where('id', $id)->first()->toArray();
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
        'location' => 'required'
    ]);
    try {
         $validated['location_map'] = $this->location_map;
         $validated['place_id'] = $this->place_id;
         $validated['isactive'] = 1;
         $validated['workspace_id'] = Auth::user()->workspace_id;
         Routes::whereId($this->id)->update($validated);
         session()->flash('success', 'The data has been updated successfully.');
     } catch (\Exception $e) {
         session()->flash('error', $e->getMessage());
     }
       $this->redirect('/vehicle/route'); 
   }
 
       /**
      * delete specific data from the listing
      * @param mixed $id
      * @return void
      */
     public function delete($id)
     {
         try{
             Routes::find($id)->delete();
             session()->flash('success',"The selected data has been deleted successfully!!");
         }catch(\Exception $e){
             session()->flash('error', $e->getMessage());
         }
         $this->redirect('/vehicle/route'); 
     }
 }
 
