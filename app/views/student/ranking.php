<h1 class="h3 mb-3">Ranking (Top 10)</h1>

<div class="ia-card p-3">
  <table class="table table-dark table-borderless align-middle mb-0">
    <thead>
      <tr>
        <th>#</th>
        <th>Aluno</th>
        <th>XP</th>
        <th>Nível</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach (($top ?? []) as $i => $u): ?>
        <?php $lvl = $xpModel->levelFromXp((int)$u['xp']); ?>
        <tr>
          <td><?= (int)($i + 1) ?></td>
          <td><?= e($u['nome']) ?></td>
          <td class="text-gold fw-semibold"><?= (int)$u['xp'] ?></td>
          <td><?= e($lvl) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>