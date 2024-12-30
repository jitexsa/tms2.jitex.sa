<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Employee</h5>
                    <a href="{{ baseUrl('employee') }}"  class="btn btn-primary btn-md">
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
                                      <h6>Employee Personal Details</h6>
                                    </div>
                                  </div>
                                  </a>
                                  <a class="nav-link" id="bank-n-wizard-tab" data-bs-toggle="pill" 
                                  href="#bank-n-wizard" role="tab"
                                   aria-controls="bank-n-wizard"
                                   aria-selected="false"> 
                                  <div class="horizontal-wizard">
                                    <div class="stroke-icon-wizard"><span>2</span></div>
                                    <div class="horizontal-wizard-content"> 
                                      <h6>Additional Details</h6>
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
                                          <x-input-label for="emp_name" :value="__('Employee Name')" />
                                          <x-text-input   wire:model="emp_name" id="emp_name" class="form-control" type="text" required />
                                          <x-input-error :messages="$errors->get('emp_name')" class="mt-2" />
                                        </div>
                                        <div class="col-6 mb-2">
                                            <x-input-label for="emp_nid" :value="__('Employee NID')" />
                                            <x-text-input  wire:model="emp_nid" class="form-control" type="number" id="emp_nid"/>
                                            <x-input-error :messages="$errors->get('emp_nid')" class="mt-2" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="emp_email" :value="__('Email')" />
                                          <x-text-input   wire:model="emp_email" required class="form-control" type="emp_email" id="email" />
                                          <x-input-error :messages="$errors->get('emp_email')" class="mt-2" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="emp_phone" :value="__('Employee Mobile')" />
                                          <x-text-input  wire:model="emp_phone" class="form-control" type="number" id="emp_phone" />
                                          <x-input-error :messages="$errors->get('emp_phone')" class="mt-2" />
                                        </div>
                                        <div class="col-6 mb-2">
                                            <x-input-label for="dob" :value="__('Date of Birth')" />
                                            <x-text-input   wire:model="dob" required class="form-control" data-datepicker type="text" id="dob" />
                                            <x-input-error :messages="$errors->get('dob')" class="mt-2" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="picture" :value="__('Photograph')" />
                                          <x-text-input  wire:model="picture" class="form-control" type="file" id="picture" />
                                        </div>
                                        <div class="col-6 mb-2">
                                            <x-input-label for="address" :value="__('Address')" />
                                            <x-text-input  wire:model="address" class="form-control" type="text" id="address" />
                                        </div>
                                        <div class="col-6 mb-2">
                                          <x-input-label for="status" :value="__('Status')" />
                                          <select class="form-control" wire:model="isactive" id="status" required>
                                                    <option value="" selected="selected">Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="bank-n-wizard" role="tabpanel" aria-labelledby="bank-n-wizard-tab">
                                    <div class="row"> 
                                        <div class="col-6 mb-2">
                                            <x-input-label for="department" :value="__('Department')" />
                                              <select class="form-control" wire:model="department" id="department">
                                                    <option value="" selected="selected">Select Department</option>
                                                    @php
                                                    $designation = department();
                                                    @endphp
                                                    @if($designation)
                                                    @foreach ($designation as $depart)
                                                    <option value="{{ $depart->department_name }}">{{ $depart->department_name }}</option>
                                                        @endforeach
                                                        @endif
                                                </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                                <x-input-label for="payroll_type" :value="__('Pay Roll Type')" />
                                                <select class="form-control" wire:model="payroll_type" id="payroll_type">
                                                    <option value="" selected="selected">Select Pay Roll Type</option>
                                                    <option value="External">External</option>
                                                    <option value="Internal">Internal</option>
                                                </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                              <x-input-label for="location" :value="__('Location')" />
                                                <select class="form-control" wire:model="location" id="location">
                                                    <option value="" selected="selected">Location</option>
                                                    @php
                                                    $loaction_list = locationList();
                                                    @endphp
                                                    @if($loaction_list)
                                                    @foreach ($loaction_list as $dd)
                                                        <option value="{{ $dd->id }}">{{ $dd->location_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                              <x-input-label for="designation" :value="__('Designation')" />
                                                <select class="form-control" wire:model="designation" id="designation">
                                                    <option value="" selected="selected">Designation</option>
                                                    @php
                                                    $designation = designation();
                                                    @endphp
                                                    @if($designation)
                                                    @foreach ($designation as $v)
                                                    <option value="{{ $v->position_name }}">{{ $v->position_name }}</option>
                                                        @endforeach
                                                        @endif
                                                </select>
                                        </div>
                                        <div class="col-6 mb-2">
                                              <x-input-label for="join_date" :value="__('Join  Date')" />
                                              <x-text-input  wire:model="join_date" class="form-control" type="text" data-datepicker id="join_date" />
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