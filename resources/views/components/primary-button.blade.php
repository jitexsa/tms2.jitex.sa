<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-block w-100']) }}>
    {{ $slot }}
</button>
