<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Driver</h5>
                    <a href="{{ baseUrl('employee/driver') }}" class="btn btn-primary btn-md">
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
                                      <h6>Driver Personal Details</h6>
                                    </div>
                                  </div>
                                  </a>
                                  <a class="nav-link" id="bank-n-wizard-tab" data-bs-toggle="pill" 
                                  href="#bank-n-wizard" role="tab" aria-controls="bank-n-wizard" aria-selected="false"> 
                                  <div class="horizontal-wizard">
                                    <div class="stroke-icon-wizard"><span>2</span></div>
                                    <div class="horizontal-wizard-content"> 
                                      <h6>Port ID Details</h6>
                                    </div>
                                  </div>
                                  </a>
                                  <a class="nav-link" id="iqama-n-wizard-tab" data-bs-toggle="pill" 
                                  href="#iqama-n-wizard" role="tab" aria-controls="iqama-n-wizard" aria-selected="false"> 
                                  <div class="horizontal-wizard">
                                    <div class="stroke-icon-wizard"><span>3</span></div>
                                    <div class="horizontal-wizard-content"> 
                                      <h6>Iqama Details</h6>
                                    </div>
                                  </div>
                                  </a>
                                  <a class="nav-link" id="license-n-wizard-tab" data-bs-toggle="pill" 
                                  href="#license-n-wizard" role="tab" aria-controls="license-n-wizard" aria-selected="false"> 
                                  <div class="horizontal-wizard">
                                    <div class="stroke-icon-wizard"><span>4</span></div>
                                    <div class="horizontal-wizard-content"> 
                                      <h6>License Details</h6>
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
                                          <x-input-label for="driver_name" :value="__('Driver Name')" /> <i class="text-danger">*</i>
                                          <x-text-input   wire:model="driver_name" id="driver_name" class="form-control" type="text" required />
                                          <x-input-error :messages="$errors->get('driver_name')" class="mt-2" />
                                        </div>
                                        <div class="col-6 mb-2">
                                            <x-input-label for="mobile" :value="__('Mobile')" /> <i class="text-danger">*</i>
                                            <x-text-input  wire:model="mobile" class="form-control" type="number" id="mobile"/>
                                            <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="passport_no" :value="__('Passport No')" />
                                          <x-text-input   wire:model="passport_no" class="form-control" type="text" id="passport_no" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="passport_expiry" :value="__('Passport Expiry')" />
                                          <x-text-input  wire:model="passport_expiry" class="form-control" type="text" data-datepicker id="passport_expiry" />
                                        </div>
                                        <div class="col-6 mb-2">
                                            <x-input-label for="nationality" :value="__('Nationality')" />
                                            <select class="form-control" wire:model="nationality" id="nationality">
                                                <option value="" selected="selected">Nationality</option>
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
                                          <x-input-label for="location" :value="__('Location')" />
                                          <select class="form-control" wire:model="location" id="location">
                                              <option value="" selected="selected">Location</option>
                                              @php
                                              $loaction_list = locationList();
                                              @endphp
                                              @foreach ($loaction_list as $rr) {?>
                                                  <option value="{{ $rr->id }}">
                                                      {{ $rr->location_name }}</option>
                                              @endforeach
                                          </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <x-input-label for="picture" :value="__('Photograph')" />
                                            <input type="file" accept="image/*" wire:model="picture" class="form-control">
                                              @if(isset($dpicture) and $dpicture)
                                                  <div class="attachment">
                                                      <img src="{{ baseURL($dpicture) }}" width="100">
                                                  </div>
                                              @endif
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="join_date" :value="__('Join Date')" />
                                          <x-text-input  wire:model="join_date" class="form-control" type="text" data-datepicker id="join_date" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="company" :value="__('Company')" /> <i class="text-danger">*</i>
                                          <select class="form-control" wire:model="company" id="company">
                                              <option value="" selected="selected">Company</option>
                                              @php
                                              $get_company = getCompany();
                                              @endphp
                                              @foreach ($get_company as $r)
                                                  <option value="{{ $r->id }}"> {{ $r->company_name }}</option>
                                              @endforeach
                                          </select>
                                          <x-input-error :messages="$errors->get('company')" class="mt-2" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="status" :value="__('Status')" /> <i class="text-danger">*</i>
                                          <select class="form-control" wire:model="status" id="status" >
                                              <option value="" selected="selected">Status</option>
                                              <option value="1">Active</option>
                                              <option value="0">Inactive</option>
                                          </select>
                                          <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="division" :value="__('Division')" /> <i class="text-danger">*</i>
                                          <select class="form-control" wire:model="division" id="division" required>
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
                                          <x-input-label for="workspace_id" :value="__('Workspace')" /> <i class="text-danger">*</i>
                                          <select class="form-control" wire:model="workspace_id" id="workspace_id" required>
                                              <option value="" selected="selected">Workspace</option>
                                              @php
                                              $workspace_list = workspaceList();
                                              @endphp
                                              @foreach ($workspace_list as $r)
                                                  <option value="{{ $r->id }}"> {{ $r->workspace_name }}</option>
                                              @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('workspace')" class="mt-2" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="subcontractor" :value="__('Subcontractor')" />
                                          <select class="form-control" name="subcontractor" id="subcontractor">
                                              <option value="" selected="selected">Subcontractor</option>
                                              @php
                                              $get_subcontractor = subContractor();
                                              @endphp
                                              @foreach ($get_subcontractor as $r)
                                                  <option value="{{ $r->id }}"> {{ $r->transporter_name }}</option> 
                                              @endforeach
                                          </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="bank-n-wizard" role="tabpanel"
                                 aria-labelledby="bank-n-wizard-tab">
                                        <div class="row"> 
                                            <div class="col-6 mb-2">
                                            <x-input-label for="port_id_number" :value="__('Port ID Number')" />
                                            <x-text-input  wire:model="port_id_number" class="form-control" type="text" id="port_id_number" />
                                            </div>
                                            <div class="col-6 mb-2">
                                            <x-input-label for="port_id_end_date" :value="__('Port ID End Date')" />
                                            <x-text-input  wire:model="port_id_end_date" class="form-control" type="text" data-datepicker id="port_id_end_date" />
                                            </div>
                                            <div class="col-6 mb-2">
                                              <x-input-label for="port_attachment" :value="__('Port Attachment')" />
                                              <x-text-input type="file" accept="image/*" wire:model="port_attachment" class="form-control"/>
                                              @if(isset($port_attachment) and $port_attachment)
                                                  <div class="attachment">
                                                      <img src="{{ baseURL($port_attachment) }}" width="100">
                                                  </div>
                                              @endif
                                            </div>
                                        </div>
                                </div>
                                <div class="tab-pane fade" id="iqama-n-wizard" role="tabpanel"
                                 aria-labelledby="iqama-n-wizard-tab">
                                    <div class="row"> 
                                        <div class="col-6 mb-2">
                                          <x-input-label for="national_id" :value="__('National ID / Iqama No')" />
                                          <x-text-input  wire:model="national_id" class="form-control" type="text" id="national_id" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="iqama_expiry_date" :value="__('Iqama Expiry Date')" />
                                          <x-text-input  wire:model="iqama_expiry_date" class="form-control" type="text" data-datepicker id="iqama_expiry_date" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="iqama_image" :value="__('Iqama Image')" />
                                          <x-text-input type="file" accept="image/*" wire:model="iqama_image" class="form-control"/>
                                          @if(isset($iqama_image) and $iqama_image)
                                              <div class="attachment">
                                                  <img src="{{ baseURL($iqama_image) }}" width="100">
                                              </div>
                                          @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="license-n-wizard" role="tabpanel"
                                 aria-labelledby="license-n-wizard-tab">
                                    <div class="row"> 
                                        <div class="col-6 mb-2">
                                            <x-input-label for="license_type" :value="__('License Type')" />
                                              <select class="form-control" wire:model="license_type" id="license_type">
                                                    <option value="" selected="selected">Select License Type</option>
                                                    @php
                                                    $license = getLicenseType();
                                                    @endphp
                                                    @if($license)
                                                    @foreach ($license as $v)
                                                      <option value="{{ $v->license_name }}">
                                                        {{ $v->license_name }}
                                                      </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <x-input-label for="license_number" :value="__('License Number')" /> <i class="text-danger">*</i>
                                            <x-text-input  wire:model="license_number" class="form-control" type="text" id="license_number" />
                                            <x-input-error :messages="$errors->get('license_number')" class="mt-2" />
                                        </div>
                                        <div class="col-6 mb-2">
                                            <x-input-label for="license_expiry_date" :value="__('License Expiry Date')" />
                                            <x-text-input wire:model="license_expiry_date" class="form-control" type="text" data-datepicker id="license_expiry_date" />
                                        </div>
                                        <div class="col-6 mb-2">
                                            <x-input-label for="license_issue_date" :value="__('License Issue Date')" />
                                            <x-text-input  wire:model="license_issue_date" class="form-control" type="text" data-datepicker id="license_issue_date" />
                                        </div>
                                        <div class="col-6 mb-2">
                                              <x-input-label for="license_image" :value="__('License Image')" />
                                              <x-text-input type="file" accept="image/*" wire:model="license_image" class="form-control"/>
                                              @if(isset($license_image) and $license_image)
                                                  <div class="attachment">
                                                      <img src="{{ baseURL($license_image) }}" width="100">
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