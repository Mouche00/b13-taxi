<x-layout class="bg-[url('{{ asset('/images/parchment.jpg') }}')] bg-cover bg-norepeat">
        <x-dashboard.navbar role="admin" />
        <div class="flex">
            <x-dashboard.sidebar role="admin" />

            <main class="relative flex flex-col md:pl-12 lg:pl-0 lg:flex-row w-full">
                <div class="pb-8 pr-12 w-full md:w-full mx-auto md:mx-0">
                    <div class="bg-white border-black border-4 border-dashed rounded-xl font-black text-xl">
                        <h1 class="font-black text-white text-xl bg-black p-4 text-center">Reservations</h1>
                        <div class="flex flex-col md:flex-row justify-evenly p-4 gap-4">
                            <div class="w-full overflow-auto">
                                <table class="w-full border-separate border-spacing-2">
                                    <thead>
                                        <tr class="gap-2">
                                            <th class="bg-black rounded-lg py-4 px-8 text-white mx-2">ID</th>
                                            <th class="bg-black rounded-lg py-4 px-8 text-white mx-2">Name</th>
                                            <th class="bg-black rounded-lg py-4 px-8 text-white mx-2">Email</th>
                                            <th class="bg-black rounded-lg py-4 px-8 text-white mx-2">Role</th>
                                            <th class="bg-black rounded-lg py-4 px-8 text-white mx-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="border-2 border-black border-solid rounded-lg py-4 px-8 text-center">{{ $user->id }}</td>
                                                <td class="border-2 border-black border-solid rounded-lg py-4 px-8 text-center">{{ $user->name }}</td>
                                                <td class="border-2 border-black border-solid rounded-lg py-4 px-8 text-center">{{ $user->email }}</td>
                                                <td class="border-2 border-black border-solid rounded-lg py-4 px-8 text-center">{{ $user->driver ? 'Driver' : ($user->passenger ? 'Passenger' : ($user->admin ? 'Admin' : 'Unkown')) }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST" class="m-0 w-full h-full">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="w-full h-full py-4 px-8 border-2 border-black border-solid rounded-lg transition-all hover:bg-black hover:text-white">DELETE</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>    
    </div>
</x-layout>
