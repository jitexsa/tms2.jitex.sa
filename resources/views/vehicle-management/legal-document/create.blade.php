<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Legal Document</h5>
                    <a href="{{ baseUrl('vehicle/legal-document') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <div class="row">
                      <div class="col-6 mb-2">
                        <x-input-label for="document_id" :value="__('Document Type')" />
                        <select class="form-control" wire:model="document_id" id="document_id" required>
                                    <option value="" selected="selected">Select</option>
                                    @php
                                     $get_document = getDocumentType();
                                     @endphp
                                     @foreach ($get_document as $r)
                                         <option value="{{ $r->id }}">{{ $r->document_name }}</option>
                                     @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('document_id')" class="mt-2" />
                      </div>
                      <div class="col-6 mb-2">
                          <x-input-label for="vehicle" :value="__('Vehicle')" />
                          @include('layouts.dropdown.vehicle')
                          <x-input-error :messages="$errors->get('vehicle')" class="mt-2" />
                      </div>
                     
                      <div class="col-6 mb-2">
                        <x-input-label for="last_issue_date" :value="__('Last Issue Date')" />
                        <x-text-input  wire:model="last_issue_date" class="form-control" type="text" data-datepicker id="last_issue_date" />
                        <x-input-error :messages="$errors->get('last_issue_date')" class="mt-2" />
                      </div>
                      <div class="col-6 mb-2">
                          <x-input-label for="expire_date" :value="__('Expire Date')" />
                          <x-text-input   wire:model="expire_date" required class="form-control" data-datepicker type="text" id="expire_date" />
                          <x-input-error :messages="$errors->get('expire_date')" class="mt-2" />
                      </div>
                      <div class="col-6 mb-2">
                        <x-input-label for="document" :value="__('Document Attachment')" />
                        <x-text-input  wire:model="document" class="form-control" type="file" id="document" />
                        <br /> <br />
                            @if(isset($document) and $document)
                                <div class="attachment">
                                    <a href="{{ baseURL($document) }}" target="_blank">View Document</a>
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