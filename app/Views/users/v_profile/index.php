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
    <link href="<?= base_url('assets/style.css'); ?>" rel="stylesheet">

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

    <title><?= $title; ?></title>
</head>

<body>
    <header>
        <div class="navbar navbar-light bg-light shadow-sm">
            <div class="container">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <img src="<?= base_url('images/logo2.png'); ?>" alt="logo" width="120px">
                </a>
                <input type="text" id="search" name="search" placeholder="Search" style="border:none">
                <div class="d-flex align-items-end">
                    <button style="background-color:transparent;border:none;"><i class="fas fa-home fa-lg"></i></button>
                    <button style="background-color:transparent;border:none;"><i class="fas fa-heart fa-lg"></i></button>
                    <button style="background-color:transparent;border:none;"><i class="fas fa-user fa-lg"></i></button>
                </div>
            </div>
        </div>
    </header>

    <main>

        <section class="text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <img src="<?= base_url('images/profile/default.png'); ?>" alt="Profile Picture" width="100px" class="img-thumbnail rounded-circle">
                    <h1 class="fw-light">@<?= $user['username']; ?></h1>
                    <p class="lead text-muted"><?= $user['nama']; ?></p>
                    <p><?= $total; ?> Post</p>
                </div>
            </div>
            <button onclick="upload()" style="background-color:transparent;border:none;color:blue"><i class="fas fa-plus-circle fa-2x"></i></button>
        </section>
        <center>
            <hr width="75%">
        </center>

        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php foreach ($posts as $p) : ?>
                        <div class="col">
                            <div class="card shadow-sm">
                                <button style="background-color:transparent;border:none;" onclick="view(<?= $p['id_post']; ?>)"><img src="<?= base_url('images/posts/thumb') . '/thumb_' . $p['foto_post']; ?>" alt="<?= $p['foto_post']; ?>" class="img-thumbnail"></button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </main>

    <footer class="text-muted py-3">
        <div class="container text-center">
            <p class="mb-1">&copy; 2021 InstaApp by Aulia Ahmad Nabil</p>
        </div>
    </footer>

    <div class="viewmodal"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function upload() {
            $.ajax({
                type: "POST",
                url: "<?= base_url('Profile/form_upload'); ?>",
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodal').html(response.sukses).show();
                        $('#modalupload').modal('show');
                    }
                }
            });
        }

        function view(id) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('Profile/view_post'); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodal').html(response.sukses).show();
                        $('#modalview').modal('show');
                    }
                }
            });
        }
    </script>
</body>

</html>