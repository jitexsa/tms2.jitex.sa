<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>{{ $this->contractor }} Contractor Details</h5>
                    <a href="{{ baseUrl('subcontractor/detail/'.$contractor_id) }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <input wire:model="contractor_id" type="hidden">
                  <div class="col-6">
                        <x-input-label for="fleet_type" :value="__('Fleet Type')" />
                        <select class="form-control" wire:model="fleet_type" id="fleet_type" required>
                            <option value="" selected="selected">Fleet Type</option>
                            @php
                            $get_vehicle_type  = getVehicleType();
                            @endphp
                            @foreach ($get_vehicle_type as $type)
                                <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                            @endforeach
                        </select>
                         <x-input-error :messages="$errors->get('fleet_type')" class="mt-2" />
                      </div>  
                      
                      <div class="col-6">
                        <x-input-label for="no_of_vehicles" :value="__('# of Vehicles')" />
                        <x-text-input wire:model="no_of_vehicles" id="no_of_vehicles" class="form-control" type="text" required />
                        <x-input-error :messages="$errors->get('no_of_vehicles')" class="mt-2" />
                      </div>

                      <div class="col-6">
                       <x-input-label for="location" :value="__('Location')" />
                        @include('layouts.dropdown.route', array('name' => 'location'))
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                      </div>
                      <div class="col-6">
                        <x-input-label for="remarks" :value="__('Remarks')" />
                        <x-text-input wire:model="remarks" id="remarks" class="form-control" type="text" />
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