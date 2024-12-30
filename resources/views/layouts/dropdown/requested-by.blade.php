<select class="form-control" wire:model="request_by" id="request_by" data-select required>
    <option value="" selected="selected">Select Option</option>
    @php
    $trip_request = tripRequested();
    @endphp
    @foreach ($trip_request as $key => $s)
        <option value="{{ $s->id }}">
        {{ $s->name }}</option>
    @endforeach
</select>