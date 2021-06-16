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
        <form action="<?= base_url('Auth/simpan'); ?>" method="POST" class="formlogin">
            <?= csrf_field() ?>
            <i class="fab fa-instagram fa-7x"></i>
            <h1 class="h3 mb-3 fw-normal">Register here</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="nama" placeholder="Aulia Ahmad Nabil" name="nama">
                <label for="nama">Nama</label>
                <div class="invalid-feedback errorNama">

                </div>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" placeholder="nabilunited2@gmail.com" name="email">
                <label for="email">Email</label>
                <div class="invalid-feedback errorEmail">

                </div>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="username" placeholder="brondol" name="username">
                <label for="username">Username</label>
                <div class="invalid-feedback errorUsername">

                </div>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                <label for="password">Password</label>
                <div class="invalid-feedback errorPassword">

                </div>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password2" placeholder="Password" name="password2">
                <label for="password2">Confirm Password</label>
                <div class="invalid-feedback errorPassword2">

                </div>
            </div>
            <button class="w-100 btn btn-lg btn-primary btnlogin" type="submit">Register</button>
        </form>
        <div class="mt-3">
            <p>Already have an account? <a href="<?= base_url('Auth'); ?>">Sign in</a></p>
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
                        $('.btnlogin').html('Register')
                    },
                    success: function(response) {
                        if (response.error) {
                            $('.btnlogin').addClass('mt-3');
                            if (response.error.username) {
                                $('#username').addClass('is-invalid');
                                $('.errorUsername').html(response.error.username);
                            } else {
                                $('#username').removeClass('is-invalid');
                                $('.errorUsername').html('');
                            }
                            if (response.error.email) {
                                $('#email').addClass('is-invalid');
                                $('.errorEmail').html(response.error.email);
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('.errorEmail').html('');
                            }
                            if (response.error.nama) {
                                $('#nama').addClass('is-invalid');
                                $('.errorNama').html(response.error.nama);
                            } else {
                                $('#nama').removeClass('is-invalid');
                                $('.errorNama').html('');
                            }
                            if (response.error.password) {
                                $('#password').addClass('is-invalid');
                                $('.errorPassword').html(response.error.password);
                            } else {
                                $('#password').removeClass('is-invalid');
                                $('.errorPassword').html('');
                            }
                            if (response.error.password2) {
                                $('#password2').addClass('is-invalid');
                                $('.errorPassword2').html(response.error.password2);
                            } else {
                                $('#password2').removeClass('is-invalid');
                                $('.errorPassword2').html('');
                            }
                        } else {
                            Swal.fire({
                                title: "Berhasil!",
                                text: response.sukses.msg,
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