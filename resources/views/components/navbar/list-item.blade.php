@props(['name', 'link', 'class'])

<li>
    <x-navbar.link class="{{ $class ?? 'bg-white border-b-4 border-black text-black' }}" href="{{ $link }}" name="{{ $name }}" />
</li>
