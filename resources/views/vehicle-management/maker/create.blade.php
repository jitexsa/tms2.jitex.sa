<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Vehicle Maker</h5>
                    <a href="{{ baseUrl('vehicle/maker') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                      <div class="col-12">
                        <x-input-label for="make_name" :value="__('Maker Name')" />
                        <x-text-input wire:model="make_name" id="make_name" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('make_name')" class="mt-2" />
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