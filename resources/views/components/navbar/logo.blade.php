@props(['path', 'width'])

<img width="{{ $width ?? '100px' }}" src="{{ asset($path) }}" alt="">
