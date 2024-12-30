<select class="form-control" wire:model="{{ $name }}" id="{{ $name }}" data-select required>
    <option value="" selected="selected">Select Option</option>
    @php
    $routelist = routeList();
    @endphp
    @foreach ($routelist as $val)
        <option value="{{ $val->id }}">{{ $val->location }}</option>
    @endforeach
</select>