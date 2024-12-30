<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Vendor Type</h5>
                    <a href="{{ baseUrl('vendor/vendor-type') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                      <div class="col-6">
                        <x-input-label for="vendor_type" :value="__('Vendor Type')" />
                        <x-text-input wire:model="vendor_type" id="vendor_type" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('vendor_type')" class="mt-2" />
                      </div>
                      <div class="col-6"> 
                        <div class="card-wrapper border rounded-3">
                          <h6 class="sub-title">Category</h6>
                          <div class="radio-form">
                            <div class="form-check">
                              <x-text-input wire:model="vendor_category" id="vendor_category_fuel" class="form-check-input" type="radio" value="1"  required=""/>
                              <x-input-label for="vendor_category_fuel" :value="__('Fuel')" />
                            </div>
                            <div class="form-check">
                              <x-text-input wire:model="vendor_category" id="vendor_category_maintenance" class="form-check-input" type="radio" value="2"  required=""/>
                              <x-input-label for="vendor_category_maintenance" :value="__('Maintenance')" />
                            </div>
                            <div class="form-check">
                              <x-text-input wire:model="vendor_category" id="vendor_category_other" class="form-check-input" type="radio" value="3"  required=""/>
                              <x-input-label for="vendor_category_other" :value="__('Other')" />
                            </div>
                          </div>
                          <x-input-error :messages="$errors->get('vendor_category')" class="mt-2" />
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