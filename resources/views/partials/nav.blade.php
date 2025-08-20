 <nav class="bg-white shadow-md p-4">
     <div class="container mx-auto flex justify-between items-center">
         <a href="#" class="text-2xl font-bold text-indigo-600">
             <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto">
         </a>
         <div>
             <a href="{{ route('landing') }}" class="text-gray-600 hover:text-indigo-600 mx-2">Inicio</a>
             <a href="{{ route('agendamiento') }}" class="text-gray-600 hover:text-indigo-600 mx-2">Programación</a>
             {{-- <a href="{{ route('reporte') }}" class="text-gray-600 hover:text-indigo-600 mx-2">Reporte</a> --}}
             <a href="{{ route('puntos') }}" class="text-gray-600 hover:text-indigo-600 mx-2">Puntos</a>
             <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 mx-2">Inicio de sesión</a>


         </div>
     </div>
 </nav>
