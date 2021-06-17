<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <!-- Fontawesome -->
    <link href="<?= base_url('assets/fontawesome/css/all.css'); ?>" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('images/logo.png'); ?>" />

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <link href="<?= base_url('assets/signin.css'); ?>" rel="stylesheet">
    <title><?= $title; ?></title>
</head>

<body class="text-center">

    <main class="form-signin">
        <form action="<?= base_url('Auth/validasi'); ?>" method="POST" class="formlogin">
            <?= csrf_field() ?>
            <i class="fab fa-instagram fa-7x"></i>
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="floatingInput" placeholder="brondol" name="username">
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary btnlogin" type="submit">Sign in</button>
        </form>
        <div class="mt-3">
            <p>Don't have an account? <a href="<?= base_url('Auth/daftar'); ?>">Sign up</a></p>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('.formlogin').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.btnlogin').prop('disable', true);
                        $('.btnlogin').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...')
                    },
                    complete: function() {
                        $('.btnlogin').prop('disable', false);
                        $('.btnlogin').html('Sign in')
                    },
                    success: function(response) {
                        if (response.error) {
                            Swal.fire({
                                title: "Oooopss!",
                                text: response.error,
                                icon: "error",
                                showConfirmButton: false,
                                timer: 1250
                            });
                        }

                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Anda berhasil login!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1250
                            }).then(function() {
                                window.location = response.sukses.link;
                            });
                        }
                    }
                });
                return false;
            });
        });
    </script>

</body>

</html>