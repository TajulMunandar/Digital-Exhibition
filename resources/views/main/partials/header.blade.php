 <nav class="navbar navbar-expand-lg navbar-custom">
     <div class="container">
         <a class="navbar-brand" href="/"><img src="{{ asset('img/logo.png') }}" alt=""></a>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav mx-auto">
                 <li class="nav-item">
                     <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ request()->is('showcase*') ? 'active' : '' }}" href="/showcase">Showcase</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}" href="/tentang">Tentang</a>
                 </li>
             </ul>
             <a class="btn btn-purple" href="{{ route('login') }}">Masuk</a>
         </div>
     </div>
 </nav>
