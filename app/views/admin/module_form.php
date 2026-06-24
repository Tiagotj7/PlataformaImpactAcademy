<?php use App\Core\Csrf; ?>
<?php
$programData = $program ?? ['nome' => '', 'id' => 0];
$moduleData = $module ?? null;
$isEdit = !empty($moduleData);
$action = $isEdit
  ? url('admin/modulos/' . (int)($moduleData['id'] ?? 0) . '/editar')
  : url('admin/programas/' . (int)$programData['id'] . '/modulos/novo');
?>
<h1 class="h3 mb-3"><?= e($title ?? 'Módulo') ?></h1>

<div class="ia-card p-4">
  <div class="text-white-75 small mb-3">Programa: <?= e($programData['nome']) ?></div>

  <form method="post" action="<?= $action ?>">
    <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">

    <div class="mb-3">
      <label class="form-label">Título</label>
      <input class="form-control ia-input" name="titulo" required value="<?= e($moduleData['titulo'] ?? '') ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Ordem</label>
      <input class="form-control ia-input" name="ordem" type="number" value="<?= e((string)($moduleData['ordem'] ?? 0)) ?>">
    </div>

    <button class="btn btn-gold" type="submit">Salvar</button>
    <a class="btn btn-outline-gold" href="<?= url('admin/programas/' . (int)$programData['id'] . '/modulos') ?>">Voltar</a>
  </form>
</div>