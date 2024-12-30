<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Vendor</h5>
                    <a href="{{ baseUrl('vendor') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <div class="horizontal-wizard-wrapper vertical-options vertical-variations">
                      <div class="row g-3">
                        <div class="col-xl-3 main-horizontal-header">
                          <div class="nav nav-pills horizontal-options"
                               id="vertical-n-wizard-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="wizard-n-info-tab"
                               data-bs-toggle="pill" href="#wizard-n-info"
                               role="tab" aria-controls="wizard-n-info" aria-selected="true">
                              <div class="horizontal-wizard">
                                <div class="stroke-icon-wizard"><span>1</span></div>
                                <div class="horizontal-wizard-content"> 
                                  <h6>Personal Details</h6>
                                </div>
                              </div></a><a class="nav-link" id="bank-n-wizard-tab" data-bs-toggle="pill" 
                              href="#bank-n-wizard" role="tab" aria-controls="bank-n-wizard" aria-selected="false"> 
                              <div class="horizontal-wizard">
                                <div class="stroke-icon-wizard"><span>2</span></div>
                                <div class="horizontal-wizard-content"> 
                                  <h6>Bank Information</h6>
                                </div>
                              </div></a>
                            </div>
                        </div>
                        <div class="col-xl-9">
                          <div class="tab-content dark-field" id="vertical-n-wizard-tabContent">
                            <div class="tab-pane fade show active" id="wizard-n-info"
                                 role="tabpanel" aria-labelledby="wizard-n-info-tab">
                                 <div class="row">
                               <div class="col-6 mb-3">
                                   <x-input-label for="vendor_type" :value="__('Vendor Type')" />
                                    <select class="form-control" wire:model="vendor_type" id="vendor_type" required>
                                        <option value="" selected="selected">Vendor Type</option>
                                        @php
                                        $get_vendor_type = getVendorType();
                                        @endphp
                                        @foreach ($get_vendor_type as $v)
                                            <option value="{{ $v->id }}">
                                            {{ $v->vendor_type }}
                                            </option>
                                      @endforeach
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                  <x-input-label for="vendor_name" :value="__('Vendor Name')" />
                                  <x-text-input wire:model="vendor_name" id="vendor_name" class="form-control" type="text" required />
                                  <x-input-error :messages="$errors->get('vendor_name')" class="mt-2" />
                                </div>
                                <div class="col-6 mb-3">
                                  <x-input-label for="phone_number" :value="__('Phone Number')" />
                                  <x-text-input wire:model="phone_number" id="phone_number" class="form-control" type="text" />
                                </div>
                                <div class="col-6 mb-3">
                                  <x-input-label for="address" :value="__('Address')" />
                                  <x-text-input wire:model="address" id="address" class="form-control" type="text" />
                                </div>
                                <div class="col-6">
                                  <x-input-label for="cr_attachment" :value="__('CR')" />
                                  <x-text-input wire:model="cr_attachment" id="cr_attachment" class="form-control" type="file" />
                                </div>
                                <div class="col-6">
                                  <x-input-label for="vat_certificate" :value="__('VAT Certificate')" />
                                  <x-text-input wire:model="vat_certificate" id="vat_certificate" class="form-control" type="file" />
                                </div>
                                 </div>
                            </div>
                            <div class="tab-pane fade" id="bank-n-wizard" role="tabpanel" aria-labelledby="bank-n-wizard-tab">
                            <div class="row">    
                                <div class="col-6 mb-3">
                                      <x-input-label for="bank_name" :value="__('Bank Name')" />
                                      <x-text-input wire:model="bank_name" id="bank_name" class="form-control" type="text" />
                                </div>
                                <div class="col-6 mb-3">
                                      <x-input-label for="account_number" :value="__('Account No')" />
                                      <x-text-input wire:model="account_number" id="account_number" class="form-control" type="text" />
                                </div>
                                <div class="col-6">
                                      <x-input-label for="branch_code" :value="__('Branch Code')" />
                                      <x-text-input wire:model="branch_code" id="branch_code" class="form-control" type="text" />
                                </div>
                                <div class="col-6">
                                      <x-input-label for="iban_no" :value="__('IBAN No')" />
                                      <x-text-input wire:model="iban_no" id="iban_no" class="form-control" type="text" />
                                </div>
                            </div>
                            </div>
                          </div>
                        </div>
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