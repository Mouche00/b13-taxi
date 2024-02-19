@props(['path', 'width'])

<img width="{{ $width ?? '100px' }}" src="{{ asset($path) }}" alt="" {{ $attributes->merge(['class' => 'w-[50px] md:w-[75px]']) }}>
