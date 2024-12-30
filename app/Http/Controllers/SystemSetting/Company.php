<?php

namespace App\Http\Controllers\SystemSetting;

use App\Models\Company as ModelsCompany;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Company extends Component
{

/**
     * form fields
     * @var string[]
     */
    public $company_name, $rec, $id;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $model =  new ModelsCompany();
        $this->rec = $model->getCompanies();
        return view('system-setting.company.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'company_name' => 'required'
         ]);
         try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsCompany::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
            $this->redirect('/setting/company'); 
     }


      /**
       * edit
       */
      function edit($id){
        $this->id = $id;
        $edit = ModelsCompany::select('company_name')
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
         'company_name' => 'required'
    ]);

      try {
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsCompany::whereId($this->id)->update($validated);
        session()->flash('success', 'The data has been updated successfully.');
    } catch (\Exception $e) {
        session()->flash('error', $e->getMessage());
    }
        $this->redirect('/setting/company');  
}

      /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            ModelsCompany::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/setting/company'); 
    }
}