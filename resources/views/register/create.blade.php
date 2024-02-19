<x-layout class="">
    <div class="w-full h-full flex justify-center items-center bg-black-600/30 backdrop-brightness-75 w-[100vw] overflow-hidden">
        <div id="register-background" class="flex justify-evenly items-center w-[100vw] bg-black bg-white h-full transition-all overflow-hidden">
            <div id="passenger-form-wrapper" class="relative w-[50%] h-[100vh] bg-white flex justify-center items-center absolute transition-all">
                <button class="absolute left-0 translate-x-[-90%] w-full bg-black px-16 py-8 text-white text-5xl rounded-lg rotate-[-90deg] font-black transition-all" type="button">Passenger</button>
                <form action="/register" method="POST" id="passenger-form" class="flex flex-col justify-between p-16 py-8 bg-black text-white rounded-lg w-fit m-auto transition-all" enctype="multipart/form-data">
                    @csrf

                    <x-form.input name="role" type="hidden" value="passenger" />
                    <div class="grid grid-cols-1 gap-x-16">
                        @include('register._user-inputs')

                        <x-form.input name="phone" required />
                    </div>

                    <x-form.button class="!text-black bg-white">SIGN UP</x-form.button>
                </form>

                <button type="button" id="passenger-switch" class="bg-black bg-white px-16 py-8 text-white rotate-[-90deg] rounded-lg rotate-[-90deg] transition-all">Sign in as Passenger</button>
            </div>

            <div id="driver-form-wrapper" class="w-[50%] h-[100vh] bg-black flex flex-row-reverse justify-center items-center absolute translate-x-[100%] transition-all">
                <button class="absolute right-0 translate-x-[90%] w-full bg-white px-16 py-8 text-black text-5xl rounded-lg rotate-[90deg] font-black transition-all" type="button">Driver</button>

                <form action="/register" method="POST" id="driver-form" class="flex flex-col justify-between bg-white p-16 py-8 rounded-lg w-fit h-[100vh] m-auto h-fit" enctype="multipart/form-data">
                    @csrf

                    <x-form.input name="role" type="hidden" value="driver" />
                    <div class="grid grid-cols-1  gap-x-16">
                        @include('register._user-inputs')

                        <x-form.input name="description" required />
                        <x-form.input name="registration" required />
                        <x-form.input name="typeVehicle" auxname="Vehicule Type" required />
                        
                        <div class="flex justify-between items-center my-4 space-y-2 space-x-4">
                        <label class="font-black" for="typePayment">Payment Type:</label>

                            <select name="typePayment" id="typePayment" class="p-2 rounded-lg">
                                <option value="cash">Cash</option>
                                <option value="credit">Credit</option>
                            </select>
                        </div>
                    </div>

                    <x-form.button>SIGN UP</x-form.button>
                </form>

                <button type="button" id="driver-switch" class="bg-black bg-white px-16 py-8 text-black rotate-[-90deg] rounded-lg rotate-90deg transition-all">Sign in as Driver</button>
            </div>
        </div>
    </div>
</x-layout>
