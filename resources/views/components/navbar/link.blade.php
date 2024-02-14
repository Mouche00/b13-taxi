@props(['name'])

<a {{ $attributes->merge(['class' => 'font-black py-4 px-8 text-lg']) }}>{{ ucwords($name) }}</a>
