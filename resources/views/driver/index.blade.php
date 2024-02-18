<x-layout class="bg-[url('{{ asset('/images/parchment.jpg') }}')] bg-cover bg-norepeat">
        <x-dashboard.navbar role="driver" />
        <div class="flex">
            <x-dashboard.sidebar role="driver" />

            <main class="relative flex w-full">
                <div class="pb-8 pr-12 w-[65%]">
                    <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                        <h1 class="font-black text-white text-xl bg-black p-4 text-center">Selected Route</h1>
                        <form action="/route/add" method="POST" class="p-4 pt-8 relative">
                            @if(auth()->user()->driver()->first()->available != 1)
                                @csrf
                            @endif

                            <div class="flex items-center gap-2">
                                <div class="flex flex-col items-center p-2">
                                    <img width="150px" src="{{ asset('/images/ship.png') }}" alt="">
                                    <select name="departure" id="departure" class="m-2 p-2 rounded w-48  text-sm">
                                        @foreach($cities as $city)
                                            @php
                                                $city->ville = preg_replace('/[^A-Za-z0-9 \-]/', '', $city->ville);
                                                $id = strtolower(str_replace(' ', '-', $city->ville));
                                            @endphp
                                            <option value="{{ $city->ville }}" id="{{ $id }}" {{ $currentRoute ? ($city->ville == $currentRoute->departure ? 'selected' : '') :  ''}} {{ auth()->user()->driver()->first()->available != 1 ? 'disabled' : '' }}>{{ ucwords($city->ville) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-dashboard.route-line />
                                <div class="flex flex-col items-center m-4">
                                    <img width="150px" src="{{ asset('/images/ship.png') }}" alt="">
                                    <select name="destination" id="destination" class="m-2 p-2 rounded w-48 text-sm">
                                        @foreach($cities as $city)
                                            @php
                                                $city->ville = preg_replace('/[^A-Za-z0-9 \-]/', '', $city->ville);
                                                $id = strtolower(str_replace(' ', '-', $city->ville));
                                            @endphp
                                            @if ($loop->first)
                                                <option value="{{ $city->ville }}" id="{{ $id }}" {{ $currentRoute ? ($city->ville == $currentRoute->destination ? 'selected' : 'class=hidden') : 'class=hidden'}} {{ auth()->user()->driver()->first()->available != 1 ? 'disabled' : '' }}>{{ ucwords($city->ville) }}</option>
                                            @elseif ($loop->iteration == 2)
                                                <option value="{{ $city->ville }}" id="{{ $id }}" {{ $currentRoute ? ($city->ville == $currentRoute->destination ? 'selected' : '') : 'selected' }} {{ auth()->user()->driver()->first()->available != 1 ? 'disabled' : '' }}>{{ ucwords($city->ville) }}</option>
                                            @else
                                                <option value="{{ $city->ville }}" id="{{ $id }}" {{ $currentRoute ? ($city->ville == $currentRoute->destination ? 'selected' : '') : '' }} {{ auth()->user()->driver()->first()->available != 1 ? 'disabled' : '' }}>{{ ucwords($city->ville) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <x-dashboard.date-input value="{{ Carbon\Carbon::parse($currentRoute->pivot->date)->timezone('Africa/Casablanca')->format('Y-m-d\Th:i:s') ?? now()->timezone('Africa/Casablanca')->format('Y-m-d\Th:i:s') }}"/>

                            @if(auth()->user()->driver()->first()->available == 1)
                                <button type="submit" class="absolute left-[50%] bottom-0 bg-black py-2 px-4 rounded-lg text-white translate-x-[-50%] translate-y-[100%]">{{ $currentRoute ? 'Change' : 'Select' }}</button>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="pb-8 pr-12 w-[35%]">
                    <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                        <h1 class="font-black text-white text-xl bg-black p-4 text-center">Route History</h1>
                        @if (!$routes->isEmpty())
                            @foreach ($routes as $route)
                                <form action="/route/add" method="POST" class="p-4 pt-12 relative">
                                    @csrf

                                    <input type="hidden" name="departure" id="departure" value="{{ $route->departure }}" class="text-xs text-center">
                                    <input type="hidden" name="destination" id="destination" value="{{ $route->destination }}" class="text-xs text-center">
                                    <div class="flex items-center gap-2">
                                        <div class="flex flex-col items-center p-2">
                                            <img width="150px" src="{{ asset('/images/ship.png') }}" alt="">
                                            <p class="text-xs text-center"> {{ $route->departure }} </p>
                                        </div>
                                        <x-dashboard.route-line />
                                        <div class="flex flex-col items-center m-2">
                                            <img width="150px" src="{{ asset('/images/ship.png') }}" alt="">
                                            <p class="text-xs text-center"> {{ $route->destination }} </p>
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
            </main>
        </div>    
    </div>
</x-layout>
