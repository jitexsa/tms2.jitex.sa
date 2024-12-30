<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Vehicle Inspection</h5>
                    <a href="{{ baseUrl('vehicle/inspection') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                        <div class="col-12 mb-2">
                            <div class="row">
                                <div class="col-4">
                                    <x-input-label for="vehicle" :value="__('Vehicle')" />
                                    @include('layouts.dropdown.vehicle')
                                    <x-input-error :messages="$errors->get('vehicle')" class="mt-2" />
                                </div>
                                <div class="col-4">
                                    <x-input-label for="driver_name" :value="__('Driver Name')" />
                                    <x-text-input class="form-control" id="driver_name" type="text" value="" readonly />
                                </div>
                                <div class="col-4">
                                        <x-input-label for="inspection_date" :value="__('Inspection Date')" />
                                        <x-text-input wire:model="inspection_date" class="form-control" type="text" id="inspection_date"  data-datepicker required/>
                                        <x-input-error :messages="$errors->get('inspection_date')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="col-12">
                                        <x-input-label for="kms_in" :value="__('ODO Reading')" />
                                        <x-text-input class="form-control" wire:model="kms_in" type="number" id="kms_in"  required />
                                        <x-input-error :messages="$errors->get('kms_in')" class="mt-2" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="datetime_in" :value="__('Date & Time Incoming')" />
                                        <x-text-input class="form-control" id="datetime_in" wire:model="datetime_in" type="text" data-datepicker required />
                                        <x-input-error :messages="$errors->get('datetime_in')" class="mt-2" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="datetime_out" :value="__('Date & Time Outgoing')" />
                                        <x-text-input class="form-control" id="datetime_out" wire:model="datetime_out" type="text" data-datepicker required />
                                        <x-input-error :messages="$errors->get('datetime_out')" class="mt-2" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="petrol_card" :value="__('Petrol Card')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="petrol_card" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="petrol_card" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="petrol_card_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="invertor" :value="__('Inverter/Cigarette')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="invertor" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="invertor" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="invertor_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="int_damage" :value="__('Interior damages')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="int_damage" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="int_damage" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="int_damage_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="ext_car" :value="__('Damage to exterior of car: dents, scratches, broken lights etc')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="ext_car" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="ext_car" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="ext_car_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="ladder" :value="__('Ladders, extension ladder')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="ladder" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="ladder" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="ladder_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="power_tool" :value="__('Any of our power tools')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="power_tool" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="power_tool" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="power_tool_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="head_light" :value="__('Lights, headlights working')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="head_light" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="head_light" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="head_light_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="windows" :value="__('Windows: working or not/ any damages/ window tints')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="windows" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="windows" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="windows_text" class="form-control"/>
                                </div>
                                <div class="col-12">
                                        <x-input-label for="oil_chk" :value="__('Oil check')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="oil_chk" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="oil_chk" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="oil_chk_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="tool_box" :value="__('Tool boxes, gas struts on tool boxes, roller draws inside tool boxes trundle tray')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="tool_box" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="tool_box" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="tool_box_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="inspected_by" :value="__('Inspected By')" />
                                        <select class="form-control" wire:model="inspected_by" id="inspected_by" required>
                                            <option value="" selected="selected">Select Vehicle</option>
                                            @php
                                            $get_employee = getUsersList();
                                            @endphp
                                            @foreach ($get_employee as $val)
                                                <option value="{{ $val->id }}"> {{ $val->firstname.' '.$val->lastname }}</option>
                                            @endforeach
                                        </select>
                                        <x-input-error :messages="$errors->get('inspected_by')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col-12" id="vehicle_inspection_section" style="display: none;">
                                    <div class="form-group">
                                        <x-input-label for="vehicle_inspection_image" :value="__('Vehicle Inspection')" />
                                        <div class="border d-flex justify-content-center p-2">
                                            <textarea wire:model="vehicle_inspection_image" style="display: none"></textarea>
                                            <x-text-input type="hidden" id="inspection_image_sketch" />
                                            <img src="{{ baseURL($vehicle_inspection_image) }} ?>" id="vehicle_inspection_image" width="250">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <x-input-label for="reg_no" :value="__('Registration Number')" />
                                    <x-text-input class="form-control" type="text" id="reg_no" readonly />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="lights" :value="__('Lights, Indicators')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="lights" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="lights" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="lights_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="car_mats" :value="__('Car mats/Car seat covers')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="car_mats" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="car_mats" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="car_mats_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="int_lights" :value="__('Interior Lights')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="int_lights" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="int_lights" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="int_lights_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="tyre" :value="__('Tyres: New / need replacing')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="tyre" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="tyre" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="tyre_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="leed" :value="__('Extension leeds')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="leed" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="leed" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="leed_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="ac" :value="__('Air conditioner : working or not')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="ac" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="ac" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="ac_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="lock" :value="__('Automatic locks/alarms working')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="lock" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="lock" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="lock_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="condition" :value="__('Condition or car seats')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="condition" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="condition" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="condition_text" class="form-control" />
                                </div>
                                <div class="col-12">
                                        <x-input-label for="suspension" :value="__('Suspension')" />
                                        <br />
                                        <x-text-input type="radio" wire:model="suspension" class="flat-red" value="1" required /> Yes
                                        <x-text-input type="radio" wire:model="suspension" class="flat-red" value="0" required /> No
                                        <x-text-input type="text" wire:model="suspension_text" class="form-control" />
                                </div>
                            </div>
                        </div>
                      <div class="col-12 text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>
          <div id="vehicle_inspection_view" class="modal fade bd-example-modal-lg" role="dialog">
                <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                                <strong class="title">Vehicle Inspection</strong>
                                <button type="button" class="btn-close py-0" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                        </div>
                        <div class="col-12 text-right mt-2 pe-3">
                                <button type="button" class="btn btn-primary" id="done">Done</button>
                                <button type="button" class="btn btn-light" id="reset">Reset</button>
                        </div>
                        <div class="modal-body" style="height: 80vh;">
                                <div class="border inspection-parent mt-2 pb-2">
                                <img src="" id="truck_sketch">
                                </div>
                        </div>
                        </div>
                </div>
           </div>
          <script src="{{ baseURL('node_modules/dom-to-image-more/dist/dom-to-image-more.min.js')}}"></script>
          {{ setJs(['vehicle-inspection/vehicle-image-inspection, vehicle-inspection/index']) }}