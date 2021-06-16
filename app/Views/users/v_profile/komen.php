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

<script>
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
                    datakomen();
                }
            }
        });
    }
</script>