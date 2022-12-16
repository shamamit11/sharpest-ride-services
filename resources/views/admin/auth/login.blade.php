<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Admin :: Sharpest Rides</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="Sharpest Rides" name="description" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.ico') }}">
<link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
<link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/toastr/build/toastr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg authentication-bg-pattern">

    <div class="account-pages my-5">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <div class="text-center">
                        <img src="{{ asset('assets/admin/images/logo-dark.png')}}" alt="" height="22" class="mx-auto">
                        <p class="text-muted mt-2 mb-4">Responsive Admin Dashboard</p>

                    </div>
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h4 class="text-uppercase mt-0">Sign In</h4>
                            </div>
                            <div id='login_error' class="alert alert-danger alert-dismissible fade show d-none" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            Username or Password Not Matched!
                                        </div>
                            <form id="frm_login" method="post" action="{{ route('admin-checkLogin') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input class="form-control" name="email" type="text"
                                        placeholder="Enter your email">
                                    <div class="error" id='error_email'></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input class="form-control" name="password" type="password"
                                        placeholder="Enter your password">
                                    <div class="error" id='error_password'></div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="remember_me" class="form-check-input" checked>
                                        <label class="form-check-label">Remember me</label>
                                    </div>
                                </div>
                                <div class="mb-3 d-grid text-center">
                                    <button class="btn btn-primary btn-loading" type="submit"> Log In </button>
                                </div>
                            </form>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 text-center">
                                <p> <a href="javascript:;" class="text-muted ms-1"><i class="fa fa-lock me-1"></i>Forgot
                                        your password?</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.includes.scripts')
    <script src="{{ asset('assets/admin/js/auth/login.js') }}"></script>
    </html>