<select class="form-control" name="driver_id" wire:model="driver_id" id="driver_id" data-select required>

    <option value="" selected="selected">Select Driver</option>
    @php
    $get_driver = getDriver(Auth::user()->workspace_id);
    @endphp
    @foreach ($get_driver as $val)
        <option value="{{  $val->id }}" data-license="{{  $val->license_number }}"
                data-mobile="{{  $val->mobile }}"  {{ getSelected($val->id, (isset($vehicle_info) and !empty($vehicle_info))?$vehicle_info->driver_id:'') }}>  {{  $val->driver_name }} </option>
   @endforeach
</select>