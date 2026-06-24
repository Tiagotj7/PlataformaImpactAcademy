<?php
use App\Models\Progress;
use App\Core\Auth;

$progress = new Progress();
$userId = Auth::id();
?>
<h1 class="h3 mb-2"><?= e($program['nome']) ?></h1>
<p class="text-white-75"><?= e((string)($program['descricao'] ?? '')) ?></p>

<?php if (!$modules): ?>
  <div class="ia-card p-3">Nenhum módulo cadastrado.</div>
<?php endif; ?>

<?php foreach ($modules as $m): ?>
  <div class="ia-card p-3 mb-3">
    <div class="d-flex justify-content-between align-items-center">
      <h2 class="h6 mb-0"><?= e($m['titulo']) ?></h2>
      <span class="badge text-bg-dark border border-gold-25">Ordem <?= (int)$m['ordem'] ?></span>
    </div>

    <?php $lessons = $lessonModel->byModule((int)$m['id']); ?>
    <?php if (!$lessons): ?>
      <div class="text-white-75 small mt-2">Nenhuma aula publicada.</div>
    <?php else: ?>
      <ul class="list-group list-group-flush mt-2">
        <?php foreach ($lessons as $a): ?>
          <?php $done = $progress->isLessonCompleted($userId, (int)$a['id']); ?>
          <li class="list-group-item ia-list d-flex justify-content-between align-items-center">
            <a class="link-light text-decoration-none" href="<?= url('aula/' . (int)$a['id']) ?>">
              <?= e($a['titulo']) ?>
            </a>
            <?php if ($done): ?>
              <span class="badge bg-success">Concluída</span>
            <?php else: ?>
              <span class="badge bg-secondary">Pendente</span>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
<?php endforeach; ?>