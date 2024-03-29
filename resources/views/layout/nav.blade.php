<header class="p-3 bg-dark text-white">
      <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg">
          <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
          </a>

          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{ route('home.index') }}"  class="nav-link px-2 text-white">HOME</a></li>
            @auth
            <li><a href="{{ route('tasks.index') }}" class="nav-link px-2 text-white">TAREAS</a></li>

            {{-- la unica ruta a la que puede acceder el operario: --}}
            <li><a href="{{ route('tasksOper.index') }}" class="nav-link px-2 text-white">MIS TAREAS </a></li>
         
            <li><a href="{{ route('users.index') }}" class="nav-link px-2 text-white">EMPLEADOS</a></li>
        
            <li><a href="{{ route('clients.index') }}" class="nav-link px-2 text-white">CLIENTES</a></li>

            <li><a href="{{ route('cuotes.index') }}" class="nav-link px-2 text-white">CUOTAS</a></li>

            <li><a href="{{ route('misdatos.index') }}" class="nav-link px-2 text-white">MIS DATOS</a></li>
          </ul>

            {{auth()->user()->name}}&nbsp;
            <div class="text-end ">
              <a href="{{ route('logout.perform') }}" style="float: right;" class="btn btn-outline-light  me-2 float-end">Logout</a>
            </div>
            @endauth

        @guest
        {{-- lo que ve el invitado: --}}
          <div class="text-end">
          <a href="{{ route('login.perform') }}" class="btn btn-outline-light me-2">LOGIN</a>
          <a href="{{ route('register.perform') }}" class="btn btn-warning">SIGN-UP</a>
          <a href="{{ route('soycliente.index') }}" class="btn btn-info">IM CLIENT</a>
          </div>
        @endguest
        </div>
      </div>
    </header>