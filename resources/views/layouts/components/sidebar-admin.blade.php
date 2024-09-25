<nav class="navbar navbar-expand-md sticky-top p-3" style="top:0;box-sizing:border-box;">
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="Sidebar">
        <div class="d-flex flex-column align-items-center mb-3">
            <img src="{{ asset('image/profile_pictures/default-user.jpg') }}" alt="" class="w-50 w-md-25 ratio-1x1 border rounded-circle">
            <div class="dropdown">
                <a id="accountDropdowm" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdowm">
                    <a class="dropdown-item text-smaller" href="">Pengaturan Akun</a>
                    <a class="dropdown-item text-smaller text-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <ul class="nav flex-column nav-pills">
            <li class="nav-item">
                <a href="{{ route('admin') }}" class="nav-link h5  {{ $page == 'home' ? 'active' : ''; }}">
                    <strong><i class="fa-solid fa-house me-2"></i>Dashboard</strong>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin') }}" class="nav-link h5 {{ $page == 'shop' ? 'active' : ''; }}">
                    <strong><i class="fa-solid fa-shop me-2"></i>Tentang Toko</strong>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link h5" data-bs-toggle="collapse" data-bs-target="#order" aria-expanded="true" aria-controls="order">
                    <strong><i class="fa-solid fa-list-check me-2"></i>Buku</strong>
                    <i class="position-absolute fa-solid fa-caret-down h5" style="right:35px;"></i>
                </a>
            </li>
            <div id="order" class="accordion-collapse collapse show mb-3 ps-3">
                <li class="nav-item">
                    <a href="/admin/statistic-user" class="nav-link {{ $page == 'book' ? 'active' : ''; }}">Kelola Buku</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/statistic-seller" class="nav-link {{ $page == 'book-inactive.status' ? 'active' : ''; }}">Buku Non-aktif</a>
                </li>
                <li class="nav-item">
                    <a href="/admin/statistic-selling" class="nav-link {{ $page == 'category.cancel' ? 'active' : ''; }}">Kelola Kategori</a>
                </li>
            </div>
        </ul>
    </div>
</nav>