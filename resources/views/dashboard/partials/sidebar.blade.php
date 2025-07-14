 <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
     id="sidenav-main" style="background: #eee6fb;">
     <div class="sidenav-header">
         <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
             aria-hidden="true" id="iconSidenav"></i>
         <a class="navbar-brand m-0 d-flex flex-column"
             href="
                @if (auth()->user()->isAdmin == 1) {{ url('/dashboard/index') }}
                @elseif (auth()->user()->MentorProject != null)
                    {{ url('/dashboard/index-mentor') }}
                @else
                    {{ url('/dashboard/index-mente') }} @endif
            ">
             <span class="ms-1 font-weight-bold">
                 @if (auth()->user()->isAdmin == 1)
                     Admin Infinite Learning
                 @elseif (auth()->user()->MentorProject != null)
                     Mentor Infinite Learning
                 @else
                     Mentee Dashboard
                 @endif
             </span>
             <span class="ms-1 ">
                 @if (auth()->user()->isAdmin == 1)
                     Head Program
                 @elseif (auth()->user()->MentorProject != null)
                     Mentor Infinite Learning
                 @else
                     {{ auth()->user()->Mentee->Kategori->nama }}
                 @endif
             </span>
         </a>
     </div>
     <hr class="horizontal dark mt-0">
     <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
         <ul class="navbar-nav">
             @if (auth()->user()->isAdmin == 1)
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/index') ? 'active' : '' }}" href="/dashboard/index">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/index') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-house fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Dashboard</span>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/proyek-mentee*') ? 'active' : '' }}"
                         href="/dashboard/proyek-mentee">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/proyek-mentee*') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-file fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Proyek Mentee</span>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/pesan-masuk*') ? 'active' : '' }}"
                         href="/dashboard/pesan-masuk">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/pesan-masuk*') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-message fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Pesan Masuk</span>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/mentor*') ? 'active' : '' }}"
                         href="/dashboard/mentor">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/mentor*') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-user fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Akun Mentor</span>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/mentee*') ? 'active' : '' }}"
                         href="/dashboard/mentee">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/mentee*') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-users fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Akun Mentee</span>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/tech*') ? 'active' : '' }}" href="/dashboard/tech">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/tech*') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-microchip fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Tech</span>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/member-master*') ? 'active' : '' }}"
                         href="/dashboard/member-master">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/member-master*') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-user-group fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Member Master</span>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/kategori*') ? 'active' : '' }}"
                         href="/dashboard/kategori">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/kategori*') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-list fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Kategori</span>
                     </a>
                 </li>
             @elseif(auth()->user()->isAdmin == 0 && auth()->user()->MentorProject != null)
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/index-mentor') ? 'active' : '' }}"
                         href="/dashboard/index-mentor">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/index-mentor') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-house fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Beranda</span>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/status-proyek*') ? 'active' : '' }}"
                         href="/dashboard/status-proyek">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/status-proyek*') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-circle-check fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Status Semua Proyek</span>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/arsip-proyek*') ? 'active' : '' }}"
                         href="/dashboard/arsip-proyek">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/arsip-proyek*') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-box-archive fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Arsip Proyek</span>
                     </a>
                 </li>
             @else
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/index-mente') ? 'active' : '' }}"
                         href="/dashboard/index-mente">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/index') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-house fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Dashboard</span>
                     </a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link {{ Request::is('dashboard/tampilan-proyek*') ? 'active' : '' }}"
                         href="/dashboard/tampilan-proyek">
                         <div class="icon icon-shape icon-sm shadow border-radius-md text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: {{ Request::is('dashboard/tampilan-proyek*') ? '#6f42c1' : '#b28be9' }}">
                             <i class="fa-solid fa-eye fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Tampilan Proyek</span>
                     </a>
                 </li>
             @endif
             <li class="nav-item">
                 <form action="{{ route('logout') }}" method="POST">
                     @csrf
                     <button type="submit" class="nav-link">
                         <div class="icon icon-shape icon-sm shadow border-radius-md  text-center me-2 d-flex align-items-center justify-content-center"
                             style="background: #b28be9">
                             <i class="fa-solid fa-right-from-bracket fs-6"></i>
                         </div>
                         <span class="nav-link-text ms-1">Keluar</span>
                     </button>
                 </form>
             </li>
         </ul>
     </div>

 </aside>
