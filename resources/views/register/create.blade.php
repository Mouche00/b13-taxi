<x-layout class="bg-[url('{{ asset('/images/back.jpg') }}')] bg-no-repeat bg-cover">
    <div class="w-full h-full flex justify-center items-center bg-black-600/30 backdrop-brightness-75">
        <button type="button" id="register-switch" class="bg-black px-16 py-8 text-white rotate-[-90deg] rounded-lg">Sign in as Driver</button>
        <div class="bg-white p-16 flex justify-center items-center rounded-lg">
            <form action="/register" method="POST" id="passenger-form" class="flex flex-col justify-between" enctype="multipart/form-data">
                @csrf

                <x-form.input name="role" type="hidden" value="passenger" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16">
                    @include('register._user-inputs')

                    <x-form.input name="phone" required />
                </div>

                <x-form.button>SIGN UP</x-form.button>
            </form>

            <form action="/register" method="POST" id="driver-form" class="flex flex-col justify-between hidden" enctype="multipart/form-data">
                @csrf

                <x-form.input name="role" type="hidden" value="driver" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16">
                    @include('register._user-inputs')

                    <x-form.input name="description" required />
                    <x-form.input name="registration" required />
                    <x-form.input name="typeVehicle" required />
                    <x-form.input name="typePayment" required />
                </div>

                <x-form.button>SIGN UP</x-form.button>
            </form>
        </div>
    </div>
</x-layout>
