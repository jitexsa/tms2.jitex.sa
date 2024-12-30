<?php

namespace App\Http\Controllers\SystemSetting;

use App\Models\EmailSetting as ModelsEmailSetting;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailSetting extends Component
{
 
/**
     * form fields
     * @var string[]
     */
    public $id, $smtp_host, $smtp_port, $smtp_password, $protocol, $sender;
    public $create = false;

    /**
     * render view layout
     */
    public function render(Request $request)
    {
        $model =  new ModelsEmailSetting();
        $rec = $model->getEmailSetting();
        foreach($rec as $key => $v){
            $this->{$key} = $v;
          }
        return view('system-setting.email-setting.index');
    }

     /**
      * save workspace
      */
     public function save()
     {
         $validated = $this->validate([
             'smtp_host' => 'required',
             'smtp_port' => 'required',
             'smtp_password' => 'required',
             'protocol' => 'required',
             'sender' => 'required'
         ]);
         try {
        ModelsEmailSetting::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
            $this->redirect('/setting/email-setting'); 
     }

  /**
   * update
   */
  public function update()
  {
        $validated = $this->validate([
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'smtp_password' => 'required',
            'protocol' => 'required',
            'sender' => 'required'
        ]);

        try {
            ModelsEmailSetting::whereId($this->id)->update($validated);
            session()->flash('success', 'The data has been updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
            $this->redirect('/setting/email-setting');  
    }
}