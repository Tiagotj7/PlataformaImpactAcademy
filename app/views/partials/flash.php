<?php if ($msg = flash('success')): ?>
  <div class="alert alert-success ia-flash" data-kind="success"><?= e($msg) ?></div>
<?php endif; ?>

<?php if ($msg = flash('error')): ?>
  <div class="alert alert-danger ia-flash" data-kind="error"><?= e($msg) ?></div>
<?php endif; ?>