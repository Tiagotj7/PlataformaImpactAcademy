<?php use App\Core\Csrf; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 mb-0">Programas</h1>
  <a class="btn btn-gold" href="<?= url('admin/programas/novo') ?>">Novo</a>
</div>

<div class="ia-card p-3">
  <table class="table table-dark table-borderless align-middle mb-0">
    <thead>
      <tr>
        <th>ID</th><th>Nome</th><th>Status</th><th class="text-end">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (($programs ?? []) as $p): ?>
        <tr>
          <td><?= (int)$p['id'] ?></td>
          <td><?= e($p['nome']) ?></td>
          <td><span class="badge bg-secondary"><?= e($p['status']) ?></span></td>
          <td class="text-end">
            <a class="btn btn-outline-gold btn-sm" href="<?= url('admin/programas/' . (int)$p['id'] . '/modulos') ?>">Módulos</a>
            <a class="btn btn-outline-gold btn-sm" href="<?= url('admin/programas/' . (int)$p['id'] . '/editar') ?>">Editar</a>
            <form class="d-inline" method="post" action="<?= url('admin/programas/' . (int)$p['id'] . '/excluir') ?>"
                  onsubmit="return confirm('Excluir este programa?');">
              <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">
              <button class="btn btn-outline-danger btn-sm" type="submit">Excluir</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>