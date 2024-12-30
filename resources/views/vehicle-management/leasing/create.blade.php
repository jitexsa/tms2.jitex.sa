<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Vehicle Leasing</h5>
                    <a href="{{ baseUrl('vehicle/leasing') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <div class="row">
                  <div class="col-6 mb-2">
                        <x-input-label for="customer_id" :value="__('Customer')" />
                        <select class="form-control" wire:model="customer_id" id="customer_id" required>
                                    <option value="" selected="selected">Customer</option>
                                    @php
                                     $get_company = getCompany();
                                     @endphp
                                     @foreach ($get_company as $r)
                                         <option value="{{ $r->id }}">{{ $r->company_name }}</option>
                                     @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                      </div>
                      <div class="col-6 mb-2">
                        <x-input-label for="company" :value="__('Company Name')" />
                        <select class="form-control" wire:model="company" id="company" required>
                                    <option value="" selected="selected">Company</option>
                                    @php
                                     $get_company = getCompany();
                                     @endphp
                                     @foreach ($get_company as $r)
                                         <option value="{{ $r->id }}">{{ $r->company_name }}</option>
                                     @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('company')" class="mt-2" />
                      </div>
                      <div class="col-6 mb-2">
                      <x-input-label :value="__('Lease Type')" />
                      <div class="leasing-filter">
                            <x-text-input wire:model="lease_type" name="lease_type" type="radio" id="monthly"  value="monthly" />
                            <label for="monthly">Monthly</label>
                            <x-text-input wire:model="lease_type" name="lease_type" type="radio" id="quarterly"  value="quarterly"  />
                            <label for="quarterly">Quarterly</label>
                            <x-text-input wire:model="lease_type" name="lease_type" type="radio" id="yearly"  value="yearly" />
                            <label for="yearly">Yearly</label>
                            <inx-text-inputput wire:model="lease_type" name="lease_type" type="radio" id="custom"  value="custom" />
                            <label for="custom">Custom</label>
                      </div>
                    </div>
                      <div class="col-6 mb-2">
                          <x-input-label for="vehicle" :value="__('Vehicle')" />
                          <select class="form-control" required  wire:model="vehicle" id="vehicle">
                                <option value="" selected="selected">Vehicle</option>
                                  @if(isset($vehicles))
                                      @foreach($vehicles as $vl)
                                          <option value="{{ $vl->id }}">{{ $vl->licence_plate_no }}</option>
                                      @endforeach
                                  @endif
                            </select>
                          <x-input-error :messages="$errors->get('vehicle')" class="mt-2" />
                      </div>
                    
                      <div class="col-6 mb-2">
                          <x-input-label for="start_date" :value="__('Start Date')" />
                          <x-text-input   wire:model="start_date" required class="form-control" data-datepicker type="text" id="start_date" />
                          <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                      </div>
                      <div class="col-6 mb-2">
                          <x-input-label for="end_date" :value="__('End Date')" />
                          <x-text-input  wire:model="end_date" class="form-control" type="text" data-datepicker id="end_date" />
                          <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                      </div>
                      <div class="col-6 mb-2">
                        <x-input-label for="attachments" :value="__('Attachments')" />
                        <x-text-input  wire:model="attachments" class="form-control" type="file" id="attachments" />
                        <br /> <br />
                            @if(isset($attachments) and $attachments)
                                <div class="attachment">
                                    <a href="{{ baseURL($attachments) }}" target="_blank">View Document</a>
                                </div>
                            @endif
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
          {{ setJs(['vehicle-leasing/index']) }}