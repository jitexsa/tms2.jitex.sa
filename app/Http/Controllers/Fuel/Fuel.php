<?php

namespace App\Http\Controllers\Fuel;

use App\Models\Fuel as ModelsFuel;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Fuel extends Component
{

/**
     * form fields
     * @var string[]
     */
    public $vehicle, $vendor_id, $refueling_date, $fuel_type_id, $start_meter, $qty, $reference, $cost, $state,
      $note, $slip, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model = new ModelsFuel();
        $this->rec = $model->getFuel();
        return view('fuel.fuel.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'vehicle' => 'required',
             'vendor_id' => 'required',
             'refueling_date' => 'required',
             'fuel_type_id' => 'required',
             'start_meter' => 'required',
             'qty' => 'required',
             'cost' => 'required',
             'state' => 'required'
         ]);
         try {
            $validated['refueling_date']  = dateFormat( $validated['refueling_date'],'datedesc');
            $validated['reference']  = $this->reference;
            $validated['note']  = $this->note;
            $validated['request_by'] = Auth::user()->id;
            $validated['workspace_id'] = Auth::user()->workspace_id;
            ModelsFuel::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
            $this->redirect('/fuel');  
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsFuel::where('id', $id)->first()->toArray();
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
        'vehicle' => 'required',
        'vendor_id' => 'required',
        'refueling_date' => 'required',
        'fuel_type_id' => 'required',
        'start_meter' => 'required',
        'qty' => 'required',
        'cost' => 'required',
        'state' => 'required'
    ]);

      try {
        $validated['refueling_date']  = dateFormat( $validated['refueling_date'],'datedesc');
        $validated['reference']  = $this->reference;
        $validated['note']  = $this->note;
        $validated['request_by'] = Auth::user()->id;
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsFuel::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error',  $e->getMessage());
    }
        $this->redirect('/fuel'); 
  }

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsFuel::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/fuel'); 
    }
}
