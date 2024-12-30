<div id="add-vehicle" class="modal fade bd-example-modal-lg" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <strong>Add Vehicle</strong>
                <button type="button" class="btn-close py-0" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="message"></div>
                <form action="{{baseURL('ajax/add-vehicle')}}" method="post" id="vehicle-form" class="row g-3 needs-validation custom-input">
                <input name="id" type="hidden" value="{{ ($vehicle_info)?$vehicle_info->id:''}}" />
                <x-text-input name="licence_plate_no" id="licence_plate_no" type="hidden" />
                <div class="col-6">   
                    <div class="col-12">
                        <label for="plate_no" class="col-form-label">License Plate No <i class="text-danger">*</i></label>
                        <div class="row">
                        <div class="col-6">
                            <input name="plate_no" required class="form-control" type="text"
                                   placeholder="No" id="plate_no" value="{{ ($vehicle_info)?$vehicle_info->plate_no:'' }}" number {{ ($vehicle_info)?'readonly':'' }}>
                        </div>
                        <div class="col-6">
                            <input name="plate_alphabet" required class="form-control" type="text"
                                   placeholder="Alphabet" id="plate_alphabet" value="{{ ($vehicle_info)?$vehicle_info->plate_alphabet:'' }}" {{ ($vehicle_info)?'readonly':'' }}>
                        </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="subcontractor" class="col-form-label">Subcontractor <i class="text-danger">*</i></label>
                            <select class="form-control" name="subcontractor" id="subcontractor" required>
                                <option value="" selected="selected">Subcontractor</option>
                                @php
                                $get_subcontractor = subContractor();
                                @endphp
                                @foreach ($get_subcontractor as $r)
                                    <option value="{{ $r->id }}" {{getSelected($r->id, ($vehicle_info)?$vehicle_info->subcontractor:'') }}> {{ $r->transporter_name }}</option>
                               @endforeach
                            </select>
                    </div>
                    <div class="col-12">
                        <label for="service_start_date" class="col-form-label">Service Start Date <i class="text-danger">*</i> </label>
                            <input name="service_start_date"  class="form-control" data-datepicker type="text"
                                   placeholder="Service Start Date" id="service_start_date" required value="{{ ($vehicle_info)?dateFormat($vehicle_info->service_start_date, 'shortdate'):'' }}">
                    </div>
                    <div class="col-12">
                        <label for="truck_image" class="col-form-label">Truck Picture </label>
                            <input type="file" accept="image/*" name="truck_image" id="truck_image" class="form-control">
                            @if($vehicle_info and $vehicle_info->truck_image)
                                <img src="{{ baseURL($vehicle_info->truck_image) }}" width="100">
                           @endif
                    </div>
                </div>
                <div class="col-6">  
                    <div class="col-12">
                            <label for="vehicle_type" class="col-form-label">Vehicle Type <i class="text-danger">*</i></label>
                            <select class="form-control" required="" name="vehicle_type" id="vehicle_type" data-select>
                                <option value="" selected="selected">Select Vehicle Type</option>
                               @php
                                $get_vehicle_type  = getVehicleType();
                                @endphp
                                @foreach ($get_vehicle_type as $type)
                                    <option value="{{ $type->id}}" {{ getSelected($type->id, ($vehicle_info)?$vehicle_info->vehicle_type:'') }}>{{ $type->type_name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-12">
                            <label for="division" class="col-form-label">Division <i class="text-danger">*</i></label>
                            <select class="form-control" name="division" id="division" required>
                                <option value="" selected="selected">Select Division</option>
                                @php
                                $get_division = getDivision();
                                @endphp
                                @foreach ($get_division as $r) 
                                    <option value="{{ $r->id }}" {{ getSelected($r->id, ($vehicle_info)?$vehicle_info->division:'') }}>
                                        {{ $r->division_name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-12">
                        <label for="driver" class="col-form-label">Driver <i class="text-danger">*</i></label>
                        <div class="row">
                            <div class="col-11 load-driver">
                                @include('layouts.dropdown.driver', array('vehicle_info' => $vehicle_info))
                            </div>
                            <div class="col-1 pt-2">
                                <a href="#" data-bs-target="#add_driver" data-bs-toggle="modal">
                                    <img src="{{ baseURL('assets/images/plus.png') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-right mt-2">
                        <label class="col-form-label"></label>
                        <button type="submit" class="btn btn-success w-md m-b-5">{{ ($vehicle_info)?'Update':'Add' }}</button>
                    </div>
                </div>
                 </form>
            </div>
        </div>
</div>
</div>