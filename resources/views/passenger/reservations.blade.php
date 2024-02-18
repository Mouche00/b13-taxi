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
                            <div class="relative border-2 border-dashed border-black m-4 rounded-lg flex items-center">

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

                                <div class="flex flex-col text-white bg-black h-64 items-center justify-between">
                                        <form method="POST" action="/reservations/{{ $reservation->id }}/delete" class="bg-black w-full h-[50%] m-0 flex justify-center items-center p-4 hover:bg-whit hover:bg-white hover:text-blac hover:text-black eas delay-15 transition ease-in-out delay-150 border-da border-dashe border-l-2 border-dashed hover:border-black border-b-2">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit">Delete</button>

                                        </form>
                                        <form method="POST" action="/reservations/{{ $reservation->id }}/favorite" class="bg-black w-full h-[50%] m-0 flex justify-center items-center p-4 hover:bg-whit hover:bg-white hover:text-blac hover:text-black eas delay-15 transition ease-in-out delay-150 border-da border-dashe border-l-2 border-dashed hover:border-black border-t-2">
                                            @csrf
                                            @method('PATCH')

                                            <button type="submit">Favorite</button>

                                        </form>
                                    </div>

                                <div class="absolute flex flex-col items-center justify-center bg-white rounded-lg border-2 border-black border-dashed left-[33%] translate-x-[-50%] p-4 space-y-12 top-[50%] translate-y-[-50%]">
                                    <img width="100px" src="{{ asset('/images/clock.png') }}" alt="" class="absolute top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">
                                    <p class="bg-gray-200 text-sm border-black p-2 rounded mt-8 min-w-32 text-center">{{ $reservation->route->date }}</p>
                                </div>

                                <div class="absolute flex flex-col items-center justify-center bg-white rounded-lg border-2 border-black border-dashed left-[66%] translate-x-[-50%] p-4 space-y-12 top-[50%] translate-y-[-50%]">
                                    <img width="125px" src="{{ asset('/images/ship.png') }}" alt="" class="absolute bg-white top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">
                                    <p class="bg-gray-200 text-sm border-black p-2 rounded mt-8 min-w-32 text-center">{{ $reservation->route->driver->user()->first()->name }}</p>
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
