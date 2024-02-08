@props(['name'])

<div class="flex justify-between items-center my-4 space-y-2 space-x-4">
    @if($name !== 'role')
        <x-form.label name="{{ $name }}"/>
    @endif

    <input  class="border-2 border-black p-2 md:mx-4 rounded"
            name="{{ $name }}"
            id="{{ $name }}"
            {{ $attributes(['value' => old($name)]) }}
    >
</div>

<x-form.error name="{{ $name }}"/>
