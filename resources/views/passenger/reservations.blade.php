<x-layout class="bg-[url('{{ asset('/images/parchment.jpg') }}')] bg-cover bg-norepeat">
    <x-dashboard.navbar role="passenger" />
    <div class="flex">
        <x-dashboard.sidebar role="passenger" />

        <main class="relative w-full">
            <div class="pb-8 pr-12 my-3 ml-2">
                <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                    <h1 class="font-black text-white text-xl bg-black p-4 text-center">Reservations</h1>
                    @if (!$reservations->isEmpty())
                        @foreach ($reservations as $reservation)
                            <div class="relative border-2 border-dashed border-black m-4 rounded-lg flex items-center mb-32">
                                @if(!$reservation->favorited && $favorites->map(fn($item) => $item->route)->map(fn($item) => $item->route)->where('departure', $reservation->route->route->departure)->where('destination', $reservation->route->route->destination)->isEmpty())
                                    <div class="relative flex text-white h-64 w-32 items-center justify-between border-r-2 border-dashed border-black bg-[url('http://127.0.0.1:8003/images/parchment.jpg')] bg-cover">
                                        <form method="POST" action="/reservation/{{ $reservation->id }}/update" class="m-0 flex justify-center items-center absolute top-0 left-[50%] translate-x-[-50%] h-full">
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
                                        <p class="text-xs text-center"> {{ $reservation->route->route->departure }} </p>
                                    </div>
                                    <x-dashboard.route-line />
                                    <div class="flex flex-col items-center m-2">
                                        <img width="150px" src="{{ asset('/images/castle.png') }}" alt="">
                                        <p class="text-xs text-center"> {{ $reservation->route->route->destination }} </p>
                                    </div>
                                </div>
                                
                                @if (now()->timezone('Africa/Casablanca')->addHour()->toDateTimeString() < Carbon\Carbon::parse($reservation->route->date)->toDateTimeString())
                                    <div class="relative flex text-white h-64 w-16 items-center justify-between">
                                        <form method="POST" action="/reservation/{{ $reservation->id }}/delete" class="m-0 flex justify-center items-center absolute top-0 right-0 h-full border-l-2 border-dashed border-black">
                                            @csrf
                                            @method('DELETE')

                                            <button class="p-4 rounded bg-black h-full" type="submit">
                                                <img width="25px" src="{{ asset('images/x-icon-white.png') }}" alt="">
                                            </button>

                                        </form>
                                    </div>
                                @endif
                                
                                @if($reservation->review == null)
                                    <form method="POST" action="/review/add" class="m-0 flex justify-center items-center absolute bottom-0 left-[50%] translate-x-[-50%] translate-y-[50%] border-2 border-black border-dashed rounded-lg bg-white p-4 pt-12">
                                        @csrf

                                        <img width="100px" src="{{ asset('/images/star.png') }}" alt="" class="absolute top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">

                                        <input type="hidden" name="reservation_id" id="reservation_id" value="{{ $reservation->id }}">

                                        @for ($i = 1; $i <= 5; $i++)
                                            <input type="submit" name="rating" id="rating" value="{{ $i }}" class="mx-2 text-white py-2 px-4 bg-black rounded border-2 border-solid border-black transition ease-in-out delay-150 hover:bg-white hover:text-black">
                                        @endfor
                                        

                                    </form>
                                @else
                                    <div class="m-0 flex justify-center items-center absolute bottom-0 left-[50%] translate-x-[-50%] translate-y-[50%] border-2 border-black border-dashed rounded-lg bg-white p-4 pt-12">

                                        <img width="100px" src="{{ asset('/images/star.png') }}" alt="" class="absolute top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">

                                        @for ($i = 1; $i <= 5; $i++)
                                            <p class="mx-2 {{ $reservation->review->rating == $i ? 'text-black' : 'text-gray-200' }} py-2 px-4">{{ $i }}</p>
                                        @endfor
                                        

                                    </div> 
                                @endif

                                <div class="absolute flex flex-col items-center justify-center bg-white rounded-lg border-2 border-black border-dashed left-[33%] translate-x-[-50%] p-4 space-y-8 top-[50%] translate-y-[-50%]">
                                    <img width="75px" src="{{ asset('/images/clock.png') }}" alt="" class="absolute top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">
                                    <p class="text-sm border-black p-2 rounded mt-8 min-w-32 text-center">{{ $reservation->route->date }}</p>
                                </div>

                                <div class="absolute flex flex-col items-center justify-center bg-white rounded-lg border-2 border-black border-dashed left-[66%] translate-x-[-50%] p-4 space-y-8 top-[50%] translate-y-[-50%]">
                                    <img width="100px" src="{{ asset('/images/ship.png') }}" alt="" class="absolute bg-white top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">
                                    <p class="text-sm border-black p-2 rounded mt-8 min-w-32 text-center">{{ $reservation->route->driver->user()->first()->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h1 class="p-4 text-center text-sm">Nothing here yet.</h1>
                    @endif
                </div>
            </div>        
        </main>
</x-layout>
