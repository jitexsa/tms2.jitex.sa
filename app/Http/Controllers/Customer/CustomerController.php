<?php

namespace App\Http\Controllers\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;

class CustomerController extends Component
{
    
      /**
     * form fields
     * @var string[]
     */
    public $customer_name, $mobile, $address, $country_id, $division_id, 
        $cr_number, $email, $city, $company_id, $is_sms, $rec, $id;
    public $create = false;


    /**
     * render view layout
     */
    public function render(Request $request)
    {
        if($request->route()->getName() == 'add'){
            $this->create = true;
        }
        $customer = new Customer();
        $this->rec = $customer->getCustomer();
        return view('customer.index');
    }

    /**
      * save
      */
      public function save()
      {

          $validated = $this->validate([
              'customer_name' => 'required',
              'mobile' => 'required',
              'address' => 'required',
              'country_id' => 'required',
              'division_id' => 'required',
              'email' => 'required',
              'city' => 'required',
              'company_id' => 'required',
              'is_sms' => 'required'
          ]);
          try {
          $validated['workspace_id'] = Auth::user()->workspace_id;
          Customer::create($validated);
            session()->flash('success', 'The data has been saved successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
          $this->redirect('/customer'); 
      }

      /**
       * edit
       */
      function edit($id){
            $this->id = $id;
            $edit = Customer::select('id', 'customer_name', 'mobile', 'address', 'division_id',
            'email', 'city', 'company_id', 'is_sms')->where('id', $id)->first()->toArray();
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
              'customer_name' => 'required',
              'mobile' => 'required',
              'address' => 'required',
              'country_id' => 'required',
              'division_id' => 'required',
              'email' => 'required',
              'city' => 'required',
              'company_id' => 'required',
              'is_sms' => 'required'
          ]);
          try {
          $validated['workspace_id'] = Auth::user()->workspace_id;
          Customer::whereId($this->id)->update($validated);
            session()->flash('success', 'The data has been updated successfully.');
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
          $this->redirect('/customer'); 
      }


    /**
     * delete specific data from the listing
     * @param mixed $id
     * @return void
     */
    public function delete($id)
    {
        try{
            Customer::find($id)->delete();
            session()->flash('success',"The selected data has been deleted successfully!!");
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
        }
        $this->redirect('/customer'); 
    }
}
