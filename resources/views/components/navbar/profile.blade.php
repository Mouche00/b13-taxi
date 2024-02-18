@props(['role'])

<div  {{ $attributes->merge(['class' => '']) }}>
    <div class="flex gap-2 items-center">
        <div class="flex flex-col">
            <h1 class="text-xl font-extrabold drop-shadow-[0_2px_2px_rgb(255,255,255)]">{{ ucwords(auth()->user()->name) }}</h1>
            <em class="font-italic text-white drop-shadow-[0_2px_2px_rgb(0,0,0)]">{{ ucwords($role) }}</em>
        </div>
        <div class="relative">
            <img id="profile-picture" width="75px" src="{{ asset('/storage/' . auth()->user()->picture) }}" alt="" class="rounded-full overflow-hidden border-2 border-black">
            <div id="profile-menu" class="bg-gray-200 p-4 rounded-lg flex flex-col space-y-2 absolute hidden m-1 z-50 left-0 translate-x-[-50%]">
                <a href="/{{ $role }}/dashboard">Dashboard</a>
                <a href="/logout">Logout</a>
            </div>
        </div>
    </div>

    
</div>
