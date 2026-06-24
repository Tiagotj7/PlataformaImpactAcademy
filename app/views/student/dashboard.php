<?php
$xpValue = (int)($xp ?? 0);
$levelValue = (string)($level ?? 0);
$lastLesson = $last ?? null;
$programsList = $programs ?? [];
?>

<h1 class="h3 mb-3">Dashboard</h1>

<div class="row g-3">
  <div class="col-md-4">
    <div class="ia-card p-3">
      <div class="text-white-75 small">Pontuação</div>
      <div class="display-6 fw-bold">
        <span data-count-to="<?= $xpValue ?>" data-count-duration="900">0</span>
        <span class="fs-6 text-white-75">XP</span>
      </div>
      <div class="text-gold small">Nível: <?= e($levelValue) ?></div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="ia-card p-3">
      <div class="text-white-75 small mb-2">Última aula concluída</div>
      <?php if (!empty($lastLesson)): ?>
        <div class="fw-semibold"><?= e($lastLesson['titulo'] ?? '') ?></div>
        <div class="small text-white-75"><?= e($lastLesson['completed_at'] ?? '') ?></div>
        <a class="btn btn-outline-gold btn-sm mt-2" href="<?= url('aula/' . (int)($lastLesson['id'] ?? 0)) ?>">Abrir aula</a>
      <?php else: ?>
        <div class="text-white-75">Você ainda não concluiu nenhuma aula.</div>
      <?php endif; ?>
    </div>
  </div>
</div>

<h2 class="h5 mt-4">Programas ativos</h2>
<div class="row g-3">
  <?php foreach ($programsList as $p): ?>
    <div class="col-md-4">
      <div class="ia-card p-3 h-100">
        <div class="fw-semibold"><?= e($p['nome'] ?? '') ?></div>
        <a class="btn btn-gold btn-sm mt-2" href="<?= url('programa/' . (int)($p['id'] ?? 0)) ?>">Continuar</a>
      </div>
    </div>
  <?php endforeach; ?>
  <?php if (empty($programsList)): ?>
    <div class="col-12 text-white-75">Você ainda não está matriculado.</div>
  <?php endif; ?>
</div>