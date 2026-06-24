<?php
$moduleData = $module ?? ['titulo' => '', 'id' => 0];
$lessonsList = $lessons ?? [];
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h1 class="h3 mb-0">Aulas</h1>
    <div class="text-white-75 small">Módulo: <?= e($moduleData['titulo']) ?></div>
  </div>
  <a class="btn btn-gold" href="<?= url('admin/modulos/' . (int)$moduleData['id'] . '/aulas/novo') ?>">Nova aula</a>
</div>

<?php use App\Core\Csrf; ?>

<div class="ia-card p-3">
  <table class="table table-dark table-borderless align-middle mb-0">
    <thead><tr><th>ID</th><th>Título</th><th>Status</th><th>Ordem</th><th class="text-end">Ações</th></tr></thead>
    <tbody>
      <?php foreach ($lessonsList as $a): ?>
        <tr>
          <td><?= (int)$a['id'] ?></td>
          <td><?= e($a['titulo'] ?? '') ?></td>
          <td><span class="badge bg-secondary"><?= e($a['status'] ?? '') ?></span></td>
          <td><?= (int)$a['ordem'] ?></td>
          <td class="text-end">
            <a class="btn btn-outline-gold btn-sm" href="<?= url('admin/aulas/' . (int)$a['id'] . '/editar') ?>">Editar</a>

            <form class="d-inline" method="post"
                  action="<?= url('admin/aulas/' . (int)$a['id'] . '/excluir') ?>"
                  onsubmit="return confirm('Excluir esta aula?');">
              <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">
              <button class="btn btn-outline-danger btn-sm" type="submit">Excluir</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($lessonsList)): ?>
        <tr><td colspan="5" class="text-white-75">Nenhuma aula.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<a class="btn btn-outline-gold mt-3" href="<?= url('admin/programas') ?>">Voltar</a>