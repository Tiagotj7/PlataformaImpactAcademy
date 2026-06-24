<?php if (!empty($_SESSION['flash'])): ?>
    <div class="flash">
        <?= htmlspecialchars($_SESSION['flash']) ?>
    </div>
<?php endif; ?>
