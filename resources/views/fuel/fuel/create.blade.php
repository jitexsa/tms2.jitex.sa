<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Fuel</h5>
                    <a href="{{ baseUrl('fuel') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <div class="col-6">
                           <x-input-label for="vehicle" :value="__('Vehicle')" />
                           @include('layouts.dropdown.vehicle')
                           <x-input-error :messages="$errors->get('vehicle')" class="mt-2" />
                      </div>   
                <div class="col-6">
                            <x-input-label for="vendor_id" :value="__('Vendor')" />
                            <select class="form-control" wire:model="vendor_id" id="vendor_id" required>
                                <option value="" selected="selected">Select Vendor</option>
                                @php
                                $get_vendor = getFuelVendor();
                                @endphp
                                @foreach ($get_vendor as $val)
                                    <option value="{{ $val->id }}">{{ $val->vendor_name }}</option>
                               @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('vendor_id')" class="mt-2" />
                    </div>
                    <div class="col-6">
                           <x-input-label for="refueling_date" :value="__('Refueled Date')" />
                           <x-text-input wire:model="refueling_date" id="refueling_date" data-datepicker class="form-control" type="text" required />
                           <x-input-error :messages="$errors->get('refueling_date')" class="mt-2" />
                    </div>
                    <div class="col-6">
                    <x-input-label for="fuel_type_id" :value="__('Fuel Type')" />
                            <select class="form-control" wire:model="fuel_type_id" id="fuel_type_id" required>
                                <option value="" selected="selected">Select Fuel Type</option>
                                @php
                                $fuelType = getFuelType();
                                @endphp
                                @foreach ($fuelType as $val)
                                    <option value="{{ $val->id }}">{{ $val->type_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('fuel_type_id')" class="mt-2" />
                    </div>
                    <div class="col-6">
                        <x-input-label for="start_meter" :value="__('Current ODO Meter')" />
                        <x-text-input wire:model="start_meter" id="start_meter" class="form-control" type="number" step="any" required />
                        <small>Meter reading at time of fuel-up</small>
                        <x-input-error :messages="$errors->get('start_meter')" class="mt-2" />
                    </div>
                    <div class="col-6">
                    <x-input-label for="qty" :value="__('Qty (gallon)')" />
                        <x-text-input wire:model="qty" id="qty" class="form-control" type="number"  required />
                        <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                    </div>
                    <div class="col-6">
                        <x-input-label for="reference" :value="__('Invoice Reference')" />
                        <x-text-input wire:model="reference" id="reference" class="form-control" type="text" /> 
                    </div>
                    
                    <div class="col-6">
                    <x-input-label for="cost" :value="__('Cost/Unit')" />
                        <x-text-input wire:model="cost" id="cost" class="form-control" type="number" required />
                        <x-input-error :messages="$errors->get('cost')" class="mt-2" />
                    </div>
                    <div class="col-6">
                        <x-input-label for="state" :value="__('State/Province')" />
                        <x-text-input wire:model="state" id="state" class="form-control" type="text" required />
                        <x-input-error :messages="$errors->get('state')" class="mt-2" />
                    </div>
                    <div class="col-6">
                    <x-input-label for="note" :value="__('Note')" />
                        <x-text-input wire:model="note" id="note" class="form-control" type="text"/>
                    </div>
                    <div class="col-6">
                    <x-input-label for="slip" :value="__('Fuel Slip Scan Copy')" />
                     <input wire:model="slip" id="slip" class="form-control"  type="file">
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