@props(['role'])

<div class="absolute flex flex-col items-center justify-center bg-white rounded-lg border-2 border-black border-dashed left-[50%] translate-x-[-50%] p-4 space-y-12 top-[50%] translate-y-[-50%]">
    <img width="100px" src="{{ asset('/images/clock.png') }}" alt="" class="absolute top-0 left-[50%] translate-x-[-50%] translate-y-[-50%]">
    <input type="datetime-local" name="date" id="date" class="bg-gray-200 text-sm border-black p-2 rounded mt-8" min="{{ now()->timezone('Africa/Casablanca')->format('Y-m-d\Th:i') }}" max="{{ now()->timezone('Africa/Casablanca')->addMonth()->format('Y-m-d\Th:i') }}" {{ $attributes(['value' => now()->timezone('Africa/Casablanca')->format('Y-m-d\Th:i')]) }} {{ $role == 'driver' ? (auth()->user()->driver()->first()->available != 1 ? 'disabled' : '') : '' }} required>
</div>
@error('date')
    <p class="text-xs text-center text-red-500">{{ $message }}</p>
@enderror