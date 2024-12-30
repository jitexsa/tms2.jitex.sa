<select class="form-control" wire:model="job_no" id="job_no" data-select required>
    <option value="">Select Option</option>
    @php
    $shipping = getShipping();
    @endphp
    @foreach ($shipping as $key => $s)
        <option value="{{ $s->shipment_reference_number }}">
        {{ $s->shipment_reference_number }}</option>
    @endforeach
</select>