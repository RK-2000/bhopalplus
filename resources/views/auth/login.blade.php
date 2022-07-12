<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bhopal Plus</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/backend/assets/vendors/css/vendor.bundle.base.css') }}">

    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset('public/backend/assets/bhopalplus.png') }}" />

</head>

<body>
    <div class="container-scroller">

        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="row w-100 m-0">

                <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">


                    <div class="card col-lg-4 mx-auto">
                        <div class="card-body px-5 py-5">
                            {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
                            {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
                            <!-- Validation Errors -->

                            <center><img src="{{ asset('public/backend/assets/bhopalplus.png') }}"
                                    style="border-radius: 44px;
                                height: 77px;"
                                    alt="">
                                <h3 class="card-title mb-3">Admin Login</h3>
                            </center>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email" :value="__('Email')">email *</label>
                                    <input id="email" type="email" name="email" :value="old('email')" required
                                        autofocus class="form-control p_input">
                                </div>
                                <div class="form-group">
                                    <label for="password" :value="__('Password')">Password *</label>
                                    <input id="password" class="form-control p_input" type="password" name="password"
                                        required autocomplete="current-password">
                                </div>
                                <div class="form-group d-flex align-items-center justify-content-between">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input id="remember_me" type="checkbox" class="form-check-input"
                                                name="remember"> Remember me </label>

                                    </div>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="forgot-pass">Forgot
                                            password</a>
                                    @endif


                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-block enter-btn">Login</button>
                                </div>

                            </form>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert"
                            style="position: fixed;
                        top: 9px;
                        right: 9px;">
                            <strong>{{ session('status') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color:#fff;">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('errors'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert"
                            style="position: fixed;
                        top: 9px; right: 9px;">
                            <strong>
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color:#fff;">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('public/backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('public/backend/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/misc.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/settings.js') }}"></script>
    <script src="{{ asset('public/backend/assets/js/todolist.js') }}"></script>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".alert").hide();
            }, 5000);
        });
    </script>

</body>

</html>
