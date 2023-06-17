<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ url('assets/vendors/ti-icons/css/themify-icons.css', []) }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/base/vendor.bundle.base.css', []) }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css', []) }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/datatables/dataTables.bootstrap4.min.css', []) }}">

</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h4 class="font-weight-light">RESET AKUN</h4>
                            <form class="pt-3" method="post" action="{{ route('reset.data', []) }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg @error('username')
                                        is-invalid
                                    @enderror" name="username" id="username" value="{{old('username')}}" placeholder="Masukan Email">
                                    @error('username')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg @error('nama')
                                        is-invalid
                                    @enderror" name="nama" id="nama" value="{{old('nama')}}" placeholder="Nama Lengkap">
                                    @error('nama')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                                
                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col-md-12 text-right my-1 justify-content-end align-content-end float-right" style="float: right !important">
                                            <button type="submit" name="button" style="float: right !important" class="btn w-100 d-inline btn-block btn-success btn-lg font-weight-medium auth-form-btn">Cek Data</button>
                                        </div>
                                    </div>
                                    

                                    
                                </div>
                            </form>
                            {{-- <a href="{{ url('welcome', []) }}" class="link-primary">Halaman Utama</a> --}}
                                            
                            <p class="mt-1"> <a href="{{ url('login', []) }}" class="link-primary">Kembali ke halaman Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="{{ url('assets/vendors/base/vendor.bundle.base.js', []) }}"></script>
    <script src="{{ url('assets/js/jquery.cookie.js', []) }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/off-canvas.js', []) }}"></script>
    <script src="{{ url('assets/js/hoverable-collapse.js', []) }}"></script>
    <script src="{{ url('assets/js/template.js', []) }}"></script>
    <script src="{{ url('assets/js/todolist.js', []) }}"></script>
    @include('sweetalert::alert')

</body>

</html>