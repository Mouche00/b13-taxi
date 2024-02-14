<x-layout class="bg-[url('{{ asset('/images/back.jpg') }}')] bg-no-repeat bg-cover">
    <div class="w-full h-full flex justify-center items-center bg-black-600/30 backdrop-brightness-75">
        <div class="bg-white p-16 flex justify-center items-center rounded-lg">
            <form action="/login" method="POST" class="flex flex-col justify-between">
                @csrf

                <div class="grid grid-cols-1 gap-x-16">

                    <x-form.input name="email" type="email" required />
                    <x-form.input name="password" type="password" autocomplete="new-password" required />
                </div>

                <x-form.button>LOG IN</x-form.button>
            </form>

        </div>
    </div>
</x-layout>
