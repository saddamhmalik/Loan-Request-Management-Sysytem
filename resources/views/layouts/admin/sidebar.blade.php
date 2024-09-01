<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a  class="d-block">{{auth()->user()->first_name .' ' .auth()->user()->last_name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard Link -->
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}"
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

                <!-- Loan Requests Section -->
                @php
                    $isLoanRequestActive = request()->routeIs('admin.loan_requests') || request()->is('admin/loan_requests*');
                @endphp
                <li class="nav-item {{ $isLoanRequestActive ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $isLoanRequestActive ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Loan Requests
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- All Requests Link -->
                        <li class="nav-item">
                            <a href="{{ route('admin.loan_requests') }}"
                               class="nav-link {{ request()->routeIs('admin.loan_requests') && !request()->has('status') ? 'active' : '' }}">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>All Requests</p>
                            </a>
                        </li>
                        <!-- Approved Requests Link -->
                        <li class="nav-item">
                            <a href="{{ route('admin.loan_requests', ['status' => 'approved']) }}"
                               class="nav-link {{ request()->routeIs('admin.loan_requests') && request()->get('status') == 'approved' ? 'active' : '' }}">
                                <i class="far fa-check-circle nav-icon text-success"></i>
                                <p>Approved</p>
                            </a>
                        </li>
                        <!-- Pending Requests Link -->
                        <li class="nav-item">
                            <a href="{{ route('admin.loan_requests', ['status' => 'pending']) }}"
                               class="nav-link {{ request()->routeIs('admin.loan_requests') && request()->get('status') == 'pending' ? 'active' : '' }}">
                                <i class="far fa-clock nav-icon text-warning"></i>
                                <p>Pending</p>
                            </a>
                        </li>
                        <!-- Rejected Requests Link -->
                        <li class="nav-item">
                            <a href="{{ route('admin.loan_requests', ['status' => 'rejected']) }}"
                               class="nav-link {{ request()->routeIs('admin.loan_requests') && request()->get('status') == 'rejected' ? 'active' : '' }}">
                                <i class="far fa-times-circle nav-icon text-danger"></i>
                                <p>Rejected</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
