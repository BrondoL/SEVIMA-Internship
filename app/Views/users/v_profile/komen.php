<?php foreach ($komen as $k) : ?>
    <div class="row">
        <div class="col">
            <img src="<?= base_url('images/profile') . '/' . $k['foto']; ?>" alt="Profile Picture" width="25px" class="img-thumbnail rounded-circle">
            <small><b><?= $k['username']; ?></b></small>
            <small><?= $k['komentar']; ?></small>
        </div>
    </div>
<?php endforeach; ?>