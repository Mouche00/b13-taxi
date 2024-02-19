<x-layout class="bg-[url('{{ asset('/images/parchment.jpg') }}')] bg-cover bg-norepeat">
    <x-dashboard.navbar role="passenger" />
    <div class="flex">
        <x-dashboard.sidebar role="passenger" />

        <div class="pb-8 pr-12 mx-2 w-[70%] lg:w-[50%] md:ml-12">
            <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                <h1 class="font-black text-white text-xl bg-black p-4 text-center">Route History</h1>
                @if (!$reservations->isEmpty())
                    @foreach ($reservations as $reservation)
                        <form action="" method="GET" class="p-4 pt-12 relative">

                            <input type="hidden" name="departure" id="departure" value="{{ $reservation->route->route->departure }}">
                            <input type="hidden" name="destination" id="destination" value="{{ $reservation->route->route->destination }}">
                            <input type="hidden" name="date" id="date" value="{{ $reservation->route->date }}">

                            <div class="flex flex-col md:flex-row items-center gap-2">
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
