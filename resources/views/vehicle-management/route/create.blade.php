<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Route</h5>
                    <a href="{{ baseUrl('vehicle/route') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <x-text-input type="hidden" wire:model="place_id" id="place_id" />    
                  <div class="col-6">
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input wire:model="location" id="location" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                      </div>
                      <div class="col-6">
                        <x-input-label for="location_map" :value="__('Map Location')" />
                        <x-text-input wire:model="location_map" id="location_map" class="form-control" type="text"/>
                      </div>
                      <div class="col-12 text-right">
                        <button class="btn btn-primary" type="submit">{{($id)?'Update':'Save'}}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>