<div class="modal" id="modalview" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col">
                                    <img src="<?= base_url("images/posts/thumb") . '/thumb_' . $foto; ?>" alt="foto" width="600">
                                </div>
                            </div>
                            <?php if ($author == session()->get('username')) : ?>
                                <div class="row mt-2">
                                    <div class="col">
                                        <button style="background-color:transparent;border:none;" onclick="edit_post(<?= $id; ?>)"><i class="far fa-edit fa-lg"></i></button>
                                        <button style="background-color:transparent;border:none;" onclick="hapus_post(<?= $id; ?>)"><i class="far fa-trash-alt fa-lg"></i></button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-5 komensection">
                            <div class="row">
                                <div class="col">
                                    <img src="<?= base_url('images/profile') . '/' . $foto_user; ?>" alt="Profile Picture" width="40px" class="img-thumbnail rounded-circle">
                                    <b><?= $author; ?></b>
                                    <br>
                                    <textarea cols="45" rows="10" style="border: none;outline:none" readonly><?= $deskripsi; ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <?php if ($cek_like) : ?>
                                        <button style="background-color:transparent;border:none;" onclick="like(<?= $id; ?>)"><i class="fas fa-heart fa-2x lope" style="color: red;"></i></button>
                                    <?php else : ?>
                                        <button style="background-color:transparent;border:none;" onclick="like(<?= $id; ?>)"><i class="far fa-heart fa-2x lope"></i></button>
                                    <?php endif; ?>
                                    <label for="komentar"><i class="far fa-comment fa-2x"></i></label>
                                </div>
                            </div>
                            <div class="row mb-3 px-2">
                                <div class="col">
                                    <?php if ($total_like != 0) : ?>
                                        <small>Liked by <?= $total_like; ?> people</small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="viewkomen"></div>
                            <hr>
                            <form action="<?= base_url('Action/komen'); ?>" method="POST" class="formkomen">
                                <input type="hidden" value="<?= $id; ?>" name="id">
                                <div class="row">
                                    <div class="col">
                                        <textarea style="border: none;outline:none" cols="39" rows="1" placeholder="Add a comment..." id="komentar" name="komentar"></textarea>
                                        <div class="invalid-feedback errorKomentar">

                                        </div>
                                    </div>
                                    <div class="col">
                                        <button type="submit" style="background-color:transparent;border:none;"><small style="color: blue;">Post</small></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
                    $('.lope').removeClass("fas");
                    $('.lope').addClass("far");
                    $('.lope').css("color", "");
                } else {
                    $('.lope').removeClass("far");
                    $('.lope').addClass("fas");
                    $('.lope').css("color", "red");
                }
            }
        });
    }

    function datakomen() {
        $.ajax({
            url: "<?= base_url('Action/fetch_komen') . '/' . $id; ?>",
            dataType: "json",
            success: function(response) {
                $('.viewkomen').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        datakomen();

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
                            $('#komentar').addClass('is-invalid');
                            $('.errorKomentar').html(response.error.komentar);
                        } else {
                            $('#komentar').removeClass('is-invalid');
                            $('.errorKomentar').html('');
                        }
                    } else {
                        $('textarea#komentar').val('');
                        datakomen();
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });

    function hapus_post(id) {
        Swal.fire({
            title: 'Hapus ?',
            text: `Apakah anda yakin hapus postingan ini ?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('Action/hapus_post') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: "Berhasil menghapus postingan",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            location.reload();
                        }
                    }
                });
            }
        })
    }

    function edit_post(id) {
        $.ajax({
            type: "POST",
            url: "<?= base_url('Profile/form_edit'); ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('#modalview').modal('hide');
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }
            }
        });
    }
</script>