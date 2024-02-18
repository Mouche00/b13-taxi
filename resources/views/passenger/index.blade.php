<x-layout class="bg-[url('{{ asset('/images/parchment.jpg') }}')] bg-cover bg-norepeat">
    <x-dashboard.navbar role="passenger" />
    <div class="flex">
        <x-dashboard.sidebar role="passenger" />

        <main class="relative w-full">
            <div class="grid grid-cols-3">
                <div class="col-span-2 row-span-2 border-2 border-black border-dashed rounded-lg">
                    <div class="m-2">
                        <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                            <h1 class="font-black text-white text-xl bg-black p-4 text-center">Search Routes</h1>
                            <form action="" method="GET" class="p-2 pt-4 relative">
                                <div class="flex items-center gap-2">
                                    <div class="flex flex-col items-center p-2">
                                        <img width="150px" src="{{ asset('/images/castle.png') }}" alt="">
                                        <select name="departure" id="departure" class="m-2 p-2 rounded w-48 text-sm">
                                            @foreach($cities as $city)
                                                @php
                                                    $city->ville = preg_replace('/[^A-Za-z0-9 \-]/', '', $city->ville);
                                                    $id = strtolower(str_replace(' ', '-', $city->ville));
                                                @endphp
                                                <option value="{{ $city->ville }}" id="{{ $id }}" {{ request(['departure']) ? (request('departure') == $city->ville ? 'selected' : '' ) : '' }}>{{ ucwords($city->ville) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-dashboard.route-line />
                                    <div class="flex flex-col items-center m-4">
                                        <img width="150px" src="{{ asset('/images/castle.png') }}" alt="">
                                        <select name="destination" id="destination" class="m-2 p-2 rounded w-48 text-sm">
                                            @foreach($cities as $city)
                                                @php
                                                    $city->ville = preg_replace('/[^A-Za-z0-9 \-]/', '', $city->ville);
                                                    $id = strtolower(str_replace(' ', '-', $city->ville));
                                                @endphp
                                                @if ($loop->first)
                                                    <option value="{{ $city->ville }}" id="{{ $id }}" class="hidden" {{ request(['destination']) ? (request(['destination'])['destination'] == $city->ville ? 'selected' : '' ) : 'selected' }}>{{ ucwords($city->ville) }}</option>
                                                @elseif ($loop->iteration == 2)
                                                    <option value="{{ $city->ville }}" id="{{ $id }}" {{ request(['destination']) ? (request('destination') == $city->ville ? 'selected' : '' ) : 'selected' }}>{{ ucwords($city->ville) }}</option>
                                                @else
                                                    <option value="{{ $city->ville }}" id="{{ $id }}" {{ request(['destination']) ? (request('destination') == $city->ville ? 'selected' : '' ) : '' }}>{{ ucwords($city->ville) }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <x-dashboard.date-input />

                                <button type="submit" class="absolute left-[50%] bottom-0 bg-black py-2 px-4 rounded-lg text-white translate-x-[-50%] translate-y-[100%]">Search</button>
                            </form>
                        </div>
                    </div>
                    @if (request(['departure']) && !$drivers->isEmpty())
                        <div class="m-2 mt-8 w-fit">
                            <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                                <h1 class="font-black text-white text-xl bg-black p-4 text-center">Select Driver(s)</h1>
                                <div class="grid grid-cols-4" style="grid-template-columns: 1fr max-content;">
                                    @foreach ($drivers as $driver)
                                        <form action="/reservation/add" method="POST" class="relative flex justify-center hover:bg-black m-4 rounded-lg hover:text-white transition ease-in-out delay-150">
                                            @csrf

                                            <input type="hidden" name="date" id="date" value="{{ request(['date'])['date'] }}"> 
                                            <input type="hidden" name="route_id" id="route_id" value="{{ $driver->currentRoute->first()->pivot->id }}">

                                            <div class="flex items-center gap-2">
                                                <div class="flex flex-col items-center p-2">
                                                    <img width="150px" src="{{ asset('/images/ship.png') }}" alt="">
                                                    <p class="text-sm text-center"> {{ $driver->user()->first()->name }} </p>
                                                </div>
                                            </div>

                                            <button type="submit" class="w-full h-full absolute left-0 top-0 rounded-lg"></button>
                                        </form>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif 
                </div> 
                <div class="pb-8 pr-12 my-3 ml-2">
                    <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                        <h1 class="font-black text-white text-xl bg-black p-4 text-center">Route History</h1>
                        @if (!$reservations->isEmpty())
                            @foreach ($reservations as $reservation)
                                <form action="" method="GET" class="p-4 pt-12 relative">

                                    <input type="hidden" name="departure" id="departure" value="{{ $reservation->route->route->departure }}">
                                    <input type="hidden" name="destination" id="destination" value="{{ $reservation->route->route->destination }}">
                                    <input type="hidden" name="date" id="date" value="{{ $reservation->route->date }}">

                                    <div class="flex items-center gap-2">
                                        <div class="flex flex-col items-center p-2">
                                            <img width="150px" src="{{ asset('/images/castle.png') }}" alt="">
                                            <p class="text-xs text-center"> {{ $reservation->route->route->departure }} </p>
                                        </div>
                                        <x-dashboard.route-line />
                                        <div class="flex flex-col items-center m-2">
                                            <img width="150px" src="{{ asset('/images/castle.png') }}" alt="">
                                            <p class="text-xs text-center"> {{ $reservation->route->route->destination }} </p>
                                        </div>
                                    </div>
                                    <button type="submit" class="w-full h-full absolute left-0 top-0 translate-y-[7%] rounded-lg">
                                        <span class="text-4xl text-white bg-black py-4 px-8 rounded-lg">{{ $loop->iteration }}</span>
                                    </button>
                                </form>
                            @endforeach
                        @else
                            <h1 class="p-4 text-center text-sm">Nothing here yet.</h1>
                        @endif
                    </div>
                </div>
            </div>          
        </main>
</x-layout>
