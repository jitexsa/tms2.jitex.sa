<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Additional Requirements</h5>
                    <a href="{{ baseUrl('trip/additional-requirements') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <div class="col-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input wire:model="name" id="name" class="form-control" type="text" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                      </div>
                  <div class="col-6">
                        <x-input-label for="labor_type" :value="__('Labor Type')" />
                        <select  class="form-control" wire:model="labor_type" id="labor_type" required>
                                <option value="" selected="selected">Select Labor Type</option>
                                @php
                                $labor_type = laborType();
                                @endphp
                                @foreach ($labor_type as $key => $s)
                                    <option value="{{ $key }}">
                                    {{ $s }}
                                    </option>
                               @endforeach
                            </select>
                        <x-input-error :messages="$errors->get('labor_type')" class="mt-2" />
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