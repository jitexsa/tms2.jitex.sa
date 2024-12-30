<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Vehicle</h5>
                    <a href="{{ baseUrl('vehicle') }}" class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                        <div class="horizontal-wizard-wrapper vertical-options vertical-variations">
                          <div class="row g-3">
                            <div class="col-xl-3 main-horizontal-header">
                              <div class="nav nav-pills horizontal-options"
                                  id="vertical-n-wizard-tab" role="tablist" aria-orientation="vertical">
                                  <a class="nav-link active" id="wizard-n-info-tab"
                                  data-bs-toggle="pill" href="#wizard-n-info"
                                  role="tab" aria-controls="wizard-n-info" aria-selected="true">
                                  <div class="horizontal-wizard">
                                    <div class="stroke-icon-wizard"><span>1</span></div>
                                    <div class="horizontal-wizard-content"> 
                                      <h6>Registration Details</h6>
                                    </div>
                                  </div>
                                  </a>
                                  <a class="nav-link" id="mvpi-n-wizard-tab" data-bs-toggle="pill" 
                                  href="#mvpi-n-wizard" role="tab" aria-controls="mvpi-n-wizard" aria-selected="false"> 
                                  <div class="horizontal-wizard">
                                    <div class="stroke-icon-wizard"><span>2</span></div>
                                    <div class="horizontal-wizard-content"> 
                                      <h6>MVPI Detail</h6>
                                    </div>
                                  </div>
                                  </a>
                                  <a class="nav-link" id="insurance-n-wizard-tab" data-bs-toggle="pill" 
                                  href="#insurance-n-wizard" role="tab" aria-controls="insurance-n-wizard" aria-selected="false"> 
                                  <div class="horizontal-wizard">
                                    <div class="stroke-icon-wizard"><span>3</span></div>
                                    <div class="horizontal-wizard-content"> 
                                      <h6>Insurance Details</h6>
                                    </div>
                                  </div>
                                  </a>
                                </div>
                            </div>
                            <div class="col-xl-9">
                              <div class="tab-content dark-field" id="vertical-n-wizard-tabContent">
                                <div class="tab-pane fade show active" id="wizard-n-info"
                                    role="tabpanel" aria-labelledby="wizard-n-info-tab">
                                    <div class="row">
                                        <div class="col-6 mb-2">
                                                <x-input-label for="plate_alphabet" :value="__('License Plate No')" /> <i class="text-danger">*</i>
                                                <div class="row">
                                                <div class="col-6">
                                                <x-text-input  wire:model="licence_plate_no"  type="hidden" />
                                                <x-text-input  wire:model="plate_no" class="form-control" type="text" number id="plate_no" placeholder="No" required />
                                                <x-input-error :messages="$errors->get('plate_no')" class="mt-2" />
                                                </div>
                                                <div class="col-6">
                                                <x-text-input  wire:model="plate_alphabet" class="form-control" type="text" id="plate_alphabet" placeholder="Alphabet" required />
                                                <x-input-error :messages="$errors->get('plate_alphabet')" class="mt-2" /> 
                                              </div>
                                              <x-input-error :messages="$errors->get('licence_plate_no')" class="mt-2" />    
                                             </div>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <x-input-label for="vehicle_color" :value="__('Color')" />
                                            <x-text-input  wire:model="vehicle_color" class="form-control" type="text" id="vehicle_color" />
                                        </div>
                                        <div class="col-6 mb-2">
                                            <x-input-label for="vehicle_make" :value="__('Maker')" />
                                            <select class="form-control" wire:model="vehicle_make" id="vehicle_make" data-select>
                                                    <option value="" selected="selected">Maker</option>
                                                    @php
                                                    $get_vehicle_maker = getVehicleMaker();
                                                    @endphp
                                                    @foreach ($get_vehicle_maker as $val)
                                                        <option value="{{ $val->id }}">
                                                            {{ $val->make_name }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                              <x-input-label for="model_year" :value="__('Model Year')" />
                                              <select class="form-control" wire:model="model_year" id="model_year" data-select>
                                                    <option value="" selected="selected">Year</option>
                                                    @for($i = 1950 ; $i <= date('Y')+1; $i++)
                                                        <option value="{{ $i }}">
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                                <x-input-label for="chassis_no" :value="__('Chassis No')" />
                                                <x-text-input wire:model="chassis_no"  class="form-control" type="text" id="chassis_no" />
                                        </div>
                                        <div class="col-6 mb-2">
                                        <x-input-label for="subcontractor" :value="__('Subcontractor')" /> <i class="text-danger">*</i>
                                                <select class="form-control" wire:model="subcontractor" id="subcontractor" required data-select>
                                                    <option value="" selected="selected">Subcontractor</option>
                                                    @php
                                                    $get_subcontractor = subContractor();
                                                    @endphp
                                                    @foreach ($get_subcontractor as $r)
                                                        <option value="{{ $r->id }}">
                                                            {{ $r->transporter_name }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('subcontractor')" class="mt-2" /> 
                                        </div>
                                        <div class="col-6 mb-2">
                                              <x-input-label for="country_of_origin" :value="__('Country of Origin')" />
                                              <select class="form-control" wire:model="country_of_origin" id="country_of_origin" data-select>
                                                    <option value="" selected="selected">Country</option>
                                                    @php
                                                    $get_country = getCountry();
                                                    @endphp
                                                    @foreach ($get_country as $r)
                                                        <option value="{{ $r->country_name }}">
                                                            {{ $r->country_name }}</option>
                                                    @endforeach
                                              </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                              <x-input-label for="service_start_date" :value="__('Service Start Date')" /> <i class="text-danger">*</i>
                                              <x-text-input wire:model="service_start_date" class="form-control" type="text" id="service_start_date" data-datepicker required />
                                              <x-input-error :messages="$errors->get('service_start_date')" class="mt-2" />  
                                        </div>
                                        <div class="col-6 mb-2">
                                                <x-input-label for="driver_id" :value="__('Driver')" /> <i class="text-danger">*</i>
                                                <select class="form-control" wire:model="driver_id" id="driver_id" required data-select>
                                                    <option value="" selected="selected">Select Driver</option>
                                                    @php
                                                    $get_driver = getVehicleDriver($driver_id);
                                                    @endphp
                                                    @foreach ($get_driver as $val)
                                                        <option value="{{ $val->id }}">
                                                        {{ $val->driver_name }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('driver_id')" class="mt-2" /> 
                                        </div>
                                            @if(Auth::user()->is_admin)
                                        <div class="col-6 mb-2">
                                              <x-input-label for="workspace_id" :value="__('Workspace')" />
                                              <select class="form-control" wire:model="workspace_id" id="workspace"  data-select  {{ ($vehicle_inspection or $vehicle_leasing)?'disabled':'' }}>
                                                    <option value="">Select Workspace</option>
                                                    @php
                                                    $workspace_list = workspaceList();
                                                    @endphp
                                                    @foreach ($workspace_list as $key => $s)
                                                        <option value="{{ $s->id }}">
                                                        {{ $s->workspace_name }}</option>
                                                    @endforeach
                                              </select>
                                        </div>
                                            @endif
                                        <div class="col-6 mb-2">
                                                <x-input-label for="truck_sketch" :value="__('Truck Sketch (530*530)')" />
                                                <x-text-input type="file" class="form-control" accept="image/*" wire:model="truck_sketch" id="truck_sketch" />
                                                @if($truck_sketch)
                                                    <img src="{{ baseURL($truck_sketch) }}" width="100">
                                                @endif
                                        </div>
                                        <div class="col-6 mb-2">
                                            <x-input-label for="display_name" :value="__('Display Name')" />
                                            <x-text-input wire:model="display_name" class="form-control" type="text" id="display_name" />
                                        </div>
                                        <div class="col-6 mb-2">
                                                <x-input-label for="vehicle_type" :value="__('Vehicle Type')" /> <i class="text-danger">*</i>
                                                <select class="form-control" required="" wire:model="vehicle_type" id="vehicle_type" data-select>
                                                    <option value="" selected="selected">Vehicle Type</option>
                                                    @php
                                                    $get_vehicle_type  = getVehicleType();
                                                    @endphp
                                                    @foreach($get_vehicle_type as $type)
                                                        <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('vehicle_type')" class="mt-2" /> 
                                        </div>
                                        <div class="col-6 mb-2">
                                                <x-input-label for="vehicle_model" :value="__('Vehicle Model')" />
                                                <select class="form-control" wire:model="vehicle_model" id="vehicle_model" data-select>
                                                    <option value="" selected="selected">Vehicle Model</option>
                                                    @php
                                                    $get_vehicle_model = getVehicleModel();
                                                    @endphp
                                                    @foreach ($get_vehicle_model as $rr)
                                                        <option value="{{ $rr->id }}">
                                                            {{ $rr->model_name }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                                <x-input-label for="vehicle_registration" :value="__('Registration #')" />
                                                <x-text-input wire:model="vehicle_registration"  class="form-control" type="text" id="vehicle_registration" />
                                        </div>
                                        <div class="col-6 mb-2">
                                                <x-input-label for="registration_date" :value="__('Registration Date')" />
                                                <x-text-input wire:model="registration_date"  class="form-control" type="text" id="registration_date" data-datepicker />
                                        </div>
                                        <div class="col-6 mb-2">
                                                <x-input-label for="registration_expiry_date" :value="__('Registration Expiry Date')" />
                                                <x-text-input wire:model="registration_expiry_date"  class="form-control" type="text" id="registration_expiry_date" data-datepicker />
                                        </div>
                                        <div class="col-6 mb-2">
                                                <x-input-label for="division" :value="__('Division')" /> <i class="text-danger">*</i>
                                                <select class="form-control" wire:model="division" id="division" required data-select>
                                                    <option value="" selected="selected">Division</option>
                                                    @php
                                                    $get_division = getDivision();
                                                    @endphp
                                                    @foreach ($get_division as $r)
                                                        <option value="{{ $r->id }}">
                                                            {{ $r->division_name }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('division')" class="mt-2" />
                                        </div>
                                        <div class="col-6 mb-2">
                                                  <x-input-label for="sequence_no" :value="__('Sequence No')" />
                                                <x-text-input wire:model="sequence_no"  class="form-control" type="text" id="sequence_no" />
                                        </div>
                                        <div class="col-6 mb-2">
                                                <x-input-label for="location" :value="__('Location')" />
                                                <select class="form-control" wire:model="location" id="location" data-select>
                                                    <option value="" selected="selected">Location</option>
                                                    @php
                                                    $loaction_list = locationList();
                                                    @endphp
                                                    @foreach ($loaction_list as $rr)
                                                        <option value="{{ $rr->id }}">
                                                            {{ $rr->location_name }}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                                <x-input-label for="odo" :value="__('ODO')" />
                                                <x-text-input wire:model="odo" class="form-control" type="number" id="odo" />
                                        </div>
                                        <div class="col-6 mb-2">
                                                <x-input-label for="truck_image" :value="__('Truck Picture')" />
                                                <x-text-input type="file" class="form-control" accept="image/*" wire:model="truck_image" id="truck_image" />
                                                @if($truck_image)
                                                    <img src="{{ baseURL($truck_image) }}" width="100">
                                                @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="mvpi-n-wizard" role="tabpanel"
                                 aria-labelledby="mvpi-n-wizard-tab">
                                        <div class="row"> 
                                            <div class="col-6 mb-2">
                                            <x-input-label for="last_mvpi_date" :value="__('Last MVPI Date')" />
                                            <x-text-input  wire:model="last_mvpi_date" class="form-control" type="text" data-datepicker id="last_mvpi_date" />
                                            </div>
                                            <div class="col-6 mb-2">
                                            <x-input-label for="mvpi_expiry_date" :value="__('MVPI Expiry Date')" />
                                            <x-text-input  wire:model="mvpi_expiry_date" class="form-control" type="text" data-datepicker id="mvpi_expiry_date" />
                                            </div>
                                            <div class="col-6 mb-2">
                                              <x-input-label for="mvpi_document" :value="__('MVPI Document')" />
                                              <x-text-input type="file" class="form-control" accept="image/*" wire:model="mvpi_document" class="form-control"/>
                                              @if(isset($mvpi_document) and $mvpi_document)
                                                  <div class="attachment">
                                                      <img src="{{ baseURL($mvpi_document) }}" width="100">
                                                  </div>
                                              @endif
                                            </div>
                                        </div>
                                </div>
                                <div class="tab-pane fade" id="insurance-n-wizard" role="tabpanel"
                                 aria-labelledby="insurance-n-wizard-tab">
                                    <div class="row"> 
                                        <div class="col-6 mb-2">
                                          <x-input-label for="insurance_start_date" :value="__('Insurance Start Date')" />
                                          <x-text-input  wire:model="insurance_start_date" class="form-control" type="text" data-datepicker id="insurance_start_date" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="insurance_end_date" :value="__('Insurance End Date')" />
                                          <x-text-input  wire:model="insurance_end_date" class="form-control" type="text" data-datepicker id="insurance_end_date" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="insurance_policy" :value="__('Insurance Policy #')" />
                                          <x-text-input  wire:model="insurance_policy" class="form-control" type="text" id="insurance_policy" />
                                        </div>
                                        <div class="col-6 mb-2">
                                              <x-input-label for="insurance_document" :value="__('Insurance Document')" />
                                              <x-text-input type="file" accept="image/*" wire:model="insurance_document" class="form-control"/>
                                              @if(isset($insurance_document) and $insurance_document)
                                                  <div class="attachment">
                                                      <img src="{{ baseURL($insurance_document) }}" width="100">
                                                  </div>
                                              @endif
                                            </div>
                                    </div>
                                </div>
                              </div>
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