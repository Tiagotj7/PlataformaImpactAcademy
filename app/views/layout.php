<?php
use App\Core\Auth;
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e(($title ?? 'Impact Academy')) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
</head>
<body class="bg-ia text-light">
  <?php require __DIR__ . '/partials/navbar.php'; ?>

  <main class="container py-4">
    <?php require __DIR__ . '/partials/flash.php'; ?>
    <?= $content ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= url('assets/js/app.js') ?>"></script>
</body>
</html>