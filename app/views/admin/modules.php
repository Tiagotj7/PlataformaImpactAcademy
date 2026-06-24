<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h1 class="h3 mb-0">Módulos</h1>
    <div class="text-white-75 small">Programa: <?= e($program['nome']) ?></div>
  </div>
  <a class="btn btn-gold" href="<?= url('admin/programas/' . (int)$program['id'] . '/modulos/novo') ?>">Novo módulo</a>
</div>

<div class="ia-card p-3">
  <table class="table table-dark table-borderless align-middle mb-0">
    <thead><tr><th>ID</th><th>Título</th><th>Ordem</th><th class="text-end">Ações</th></tr></thead>
    <tbody>
      <?php foreach (($modules ?? []) as $m): ?>
        <tr>
          <td><?= (int)$m['id'] ?></td>
          <td><?= e($m['titulo']) ?></td>
          <td><?= (int)$m['ordem'] ?></td>
          <td class="text-end">
            <a class="btn btn-outline-gold btn-sm" href="<?= url('admin/modulos/' . (int)$m['id'] . '/aulas') ?>">Aulas</a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$modules): ?>
        <tr><td colspan="4" class="text-white-75">Nenhum módulo.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<a class="btn btn-outline-gold mt-3" href="<?= url('admin/programas') ?>">Voltar</a>