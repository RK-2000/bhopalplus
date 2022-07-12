<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" style="color: #fff;" href="{{ url('/dashboard') }}">BHOPAL PLUS</a>
        <a class="sidebar-brand brand-logo-mini" style="color: #fff;" href="{{ url('/dashboard') }}">BHOPAL PLUS</a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle " src="{{ asset('public/backend/assets/bhopalplus.png') }}"
                            alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
                        <span>admin</span>
                    </div>
                </div>
                {{-- <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a> --}}
                {{-- <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                    aria-labelledby="profile-dropdown">
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-onepassword  text-info"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-calendar-today text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                        </div>
                    </a>
                </div> --}}
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/dashboard') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('bed.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-seat-flat"></i>
                </span>
                <span class="menu-title">Beds Category</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('complaint.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-comment-account-outline"></i>
                </span>
                <span class="menu-title">Complaint</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('aboutus.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-information"></i>
                </span>
                <span class="menu-title">Aboutus</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('feedback.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-comment-account-outline"></i>
                </span>
                <span class="menu-title">Feedback</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('service.index') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-chemical-weapon"></i>
                </span>
                <span class="menu-title">Add Services Category</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#user-basic" aria-expanded="false"
                aria-controls="user-basic">
                <span class="menu-icon">
                    <i class="mdi mdi-account-multiple-outline"></i>
                </span>
                <span class="menu-title">Users Login</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user-basic">

                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.index') }}">Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.index') }}">User</a></li>
                </ul>
            </div>
        </li>


        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                    <i class="mdi mdi-view-dashboard"></i>
                </span>

                <span class="menu-title">All Service Menu</span>

                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                @foreach (servicecategory() as $item)
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <?php
                            $fullhttps = substr($item->url, 0, 5);
                            $fullhttp = substr($item->url, 0, 4);
                            
                            ?>
                            @if ($fullhttps == 'https' or $fullhttp == 'http')
                                <a class="nav-link" href="{{ url($item->url) }}">
                                @else
                                    <a class="nav-link" href="{{ url('admin') . '/' . $item->url }}">
                            @endif
                            <?php if ($item->icon) {
                                $srcs = 'public/backend/image/' . $item->icon;
                            } else {
                                $srcs = 'public/backend/default-image.png';
                            } ?>
                            <img src="{{ asset($srcs) }}"
                                style="margin-right:12px; border-radius: 25px; height: 35px;
                                    width: 33px;
                                   padding: 4px; background-color: #fff;">
                            {{ $item->title }}</a>
                        </li>
                    </ul>
                @endforeach
            </div>
        </li>

    </ul>
</nav>
