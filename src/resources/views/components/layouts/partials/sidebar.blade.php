
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
            @foreach($navGroups as $navGroup)
                <li class="menu-title small text-uppercase">
                    <span class="menu-title-text">{{ $navGroup->title }}</span>
                </li>

                @foreach($navGroup->navItems as $item)
                    <li class="menu-item">
                        <a href="{{ $item->url }}" class="menu-link">
                            @if($item->icon)
                                <span class="material-symbols-outlined menu-icon">{{ $item->icon }}</span>
                            @endif
                            <span class="title">{{ $item->title }}</span>
                        </a>
                    </li>
                @endforeach
            @endforeach
        </ul>

        
    </aside>
</div>