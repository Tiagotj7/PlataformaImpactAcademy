<h1 class="h3 mb-3">Meus Programas</h1>

<div class="row g-3">
  <?php foreach (($programs ?? []) as $p): ?>
    <div class="col-md-4">
      <div class="ia-card p-3 h-100">
        <div class="fw-semibold"><?= e($p['nome']) ?></div>
        <p class="text-white-75 small mb-2"><?= e((string)($p['descricao'] ?? '')) ?></p>
        <a class="btn btn-outline-gold btn-sm" href="<?= url('programa/' . (int)$p['id']) ?>">Abrir</a>
      </div>
    </div>
  <?php endforeach; ?>
</div>