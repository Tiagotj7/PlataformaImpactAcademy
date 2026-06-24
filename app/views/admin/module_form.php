<?php use App\Core\Csrf; ?>
<h1 class="h3 mb-3">Novo Módulo</h1>

<div class="ia-card p-4">
  <div class="text-white-75 small mb-3">Programa: <?= e($program['nome']) ?></div>

  <form method="post">
    <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">

    <div class="mb-3">
      <label class="form-label">Título</label>
      <input class="form-control ia-input" name="titulo" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Ordem</label>
      <input class="form-control ia-input" name="ordem" type="number" value="0">
    </div>

    <button class="btn btn-gold" type="submit">Salvar</button>
    <a class="btn btn-outline-gold" href="<?= url('admin/programas/' . (int)$program['id'] . '/modulos') ?>">Voltar</a>
  </form>
</div>