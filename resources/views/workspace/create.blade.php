<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Workspace Setting</h5>
                    <a href="{{ baseUrl('workspace') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                      <div class="col-4">
                        <x-input-label for="workspace_name" :value="__('Workspace Name')" />
                        <x-text-input wire:model="workspace_name" id="workspace_name" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('workspace_name')" class="mt-2" />
                      </div>
                      <div class="col-4">
                        <x-input-label for="workspace_email" :value="__('Workspace Email')" />
                        <x-text-input wire:model="workspace_email" id="workspace_email" class="form-control" type="text" />
                      </div>
                      <div class="col-4">
                        <x-input-label for="workspace_phone_number" :value="__('Workspace Phone Number')" />
                        <x-text-input wire:model="workspace_phone_number" id="workspace_phone_number" class="form-control" type="text" />
                      </div>
                      <div class="col-6"> 
                        <div class="card-wrapper border rounded-3">
                          <h6 class="sub-title">Workspace Status</h6>
                          <div class="radio-form">
                            <div class="form-check">
                              <x-text-input wire:model="workspace_status" id="workspace_status_active" class="form-check-input" type="radio" value="1"  required=""/>
                              <x-input-label for="workspace_status_active" :value="__('Active')" />
                            </div>
                            <div class="form-check">
                              <x-text-input wire:model="workspace_status" id="workspace_status_inactive" class="form-check-input" type="radio" value="0"  required=""/>
                              <x-input-label for="workspace_status_inactive" :value="__('Inactive')" />
                            </div>
                          </div>
                          <x-input-error :messages="$errors->get('workspace_status')" class="mt-2" />
                        </div>
                      </div>
                      <div class="col-6"> 
                        <div class="card-wrapper border rounded-3">
                          <h6 class="sub-title">Dashboard Vehicle Section</h6>
                          <div class="radio-form">
                            <div class="form-check">
                              <x-text-input wire:model="vehicle_block" id="vehicle_block_yes" class="form-check-input" type="radio" value="1"  required=""/>
                              <x-input-label for="vehicle_block_yes" :value="__('Active')" />
                            </div>
                            <div class="form-check">
                              <x-text-input wire:model="vehicle_block" id="vehicle_block_no" class="form-check-input" type="radio" value="0"  required=""/>
                              <x-input-label for="vehicle_block_no" :value="__('Inactive')" />
                            </div>
                          </div>
                          <x-input-error :messages="$errors->get('vehicle_block')" class="mt-2" />
                        </div>
                      </div>


                      <div class="col-6"> 
                        <div class="card-wrapper border rounded-3">
                          <h6 class="sub-title">Dashboard Trip Section</h6>
                          <div class="radio-form">
                            <div class="form-check">
                              <x-text-input wire:model="trip_block" id="trip_block_yes" class="form-check-input" type="radio" value="1"  required=""/>
                              <x-input-label for="trip_block_yes" :value="__('Active')" />
                            </div>
                            <div class="form-check">
                              <x-text-input wire:model="trip_block" id="trip_block_no" class="form-check-input" type="radio" value="0"  required=""/>
                              <x-input-label for="trip_block_no" :value="__('Inactive')" />
                            </div>
                          </div>
                          <x-input-error :messages="$errors->get('trip_block')" class="mt-2" />
                        </div>
                      </div>
                      <div class="col-6"> 
                        <div class="card-wrapper border rounded-3">
                          <h6 class="sub-title">Dashboard Remainder Section</h6>
                          <div class="radio-form">
                            <div class="form-check">
                              <x-text-input wire:model="remainder" id="remainder_yes" class="form-check-input" type="radio" value="1"  required=""/>
                              <x-input-label for="remainder_yes" :value="__('Active')" />
                            </div>
                            <div class="form-check">
                              <x-text-input wire:model="remainder" id="remainder_no" class="form-check-input" type="radio" value="0"  required=""/>
                              <x-input-label for="remainder_no" :value="__('Inactive')" />
                            </div>
                          </div>
                          <x-input-error :messages="$errors->get('remainder')" class="mt-2" />
                        </div>
                      </div>


                      <div class="col-6"> 
                        <div class="card-wrapper border rounded-3">
                          <h6 class="sub-title">Dashboard Trip Status Section</h6>
                          <div class="radio-form">
                            <div class="form-check">
                              <x-text-input wire:model="trip_status_block" id="trip_status_block_yes" class="form-check-input" type="radio" value="1"  required=""/>
                              <x-input-label for="trip_status_block_yes" :value="__('Active')" />
                            </div>
                            <div class="form-check">
                              <x-text-input wire:model="trip_status_block" id="trip_status_block_no" class="form-check-input" type="radio" value="0"  required=""/>
                              <x-input-label for="trip_status_block_no" :value="__('Inactive')" />
                            </div>
                          </div>
                          <x-input-error :messages="$errors->get('trip_status_block')" class="mt-2" />
                        </div>
                      </div>
                      <div class="col-6"> 
                        <div class="card-wrapper border rounded-3">
                          <h6 class="sub-title">Dashboard Map Tracking Section</h6>
                          <div class="radio-form">
                            <div class="form-check">
                              <x-text-input wire:model="vehicle_map_tracking" id="vehicle_map_tracking_yes" class="form-check-input" type="radio" value="1"  required=""/>
                              <x-input-label for="vehicle_map_tracking_yes" :value="__('Active')" />
                            </div>
                            <div class="form-check">
                              <x-text-input wire:model="vehicle_map_tracking" id="vehicle_map_tracking_no" class="form-check-input" type="radio" value="0"  required=""/>
                              <x-input-label for="vehicle_map_tracking_no" :value="__('Inactive')" />
                            </div>
                          </div>
                          <x-input-error :messages="$errors->get('vehicle_map_tracking')" class="mt-2" />
                        </div>
                      </div>
                      
                      <div class="col-12">
                        <button class="btn btn-primary" type="submit">Save</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>