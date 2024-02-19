<button type="submit" {{ $attributes->merge(['class' => "px-8 py-4 bg-black rounded text-white mt-10"]) }}>
    {{ $slot }}
</button>
