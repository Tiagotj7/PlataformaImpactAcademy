<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impact Academy</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php include __DIR__ . '/partials/navbar.php'; ?>
    <main class="container">
        <?php include __DIR__ . '/partials/flash.php'; ?>
        <?php include $viewFile; ?>
    </main>
    <script src="/assets/js/app.js"></script>
</body>
</html>
