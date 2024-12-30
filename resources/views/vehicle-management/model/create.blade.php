<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Vehicle Model</h5>
                    <a href="{{ baseUrl('vehicle/model') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <div class="col-6">
                        <x-input-label for="make_id" :value="__('Maker Name')" />
                        <select  class="form-control" wire:model="make_id" id="make_id" required>
                                <option value="" selected="selected">Select Make</option>
                                @php
                                $get_vehicle_maker = getVehicleMaker();
                                @endphp
                                @foreach ($get_vehicle_maker as $v)
                                    <option value="{{ $v->id }}">
                                    {{ $v->make_name }}
                                    </option>
                               @endforeach
                            </select>
                        <x-input-error :messages="$errors->get('make_id')" class="mt-2" />
                      </div>   
                  <div class="col-6">
                        <x-input-label for="model_name" :value="__('Model Name')" />
                        <x-text-input wire:model="model_name" id="model_name" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('model_name')" class="mt-2" />
                      </div>
                      <div class="col-12">
                        <button class="btn btn-primary" type="submit">{{($id)?'Update':'Save'}}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>