<x-layout class="bg-[url('{{ asset('/images/parchment.jpg') }}')] bg-cover bg-norepeat">
        <x-dashboard.navbar role="admin" />
        <div class="flex">
            <x-dashboard.sidebar role="admin" />

            <main class="relative flex flex-col md:pl-12 lg:pl-0 lg:flex-row w-full">
                <div class="pb-8 pr-12 md:w-[50%] mx-auto md:mx-0">
                    <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                        <h1 class="font-black text-white text-xl bg-black p-4 text-center">Statistics</h1>
                        <div class="flex flex-col md:flex-row justify-evenly p-4 gap-4">
                            <div class="border-2 border-dashed border-black rounded-lg">
                                <h1 class="font-black text-white text-xl bg-black p-4 text-center">Drivers</h1>
                                    <p class="p-4">All: {{ $drivers['all'] }}</p>
                                    <p class="p-4">Deleted: {{ $drivers['deleted'] }}</p>
                                    <p class="p-4">Available: {{ $drivers['available'] }}</p>
                                    <p class="p-4">Unavailable: {{ $drivers['unavailable'] }}</p>
                            </div>

                            <div class="border-2 border-dashed border-black rounded-lg">
                                <h1 class="font-black text-white text-xl bg-black p-4 text-center">Passengers</h1>
                                    <p class="p-4">All: {{ $passengers['all'] }}</p>
                                    <p class="p-4">Deleted: {{ $passengers['deleted'] }}</p>
                            </div>

                            <div class="border-2 border-dashed border-black rounded-lg">
                                <h1 class="font-black text-white text-xl bg-black p-4 text-center">Reservations</h1>
                                    <p class="p-4">All: {{ $reservations['all'] }}</p>
                                    <p class="p-4">Deleted: {{ $reservations['deleted'] }}</p>
                                    <p class="p-4">Reviewed: {{ $reservations['reviewed'] }}</p>
                                    <p class="p-4">Favorited: {{ $reservations['favorited'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>    
    </div>
</x-layout>
