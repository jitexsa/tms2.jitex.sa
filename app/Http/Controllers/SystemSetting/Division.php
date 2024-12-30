<?php

namespace App\Http\Controllers\SystemSetting;

use App\Models\Division as ModelsDivision;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Division extends Component
{
  
/**
     * form fields
     * @var string[]
     */
    public $division_name, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model =  new ModelsDivision();
        $this->rec = $model->getDivision();
        return view('system-setting.division.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'division_name' => 'required'
         ]);
         try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsDivision::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
            $this->redirect('/setting/division'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsDivision::where('id', $id)->first()->toArray();
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
         'division_name' => 'required'
    ]);

      try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsDivision::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
        $this->redirect('/setting/division');  
}

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsDivision::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/setting/division'); 
    }
}


