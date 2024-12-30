<?php

namespace App\Http\Controllers\SystemSetting;

use App\Models\SMSTemplate as ModelsSMSTemplate;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SMSTemplate extends Component
{
/**
     * form fields
     * @var string[]
     */
    public $description, $rec, $id;
    public $create = false;

/**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model =  new ModelsSMSTemplate();
        $this->rec = $model->getSMS();
        return view('system-setting.sms-template.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'description' => 'required'
         ]);
         try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsSMSTemplate::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/setting/sms-template'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsSMSTemplate::select('description')
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
         'description' => 'required'
    ]);

      try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsSMSTemplate::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
    $this->redirect('/setting/sms-template');
}

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsSMSTemplate::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/setting/sms-template'); 
    }
}
