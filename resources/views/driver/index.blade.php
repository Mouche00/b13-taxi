<x-layout class="bg-[url('{{ asset('/images/parchment.jpg') }}')] bg-cover bg-norepeat">
        <x-dashboard.navbar role="driver" />
        <div class="flex">
            <x-dashboard.sidebar role="driver" />

            <main class="relative flex w-full">
                <div class="pb-8 pr-12">
                    <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                        <h1 class="font-black text-white text-xl bg-black p-4 text-center">Selected Route</h1>
                        <form action="/route/add" method="POST" class="p-4 pt-8 relative">
                            @csrf

                            <div class="flex items-center gap-2">
                                <div class="flex flex-col items-center p-2">
                                    <img width="150px" src="{{ asset('/images/ship.png') }}" alt="">
                                    <select name="departure" id="departure" class="m-2 p-2 rounded w-48">
                                        @foreach($cities as $city)
                                            @php
                                                $city->ville = preg_replace('/[^A-Za-z0-9 \-]/', '', $city->ville);
                                                $id = strtolower(str_replace(' ', '-', $city->ville));
                                            @endphp
                                            @if ($loop->last)
                                                <option value="{{ $city->ville }}" id="{{ $id }}" class="hidden" {{ $city->ville == $routes->first()->departure ? 'selected' : '' }}>{{ ucwords($city->ville) }}</option>
                                            @else
                                                <option value="{{ $city->ville }}" id="{{ $id }}" {{ $city->ville == $routes->first()->departure ? 'selected' : '' }}>{{ ucwords($city->ville) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" w-64 flex items-center">
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
                                    <img width="150px" src="{{ asset('/images/ship.png') }}" alt="">
                                    <select name="destination" id="destination" class="m-2 p-2 rounded w-48">
                                        @foreach($cities as $city)
                                            @php
                                                $city->ville = preg_replace('/[^A-Za-z0-9 \-]/', '', $city->ville);
                                                $id = strtolower(str_replace(' ', '-', $city->ville));
                                            @endphp
                                            @if ($loop->first)
                                                <option value="{{ $city->ville }}" id="{{ $id }}" class="hidden" {{ $city->ville == $routes->first()->destination ? 'selected' : '' }}>{{ ucwords($city->ville) }}</option>
                                            @elseif ($loop->iteration = 2)
                                                <option value="{{ $city->ville }}" id="{{ $id }}" {{ $city->ville == $routes->first()->destination ? 'selected' : '' }}>{{ ucwords($city->ville) }}</option>
                                            @else
                                                <option value="{{ $city->ville }}" id="{{ $id }}" {{ $city->ville == $routes->first()->destination ? 'selected' : '' }}>{{ ucwords($city->ville) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="absolute left-[50%] bottom-0 bg-black py-2 px-4 rounded-lg text-white translate-x-[-50%] translate-y-[100%]">Change</button>
                        </form>
                    </div>
                </div>

                <div class="pb-8 pr-12 w-full">
                    <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                        <h1 class="font-black text-white text-xl bg-black p-4 text-center">Route History</h1>
                        @foreach ($routes as $route)
                            @if (! $loop->first)
                                <form action="/route/add" method="POST" class="p-4 pt-12 relative">
                                    @csrf

                                    <input type="hidden" name="departure" id="departure" value="{{ $route->departure }}" class="text-xs text-center">
                                    <input type="hidden" name="destination" id="destination" value="{{ $route->destination }}" class="text-xs text-center">
                                    <div class="flex items-center gap-2">
                                        <div class="flex flex-col items-center p-2">
                                            <img width="150px" src="{{ asset('/images/ship.png') }}" alt="">
                                            <p class="text-xs text-center"> {{ $route->departure }} </p>
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
                                        <div class="flex flex-col items-center m-2">
                                            <img width="150px" src="{{ asset('/images/ship.png') }}" alt="">
                                            <p class="text-xs text-center"> {{ $route->destination }} </p>
                                        </div>
                                    </div>
                                    <button type="submit" class="w-full h-full absolute left-0 top-0 rounded-lg">
                                        <span class="text-6xl text-white bg-black py-4 px-8 rounded-lg">{{ $loop->iteration -1 }}</span>
                                    </button>
                                </form>
                            @endif
                        @endforeach
                    </div>
                </div>
            </main>
        </div>    
    </div>
</x-layout>
