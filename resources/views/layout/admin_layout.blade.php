<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link rel="stylesheet" href="{{ asset('css/slimselect.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_style.css') }}">
    <title>Admintrator</title>
</head>

<body>
    @if ($errors->any())
        <!-- Position it -->
        <div style="position: fixed; top: 30px; right: 15px; z-index:10000">
            @foreach ($errors->all() as $error)
                <!-- Then put toasts within -->
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-danger">
                        <strong class="mr-auto text-light">Error</strong>
                        <button type="button" class="ml-2 mb-1 close text-light btn-close-toast" data-dismiss="toast"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        {{ $error }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <div id="warpper" class="nav-fixed">
        <nav class="topnav shadow navbar-light bg-white d-flex">
            <div class="navbar-brand">
                <a href="?">
                    @if (Auth::check() && Auth::user()->role === 'admin')
                        MYMOVIELIST ADMIN
                    @else
                        MYMOVIELIST BLOG
                    @endif
                </a>
            </div>
            <div class="nav-right ">
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <div class="btn-group mr-auto">
                        <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="plus-icon fas fa-plus-circle"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="?view=add-post">Thêm bài viết</a>
                            <a class="dropdown-item" href="?view=add-product">Thêm sản phẩm</a>
                            <a class="dropdown-item" href="?view=list-order">Thêm đơn hàng</a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Tài khoản</a>
                            <a class="dropdown-item" href="#">Thoát</a>
                        </div>
                    </div>
                @endif
            </div>
        </nav>
        <!-- end nav  -->
        <div id="page-body" class="d-flex">
            <div id="sidebar" class="bg-white">
                <ul id="sidebar-menu">
                    @if (Auth::check() && Auth::user()->role === 'admin')
                        <li class="nav-link">
                            <a href="?view=dashboard">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Dashboard
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                        </li>
                        <li class="nav-link">
                            <a href="{{ route('cat.show') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Category
                            </a>
                            <i class="arrow fas fa-angle-right"></i>

                            <ul class="sub-menu">
                                <li><a href="{{ route('cat.add') }}">Add category</a></li>
                                <li><a href="{{ route('cat.show') }}">List categories</a></li>
                            </ul>
                        </li>
                        <li class="nav-link">
                            <a href="{{ route('member.show') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Movie members
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                            <ul class="sub-menu">
                                <li><a href="{{ route('member.add') }}">Add movie member</a></li>
                                <li><a href="{{ route('member.show') }}">List movie members</a></li>
                            </ul>
                        </li>
                        <li class="nav-link">
                            <a href="{{ route('movie.show') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Movie
                            </a>
                            <i class="arrow fas fa-angle-right"></i>
                            <ul class="sub-menu">
                                <li><a href="{{ route('movie.add') }}">Add movie</a></li>
                                <li><a href="{{ route('movie.show') }}">List movies</a></li>
                            </ul>
                        </li>
                        <li class="nav-link">
                            <a href="{{ route('admin.user.show') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Users
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="{{ route('admin.report.show') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Reports
                            </a>
                        </li>
                        <li class="nav-link">
                            <a href="{{ route('admin.comment.show') }}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"></i>
                                </div>
                                Comments
                            </a>
                        </li>
                    @endif
                    <li class="nav-link">
                        <a href="{{ route('user.blog.show') }}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="far fa-folder"></i>
                            </div>
                            Blogs
                        </a>
                        <i class="arrow fas fa-angle-right"></i>

                        <ul class="sub-menu">
                            <li><a href="{{ route('user.blog.add') }}">Thêm mới</a></li>
                            <li><a href="{{ route('user.blog.show') }}">Danh sách</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="wp-content">
                @yield('content')
            </div>
        </div>


    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/slimselect.min.js') }}"></script>
    <script src="{{ asset('js/quill.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>

</html>
