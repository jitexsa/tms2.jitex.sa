<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Insurance</h5>
                    <a href="{{ baseUrl('vehicle/insurance') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <div class="row">
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
                          <x-input-label for="vehicle" :value="__('Vehicle')" />
                          @include('layouts.dropdown.vehicle')
                          <x-input-error :messages="$errors->get('vehicle')" class="mt-2" />
                      </div>
                      <div class="col-6 mb-2">
                        <x-input-label for="recurring_period" :value="__('Recurring Period')" />
                        <select class="form-control" required wire:model="recurring_period" id="recurring_period">
                                <option value="" selected>Select</option>
                                <option value="30">30</option>
                                <option value="Yes">Yes</option>
                                <option value="11">11</option>
                                <option value="1 Year">1 Year </option>
                                <option value="1 Month">1 Month</option>
                                <option value="10 Days">10 Days </option>
                            </select>
                        <x-input-error :messages="$errors->get('recurring_period')" class="mt-2" />
                      </div>
                      <div class="col-6 mb-2">
                        <x-input-label for="recurring_date" :value="__('Recurring Date')" />
                        <x-text-input  wire:model="recurring_date" class="form-control" type="text" data-datepicker id="recurring_date" />
                        <x-input-error :messages="$errors->get('recurring_date')" class="mt-2" />
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
                          <x-input-label for="policy_number" :value="__('Policy Number')" />
                          <x-text-input  wire:model="policy_number" class="form-control" type="text" id="policy_number" />
                          <x-input-error :messages="$errors->get('policy_number')" class="mt-2" />
                      </div>
                      <div class="col-6 mb-2">
                        <x-input-label for="policy_document" :value="__('Policy Document')" />
                        <x-text-input  wire:model="policy_document" class="form-control" type="file" id="policy_document" />
                        <br /> <br />
                            @if(isset($policy_document) and $policy_document)
                                <div class="attachment">
                                    <a href="{{ baseURL($policy_document) }}" target="_blank">View Document</a>
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