<div class="dropdown d-inline-block">
    <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="si si-user d-sm-none"></i>
        <span class="d-none d-sm-inline-block fw-semibold">{{ auth()->user()->name }}</span>
        <i class="si si-arrow-down opacity-50 ms-1"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="page-header-user-dropdown">
{{--        <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">--}}
{{--            <span>Patients</span>--}}
{{--            <i class="far fa-fw fa-user-circle opacity-50 ms-1"></i>--}}
{{--        </a>--}}
{{--        <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">--}}
{{--            <span>Appointments</span>--}}
{{--            <i class="fa fa-fw fa-calendar-alt opacity-50 ms-1"></i>--}}
{{--        </a>--}}
{{--        <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">--}}
{{--            <span>Payments</span>--}}
{{--            <i class="fab fa-fw fa-paypal opacity-50 ms-1"></i>--}}
{{--        </a>--}}
{{--        <div class="dropdown-divider"></div>--}}
{{--        <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">--}}
{{--            <span>Profile</span>--}}
{{--            <i class="fa fa-fw fa-pencil-alt opacity-50 me-1"></i>--}}
{{--        </a>--}}
{{--        <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">--}}
{{--            <span>Settings</span>--}}
{{--            <i class="fa fa-fw fa-cog opacity-50 ms-1"></i>--}}
{{--        </a>--}}
{{--        <div class="dropdown-divider"></div>--}}
        <a class="dropdown-item d-flex align-items-center justify-content-between space-x-1" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span>{{ trans('auth.buttons.logout') }}</span>
            <i class="si si-logout fa-fw opacity-25"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
