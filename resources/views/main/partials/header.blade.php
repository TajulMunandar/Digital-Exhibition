 <nav class="navbar navbar-expand-lg navbar-custom">
     <div class="container">
         <a class="navbar-brand" href="/"><img src="{{ asset('img/logo.png') }}" alt=""></a>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav mx-auto">
                 <li class="nav-item">
                     <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/" style="{{ request()->is('/') ? 'padding: 0.6rem; background-color: rgba(138, 61, 255, 0.1) !important; color: #8A3DFF !important; font-weight: bold !important;' : '' }}">Beranda</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ request()->is('showcase*') ? 'active' : '' }}" href="/showcase" style="{{ request()->is('showcase*') ? 'padding: 0.6rem; background-color: rgba(138, 61, 255, 0.1) !important; color: #8A3DFF !important; font-weight: bold !important;' : '' }}">Showcase</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ request()->is('tentang') ? 'active' : '' }}" href="/tentang" style="{{ request()->is('tentang') ? 'padding: 0.6rem; background-color: rgba(138, 61, 255, 0.1) !important; color: #8A3DFF !important; font-weight: bold !important;' : '' }}">Tentang</a>
                 </li>
             </ul>
             <a class="btn-custom rounded" href="{{ route('login') }}">Masuk</a>
         </div>
     </div>
 </nav>
