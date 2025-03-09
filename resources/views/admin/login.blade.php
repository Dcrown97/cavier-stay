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


        <div class="login">
            <div class="image-placeholder">

            </div>
            <div class="form">

                <div class="text-center mb-4"><span class="material-icons text-primary"
                        style="font-size:6rem;">login</span></div>

                <h3 class="h4 mb-5 text-center">Cavier Properties</h3>

                @include('flash.flash')

                <form action="/user/login" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" class="form-control" required value="{{ old('email') }}" name="email"
                            id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" required="" class="form-control"
                            id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        <a href="/forgot-password" data-toggle="modal" data-target="#forgotPassword"
                            class="float-right">Password
                            ?</a>
                    </div>
                    <input type="submit" class="btn mt-4 btn-primary btn-block" value="Login">
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
