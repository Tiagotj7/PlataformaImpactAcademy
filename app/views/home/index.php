<div class="p-4 p-md-5 rounded ia-card" data-aos="fade-up">
  <h1 class="display-6 fw-bold">
    Desenvolva sua liderança. Alcance alta performance.
    <span class="text-gold">Construa seu legado.</span>
  </h1>
  <p class="text-white-75 mt-3 mb-0">
    Plataforma web de desenvolvimento humano, liderança e performance.
  </p>
</div>

<h2 class="h4 mt-4">Programas em destaque</h2>

<div class="row g-3 mt-1">
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

        <div class="d-flex justify-content-between align-items-start">
          <h3 class="h6 mb-2"><?= e($p['nome']) ?></h3>
          <span class="badge text-bg-dark border border-gold-25"><?= e($p['status']) ?></span>
        </div>

        <p class="text-white-75 small">
          <?= e((string)($p['descricao'] ?? '')) ?>
        </p>

        <a class="btn btn-outline-gold btn-sm" href="<?= url('programa/' . (int)$p['id']) ?>">
          Ver conteúdo
        </a>
      </div>
    </div>
  <?php endforeach; ?>

  <?php if (empty($programs)): ?>
    <div class="col-12">
      <div class="ia-card p-3 text-white-75">
        Nenhum programa ativo cadastrado.
      </div>
    </div>
  <?php endif; ?>
</div>