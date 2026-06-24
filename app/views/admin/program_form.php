<?php use App\Core\Csrf; ?>
<h1 class="h3 mb-3"><?= e($title ?? 'Programa') ?></h1>

<div class="ia-card p-4">
  <form method="post">
    <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">

    <div class="mb-3">
      <label class="form-label">Nome</label>
      <input class="form-control ia-input" name="nome" required value="<?= e($program['nome'] ?? '') ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Descrição</label>
      <textarea class="form-control ia-input" name="descricao" rows="4"><?= e($program['descricao'] ?? '') ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Imagem (URL)</label>
      <input class="form-control ia-input" name="imagem" value="<?= e($program['imagem'] ?? '') ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Status</label>
      <select class="form-select ia-input" name="status">
        <?php $st = $program['status'] ?? 'ativo'; ?>
        <option value="ativo" <?= $st==='ativo'?'selected':'' ?>>Ativo</option>
        <option value="inativo" <?= $st==='inativo'?'selected':'' ?>>Inativo</option>
      </select>
    </div>

    <button class="btn btn-gold" type="submit">Salvar</button>
    <a class="btn btn-outline-gold" href="<?= url('admin/programas') ?>">Voltar</a>
  </form>
</div>