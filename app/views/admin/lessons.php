<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h1 class="h3 mb-0">Aulas</h1>
    <div class="text-white-75 small">Módulo: <?= e($module['titulo']) ?></div>
  </div>
  <a class="btn btn-gold" href="<?= url('admin/modulos/' . (int)$module['id'] . '/aulas/novo') ?>">Nova aula</a>
</div>

<div class="ia-card p-3">
  <table class="table table-dark table-borderless align-middle mb-0">
    <thead><tr><th>ID</th><th>Título</th><th>Status</th><th>Ordem</th></tr></thead>
    <tbody>
      <?php foreach (($lessons ?? []) as $a): ?>
        <tr>
          <td><?= (int)$a['id'] ?></td>
          <td><?= e($a['titulo']) ?></td>
          <td><span class="badge bg-secondary"><?= e($a['status']) ?></span></td>
          <td><?= (int)$a['ordem'] ?></td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$lessons): ?>
        <tr><td colspan="4" class="text-white-75">Nenhuma aula.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<a class="btn btn-outline-gold mt-3" href="<?= url('admin/programas') ?>">Voltar</a>