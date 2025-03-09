<!doctype html>
<html lang="en">

<!-- Mirrored from cosmoadmin.com/preview/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Aug 2018 12:21:06 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" href="../real-estate-html-template/img/cavier_logo.jpeg">

    <!-- Base CSS -->

    <link rel="stylesheet" href="/assets2/css/basestyle/style.css">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Fontawesome Icons -->
    <link href="/assets2/css/fontawesome/fontawesome-all.min.css" rel="stylesheet">

    <link href="/assets2/css/pages/login.css" rel="stylesheet">

    <title>Cavier - Properties</title>
</head>

<body>


    <section class="wrapper">


        <div class="login mb-5" style="height: 100vh">
            <div class="image-placeholder">
                <h1>Lorem ipsum dolor sit amet<br>consectetur pellentesque adipiscing elit.</h1>
            </div>
            <div class="form">

                <div class="text-center"><span class="material-icons text-success"
                        style="font-size:6rem;">register</span></div>

                <h3 class="h4 text-center">Cavier Admin Registraion</h3>
                @include('flash.flash')

                <form action="/user/register" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" required="" name="name"
                            aria-describedby="emailHelp" placeholder="Enter full name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control" required="" name="email"
                            aria-describedby="emailHelp" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" required="" class="form-control"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" name="password_confirmation" required="" class="form-control"
                            placeholder="Password">
                    </div>

                    <button type="submit" class="btn mt-4 btn-success text-white btn-block"
                        value="">Register</button>
                </form>

            </div>
        </div>


    </section>


    <div class="modal fade " id="forgotPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="exampleModalLabel">Forgot Your Password ?</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email or Username</label>
                            <input type="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Reset Password</button>
                </div>
            </div>
        </div>
    </div>


    <script src="assets2/js/jquery-3.3.1.slim.min.html"></script>
    <script src="assets2/js/popper.min.html"></script>
    <script src="assets2/js/bootstrap/bootstrap.min.js"></script>
    <script src="assets2/js/custom.js"></script>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56821827-7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-56821827-7');
    </script>

</body>

<!-- Mirrored from cosmoadmin.com/preview/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 20 Aug 2018 12:21:08 GMT -->

</html>
