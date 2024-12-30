<?php

namespace App\Http\Controllers\VehicleManagement;

use App\Models\Setting;
use App\Models\VehicleInspection as ModelsVehicleInspection;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleInspection extends Component
{
    /**
     * form fields
     * @var string[]
     */
    public $vehicle, $inspection_date, $kms_in, $datetime_in, $datetime_out, $petrol_card, $petrol_card_text,
    $invertor, $invertor_text, $int_damage, $int_damage_text, $ext_car, $ext_car_text, $ladder,
    $ladder_text, $power_tool, $power_tool_text, $head_light, $head_light_text, $windows,
    $windows_text, $oil_chk, $oil_chk_text, $tool_box, $tool_box_text, $inspected_by,
    $vehicle_inspection_image, $lights, $lights_text, $car_mats, $car_mats_text,
    $int_lights, $int_lights_text, $tyre, $tyre_text, $leed, $leed_text, $ac, $ac_text,
    $lock, $lock_text, $condition, $condition_text, $suspension, $suspension_text, $rec, $id;
    public $create = false;

    public function render(Request $request)
    {
        if($request->route()->getName() == 'pdf' and $request->route()->parameters['id'])
        {
                $this->pdf( $request->route()->parameters['id']);
        }
        else
        {
            if($request->route()->getName() == 'add'){
                $this->create = true;
            }
            $model = new ModelsVehicleInspection();
            $this->rec = $model->getInspection();
            return view('vehicle-management.inspection.index');
        }
    }

    /**
      * save workspace
      */
      public function save()
      {
          $validated = $this->validate([
                'vehicle' => 'required',
                'inspection_date' => 'required',
                'kms_in' => 'required',
                'datetime_in' => 'required',
                'datetime_out' => 'required',
                'inspected_by' => 'required'
          ]);
          try {
            $validated['petrol_card'] = $this->petrol_card;
            $validated['petrol_card_text'] = $this->petrol_card_text;
            $validated['invertor'] = $this->invertor;
            $validated['invertor_text'] = $this->invertor_text;
            $validated['int_damage'] = $this->int_damage;
            $validated['int_damage_text'] = $this->int_damage_text;
            $validated['ext_car'] = $this->ext_car;
            $validated['ext_car_text'] = $this->ext_car_text;
            $validated['ladder'] = $this->ladder;
            $validated['ladder_text'] = $this->ladder_text;
            $validated['power_tool'] = $this->power_tool;
            $validated['power_tool_text'] = $this->power_tool_text;
            $validated['head_light'] = $this->head_light;
            $validated['head_light_text'] = $this->head_light_text;
            $validated['windows'] = $this->windows;
            $validated['windows_text'] = $this->windows_text;
            $validated['oil_chk'] = $this->oil_chk;
            $validated['oil_chk_text'] = $this->oil_chk_text;
            $validated['tool_box'] = $this->tool_box;
            $validated['tool_box_text'] = $this->tool_box_text;
            $validated['lights'] = $this->lights;
            $validated['lights_text'] = $this->lights_text;
            $validated['car_mats'] = $this->car_mats;
            $validated['car_mats_text'] = $this->car_mats_text;
            $validated['int_lights'] = $this->int_lights;
            $validated['int_lights_text'] = $this->int_lights_text;
            $validated['tyre'] = $this->tyre;
            $validated['tyre_text'] = $this->tyre_text;
            $validated['leed'] = $this->leed;
            $validated['leed_text'] = $this->leed_text;
            $validated['ac'] = $this->ac_text;
            $validated['lock'] = $this->lock;
            $validated['lock_text'] = $this->lock_text;
            $validated['condition'] = $this->condition;
            $validated['condition_text'] = $this->condition_text;
            $validated['suspension'] = $this->suspension;
            $validated['suspension_text'] = $this->suspension_text;
            $validated['inspection_date'] = dateFormat($this->inspection_date,'datedesc');
            if($this->vehicle_inspection_image){
                $inspection_image = str_replace('data:image/png;base64,', '',  $this->vehicle_inspection_image);
                $inspection_image = str_replace(' ', '+', $inspection_image);
                $inspection_image = base64_decode($inspection_image);
                $vehicle = getValue('vehicles', 'id = '. $this->vehicle);
                $folder = preg_replace('/\s+/', '-', strtolower($vehicle->licence_plate_no));
                $vehicle_inspection_image = 'uploads/vehicle-inspection/'.$folder;
                if (!is_dir($vehicle_inspection_image))
                    mkdir($vehicle_inspection_image, 0755,true);
                file_put_contents($vehicle_inspection_image.'/inspection.png', $inspection_image);
                $validated['vehicle_inspection_image'] = $vehicle_inspection_image.'/inspection.png';
            }
            $validated['user_id'] = Auth::user()->id;
            $validated['workspace_id'] = Auth::user()->workspace_id;
            ModelsVehicleInspection::create($validated);
             session()->flash('success', 'The data has been saved successfully.');
         } catch (\Exception $e) {
             session()->flash('error', $e->getMessage());
         }
          $this->redirect('/vehicle/inspection'); 
      }
 
 
       /**
        * edit
        */
       function edit($id){
         $this->id = $id;
         $edit = ModelsVehicleInspection::where('id', $id)->first()->toArray();
          foreach($edit as $key => $v){
            if(in_array($key, ['inspection_date'])){
               $v = dateFormat($v,'report');
            }
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
            'inspection_date' => 'required',
            'kms_in' => 'required',
            'datetime_in' => 'required',
            'datetime_out' => 'required',
            'inspected_by' => 'required'
    ]);
    try {
        $validated['petrol_card'] = $this->petrol_card;
        $validated['petrol_card_text'] = $this->petrol_card_text;
        $validated['invertor'] = $this->invertor;
        $validated['invertor_text'] = $this->invertor_text;
        $validated['int_damage'] = $this->int_damage;
        $validated['int_damage_text'] = $this->int_damage_text;
        $validated['ext_car'] = $this->ext_car;
        $validated['ext_car_text'] = $this->ext_car_text;
        $validated['ladder'] = $this->ladder;
        $validated['ladder_text'] = $this->ladder_text;
        $validated['power_tool'] = $this->power_tool;
        $validated['power_tool_text'] = $this->power_tool_text;
        $validated['head_light'] = $this->head_light;
        $validated['head_light_text'] = $this->head_light_text;
        $validated['windows'] = $this->windows;
        $validated['windows_text'] = $this->windows_text;
        $validated['oil_chk'] = $this->oil_chk;
        $validated['oil_chk_text'] = $this->oil_chk_text;
        $validated['tool_box'] = $this->tool_box;
        $validated['tool_box_text'] = $this->tool_box_text;
        $validated['lights'] = $this->lights;
        $validated['lights_text'] = $this->lights_text;
        $validated['car_mats'] = $this->car_mats;
        $validated['car_mats_text'] = $this->car_mats_text;
        $validated['int_lights'] = $this->int_lights;
        $validated['int_lights_text'] = $this->int_lights_text;
        $validated['tyre'] = $this->tyre;
        $validated['tyre_text'] = $this->tyre_text;
        $validated['leed'] = $this->leed;
        $validated['leed_text'] = $this->leed_text;
        $validated['ac'] = $this->ac_text;
        $validated['lock'] = $this->lock;
        $validated['lock_text'] = $this->lock_text;
        $validated['condition'] = $this->condition;
        $validated['condition_text'] = $this->condition_text;
        $validated['suspension'] = $this->suspension;
        $validated['suspension_text'] = $this->suspension_text;
        $validated['inspection_date'] = dateFormat($this->inspection_date,'datedesc');
        if($this->vehicle_inspection_image){
            $inspection_image = str_replace('data:image/png;base64,', '',  $this->vehicle_inspection_image);
            $inspection_image = str_replace(' ', '+', $inspection_image);
            $inspection_image = base64_decode($inspection_image);
            $vehicle = getValue('vehicles', 'id = '. $this->vehicle);
            $folder = preg_replace('/\s+/', '-', strtolower($vehicle->licence_plate_no));
            $vehicle_inspection_image = 'uploads/vehicle-inspection/'.$folder;
            if (!is_dir($vehicle_inspection_image))
                mkdir($vehicle_inspection_image, 0755,true);
            file_put_contents($vehicle_inspection_image.'/inspection.png', $inspection_image);
            $validated['vehicle_inspection_image'] = $vehicle_inspection_image.'/inspection.png';
        }
        $validated['user_id'] = Auth::user()->id;
        $validated['workspace_id'] = Auth::user()->workspace_id;
        ModelsVehicleInspection::whereId($this->id)->update($validated);
         session()->flash('success', 'The data has been updated successfully.');
     } catch (\Exception $e) {
         session()->flash('error', $e->getMessage());
     }
       $this->redirect('/vehicle/inspection'); 
   }
 
       /**
      * delete specific data from the listing
      * @param mixed $id
      * @return void
      */
     public function delete($id)
     {
         try{
            ModelsVehicleInspection::find($id)->delete();
             session()->flash('success',"The selected data has been deleted successfully!!");
         }catch(\Exception $e){
             session()->flash('error', $e->getMessage());
         }
         $this->redirect('/vehicle/inspection'); 
     }

     private function pdf($id){
        $model = new ModelsVehicleInspection();
        $data['rec'] = $model->vehicleInspectionInfo($id);
        $data['setting'] = Setting::first();
        $html =  view('vehicle-management.inspection.pdf', $data)->render();
        require_once 'vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' =>  'A4',
            'margin_left' => 0, 'margin_right' => 0, 'margin_top' => 0, 'margin_bottom' => 0]);
        $mpdf->WriteHTML($html);
        //$mpdf->Output();
        $mpdf->Output('vehicle-inspection-'.$data['rec']->licence_plate_no.'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    }
}
