<?php
use App\Core\Auth;
$u = Auth::user();
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e(($title ?? 'Impact Academy')) ?></title>
  <link rel="icon" href="<?= url('assets/images/favicon.ico') ?>" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= url('assets/css/style.css') ?>">
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
</head>
<body class="bg-ia text-light" data-ia-page>
  <?php if (!isset($content)) { $content = ''; } ?>

  <div class="ia-app">
    <?php require __DIR__ . '/partials/sidebar.php'; ?>

    <div class="ia-app-main">
      <div class="ia-app-topbar">
        <div class="d-flex align-items-center gap-2">
          <button class="ia-sidebar-toggle btn btn-outline-gold btn-sm" type="button" id="iaSidebarToggle">
            <i class="bi bi-list"></i>
          </button>
          <h1 class="h5 mb-0"><?= e($title ?? '') ?></h1>
        </div>
        <div class="d-flex align-items-center gap-3">
          <i class="bi bi-bell text-white-75"></i>
          <span class="small text-white-75"><?= e($u['nome'] ?? '') ?></span>
        </div>
      </div>

      <div class="ia-app-content">
        <?php require __DIR__ . '/partials/flash.php'; ?>
        <?= $content ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.2/dist/confetti.browser.min.js"></script>
  <script src="<?= url('assets/js/app.js') ?>"></script>
  <script>
    document.getElementById('iaSidebarToggle')?.addEventListener('click', () => {
      document.getElementById('iaSidebar')?.classList.toggle('is-open');
    });
  </script>
</body>
</html>
