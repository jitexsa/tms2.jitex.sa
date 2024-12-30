<?php

namespace App\Http\Controllers\CostManagement;

use App\Models\Item as ModelsItem;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Item extends Component
{
    
/**
     * form fields
     * @var string[]
     */
    public $category_id, $item_name, $item_price, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model = new ModelsItem();
        $this->rec = $model->getItems();
        return view('cost-management.item.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'category_id' => 'required',
             'item_name' => 'required'
         ]);
         try {
            $validated['item_price'] = $this->item_price;
            $validated['workspace_id'] = Auth::user()->workspace_id;
            ModelsItem::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
            $this->redirect('/cost/item'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsItem::select('category_id', 'item_name', 'item_price')
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
        'category_id' => 'required',
        'item_name' => 'required'
    ]);
    try {
        $validated['item_price'] = $this->item_price;
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsItem::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
        $this->redirect('/cost/item'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsItem::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/cost/item'); 
    }
}
