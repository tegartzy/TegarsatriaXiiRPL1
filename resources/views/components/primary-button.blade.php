<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2', 'style' => 'background-color: #34C759; color: #fff;']) }}>
    {{ $slot }}
</button>