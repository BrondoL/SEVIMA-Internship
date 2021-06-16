<!-- Modal -->
<div class="modal" id="modaledit" tabindex="-2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open_multipart('', ['class' => 'formedit']) ?>
            <?= csrf_field(); ?>
            <input type="hidden" name="id" id="id" value="<?= $id; ?>">
            <div class="modal-body">
                <div class="text-center">
                    <textarea rows="5" cols="50" id="deskripsi" name="deskripsi"><?= $deskripsi; ?></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btnedit"><i class="fa fa-share-square"></i> Update</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>

</script>