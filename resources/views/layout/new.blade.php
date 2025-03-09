<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Proctorial Website">
    <meta name="keywords" content="">
    <meta name="author" content="Flyte Technologies and Solutions Ltd">
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <!-- TinyMcE -->
    <script src="/assets2/js/wysihtml/tinymce.min.js"></script>

    <!-- Favicon -->
    <link rel="icon" href="../real-estate-html-template/img/cavier_logo.jpeg">

    <!-- Base CSS -->
    <link rel="stylesheet" href="/assets2/css/basestyle/style.css">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <!-- fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('/assets2/css/fontawesome/fontawesome-all.min.css') }}">

    <!-- wysihtml CSS -->
    <link rel="stylesheet" type="text/css" href="/assets2/css/wysihtml/wmwysiwygeditor.css">

    <title>Cavier - Stay</title>
    <!-- summernote -->
    <link rel="stylesheet" href="/assets2/js/summernote/summernote-bs4.min.css">
</head>

<body>
    <section class="wrapper">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <nav class="navbar navbar-dark bg-primary">
                <a class="navbar-brand m-0 py-2 brand-title" target="_blank" href="/">Cavier - Properties</a>
                <span></span>
                <a class="navbar-brand py-2 material-icons toggle-sidebar" href="#">menu</a>
            </nav>

            <nav class="navigation">
                <ul>
                    <li
                        class="{{ request()->route() && request()->route()->uri() == 'admin/dashboard' ? 'active' : '' }}">
                        <a href="/admin/dashboard" title="Dashboard"><span class="nav-icon material-icons">public</span>
                            Dashboard</a>
                    </li>

                    <li
                        class="{{ request()->route() && request()->route()->uri() == 'admin/locations' ? 'active' : '' }}">
                        <a href="/admin/locations" title="Locations"><span
                                class="nav-icon material-icons">widgets</span>
                            Locations</a>
                    </li>
                    <li
                        class="{{ request()->route() && request()->route()->uri() == 'admin/categories' ? 'active' : '' }}">
                        <a href="/admin/categories" title="Locations"><span
                                class="nav-icon material-icons">widgets</span>
                            Property Categories</a>
                    </li>

                    <li
                        class="{{ request()->route() && request()->route()->uri() == 'admin/property/types' ? 'active' : '' }}">
                        <a href="/admin/property/types" title="About"><span
                                class="nav-icon material-icons">widgets</span>
                            Property Types</a>
                    </li>

                    <li
                        class="{{ request()->route() && request()->route()->uri() == 'admin/properties' ? 'active' : '' }}">
                        <a href="/admin/properties" title="Services"><span
                                class="nav-icon material-icons">widgets</span>
                            Properties</a>
                    </li>

                    <li
                        class="{{ request()->route() && request()->route()->uri() == 'admin/property/agents' ? 'active' : '' }}">
                        <a href="/admin/property/agents" title="Services"><span
                                class="nav-icon material-icons">widgets</span>
                            Property Agent</a>
                    </li>

                    <li
                        class="{{ request()->route() && request()->route()->uri() == 'admin/testimonials' ? 'active' : '' }}">
                        <a href="/admin/testimonials" title="Services"><span
                                class="nav-icon material-icons">widgets</span>
                            Testimonials</a>
                    </li>

                    <li
                        class="{{ request()->route() && request()->route()->uri() == 'admin/contacts' ? 'active' : '' }}">
                        <a href="/admin/transactions" title="Contacts"><span
                                class="nav-icon material-icons">widgets</span>
                            Transactions</a>
                    </li>

                    <li
                        class="{{ request()->route() && request()->route()->uri() == 'admin/contacts' ? 'active' : '' }}">
                        <a href="/admin/contacts" title="Contacts"><span class="nav-icon material-icons">widgets</span>
                            Contacts Messages</a>
                    </li>

                    {{-- <li
                        class="{{ (request()->route() && request()->route()->uri() == 'admin/galleries' ? 'active' : request()->route() && request()->route()->uri() == 'admin/galleries') ? 'active' : '' }}">
                        <a href="/admin/galleries" title="Slider"><span class="nav-icon material-icons">equalizer</span>
                            Gallery</a>
                    </li> --}}

                    <li class="">
                        <a href="/logout" title="Log Out"><span class="nav-icon material-icons">logout</span> Log Out
                        </a>
                    </li>
                </ul>
            </nav>

        </aside>
        <div class="content-area">
            <header class="header sticky-top">
                <nav class="navbar navbar-light bg-white px-sm-4 ">
                    <a class="navbar-brand py-2 d-md-none  m-0 material-icons toggle-sidebar" href="#">menu</a>
                    <ul class="navbar-nav flex-row ml-auto">
                        <li class="nav-item ml-sm-3 user-logedin dropdown">
                            <a href="#" id="userLogedinDropdown" data-toggle="dropdown"
                                class="nav-link weight-400 dropdown-toggle">{{ Auth::user()->name ?? '' }}</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userLogedinDropdown">
                                {{-- <a class="dropdown-item" href="profile.html">My Account</a>
                                <a class="dropdown-item" href="#">Account Settings</a>
                                <a class="dropdown-item" href="#">Help
                                    & Support</a>
                                <div class="dropdown-divider"></div> --}}
                                <a class="dropdown-item" href="/logout">Log Out</a>
                            </div>
                        </li>

                    </ul>
                </nav>
            </header>

            <div class="content-wrapper">
                @yield('contents')

                <footer class="footer">
                    <p class="text-muted m-0"><small><a href="https://ftsl-ng.com/" target="_blank">Flyte Technologies
                                and
                                Solutions LTD</a> © {{ now()->year ?? '' }} -
                            www.ftsl-ng.com</small></p>
                </footer>
            </div>
        </div>
    </section>

    <script src="/assets2/js/lib/moment.min.js"></script>
    <script src="/assets2/js/lib/jquery.min.js"></script>
    <script src="/assets2/js/lib/popper.min.js"></script>
    <script src="/assets2/js/bootstrap/bootstrap.min.js"></script>
    <script src="/assets2/js/chosen-js/chosen.jquery.js"></script>
    <script src="/assets2/js/fullcalendar/fullcalendar.js"></script>

    <script src="/assets2/js/daterangepicker/daterangepicker.min.js"></script>
    <script src="/assets2/js/custom.js"></script>
    <!-- Summernote -->
    <script src="/assets2/js/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()
        })

        $(function() {
            // Summernote
            $('#summernote1').summernote()
        })
    </script>


</body>

</html>
