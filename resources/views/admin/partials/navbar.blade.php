<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">

        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if (auth()->user()->image)
                    <img alt="image" src="{{ asset('storage/' . auth()->user()->image) }}"
                        class="rounded-circle mr-1">
                @else
                    <img alt="image" src="/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                @endif

                <div class="d-sm-none d-lg-inline-block">Assalamualaikum, {{ auth()->user()->nama }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="/konfigurasi/role" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Role
                </a>
                <div class="dropdown-divider"></div>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item has-icon text-danger"><i
                            class="fas fa-sign-out-alt pt-2"></i> Logout</button>
                </form>
            </div>
        </li>
    </ul>
</nav>
