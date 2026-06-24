<?php
$programData = $program ?? ['nome' => '', 'id' => 0];
$modulesList = $modules ?? [];
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <div>
    <h1 class="h3 mb-0">Módulos</h1>
    <div class="text-white-75 small">Programa: <?= e($programData['nome']) ?></div>
  </div>
  <a class="btn btn-gold" href="<?= url('admin/programas/' . (int)$programData['id'] . '/modulos/novo') ?>">Novo módulo</a>
</div>

<?php use App\Core\Csrf; ?>

<div class="ia-card p-3">
  <table class="table table-dark table-borderless align-middle mb-0">
    <thead><tr><th>ID</th><th>Título</th><th>Ordem</th><th class="text-end">Ações</th></tr></thead>
    <tbody>
      <?php foreach ($modulesList as $m): ?>
        <tr>
          <td><?= (int)$m['id'] ?></td>
          <td><?= e($m['titulo'] ?? '') ?></td>
          <td><?= (int)$m['ordem'] ?></td>
          <td class="text-end">
            <a class="btn btn-outline-gold btn-sm" href="<?= url('admin/modulos/' . (int)$m['id'] . '/aulas') ?>">Aulas</a>
            <a class="btn btn-outline-gold btn-sm" href="<?= url('admin/modulos/' . (int)$m['id'] . '/editar') ?>">Editar</a>

            <form class="d-inline" method="post"
                  action="<?= url('admin/modulos/' . (int)$m['id'] . '/excluir') ?>"
                  onsubmit="return confirm('Excluir este módulo? Isso também excluirá as aulas relacionadas.');">
              <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">
              <button class="btn btn-outline-danger btn-sm" type="submit">Excluir</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($modulesList)): ?>
        <tr><td colspan="4" class="text-white-75">Nenhum módulo.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<a class="btn btn-outline-gold mt-3" href="<?= url('admin/programas') ?>">Voltar</a>