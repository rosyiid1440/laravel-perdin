<li class="nav-item">
    <a href="{{ url('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>
@if (Auth::user()->role_id == 1)
    <li class="nav-item">
        <a href="{{ url('admin/user') }}" class="nav-link {{ request()->is('admin/user') ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Master User
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('admin/master-kota') }}"
            class="nav-link {{ request()->is('admin/master-kota') ? 'active' : '' }}">
            <i class="nav-icon fas fa-solid fa-city"></i>
            <p>
                Master Kota
            </p>
        </a>
    </li>
@endif

@if (Auth::user()->role_id == 3)
    <li class="nav-item">
        <a href="{{ url('pegawai/pengajuan-perdin') }}"
            class="nav-link {{ request()->is('pegawai/pengajuan-perdin') ? 'active' : '' }}">
            <i class="nav-icon fas fa-solid fa-city"></i>
            <p>
                Pengajuan Perdin
            </p>
        </a>
    </li>
@endif

@if (Auth::user()->role_id == 2)
    <li class="nav-item">
        <a href="{{ url('sdm/pengajuan-perdin') }}"
            class="nav-link {{ request()->is('sdm/pengajuan-perdin') ? 'active' : '' }}">
            <i class="nav-icon fas fa-solid fa-city"></i>
            <p>
                Pengajuan Perdin
            </p>
        </a>
    </li>
@endif
