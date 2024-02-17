<x-layout class="bg-[url('{{ asset('/images/parchment.jpg') }}')] bg-cover bg-norepeat">
    <x-dashboard.navbar role="passenger" />
    <div class="flex">
        <x-dashboard.sidebar role="passenger" />

        <main class="relative w-full">
            <div class="flex">
                <div class="pb-8 pr-12 w-[65%]">
                    <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                        <h1 class="font-black text-white text-xl bg-black p-4 text-center">Add Reservation</h1>
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
                                            <option value="{{ $city->ville }}" id="{{ $id }}">{{ ucwords($city->ville) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="w-full flex items-center">
                                    <div class="relative">
                                        <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                                        <p class="absolute top-0 left-0 text-xs rotate-[-60deg] translate-x-[-15%] translate-y-[-200%] bg-black rounded text-white p-2">Departure</p>
                                    </div>
                                    <span class="inline-block border-b-2 border-black border-dashed w-full"></span>
                                    <div class="relative">
                                        <span class="inline-block w-2 h-2 rounded-full bg-black"></span>
                                        <p class="absolute top-0 left-0 text-xs rotate-[-60deg] translate-x-[-15%] translate-y-[-200%] bg-black rounded text-white p-2">Destination</p>
                                    </div>
                                </div>
                                <div class="flex flex-col items-center m-4">
                                    <img width="150px" src="{{ asset('/images/castle.png') }}" alt="">
                                    <select name="destination" id="destination" class="m-2 p-2 rounded w-48 text-sm">
                                        @foreach($cities as $city)
                                            @php
                                                $city->ville = preg_replace('/[^A-Za-z0-9 \-]/', '', $city->ville);
                                                $id = strtolower(str_replace(' ', '-', $city->ville));
                                            @endphp
                                            @if ($loop->first)
                                                <option value="{{ $city->ville }}" id="{{ $id }}" class="hidden">{{ ucwords($city->ville) }}</option>
                                            @elseif ($loop->iteration == 2)
                                                <option value="{{ $city->ville }}" id="{{ $id }}" selected>{{ ucwords($city->ville) }}</option>
                                            @else
                                                <option value="{{ $city->ville }}" id="{{ $id }}">{{ ucwords($city->ville) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="absolute flex flex-col items-center justify-center bg-white rounded-lg border-2 border-black border-dashed left-[50%] translate-x-[-50%] p-4 space-y-12 top-[50%] translate-y-[-50%]">
                                <img width="100px" src="{{ asset('/images/clock.png') }}" alt="" class="absolute top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">
                                <input type="datetime-local" name="date" id="date" class="bg-gray-200 text-sm border-black p-2 rounded mt-8">
                            </div>

                            <button type="submit" class="absolute left-[50%] bottom-0 bg-black py-2 px-4 rounded-lg text-white translate-x-[-50%] translate-y-[100%]">Search</button>
                        </form>
                    </div>
                </div>
            </div>
            @if (!$drivers->isEmpty())
                <div class="pb-8 pr-12 mt-4 max-w-[65%]">
                    <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                        <h1 class="font-black text-white text-xl bg-black p-4 text-center">Suggested Drivers</h1>
                        <div class="grid grid-cols-4">
                            @foreach ($drivers as $driver)
                                <form action="/reservation/add" method="POST" class="p-4 pt-12 relative">
                                    @csrf

                                    <input type="hidden" name="date" id="date" value="{{ request(['date'])['date'] ?? now()->addHours(2)->toDateTimeString() }}"> 
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
        </main>
</x-layout>
