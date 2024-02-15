@props(['role'])

<div  {{ $attributes->merge(['class' => 'relative']) }}>
    <div class="flex gap-2 items-center">
        <div class="flex flex-col">
            <h1 class="text-xl font-extrabold">{{ ucwords(auth()->user()->name) }}</h1>
            <em class="font-italic">{{ ucwords($role) }}</em>
        </div>
        <img id="profile-picture" width="75px" src="{{ asset('/storage/' . auth()->user()->picture) }}" alt="" class="rounded-full overflow-hidden border-2 border-black">
    </div>

    <div id="profile-menu" class="bg-gray-200 p-4 rounded-lg flex flex-col space-y-2 absolute hidden m-1 z-50">
        <a href="/{{ $role }}/dashboard">Dashboard</a>
        <a href="/logout">Logout</a>
    </div>
</div>
