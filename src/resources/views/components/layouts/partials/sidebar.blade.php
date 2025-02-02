<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="/dashboard" class="d-block text-decoration-none position-relative">
            <img src="/themes/trezo/assets/images/logo-icon.png" alt="logo-icon">
            <span class="logo-text fw-bold text-dark">Trezo</span>
        </a>
        <button class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y" id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>

    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">MAIN</span>
            </li>
            <li class="menu-item" >
                <a href="/dashboard" class="menu-link active">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="menu-item">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <a href="{{ route('logout') }}" class="menu-link logout" @click.prevent="$root.submit();">
                        <span class="material-symbols-outlined menu-icon">logout</span>
                        <span class="title">Logout</span>
                    </a>
                </form>
            </li>
            
        </ul>
    </aside>
</div>