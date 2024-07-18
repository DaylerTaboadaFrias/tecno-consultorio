<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'APPTV') }}</title>
        <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset('css/estilofondo.css') }}">
        <link rel="stylesheet" href="{{ asset('css/estilomodo.css') }}">
        
        
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/index.global.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>

.fc-event {
    padding: 0.5rem;
    background-color: #4caf50;
    color: #ffffff;
    border-radius: 0.25rem;
}

/* Estilo para el título de los eventos */
.fc-event-title {
    font-weight: bold;
}
.fc-day {
    border: 1px solid #e2e8f0; /* Borde de las celdas */
}

/* Estilo para los números de día */
.fc-day-number {
    font-size: 14px; /* Tamaño de la fuente de los números */
}

/* Estilo para resaltar el día actual */
.fc-today {
    background-color: #f0f4f8; /* Fondo del día actual */
    font-weight: bold; /* Texto del día actual en negrita */
}
.fc-col-header-cell {
    background-color: #edf2f7; /* Fondo del encabezado de la columna */
    border-bottom: 2px solid #e2e8f0; /* Borde inferior */
    font-weight: bold; /* Texto en negrita */
    text-align: center; /* Alineación del texto */
    padding: 0.5rem; /* Espaciado interno */
}
.fc .fc-toolbar-title {
    font-size: 1.25rem !important;
    margin: 0;
    font-weight: 500;
    padding: 20px 0 0px 20px;
}

.fc .fc-button {
    background-color: #006082 !important;
    border-color: #006082 !important;
}

.fc-day-today {
    background-color: #edf5f7 !important;
}

.fc-theme-standard td {
    border: 1px solid #e5e7eb !important;
} 

.fc-day-other {
    background: #FAFAFB;
}

.fc .fc-button .fc-icon {
    font-size: 0.875rem !important;
}

a.fc-col-header-cell-cushion {
    font-size: .85em !important;
    line-height: 2.2rem !important;
    font-weight: 600 !important;
}

.fc .fc-daygrid-day-top {
    flex-direction: inherit !important;
    padding: 5px !important;
    font-size: .75em !important;
    color: #6b7280 !important;
}

.fc .fc-button-primary:disabled {
    background-color: #eeeeee !important;
    color: black !important;
    border-color: #eeeeee !important;
    font-size: 0.875rem !important;
    line-height: 1.25rem !important;
    text-transform: capitalize !important;
}
.fc-toolbar-title {
    font-size: 1.25rem; /* Tamaño de la fuente */
    font-weight: bold; /* Texto en negrita */
    color: #4a5568; /* Color del texto */
    margin: 0; /* Elimina el margen para controlar el espacio */
}
    </style>
    </head>
    <body  @if(auth()->user()->configuracion->tema == 'Niños') class="niños-font antialiased" @endif 
        @if(auth()->user()->configuracion->tema == 'Jovenes') class="adolecentes-font antialiased" @endif
        @if(auth()->user()->configuracion->tema == 'Adultos') class="adultos-font antialiased" @endif>
        
        <div id="overlay" class="fixed inset-0 flex items-center justify-center bg-white bg-opacity-50 hidden z-50">
            <img src="/images/logos/logo.png" alt="Loading..." class="w-16 h-16">
        </div>
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header  class="{{ $esDeDia ? 'div-modo-dia' : 'div-modo-noche' }}" >
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main @if(auth()->user()->configuracion->tema == 'Niños') class="niños" @endif 
                @if(auth()->user()->configuracion->tema == 'Jovenes') class="adolecentes" @endif
                @if(auth()->user()->configuracion->tema == 'Adultos') class="adultos" @endif
                
                >
                @if (session()->has("status"))
                  
                    <div id="alert-border-1" class="flex p-4 mb-4 bg-blue-100 border-t-4 border-blue-500 dark:bg-blue-200" role="alert">
                        <svg class="flex-shrink-0 w-5 h-5 text-blue-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                        <div class="ml-3 text-sm font-medium text-blue-700">
                            {{ session("status") }} 
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-100 dark:bg-blue-200 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 dark:hover:bg-blue-300 inline-flex h-8 w-8" data-dismiss-target="#alert-border-1" aria-label="Close">
                          <span class="sr-only">Dismiss</span>
                          <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
        
        
    </body>
    <script src="https://unpkg.com/flowbite@1.5.1/dist/flowbite.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        <script>
            $(document).ready(function() {
                $('form').on('submit', function() {
                    $('#overlay').removeClass('hidden');
                });
                 
            });
        </script>
</html>
