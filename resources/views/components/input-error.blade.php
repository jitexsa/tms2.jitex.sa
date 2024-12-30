@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm space-y-1']) }} data-error>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
