<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        {{-- <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..."
                    aria-label="Search..." />
            </div>
        </div> --}}
        <div class="nav-item d-flex align-items-center">
            <a href="#" onclick="performSearch(event)"><i class="bx bx-search fs-4 lh-0"></i></a>
            <input type="text" class="form-control border-0 shadow-none" placeholder="Tìm kiếm..."
                   aria-label="Tìm kiếm..." id="searchInput" onkeydown="handleKeyPress(event)" />
        </div>
        <!-- /Search -->

        @if (Auth::user())
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            {{-- Message --}}
            <button type="button" class="btn btn-outline-primary me-1 noti-chat" onclick="window.location='{{ route('chat') }}'">
                <i class='bx bxs-chat'></i>
            </button>
            {{-- Notifications --}}
            <button type="button" id="notification-button" class="btn {{ Auth::user()->notifications->whereNotIn('read_status', ['read'])->isNotEmpty() ? 'btn-danger' : 'btn-outline-primary'}}" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasScroll" aria-controls="offcanvasScroll">
                <i class='bx bxs-bell'></i>
            </button>
            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/img/avatars/default.png') }}"
                            alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/img/avatars/default.png') }}"
                                            alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                                    <small class="text-muted">{{ Auth::user()->getRoleNames()[0] }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('user.user.detail') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">Tài khoản</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a class="dropdown-item" href="#">
                            <i class="bx bx-cog me-2"></i>
                            <span class="align-middle">Settings</span>
                        </a>
                    </li> --}}
                    {{-- <li>
                        <a class="dropdown-item" href="#">
                            <span class="d-flex align-items-center align-middle">
                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                <span class="flex-grow-1 align-middle">Billing</span>
                                <span
                                    class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                            </span>
                        </a>
                    </li> --}}
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Đăng xuất</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
        @else
        <div class="navbar-nav flex-row align-items-center ms-auto">
            <a href="{{ route('login') }}" class="btn btn-primary me-1">
                Đăng nhập
            </a>
        </div>
        @endif
    </div>
</nav>
<script>
    function performSearch(event) {
        event.preventDefault();
        var keyword = document.getElementById('searchInput').value;
        window.location.href = "{{ route('search.index') }}" + "?keyword=" + encodeURIComponent(keyword);
    }
    function handleKeyPress(event) {
        if (event.keyCode === 13) {
            performSearch(event);
        }
    }
</script>
