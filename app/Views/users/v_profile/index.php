<?= $this->extend('users/v_layout/index'); ?>
<?= $this->section('content'); ?>
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
        <?php if ($user['username'] == session()->get('username')) : ?>
            <button onclick="upload()" style="background-color:transparent;border:none;color:blue"><i class="fas fa-plus-circle fa-2x"></i></button>
        <?php endif; ?>
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
<?= $this->endSection(); ?>

<?= $this->section('myscript'); ?>
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

<?= $this->endSection(); ?>