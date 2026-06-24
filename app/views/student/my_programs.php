<h1 class="h3 mb-3">Meus Programas</h1>

<div class="row g-3">
  <?php foreach (($programs ?? []) as $p): ?>
    <?php
      $img = media_url($p['imagem'] ?? null);
      $fallback = program_placeholder_src();
    ?>
    <div class="col-md-4">
      <div class="ia-card p-3 h-100">
        <img
          src="<?= e($img ?: $fallback) ?>"
          data-fallback="<?= e($fallback) ?>"
          class="ia-program-img mb-2"
          alt="<?= e($p['nome']) ?>"
          loading="lazy"
          referrerpolicy="no-referrer"
          onerror="this.onerror=null;this.src=this.dataset.fallback;"
        >

        <div class="fw-semibold"><?= e($p['nome']) ?></div>

        <p class="text-white-75 small mb-2">
          <?= e((string)($p['descricao'] ?? '')) ?>
        </p>

        <a class="btn btn-outline-gold btn-sm" href="<?= url('programa/' . (int)$p['id']) ?>">
          Abrir
        </a>
      </div>
    </div>
  <?php endforeach; ?>

  <?php if (empty($programs)): ?>
    <div class="col-12">
      <div class="ia-card p-3 text-white-75">
        Você ainda não possui programas cadastrados/matriculados.
      </div>
    </div>
  <?php endif; ?>
</div>