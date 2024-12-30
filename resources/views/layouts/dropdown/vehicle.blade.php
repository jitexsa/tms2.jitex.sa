<select class="form-control" wire:model="vehicle" id="vehicle" data-select required>
    <option value="" selected="selected">Select Vehicle</option>
    @php
    $get_vehicle = getVehicle(Auth::user()->workspace_id, isset($skip)?$skip:false, isset($vehicle)?$vehicle:'');
    @endphp
    @foreach ($get_vehicle as $val)
        <option value="{{ $val['id'] }}"  data-vehicle_type="{{ $val['type_name'] }}"
                data-vehicle_registration="{{ $val['vehicle_registration'] }}"
                data-vehicle-image="{{ $val['truck_sketch'] }}"
                data-driver-id ="{{ $val['driverid'] }}"
                data-driver-name="{{ $val['driver_name'] }}"
                data-license-no="{{ $val['license_number'] }}"
                data-mobile="{{ $val['mobile'] }}">
        {{ $val['licence_plate_no'] }}</option>
        @endforeach
    @endphp
</select>