<nav>
    <div class="border-4 border-dashed border-black">
        <div class="w-[85%] m-auto flex justify-between items-center py-4">
            <div class="flex items-center gap-4">
                <x-navbar.logo path="/images/logo-wheel.png" />
                <x-navbar.logo path="/images/logo-name.png" />
            </div>


            <ul class="flex space-x-8">
                <x-navbar.list-item link="#" name="home" />
                <x-navbar.list-item link="#" name="routes" />
                <x-navbar.list-item link="#" name="about" />
            </ul>

            <div>
                <x-navbar.link class="bg-black rounded-lg border-4 border-black text-white" href="/login" name="login" />
                <x-navbar.link class="bg-white rounded-lg border-4 border-black text-black" href="/signup" name="signup" />
            </div>
        </div>
    </div>
</nav>
