@props(['role'])

<div  {{ $attributes->merge(['class' => '']) }}>
    <div class="flex gap-2 items-center">
        <div class="flex flex-col">
            <h1 class="text-sm md:text-xl font-extrabold drop-shadow-[0_2px_2px_rgb(255,255,255)]">{{ ucwords(auth()->user()->name) }}</h1>
            <em class="text-sm md:text-m font-italic text-white drop-shadow-[0_2px_2px_rgb(0,0,0)]">{{ ucwords($role) }}</em>
        </div>
        <div class="relative">
            <img id="profile-picture" src="{{ asset('/storage/' . auth()->user()->picture) }}" alt="" class="w-[50px] md:w-[75px] rounded-full overflow-hidden border-2 border-black">
            <div id="profile-menu" class="bg-gray-200 p-4 rounded-lg flex flex-col space-y-2 absolute hidden m-1 z-50 left-0 translate-x-[-50%]">
                <a href="/{{ $role }}/dashboard">Dashboard</a>
                <a class="lg:hidden" href="/{{ $role }}/dashboard">Overview</a>
                @if($role != 'admin')
                    <a class="lg:hidden" href="/{{ $role }}/routes">Routes</a>
                @endif
                <a class="lg:hidden" href="/{{ $role }}/reservations">Reservations</a>
                @if($role == 'admin')
                    <a class="lg:hidden" href="/{{ $role }}/users">Users</a>
                @endif
                <a href="/logout">Logout</a>
            </div>

            @if($role == 'driver')
                <form action="/driver/{{ auth()->user()->driver()->first()->id }}/edit" method="POST" class="absolute top-0 right-0 translate-y-[-75%] translate-x-[35%]">
                    @csrf
                    @method('PATCH')
                
                    <button type="submit">
                        <span class="inline-block text-9xl {{ auth()->user()->driver()->first()->available ? "text-green-400" : "text-red-400" }}">.</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

    
</div>
