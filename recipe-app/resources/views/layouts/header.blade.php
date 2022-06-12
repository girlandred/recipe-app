<header class="lg:fixed">
    <div class="w-full bg-green-700 p-3 text-white lg:w-72 lg:h-screen" x-data="{ open: false }"
        @click.away="open = false">
        <div class="flex justify-between items-center lg:mb-20 lg:mt-10">
            <div class="text-lg lg:hidden">
                <button
                    class="border border-gray-100 px-2 rounded-lg duration-300 ease-in-out transition text-center hover:bg-white hover:text-green-700"
                    @click="open = !open" aria-label="Menu">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <div class="hidden lg:block mt-3" :class="{ 'hidden': !open }">
            <nav class="flex flex-col space-y-3">
                @if (Auth::user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}"
                        @if (request()->routeIs('admin*')) class="w-full p-3 font-bold text-green-700 bg-white rounded-lg space-x-2"
                        @else
                            class="w-full p-3 font-bold rounded-lg hover:bg-white hover:text-green-700 space-x-2" @endif>
                        <i class="fas fa-tachometer-alt"></i>
                        <span>
                            Admin
                        </span>
                    </a>
                @endif
                @if (request()->routeIs('recipes*'))
                    <div class="w-full" x-data="{ nav: true }">
                        <button
                            class="w-full p-3 font-bold rounded-lg bg-white text-green-700 space-x-2 cursor-pointer text-left"
                            @click="nav = !nav">
                        @else
                            <div class="w-full" x-data="{ nav: false }" @click.away="nav = false">
                                <button
                                    class="w-full p-3 font-bold rounded-lg hover:bg-white hover:text-green-700 space-x-2 cursor-pointer text-left"
                                    @click="nav = !nav">
                @endif
                <i class="fas fa-hamburger"></i>
                <span>
                    Recipes
                </span>
                <span aria-label="Recipes Menu" class="float-right">
                    <i class="fas fa-angle-down text-center cursor-pointer transition transform ease-in-out duration-200"
                        :class="{ 'rotate-180': nav }"></i>
                </span>
                </button>
                <div :class="{ 'hidden': !nav }" class="flex flex-col space-y-2 mt-3">
                    <a href="{{ route('recipes.index') }}"
                        @if (request()->routeIs('recipes.index')) class="w-full py-2 pl-8 pr-3 font-bold text-green-700 bg-white rounded-lg space-x-2"
                            @else
                                class="w-full py-2 pl-8 pr-3 font-bold rounded-lg hover:bg-white hover:text-green-700 space-x-2" @endif>
                        <i class="fas fa-apple-alt"></i>
                        <span>
                            All Recipes
                        </span>
                    </a>
                    <a href="{{ route('recipes.create') }}"
                        @if (request()->routeIs('recipes.create')) class="w-full py-2 pl-8 pr-3 font-bold text-green-700 bg-white rounded-lg space-x-2"
                            @else
                                class="w-full py-2 pl-8 pr-3 font-bold rounded-lg hover:bg-white hover:text-green-700 space-x-2" @endif>
                        <i class="fas fa-plus"></i>
                        <span>
                            Create Recipe
                        </span>
                    </a>
                </div>
        </div>
        </nav>
        <div class="w-full font-bold lg:hidden" x-data="{ profile: false }" @click.away="profile = false">
            <div class="flex justify-between p-3 items-center" @click="profile = !profile">
                <p>
                    {{ Auth::user()->name }}
                </p>
                <button aria-label="Profile Menu">
                    <i class="fas fa-angle-down text-center cursor-pointer transition transform ease-in-out duration-200"
                        :class="{ 'rotate-180': profile }"></i>
                </button>
            </div>
            <div class="w-full font-bold text-green-700 bg-white rounded-lg space-x-2" :class="{ 'hidden': !profile }">
                <div class="flex flex-col text-left">
                    <a href="{{ route('locale', __('main.set_lang')) }}" class="px-3 py-2">
                        {{ __('main.change_locale') }}
                    </a>
                    <a href="{{ route('user.index', Auth::user()->id) }}" class="px-3 py-2">
                        Profile
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-2 font-bold w-full text-left" aria-label="Logout">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</header>
