@props(['role'])

<nav class="pb-8 md:py-8 md:px-12">
    <div class="bg-transparent border-black border-4 border-dashed rounded-xl">
        <div class="w-[85%] m-auto flex justify-between items-center py-4">
            <div class="flex items-center gap-4">
                <x-navbar.logo path="/images/logo-wheel.png" />
                <x-navbar.logo class="hidden md:block" path="/images/logo-name.png" />
            </div>

            <x-navbar.profile role="{{ $role }}" class="text-black"/>
        </div>
    </div>
</nav>
