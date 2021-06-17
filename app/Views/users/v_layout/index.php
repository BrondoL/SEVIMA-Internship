<?= $this->include('users/v_layout/header'); ?>
<?= $this->renderSection('content'); ?>
<?= $this->include('users/v_layout/footer'); ?>

<div class="viewmodal"></div>

<?= $this->include('users/v_layout/script'); ?>

<?= $this->renderSection('myscript'); ?>

</body>

</html>