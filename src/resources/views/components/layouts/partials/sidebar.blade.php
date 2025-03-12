
<div class="sidebar-area" id="sidebar-area">
    <x-headerLogo/>
    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">
            @foreach($navGroups as $navGroup)
                <li class="menu-title small text-uppercase">
                    {{-- <span class="material-symbols-outlined menu-icon">{{ $navGroup->icon }}</span> --}}
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