<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Fuel Type</h5>
                    <a href="{{ baseUrl('fuel/fuel-type') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                      <div class="col-12">
                        <x-input-label for="type_name" :value="__('Name')" />
                        <x-text-input wire:model="type_name" id="type_name" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('type_name')" class="mt-2" />
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