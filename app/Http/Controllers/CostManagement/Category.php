<?php

namespace App\Http\Controllers\CostManagement;

use App\Models\Category as ModelsCategory;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Category extends Component
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
        $category =  new ModelsCategory();
        $this->rec = $category->getCategory();
        return view('cost-management.category.index');
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
        ModelsCategory::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
            $this->redirect('/cost/category'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsCategory::select('name')
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
        ModelsCategory::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
        $this->redirect('/cost/category'); 
}

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsCategory::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/cost/category'); 
    }
}
