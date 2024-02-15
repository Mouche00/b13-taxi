<x-layout>
    <x-dashboard.navbar role="passenger" />
    <div class="flex">
        <x-dashboard.sidebar role="passenger" />

        <main class="relative flex w-full">
            <div class="pb-8 pr-12">
                <div class="border-black border-4 border-dashed rounded-xl font-black text-xl">
                    <form action="" method="GET">
                    @csrf

                    <div class="flex items-center gap-2">
                        <div class="flex flex-col items-center p-2">
                            <img width="150px" src="{{ asset('/images/castle.png') }}" alt="">
                            <select name="departure" id="departure" class="m-2 p-2 rounded w-48">
                                @foreach($cities as $city)
                                    @php
                                        $city->ville = preg_replace('/[^A-Za-z0-9 \-]/', '', $city->ville);
                                        $id = strtolower(str_replace(' ', '-', $city->ville));
                                    @endphp
                                    <option value="{{ $city->ville }}" id="{{ $id }}">{{ ucwords($city->ville) }}</option>
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
                            <img width="150px" src="{{ asset('/images/castle.png') }}" alt="">
                            <select name="destination" id="destination" class="m-2 p-2 rounded w-48">
                                @foreach($cities as $city)
                                    @php
                                        $city->ville = preg_replace('/[^A-Za-z0-9 \-]/', '', $city->ville);
                                        $id = strtolower(str_replace(' ', '-', $city->ville));
                                    @endphp
                                    <option value="{{ $city->ville }}" id="{{ $id }}" {{ $city->ville == $routes->first()->destination ? 'selected' : '' }}>{{ ucwords($city->ville) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="absolute left-[50%] bottom-0 bg-black py-2 px-4 rounded-lg text-white translate-x-[-50%] translate-y-[100%]">Search</button>
                    </form>
                </div>
            </div>
        </main>
</x-layout>
