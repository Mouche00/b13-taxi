@props(['role'])

<aside class="pb-8 px-12">
    <div class="bg-black w-64 border-white border-4 border-dashed rounded-xl text-white font-black text-xl">
        <div class="p-4 rounded-lg flex flex-col space-y-4 m-1">
            <a href="/{{ $role }}/dashboard">Overview</a>
            <a href="/{{ $role }}/routes">Routes</a>
            <a href="/{{ $role }}/reservations">Reservations</a>
        </div>
    </div>
</aside>
