<button {{ $attributes->merge(['type' => 'submit', 'class' => 'button bg-red-600 text-white hover:bg-red-500 focus:ring-red-500 active:bg-red-700']) }}>
    {{ $slot }}
</button>
