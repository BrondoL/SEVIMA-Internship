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
        <div class="navbar navbar-light shadow-sm">
            <div class="container">
                <a href="<?= base_url('Home'); ?>" class="navbar-brand d-flex align-items-center">
                    <img src="<?= base_url('images/logo2.png'); ?>" alt="logo" width="120px">
                </a>
                <input class="bg-light" type="text" id="search" name="search" placeholder="Search" style="border:black 1px solid">
                <div class="d-flex align-items-end">
                    <button style="background-color:transparent;border:none;" onclick="window.location = '<?= base_url('Home'); ?>'"><i class="fas fa-home fa-lg"></i></button>
                    <button style="background-color:transparent;border:none;"><i class="fas fa-heart fa-lg"></i></button>
                    <div class="dropdown">
                        <button style="background-color:transparent;border:none;" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-lg"></i></button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="<?= base_url('Profile/index') . '/' . session()->get('username'); ?>">Profile</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('Auth/logout'); ?>">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>