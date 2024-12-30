<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Customer</h5>
                    <a href="{{ baseUrl('customer') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                      <div class="col-6">
                      <div class="col-12 mb-3">
                        <x-input-label for="customer_name" :value="__('Customer Name')" />
                        <x-text-input wire:model="customer_name" id="customer_name" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                        </div>
                        <div class="col-12 mb-3">
                        <x-input-label for="mobile" :value="__('Mobile')" />
                        <x-text-input wire:model="mobile" id="mobile" class="form-control" type="text" required/>
                        <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                      </div>
                      <div class="col-12 mb-3">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input wire:model="address" id="address" class="form-control" type="text" required/>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                      </div>
                      <div class="col-12 mb-3">
                        <x-input-label for="country_id" :value="__('Country')" />
                        <select  class="form-control" wire:model="country_id" id="country_id" data-select required>
                                <option value="" selected="selected">Country</option>
                                @php
                                $get_country = getCountry();
                                @endphp
                                @foreach ($get_country as $r)
                                    <option value="{{ $r->country_id }}">
                                    {{ $r->country_name }}
                                    </option>
                               @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                      </div>
                      <div class="col-12 mb-3">
                        <x-input-label for="division_id" :value="__('Division')" />
                        <select  class="form-control" wire:model="division_id" id="division_id"  required>
                                <option value="" selected="selected">Division</option>
                                @php
                                $get_division = getDivision();
                                @endphp
                                @foreach ($get_division as $d)
                                    <option value="{{$d->division_id }}">
                                    {{ $d->division_name }}
                                    </option>
                               @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('division_id')" class="mt-2" />
                      </div>
                      </div>
                      
                     
                      
                      
                      <div class="col-6">
                      <div class="col-12 mb-3">
                        <x-input-label for="cr_number" :value="__('CR Number')" />
                        <x-text-input wire:model="cr_number" id="cr_number" class="form-control" type="text" />
                        </div>
                        <div class="col-12 mb-3">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input wire:model="email" id="email" class="form-control" type="text" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                      </div>
                      <div class="col-12 mb-3">
                        <x-input-label for="city" :value="__('City')" />
                        <x-text-input wire:model="city" id="city" class="form-control" type="text" required />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                      </div>
                      <div class="col-12 mb-3">
                        <x-input-label for="company_id" :value="__('Company')" />
                        <select  class="form-control" wire:model="company_id" id="company_id"  required>
                                <option value="" selected="selected">Company</option>
                                @php
                                $get_company = getCompany();
                                @endphp
                                @foreach ($get_company as $c)
                                    <option value="{{$c->company_id }}">
                                    {{ $c->company_name }}
                                    </option>
                               @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('company_id')" class="mt-2" />
                      </div>
                      <div class="col-12 mb-3">
                      <x-input-label for="SMS Enable" :value="__('SMS Enable')" />
                      <div class="d-flex align-items-center flex-col gap-2">
                           @php
                             $sms_status = listingStatus();
                             @endphp
                             @foreach ($sms_status as $key => $val)
                              <x-text-input wire:model="is_sms" id="is_sms_{{ $key }}" class="form-check-input" type="radio" value="{{ $key }}"  required=""/>
                              <x-input-label for="is_sms_{{ $key }}" :value="$val" />
                           @endforeach
                           </div>
                        <x-input-error :messages="$errors->get('is_sms')" class="mt-2" />
                      </div>

                      <div class="col-12 mt-3 text-right">
                        <button class="btn btn-primary" type="submit">{{($id)?'Update':'Save'}}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>