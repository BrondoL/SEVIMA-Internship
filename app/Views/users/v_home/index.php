<?= $this->extend('users/v_layout/index'); ?>
<?= $this->section('content'); ?>

<main>
    <?php foreach ($posts as $p) : ?>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <img src="<?= base_url('images/profile') . '/' . $p['foto']; ?>" alt="Profile Picture" width="40px" class="img-thumbnail rounded-circle">
                        <a href="<?= base_url('Profile/index') . '/' . $p['username']; ?>" style="color: inherit; text-decoration: none;"><b><?= $p['username']; ?></b></a>
                    </div>
                    <img src="<?= base_url('images/posts') . '/' . $p['foto_post']; ?>" alt="<?= $p['foto_post']; ?>" class="img-thumbnail">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <?php $cek_like = $LikesModel->where('id_post', $p['id_post'])->where('id_user', session()->get('user_id'))->countAllResults(); ?>
                            <div class="btn-group">
                                <?php if ($cek_like) : ?>
                                    <button style="background-color:transparent;border:none;" onclick="like(<?= $p['id_post']; ?>)"><i class="fas fa-heart fa-2x lope<?= $p['id_post']; ?>" style="color: red;"></i></button>
                                <?php else : ?>
                                    <button style="background-color:transparent;border:none;" onclick="like(<?= $p['id_post']; ?>)"><i class="far fa-heart fa-2x lope<?= $p['id_post']; ?>"></i></button>
                                <?php endif; ?>
                                <label for="komentar<?= $p['id_post']; ?>"><i class="far fa-comment fa-2x"></i></label>
                            </div>
                            <small class="text-muted"><?= $p['created_at']; ?></small>
                        </div>
                        <?php $total_like = $LikesModel->where('id_post', $p['id_post'])->countAllResults(); ?>
                        <?php if ($total_like != 0) : ?>
                            <div class="px-2">
                                <small>Liked by <?= $total_like; ?> people</small>
                            </div>
                        <?php endif; ?>

                        <p class="card-text mt-3 px-2"><?= $p['deskripsi']; ?></p>

                        <?php $komen = $KomentarModel->join('users', 'users.id_user = komentar.id_user')->where('id_post', $p['id_post'])->get()->getResultArray(); ?>
                        <?php foreach ($komen as $k) : ?>
                            <div class="row">
                                <div class="col">
                                    <img src="<?= base_url('images/profile') . '/' . $k['foto']; ?>" alt="Profile Picture" width="25px" class="img-thumbnail rounded-circle">
                                    <small><b><?= $k['username']; ?></b></small>
                                    <small><?= $k['komentar']; ?></small>
                                </div>
                                <?php if ($k['id_user'] == session()->get('user_id')) : ?>
                                    <div class="col-1">
                                        <button style="background-color:transparent;border:none;" onclick="hapus_komen(<?= $k['id_komentar']; ?>)"><i class="fas fa-trash-alt fa-sm"></i></button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        <hr>
                        <form action="<?= base_url('Action/komen'); ?>" method="POST" class="formkomen">
                            <input type="hidden" value="<?= $p['id_post']; ?>" id="id" name="id">
                            <div class="row">
                                <div class="col">
                                    <textarea style="border: none;outline:none" cols="39" rows="1" placeholder="Add a comment..." id="komentar<?= $p['id_post']; ?>" name="komentar"></textarea>
                                    <div class="invalid-feedback errorKomentar<?= $p['id_post']; ?>">

                                    </div>
                                </div>
                                <div class="col-1">
                                    <button type="submit" style="background-color:transparent;border:none;"><small style="color: blue;">Post</small></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
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

    function like(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('Action/like'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.lope' + id).removeClass("fas");
                    $('.lope' + id).addClass("far");
                    $('.lope' + id).css("color", "");
                } else {
                    $('.lope' + id).removeClass("far");
                    $('.lope' + id).addClass("fas");
                    $('.lope' + id).css("color", "red");
                }
            }
        });
    }

    $(document).ready(function() {
        $('.formkomen').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        if (response.error.komentar) {
                            $('#komentar' + $('input#id').val()).addClass('is-invalid');
                            $('.errorKomentar' + $('input#id').val()).html(response.error.komentar);
                        } else {
                            $('#komentar' + $('input#id').val()).removeClass('is-invalid');
                            $('.errorKomentar' + $('input#id').val()).html('');
                        }
                    } else {
                        $('textarea#komentar' + $('input#id').val()).val('');
                        location.reload();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    function hapus_komen(id) {
        $.ajax({
            url: "<?= base_url('Action/hapus_komen') ?>",
            type: "POST",
            dataType: "json",
            data: {
                id: id
            },
            success: function(response) {
                if (response.sukses) {
                    location.reload();
                }
            }
        });
    }
</script>

<?= $this->endSection(); ?>