<x-layout class="bg-[url('{{ asset('/images/parchment.jpg') }}')] bg-cover bg-norepeat">
    <x-dashboard.navbar role="passenger" />
    <div class="flex md:flex-col lg:flex-row">
        <x-dashboard.sidebar role="passenger" />

        <main class="relative lg:w-[60%] md:mx-12 lg:mx-0">
            @if($currentReservation == null)
                <div class="border-2 border-black border-dashed rounded-lg lg:mr-4">
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


                                <x-dashboard.date-input role="passenger" />

                                <button type="submit" class="absolute left-[50%] bottom-0 bg-black py-2 px-4 rounded-lg text-white translate-x-[-50%] translate-y-[100%]">Search</button>
                            </form>
                        </div>
                    </div>
                    @if (request(['departure']) && !$drivers->isEmpty())
                        <div class="m-2 mt-8 w-fit">
                            <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                                <h1 class="font-black text-white text-xl bg-black p-4 text-center">Select Driver(s)</h1>
                                <div class="grid grid-cols-2" style="grid-template-columns: 1fr max-content;">
                                    @foreach ($drivers as $driver)
                                        <form action="/reservation/add" method="POST" class="relative flex justify-center hover:bg-black m-4 rounded-lg hover:text-white transition ease-in-out delay-150 border-2 border-black border-dashed p-4">
                                            @csrf

                                            <input type="hidden" name="date" id="date" value="{{ request(['date'])['date'] }}"> 
                                            <input type="hidden" name="route_id" id="route_id" value="{{ $driver->currentRoute->first()->pivot->id }}">

                                            <div class="flex items-center gap-2">
                                                <div class="flex flex-col items-center gap-2 border-r-2 border-black border-dashed pr-2">
                                                    <img width="150px" src="{{ asset('/images/ship.png') }}" alt="">
                                                    <p class="text-sm col-span-2"> {{ $driver->user()->first()->name }} </p>
                                                </div>
                                                <div class="grid grid-cols-3 items-center p-2  h-full">
                                                    <!-- <p class="text-sm">Name:</p> -->

                                                    <img width="50px" src="{{ asset('/images/star.png') }}" alt="">
                                                    

                                                    <div class="text-xs col-span-2 mx-2 text-center flex">
                                                        @if ($ratings->where('id', $driver->id)->isEmpty())
                                                            <p>Unrated</p>
                                                        @else
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <p class=" {{ $ratings->where('id', $driver->id)->avg('rating') == $i ? 'text-white bg-black' : 'text-black' }} p-2 rounded">{{ $i }}</p>
                                                            @endfor
                                                        @endif
                                                    </div>

                                                    <img width="50px" src="{{ asset('/images/clock.png') }}" alt="">
                                                    <p class="text-xs col-span-2 max-w-64 bg-gray-200 text-black p-2 rounded">{{ $driver->currentRoute->first()->pivot->date }}</p>
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
            @else
                <div class=" border-4 border-dashed border-black m-4 rounded-lg flex items-center mb-32 bg-white flex-col">
                    <h1 class="font-black text-white text-xl bg-black p-4 text-center w-full">Current Reservation</h1>
                    <div class="relative w-full mt-4 pb-8">
                        @if(!$currentReservation->favorited && $favorites->map(fn($item) => $item->route)->map(fn($item) => $item->route)->where('departure', $currentReservation->route->route->departure)->where('destination', $currentReservation->route->route->destination)->isEmpty())
                            <div class="relative flex text-white h-64 w-32 items-center justify-between border-r-2 border-dashed border-black bg-[url('http://127.0.0.1:8003/images/parchment.jpg')] bg-cover">
                                <form method="POST" action="/reservation/{{ $currentReservation->id }}/update" class="m-0 flex justify-center items-center absolute top-0 left-[50%] translate-x-[-50%] h-full">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit">
                                        <img src="{{ asset('images/bookmark-bw.png') }}" alt="">
                                    </button>

                                </form>
                            </div>
                        @endif

                        <div class="flex items-center gap-2 p-4 pt-12 w-full">
                            <div class="flex flex-col items-center p-2">
                                <img width="150px" src="{{ asset('/images/castle.png') }}" alt="">
                                <p class="text-xs text-center"> {{ $currentReservation->route->route->departure }} </p>
                            </div>
                            <x-dashboard.route-line />
                            <div class="flex flex-col items-center m-2">
                                <img width="150px" src="{{ asset('/images/castle.png') }}" alt="">
                                <p class="text-xs text-center"> {{ $currentReservation->route->route->destination }} </p>
                            </div>
                        </div>
                        
                        @if (now()->timezone('Africa/Casablanca')->addHour()->toDateTimeString() < Carbon\Carbon::parse($currentReservation->route->date)->toDateTimeString())
                            <div class="relative flex text-white h-64 w-16 items-center justify-between">
                                <form method="POST" action="/reservation/{{ $currentReservation->id }}/delete" class="m-0 flex justify-center items-center absolute top-0 right-0 h-full border-l-2 border-dashed border-black">
                                    @csrf
                                    @method('DELETE')

                                    <button class="p-4 rounded bg-black h-full" type="submit">
                                        <img width="25px" src="{{ asset('images/x-icon-white.png') }}" alt="">
                                    </button>

                                </form>
                            </div>
                        @endif
                        
                        @if($currentReservation->review == null)
                            <form method="POST" action="/review/add" class="m-0 flex justify-center items-center absolute bottom-0 left-[50%] translate-x-[-50%] translate-y-[50%] border-2 border-black border-dashed rounded-lg bg-white p-4 pt-12">
                                @csrf

                                <img width="100px" src="{{ asset('/images/star.png') }}" alt="" class="absolute top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">

                                <input type="hidden" name="reservation_id" id="reservation_id" value="{{ $currentReservation->id }}">

                                @for ($i = 1; $i <= 5; $i++)
                                    <input type="submit" name="rating" id="rating" value="{{ $i }}" class="mx-2 text-white py-2 px-4 bg-black rounded border-2 border-solid border-black transition ease-in-out delay-150 hover:bg-white hover:text-black">
                                @endfor
                                

                            </form>
                        @else
                            <div class="m-0 flex justify-center items-center absolute bottom-0 left-[50%] translate-x-[-50%] translate-y-[50%] border-2 border-black border-dashed rounded-lg bg-white p-4 pt-12">

                                <img width="100px" src="{{ asset('/images/star.png') }}" alt="" class="absolute top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">

                                @for ($i = 1; $i <= 5; $i++)
                                    <p class="mx-2 {{ $currentReservation->review->rating == $i ? 'text-black' : 'text-gray-200' }} py-2 px-4">{{ $i }}</p>
                                @endfor
                                

                            </div> 
                        @endif

                        <div class="absolute flex flex-col items-center justify-center bg-white rounded-lg border-2 border-black border-dashed left-[33%] translate-x-[-50%] p-4 space-y-8 top-[50%] translate-y-[-50%]">
                            <img width="75px" src="{{ asset('/images/clock.png') }}" alt="" class="absolute top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">
                            <p class="text-sm border-black p-2 rounded mt-8 min-w-32 text-center">{{ $currentReservation->route->date }}</p>
                        </div>

                        <div class="absolute flex flex-col items-center justify-center bg-white rounded-lg border-2 border-black border-dashed left-[66%] translate-x-[-50%] p-4 space-y-8 top-[50%] translate-y-[-50%]">
                            <img width="100px" src="{{ asset('/images/ship.png') }}" alt="" class="absolute bg-white top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">
                            <p class="text-sm border-black p-2 rounded mt-8 min-w-32 text-center">{{ $currentReservation->route->driver->user()->first()->name }}</p>
                        </div>
                    </div>
                </div>
            @endif     
        </main>


        <div class="pb-8 pr-12 md:mt-12 lg:my-3 md:mx-12 lg:mx-2 md:w-[70%] lg:w-[30%]">
            <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                <h1 class="font-black text-white text-xl bg-black p-4 text-center">Favorites</h1>
                @if (!$favorites->isEmpty())
                    @foreach ($favorites as $reservation)
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
</x-layout>
