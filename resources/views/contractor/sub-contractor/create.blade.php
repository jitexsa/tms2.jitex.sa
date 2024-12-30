<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Subcontractor</h5>
                    <a href="{{ baseUrl('subcontractor') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <div class="col-6">    
                  <div class="col-12 mb-2">
                        <x-input-label for="transporter_name" :value="__('Transporter Name')" />
                        <x-text-input wire:model="transporter_name" id="transporter_name" class="form-control" type="text" required />
                        <x-input-error :messages="$errors->get('transporter_name')" class="mt-2" />
                      </div>  
                      
                      <div class="col-12 mb-2">
                        <x-input-label for="contact_person" :value="__('Contact Person')" />
                        <x-text-input wire:model="contact_person" id="contact_person" class="form-control" type="text" required />
                        <x-input-error :messages="$errors->get('contact_person')" class="mt-2" />
                      </div>

                      <div class="col-12 mb-2">
                        <x-input-label for="cr_number" :value="__('CR Number')" />
                        <x-text-input wire:model="cr_number" id="cr_number" class="form-control" type="text" />
                      </div>
                      <div class="col-12 mb-2">
                        <x-input-label for="landline_no" :value="__('Landline Number')" />
                        <x-text-input wire:model="landline_no" id="landline_no" class="form-control" type="text" />
                      </div>
                      
                      <div class="col-12 mb-2">
                        <x-input-label for="division" :value="__('Division')" />
                        <select class="form-control" wire:model="division" id="division" required>
                                    <option value="" selected="selected">Division</option>
                                    @php
                                    $get_division = getDivision();
                                    @endphp
                                    @foreach ($get_division as $r)
                                        <option value="{{ $r->id }}">
                                            {{ $r->division_name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('division')" class="mt-2" />
                      </div>

                      <div class="col-12 mb-2">
                        <x-input-label for="document_attachment" :value="__('Document Attachment')" />
                        <x-text-input wire:model="document_attachment" id="document_attachment" class="form-control" type="file" />

                        @if($document_attachment){ ?>
                                    <div class="attachment">
                                        <img src="{{$document_attachment}}" width="100">
                                    </div>
                            @endif
                      </div>

                      <div class="col-12>
                        <x-input-label for="status" :value="__('Status')" />
                        <select class="form-control" wire:model="status" id="status" required>
                                    <option value="" selected="selected">Status</option>
                                    @php
                                    $contractor_status = contractorStatus();
                                    @endphp
                                    @foreach ($contractor_status as $r)
                                        <option value="{{ $r->id }}">
                                            {{ $r->name }}
                                        </option>
                                        @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                      </div>
                  </div>
                  <div class="col-6">

                      <div class="col-12 mb-2">
                        <x-input-label for="onboarding_date" :value="__('Onboarding Date')" />
                        <x-text-input wire:model="onboarding_date" id="onboarding_date" data-datepicker class="form-control" type="text" required />
                        <x-input-error :messages="$errors->get('onboarding_date')" class="mt-2" />
                      </div>

                      <div class="col-12 mb-2">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input wire:model="email" id="email"  class="form-control" type="text" />
                      </div>

                      <div class="col-12 mb-2">
                        <x-input-label for="contact_no" :value="__('Contact Number')" />
                        <x-text-input wire:model="contact_no" id="contact_no"  class="form-control" type="text" required/>
                        <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />
                      </div>

                      <div class="col-12 mb-2">
                        <x-input-label for="vat_no" :value="__('VAT Number')" />
                        <x-text-input wire:model="vat_no" id="vat_no"  class="form-control" type="text" />
                      </div>

                      <div class="col-12 mb-2">
                        <x-input-label for="location" :value="__('Location')" />
                        @include('layouts.dropdown.route', array('name' => 'location'))
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                      </div>
                      <div class="col-12 mb-2">
                        <x-input-label for="company" :value="__('Company')" />
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
                      <div class="col-12 mb-2">
                        <x-input-label for="website" :value="__('Website')" />
                        <x-text-input wire:model="website" id="website"  class="form-control" type="text" />
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