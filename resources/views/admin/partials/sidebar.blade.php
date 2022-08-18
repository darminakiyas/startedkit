<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">

            <li class="menu-header">Administrator</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}""><a class="nav-link" href="/dashboard"><i
                        class="far fa-square"></i>
                    <span>Dashboard</span></a></li>

            @foreach (menu() as $item)
                <li class="nav-item dropdown {{ Request::is($item->slug . '*') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"
                        {{ menu_access(auth()->user()->role_id, $item->id) }}><i
                            class="{{ $item->icon }}"></i><span>{{ $item->nama }}</span></a>
                    <ul class="dropdown-menu">
                        @foreach (sub_menu()->where('menu_id', $item->id) as $items)
                            <li class="{{ Request::is($items->url . '*') ? 'active' : '' }} "><a
                                    href="/{{ $items->url }}" class="nav-link "
                                    {{ sub_menu_access(auth()->user()->role_id, $items->id) }}>{{ $items->nama }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach

        </ul>
    </aside>
</div>
