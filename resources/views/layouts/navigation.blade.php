<nav x-data="{ open: false }" class="{{ $esDeDia ? 'navbar-modo-dia' : 'navbar-modo-noche' }}">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>
                
                <!-- Navigation Links -->
                {{-- <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div> --}}
                @if (auth()->user()->tipo == 'Administrativo')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('estadisticareporte.index')" :active="request()->routeIs('estadisticareporte.index')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('historia.index')" :active="request()->routeIs('historia.index')">
                        {{ __('H. clinicas') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('consulta.index')" :active="request()->routeIs('consulta.index')">
                        {{ __('G.Consultas') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('usuario.index')" :active="request()->routeIs('usuario.index')">
                        {{ __('G.Usuarios') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('tratamiento.index')" :active="request()->routeIs('tratamiento.index')">
                        {{ __('G.Tratamientos') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('receta.index')" :active="request()->routeIs('receta.index')">
                        {{ __('G.Recetas') }}
                    </x-nav-link>
                </div>
                
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('medicamento.index')" :active="request()->routeIs('medicamento.index')">
                        {{ __('Medicamentos') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('pago.tratamiento.index')" :active="request()->routeIs('pago.tratamiento.index')">
                        {{ __('Pagos') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('cita.index')" :active="request()->routeIs('cita.index')">
                        {{ __('Citas') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('buscador.index')" :active="request()->routeIs('buscador.index')">
                        {{ __('Buscador') }}
                    </x-nav-link>
                </div>
               
                
                @endif
                @if ($esDeDia) 
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex px-2">
                    <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        @csrf
                        <a href="{{ route('logout') }}"
                           class="inline-flex items-center "
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
                @else 
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex px-2">
                        <form method="POST" action="{{ route('logout') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-white hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            @csrf
                            <a href="{{ route('logout') }}"
                            class="inline-flex items-center "
                            onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                @endif
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('configuracion.index')" :active="request()->routeIs('configuracion.index')">
                        {{ __('Configuracion') }}
                    </x-nav-link>
                </div>
                
                @if (auth()->user()->tipo == 'Cliente')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex  px-2">
                    <x-nav-link :href="route('clientepago.tratamiento.index')" :active="request()->routeIs('clientepago.tratamiento.index')">
                        {{ __('Pagos') }}
                    </x-nav-link>
                </div>
                @endif
                    @php
                        use App\Helpers\MenuHelper;
                        // Obtener los módulos permitidos para el usuario actual
                        $modulos=[];
                        if(auth()->check() && auth()->user()->tipo == 'Ninguno'){
                            $modulos = MenuHelper::getUserModules();
                        }
                        
                    @endphp
                    @foreach($modulos as $modulo)
                    
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex px-2">
                            <x-nav-link :href="url($modulo->mod_file)" :active="request()->is($modulo->mod_file)">
                                {{ __($modulo->mod_name) }}
                            </x-nav-link>
                        </div>
                    @endforeach
            </div>

            {{-- <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div>
                            <x-dropdown-link :href="route('dashboard')">
                                {{ __('Dashboard') }}
                            </x-dropdown-link>
                        </div>
                        <div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div> --}}

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    {{-- <div class="hidden sm:hidden">
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div> --}}
</nav>
