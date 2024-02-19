<x-form.input name="name" required />
<x-form.input name="email" type="email" required />
<x-form.input name="password" type="password" autocomplete="new-password" required />

<div class="mt-8 mb-16">
    <x-form.label name="picture" />
    <div id="picture-wrapper" class="w-full h-full my-4 border-2 border-dashed border-black flex justify-center items-center relative">
        <input name="picture" id="picture" type="file" class="absolute w-full h-full outline-none opacity-0">
        <p class="text-xs">Click to upload your picture</p>
    </div>
</div>
