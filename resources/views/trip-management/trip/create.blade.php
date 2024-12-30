<div class="container-fluid datatable-advance-wrapper">
            <div class="row">
              <!-- Stock result -->
              <div class="col-12">
                <div class="card">
                  <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                    <h5>Trip</h5>
                    <a href="{{ baseUrl('trip') }}"  class="btn btn-primary btn-md">
                                View 
                    </a>
                  </div>
                  <div class="card-body">
                  <form wire:submit="{{($id)?'update':'save'}}" class="row g-3 needs-validation custom-input" novalidate="">
                  <div class="col-6">
                    <div class="col-12 mb-2">
                        <label for="trip_date">Date <i class="text-danger">*</i></label>
                        <input wire:model="trip_date" class="form-control" data-datepicker type="text" placeholder="" id="trip_date" required />
                        <x-input-error :messages="$errors->get('trip_date')" class="mt-2" />
                    </div>
                    <div class="col-12  mb-2">
                        <label for="job_no">Job No <i class="text-danger">*</i></label>
                        <div class="row">
                            <div class="col-11 load-shipping">
                                @include('layouts.dropdown.shipping')
                            </div>
                            <div class="col-1 pt-2">
                                <a href="#" data-bs-target="#add-shipping" data-bs-toggle="modal">
                                    <img src="{{ baseURL('assets/images/plus.png') }}">
                                </a>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('job_no')" class="mt-2" />
                    </div>
                    <div class="col-12 mb-2">
                        <label>LDG. REF </label>
                            <div class="row">
                            <div class="col-3">
                                <input wire:model="port" class="form-control" type="text" placeholder="Port" id="port" />
                            </div>
                            <div class="col-3">
                                <input wire:model="terminal" class="form-control" type="text" placeholder="Terminal" id="terminal" />
                            </div>
                            <div class="col-3">
                                <input wire:model="warehouse" class="form-control" type="text" placeholder="W/House" id="warehouse" />
                            </div>
                            <div class="col-3">
                                <input wire:model="others" class="form-control" type="text" placeholder="Others" id="others" />
                            </div>
                            </div>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="client">Client <i class="text-danger">*</i></label>
                            <select class="form-control" wire:model="client" id="client" data-select required>
                                <option value="" selected="selected">Select Client</option>
                                @php
                                $get_customer = getCustomer();
                                @endphp
                                @foreach ($get_customer as $val)
                                    <option value="{{ $val->id }}" data-contact_person="{{ $val->customer_name }}"
                                    data-telephone=" {{ $val->mobile }}">{{ $val->customer_name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('client')" class="mt-2" />
                    </div>
                    <div class="col-12 mb-2">
                        <label for="client">Scope Of Work <i class="text-danger">*</i></label>
                            <select class="form-control" wire:model="sow_id" id="sow_id" data-select required>
                                <option value="" selected="selected">Select SOW</option>
                                @php
                                $sow = sowList();
                                @endphp
                                @foreach ($sow as $s)
                                    <option value="{{ $s->id }}"> {{ $s->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('sow_id')" class="mt-2" />
                    </div>
                    <div class="col-12">
                        <label for="request_by">Requested By <i class="text-danger">*</i></label>
                        <div class="row">
                            <div class="col-11 load-requested">
                                @include('layouts.dropdown.requested-by')
                            </div>
                            <div class="col-1 pt-2">
                                <a href="#"  data-bs-target="#add-request" data-bs-toggle="modal">
                                    <img src="{{ baseURL('assets/images/plus.png') }}">
                                </a>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('request_by')" class="mt-2" />
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-12 mb-2">
                        <label for="status">Status <i class="text-danger">*</i></label>
                            <select class="form-control" wire:model="status" id="status" data-select required>
                                <option value="" selected="selected">Select Status</option>
                                @php
                                $trip_status = tripStatus();
                                @endphp
                                @foreach ($trip_status as $key => $s)
                                    <option value="{{ $s->id }}"> {{ $s->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                    <div class="col-12 mb-2">
                        <label for="wessel">Wessel</label>
                            <input wire:model="wessel" class="form-control" type="text" placeholder="" id="wessel" />
                    </div>
                    <div class="col-12 mb-2">
                        <label for="voyage">Voyage</label>
                            <input wire:model="voyage" class="form-control" type="text" placeholder="" id="voyage" />
                    </div>
                    <div class="col-12 mb-2">
                        <label for="awb">B/L AWB</label>
                            <input wire:model="awb" class="form-control" type="text" placeholder="" id="awb" />
                    </div>
                    <div class="col-12 mb-2">
                        <label for="request_date">Request Date <i class="text-danger">*</i></label>
                            <input wire:model="request_date" class="form-control" data-datepicker type="text" placeholder="" id="request_date" required />
                            <x-input-error :messages="$errors->get('request_date')" class="mt-2" />
                    </div>
                </div>

                <div class="col-12 card-header p-2">
                    <h5 class="pl-3">Additional Requirements</h5>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <label class="col-form-label"><strong>Labour and Equipment Type</strong></label>
                        </div>
                        <div class="col-5">
                            <label class="col-form-label"><strong>Quantity</strong></label>
                        </div>
                        <div class="col-1"></div>
                    </div>
                        <div class="row">
                            <div class="col-6">
                                <select class="form-control" wire:model="labor.1" data-select data-labor>
                                    <option value="" selected="selected">Select Labor Type</option>
                                    @php
                                    $labor = getLaborType();
                                    @endphp
                                    @foreach ($labor as $key => $va)
                                        <option value="{{ $va->id }}">{{ $va->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <input wire:model="labor_qty.1" id="labor_qty" class="form-control" type="number" placeholder="">
                            </div>
                            <div class="col-1 pt-2">
                                <a href="javascript:void(0)" wire:click.prevent="addRow({{ $i }})"><img src="{{ baseURL('assets/images/plus.png') }}"></a>
                            </div>
                        </div>
                        @foreach($additional_detail as $n => $t)
                                <div class="row pt-3">
                                    <div class="col-6">
                                        <select class="form-control" wire:model="labor.{{$t}}" data-select data-labor>
                                            <option value="" selected="selected">Select Labor Type</option>
                                            @php
                                            $labor = getLaborType();
                                            @endphp
                                            @foreach ($labor as $key => $va)
                                                <option value="{{ $va->id }}">{{ $va->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <input wire:model="labor_qty.{{$t}}" id="labor_qty" class="form-control" type="number" placeholder="" required />
                                        <x-input-error :messages="$errors->get('labor_qty')" class="mt-2" />
                                    </div>
                                    <div class="col-1 pt-2">
                                        <a href="javascript:void(0)"  wire:click.prevent="removeRow({{ $n }}"><img src="{{ baseURL('assets/images/minus.png') }}"></a>
                                    </div>
                                </div>
                         @endforeach
                </div>
                <div class="col-12 card-header p-2 mt-4">
                        <h5 class="pl-3">Name & Address</h5>
                    </div>
                <div class="col-6 pt-4">
                        <div class="col-12 mb-2">
                            <label for="contact_person">Contact Person: <i class="text-danger">*</i></label>
                            <input wire:model="contact_person" class="form-control" type="text" placeholder="" id="contact_person"  required />
                            <x-input-error :messages="$errors->get('contact_person')" class="mt-2" />
                        </div>

                        <div class="col-12 mb-2">
                            <label for="telephone">Telephone <i class="text-danger">*</i></label>
                            <input wire:model="telephone" class="form-control" type="text" placeholder="" id="telephone" number  required />
                            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                        </div>
                       <div class="col-12 mb-2">
                           <label for="loading_at">POL <i class="text-danger">*</i></label>
                           <div class="row">
                            <div class="col-11 loading-route">
                                @include('layouts.dropdown.route', array('name' => 'loading_at'))
                            </div>
                            <div class="col-1 pt-2">
                                <a href="#" data-bs-target="#route" data-bs-toggle="modal" id="trip_loading">
                                    <img src="{{ baseURL('assets/images/plus.png') }}">
                                </a>
                            </div>
                           </div>
                        <x-input-error :messages="$errors->get('loading_at')" class="mt-2" />
                    </div>
                    <div class="col-12 mb-2">
                        <label for="delivery_at">POD <i class="text-danger">*</i></label>
                        <div class="row">
                            <div class="col-11 delivery-route">
                                @include('layouts.dropdown.route', array('name' => 'delivery_at'))
                            </div>
                            <div class="col-1 pt-2">
                                <a href="#" data-bs-target="#route" data-bs-toggle="modal" id="trip_delivery">
                                    <img src="{{ baseURL('assets/images/plus.png') }}">
                                </a>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('delivery_at')" class="mt-2" />
                    </div>
                    <div class="col-12 mb-2">
                        <label for="temperature">Temperature</label>
                        <input wire:model="temperature" class="form-control" type="text" placeholder="" id="temperature" />
                    </div>
                </div>
                <div class="col-6 pt-4">
                    <div class="col-12 mb-2">
                        <label for="vehicle">Vehicle No <i class="text-danger">*</i></label>
                        <div class="row">
                            <div class="col-11 load-vehicle">
                            @include('layouts.dropdown.vehicle', array('skip' => true))
                            </div>
                            <div class="col-1 pt-2">
                                <a href="#" data-open-vehicle-modal>
                                    <img src="{{ baseURL('assets/images/plus.png') }}">
                                </a>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('vehicle')" class="mt-2" />
                    </div>
                    <div class="col-12 mb-2">
                        <label for="truck_type">Truck Type</label>
                        <input class="form-control" type="text"  placeholder="" id="truck_type" readonly />
                    </div>
                    <div class="col-12 mb-2">
                        <label for="driver">Driver</label>
                        <input type="hidden" wire:model="driver" id="driver">
                        <input class="form-control" type="text"  placeholder="" id="driver_name" readonly />
                        <x-input-error :messages="$errors->get('driver')" class="mt-2" />                            
                    </div>
                    <div class="col-12 mb-2">
                        <label for="license_no">L/C No <i class="text-danger">*</i></label>
                        <input class="form-control" type="text" placeholder="" id="license_no" readonly />
                    </div>
                    <div class="col-12 mb-2">
                        <label for="driver_no">Driver Mobile <i class="text-danger">*</i></label>
                        <input class="form-control" type="text" placeholder="" id="driver_mobile" readonly />
                    </div>
                </div>
                <div class="col-12">
                <div class="row">
                    <div class="col-3">
                        <label class="col-form-label"><strong>Marks & No</strong></label>
                    </div>
                    <div class="col-3">
                        <label class="col-form-label"><strong>Cargo Description</strong></label>
                    </div>
                    <div class="col-1">
                        <label class="col-form-label"><strong>Qty</strong></label>
                    </div>
                    <div class="col-1">
                        <label class="col-form-label"><strong>Weight</strong></label>
                    </div>
                    <div class="col-3">
                        <label class="col-form-label"><strong>Remarks</strong></label>
                    </div>
                    <div class="col-1"></div>
                </div>
                    <div data-set>
                       <div class="row">
                        <div class="col-3">
                            <input wire:model="marks_no" class="form-control" type="text" placeholder="" />
                        </div>
                        <div class="col-3">
                            <input wire:model="cargo_desc" class="form-control" type="text" placeholder="" />
                        </div>
                        <div class="col-1">
                            <input wire:model="qty" class="form-control" type="text" placeholder="" number />
                        </div>
                        <div class="col-1">
                            <input wire:model="weight" class="form-control" type="text" placeholder="" number />
                        </div>
                        <div class="col-3">
                            <input wire:model="remarks" class="form-control" type="text" placeholder="" data-row />
                        </div>
                       <div class="col-1 pt-2">
                           <a href="#" data-add-row><img src="{{ baseURL('assets/images/plus.png') }}"></a>
                       </div>
                    </div>
                          @if(isset($trip_detail) and !empty($trip_detail) and count($trip_detail) > 1)
                              @php    
                              unset($trip_detail[0]);
                              @endphp
                              @foreach($trip_detail as $n => $td)
                                  <div class="row pt-3 delete">
                                      <div class="col-3">
                                          <input wire:model="marks_no" class="form-control" type="text" placeholder="" />
                                      </div>
                                      <div class="col-3">
                                          <input wire:model="cargo_desc" class="form-control" type="text" placeholder="" />
                                      </div>
                                      <div class="col-1">
                                          <input wire:model="qty" class="form-control" type="text" placeholder="" number />
                                      </div>
                                      <div class="col-1">
                                          <input wire:model="weight" class="form-control" type="text" placeholder="" number />
                                      </div>
                                      <div class="col-3">
                                          <input wire:model="remarks" class="form-control" type="text" placeholder="" data-row />
                                      </div>
                                      <div class="col-1 pt-2">
                                          <a href="#" data-delete-row><img src="{{ baseURL('assets/images/minus.png') }}"></a>
                                      </div>
                                  </div>
                                  @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-12 pt-4">
                    <div class="row">
                        <div class="col-4 text-center">
                            <label class="col-form-label"><strong>Loading Place</strong></label>
                            <div class="col-12">
                                <div class="row pb-3">
                                <div class="col-3"></div>
                                    <div class="col-4"><strong>Time</strong></div>
                                    <div class="col-5"><strong>Date</strong></div>
                                </div>

                                <div class="row pb-3">
                                <div class="col-3">Arrival</div>
                                    <div class="col-4">
                                        <select class="form-control" wire:model="arrival_time" id="arrival_time" data-select>
                                            @php
                                            $get_time = timeDropdown();
                                            @endphp
                                            <option value="" selected></option>
                                            @foreach ($get_time as $t)
                                                <option value="{{ $t }}">  {{ $t }}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <input type="text" wire:model="arrival_date" data-datepicker class="form-control place_date" id="arrival_date" />
                                    </div>
                                </div>

                                <div class="row pb-3">
                                <div class="col-3">Loaded</div>
                                    <div class="col-4">
                                        <select class="form-control" wire:model="loaded_time" id="loaded_time" data-select>
                                        @php    
                                        $get_time = timeDropdown();
                                        @endphp
                                            <option value="" selected></option>
                                            @foreach ($get_time as $t)
                                                <option value="{{ $t }}">{{ $t }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <input type="text" wire:model="loaded_date" data-datepicker class="form-control" data-datepicker id="loaded_date" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">Exit</div>
                                    <div class="col-4">
                                        <select class="form-control" wire:model="exit_time" id="exit_time" data-select>
                                            @php
                                             $get_time = timeDropdown();
                                             @endphp
                                            <option value="" selected></option>
                                            @foreach ($get_time as $t)
                                                <option value="{{ $t }}">{{ $t }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <input type="text" wire:model="exit_date" data-datepicker class="form-control place_date" id="exit_date" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <p>
                                <strong> Received the above Cargo / Container in Good condition while the seal intact</strong>
                            </p>
                            <div class="col-12 mb-2">
                                <label for="name_of_receiver">Receiver</label>
                                    <input wire:model="name_of_receiver" class="form-control" type="text" placeholder="" id="name_of_receiver" />
                            </div>

                            <div class="col-12 mb-2">
                                <label>Signature</label>
                            </div>

                            <div class="col-12">
                                <label>Stamp</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="col-form-label"><strong>Delivery Place</strong></label>
                            <div class="col-12">
                                <div class="row pb-3">
                                    <div class="col-3"></div>
                                    <div class="col-4"><strong>Time</strong></div>
                                    <div class="col-5"><strong>Date</strong></div>
                                </div>

                                <div class="row pb-3">
                                    <div class="col-3">Arrival</div>
                                    <div class="col-4">
                                        <select class="form-control" wire:model="delivery_time" id="delivery_time" data-select>
                                            @php 
                                            $get_time = timeDropdown();
                                            @endphp
                                            <option value="" selected></option>
                                            @foreach ($get_time as $t)
                                                <option value="{{ $t }}"> {{ $t }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <input type="text" wire:model="delivery_date" data-datepicker class="form-control place_date" id="delivery_date" />
                                    </div>
                                </div>

                                <div class="row pb-3">
                                <div class="col-3" style="padding-left: 0">UnLoaded</div>
                                    <div class="col-4">
                                        <select class="form-control" wire:model="unloaded_time" id="unloaded_time" data-select>
                                            @php
                                             $get_time = timeDropdown();
                                             @endphp
                                            <option value="" selected></option>
                                             @foreach ($get_time as $t)
                                                <option value="{{ $t }}">{{ $t }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <input type="text" wire:model="unloaded_date" data-datepicker class="form-control place_date" id="unloaded_date" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">Exit</div>
                                    <div class="col-4">
                                        <select class="form-control" wire:model="delivery_exit_time" id="delivery_exit_time" data-select>
                                            @php
                                             $get_time = timeDropdown();
                                             @endphp
                                            <option value="" selected></option>
                                             @foreach ($get_time as $t)
                                                <option value="{{ $t }}">{{ $t }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <input type="text" wire:model="delivery_exit_date" data-datepicker class="form-control place_date" id="delivery_exit_date" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-4">
                        <div class="col-6">
                            @if(isset($edit) and !empty($edit->loading_image))
                                <a  href="javascript:void(0)"
                                    data-attachment data-id="{{ $edit->id }}" data-type="loading">
                                    <button type="button" class="btn btn-success">View Loading Documents</button>
                                </a>
                            @endif
                            <label for="loading_image" class="drop-container" id="dropcontainer">
                                <input type="file" wire:model="loading_image" id="loading_image" class="form-control" accept="image/*" multiple />
                            </label>
                        </div>
                        <div class="col-6 text-right">
                            @if(isset($edit) and !empty($edit->unloading_image))
                                <a href="javascript:void(0)"
                                   data-attachment data-id="{{ $edit->id }}" data-type="unloading">
                                    <button type="button" class="btn btn-success"> View Unloading Documents</button>
                                </a>
                             @endif
                            <label for="unloading_image" class="drop-container" id="dropcontainer">
                                <input type="file" wire:model="unloading_image" id="unloading_image" class="form-control" accept="image/*" multiple />
                            </label>
                        </div>
                    </div>
                </div>
                      <div class="col-12 text-right">
                        <button class="btn btn-primary" type="submit">{{($id)?'Update':'Save'}}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- Container-fluid Ends-->
          </div>
          @include('layouts.modals.add-route')
          @include('layouts.modals.add-requested-by')
          @include('layouts.modals.add-shipping')
          <div class="vehicle-modal">
          @include('layouts.modals.add-vehicle', array('vehicle_info' => ''))
          </div>
          @include('layouts.modals.add-driver')
          {{setJs(['trip/index', 'trip/waybill'])}}
<script>
    let n = 0;
    $(document).on('click', '[data-additional-row]', function (e){
        e.preventDefault();
        n++;
        let row = `<div class="row pt-3 delete" id="row_${n}">
                       <div class="col-6">
                                <select class="form-control basic-single" wire:model="labor" data-labor data-select>
                                    <option value="" selected="selected">Select Labor Type</option>
                                    <?php
                                        $labor = getLaborType();
                                        foreach ($labor as $key => $va) {?>
                                        <option value="<?php echo $va->id; ?>">
                                        <?php echo $va->name;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-5">
                                <input wire:model="labor_qty" id="labor_qty" class="form-control" type="number" placeholder="" value="">
                            </div>
                        <div class="col-1">
                            <a href="#" data-delete-row><img src="${baseurl}assets/img/minus.png"></a>
                        </div>
                    </div>`;
        $("[data-additional-set]").append(row);
        $(`#row_${n}`).find(".basic-single").select2();
    });

    $(document).on('click', '#trip_loading', function (e){
        e.preventDefault();
        $('#location_type').val(1);
    })

    $(document).on('click', '#trip_delivery', function (e){
        e.preventDefault();
        $('#location_type').val(2);
    })
</script>