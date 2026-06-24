<?php use App\Core\Csrf; ?>
<?php
$moduleData = $module ?? ['titulo' => '', 'id' => 0];
$lessonData = $lesson ?? null;
$isEdit = !empty($lessonData);
$action = $isEdit
  ? url('admin/aulas/' . (int)($lessonData['id'] ?? 0) . '/editar')
  : url('admin/modulos/' . (int)$moduleData['id'] . '/aulas/novo');
?>
<h1 class="h3 mb-3"><?= e($title ?? 'Aula') ?></h1>

<div class="ia-card p-4">
  <div class="text-white-75 small mb-3">Módulo: <?= e($moduleData['titulo']) ?></div>

  <form method="post" action="<?= $action ?>">
    <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">

    <div class="mb-3">
      <label class="form-label">Título</label>
      <input class="form-control ia-input" name="titulo" required value="<?= e($lessonData['titulo'] ?? '') ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Descrição</label>
      <textarea class="form-control ia-input" name="descricao" rows="3"><?= e($lessonData['descricao'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Link do YouTube (URL ou ID)</label>
      <input class="form-control ia-input" name="video_url" value="<?= e($lessonData['video_url'] ?? '') ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Texto complementar</label>
      <textarea class="form-control ia-input" name="texto" rows="5"><?= e($lessonData['texto'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">PDF (URL por enquanto)</label>
      <input class="form-control ia-input" name="pdf" value="<?= e($lessonData['pdf'] ?? '') ?>">
    </div>

    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Status</label>
        <?php $st = $lessonData['status'] ?? 'publicada'; ?>
        <select class="form-select ia-input" name="status">
          <option value="publicada" <?= $st === 'publicada' ? 'selected' : '' ?>>Publicada</option>
          <option value="rascunho" <?= $st === 'rascunho' ? 'selected' : '' ?>>Rascunho</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Ordem</label>
        <input class="form-control ia-input" name="ordem" type="number" value="<?= e((string)($lesson['ordem'] ?? 0)) ?>">
      </div>
    </div>

    <div class="mt-3">
      <button class="btn btn-gold" type="submit">Salvar</button>
      <a class="btn btn-outline-gold" href="<?= url('admin/modulos/' . (int)$moduleData['id'] . '/aulas') ?>">Voltar</a>
    </div>
  </form>
</div>