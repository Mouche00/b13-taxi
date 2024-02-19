@props(['role'])

<aside class="pb-8 pr-12 hidden lg:block ml-12 my-3">
    <div class="bg-black w-64 border-white border-4 border-dashed rounded-xl text-white font-black text-xl">
        <div class="p-4 rounded-lg flex flex-col space-y-4 m-1">
            <a href="/{{ $role }}/dashboard">Overview</a>
            @if($role != 'admin')
                <a href="/{{ $role }}/routes">Routes</a>
            @endif
            <a href="/{{ $role }}/reservations">Reservations</a>
            @if($role == 'admin')
                <a href="/{{ $role }}/users">Users</a>
            @endif
        </div>
    </div>
</aside>
