<x-layout class="bg-[url('{{ asset('/images/parchment.jpg') }}')] bg-contain md:bg-cover bg-norepeat">
    <x-dashboard.navbar role="driver" />
    <div class="flex">
        <x-dashboard.sidebar class="ml-12" role="driver" />

        <main class="relative w-full">
            <div class="pb-8 md:px-12 lg:pr-12 my-3 ml-2">
                <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                    <h1 class="font-black text-white text-xl bg-black p-4 text-center">Reservations</h1>
                    @if (!$reservations->isEmpty())
                        @foreach ($reservations as $reservation)
                        @if($reservation->route->driver->id == auth()->user()->driver()->first()->id)
                            <div class="relative border-2 border-dashed border-black m-4 rounded-lg flex flex-col md:flex-row items-center mb-32">

                                <div class="flex items-center gap-2 p-4 pt-12 w-full flex-col md:flex-row">
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

                                <div class="hidden lg:block absolute flex flex-col items-center justify-center bg-white rounded-lg border-2 border-black border-dashed left-[33%] translate-x-[-50%] p-4 space-y-8 top-[50%] translate-y-[-50%]">
                                    <img width="75px" src="{{ asset('/images/clock.png') }}" alt="" class="absolute top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">
                                    <p class="text-sm border-black p-2 rounded mt-8 min-w-32 text-center">{{ $reservation->route->date }}</p>
                                </div>

                                <div class="absolute flex flex-col items-center justify-center bg-white rounded-lg border-2 border-black border-dashed left-[50%] lg:left-[66%] translate-x-[-50%] p-4 space-y-4 lg:space-y-8 top-[50%] translate-y-[-50%]">
                                    <img width="100px" src="{{ asset('/images/ship.png') }}" alt="" class="absolute bg-white top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">
                                    <p class="text-sm border-black p-2 rounded mt-8 min-w-32 text-center">{{ $reservation->passenger->user()->first()->name }}</p>
                                    <p class="text-sm lg:hidden border-black p-2 rounded min-w-32 text-center">{{ $reservation->route->date }}</p>
                                </div>
                            </div>
                        @endif
                        @endforeach
                    @else
                        <h1 class="p-4 text-center text-sm">Nothing here yet.</h1>
                    @endif
                </div>
            </div>        
        </main>
</x-layout>
