<button {{ $attributes->merge(['class' => 'text-white bg-black hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2']) }}>
    {{ $slot }}
</button>
