<div class="ia-hero p-4 p-md-5" data-aos="fade-up">
  <div class="row align-items-center g-4 g-md-5">
    <div class="col-lg-7">
      <h1 class="mb-3">
        Desenvolva sua <span class="text-gold">liderança.</span><br>
        Alcance <span class="text-gold">alta performance.</span><br>
        Construa seu <span class="text-gold">legado.</span>
      </h1>
      <p class="text-white-75 mb-4" style="max-width:520px;">
        A Impact Academy é a escola de líderes que desenvolve pessoas extraordinárias e prepara
        você para gerar impacto real no mundo.
      </p>
      <div class="d-flex flex-wrap gap-2 mb-4">
        <a href="<?= url('programas') ?>" class="btn btn-gold px-4 rounded-pill">Conheça os Programas</a>
        <a href="#sobre" class="btn btn-outline-gold px-4 rounded-pill">
          <i class="bi bi-play-circle"></i> Assista ao Vídeo
        </a>
      </div>

      <div class="d-flex flex-wrap gap-4">
        <div class="ia-badge-pill"><span class="ia-badge-icon"><i class="bi bi-flag"></i></span>Liderança</div>
        <div class="ia-badge-pill"><span class="ia-badge-icon"><i class="bi bi-lightning-charge"></i></span>Alta Performance</div>
        <div class="ia-badge-pill"><span class="ia-badge-icon"><i class="bi bi-graph-up-arrow"></i></span>Crescimento</div>
        <div class="ia-badge-pill"><span class="ia-badge-icon"><i class="bi bi-compass"></i></span>Propósito</div>
        <div class="ia-badge-pill"><span class="ia-badge-icon"><i class="bi bi-globe"></i></span>Impacto</div>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="ia-hero-photo">
        <img
          src="<?= url('assets/images/logo.png') ?>"
          alt="Impact Academy"
          class="ia-hero-logo"
          onerror="this.remove(); document.getElementById('iaHeroFallbackIcon').style.display='block';"
        >
        <i class="bi bi-people" id="iaHeroFallbackIcon" style="display:none;"></i>
      </div>
      <!-- A imagem vem de public/assets/images/logo.png. Se o arquivo não existir, cai no ícone. -->
    </div>
  </div>
</div>

<!-- ================= PROGRAMAS ================= -->
<div class="text-center mt-5 mb-4" id="programas">
  <h2 class="h3 mb-1">Nossos Programas</h2>
  <p class="text-white-75">Escolha o caminho da sua transformação</p>
</div>

<div class="row g-3">
  <?php foreach (($programs ?? []) as $p): ?>
    <?php
      $img = media_url($p['imagem'] ?? null);
      $fallback = program_placeholder_src();
    ?>
    <div class="col-md-4 col-lg-3">
      <div class="ia-card p-3 h-100" data-aos="fade-up">
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
      <div class="ia-card p-3 text-white-75 text-center">
        Nenhum programa ativo cadastrado ainda. Cadastre o primeiro pelo painel administrativo.
      </div>
    </div>
  <?php endif; ?>
</div>

<!-- ================= ESTATÍSTICAS ================= -->
<div class="ia-card p-4 mt-5" data-aos="fade-up">
  <div class="row text-center g-4">
    <div class="col-6 col-md-3">
      <div class="ia-stat"><div class="num" data-count-to="10000">0</div><div class="label">Alunos transformados</div></div>
    </div>
    <div class="col-6 col-md-3">
      <div class="ia-stat"><div class="num" data-count-to="500">0</div><div class="label">Empresas impactadas</div></div>
    </div>
    <div class="col-6 col-md-3">
      <div class="ia-stat"><div class="num" data-count-to="200">0</div><div class="label">Eventos realizados</div></div>
    </div>
    <div class="col-6 col-md-3">
      <div class="ia-stat"><div class="num" data-count-to="50">0</div><div class="label">Palestrantes</div></div>
    </div>
  </div>
</div>

<!-- ================= JOGO OLÍMPICO ================= -->
<div class="ia-card p-4 p-md-5 mt-5" data-aos="fade-up">
  <h2 class="h4 mb-1"><i class="bi bi-trophy text-gold"></i> Jogo Olímpico</h2>
  <p class="text-white-75 mb-4">Transforme seu desenvolvimento em uma jornada épica.</p>

  <div class="d-flex flex-wrap align-items-start justify-content-between gap-2">
    <div class="ia-xp-step">
      <div class="ic"><i class="bi bi-play-fill"></i></div>
      <div class="lbl">Assistir aula</div><div class="pts">+10 XP</div>
    </div>
    <div class="ia-xp-arrow d-none d-md-block"><i class="bi bi-arrow-right"></i></div>
    <div class="ia-xp-step">
      <div class="ic"><i class="bi bi-collection"></i></div>
      <div class="lbl">Concluir módulo</div><div class="pts">+50 XP</div>
    </div>
    <div class="ia-xp-arrow d-none d-md-block"><i class="bi bi-arrow-right"></i></div>
    <div class="ia-xp-step">
      <div class="ic"><i class="bi bi-award"></i></div>
      <div class="lbl">Concluir programa</div><div class="pts">+200 XP</div>
    </div>
    <div class="ia-xp-arrow d-none d-md-block"><i class="bi bi-arrow-right"></i></div>
    <div class="ia-xp-step">
      <div class="ic"><i class="bi bi-calendar-event"></i></div>
      <div class="lbl">Participar de evento</div><div class="pts">+100 XP</div>
    </div>
    <div class="ia-xp-arrow d-none d-md-block"><i class="bi bi-arrow-right"></i></div>
    <div class="ia-xp-step">
      <div class="ic"><i class="bi bi-send"></i></div>
      <div class="lbl">Enviar atividade</div><div class="pts">+25 XP</div>
    </div>
  </div>
</div>

<!-- ================= SOBRE ================= -->
<div class="row g-4 mt-5" id="sobre">
  <div class="col-lg-6">
    <h2 class="h4 mb-2">Sobre a Impact Academy</h2>
    <p class="text-white-75">
      Somos uma escola de desenvolvimento humano, liderança e alta performance. Unimos conteúdo
      prático, mentoria e uma jornada gamificada para transformar potencial em resultado real —
      dentro e fora das empresas.
    </p>
  </div>
  <div class="col-lg-6">
    <div class="ia-card p-4 h-100">
      <h3 class="h6 text-gold mb-2">Nossa missão</h3>
      <p class="text-white-75 small mb-0">
        Formar líderes que constroem legado através de disciplina, propósito e impacto coletivo.
      </p>
    </div>
  </div>
</div>

<!-- ================= DEPOIMENTOS ================= -->
<div class="mt-5" id="depoimentos">
  <h2 class="h4 text-center mb-4">O que dizem nossos alunos</h2>
  <div class="row g-3">
    <div class="col-md-4">
      <div class="ia-card p-4 h-100" data-aos="fade-up">
        <p class="text-white-75 small mb-3">"A Impact Academy mudou a forma como eu lidero minha equipe. Disciplina virou hábito."</p>
        <strong class="small">Ana Oliveira</strong>
      </div>
    </div>
    <div class="col-md-4">
      <div class="ia-card p-4 h-100" data-aos="fade-up">
        <p class="text-white-75 small mb-3">"A jornada gamificada me manteve engajado do início ao fim. Recomendo demais."</p>
        <strong class="small">Pedro Santos</strong>
      </div>
    </div>
    <div class="col-md-4">
      <div class="ia-card p-4 h-100" data-aos="fade-up">
        <p class="text-white-75 small mb-3">"Conteúdo denso e aplicável. Vi resultado na minha performance em poucas semanas."</p>
        <strong class="small">Maria Silva</strong>
      </div>
    </div>
  </div>
</div>

<!-- ================= CONTATO ================= -->
<div class="ia-card p-4 p-md-5 mt-5 text-center" id="contato" data-aos="fade-up">
  <h2 class="h4 mb-2">Pronto para construir seu legado?</h2>
  <p class="text-white-75 mb-4">Fale com a gente ou comece agora mesmo o seu cadastro.</p>
  <div class="d-flex justify-content-center gap-2 flex-wrap">
    <a href="<?= url('cadastro') ?>" class="btn btn-gold px-4 rounded-pill">Criar minha conta</a>
    <a href="mailto:contato@impactacademy.com" class="btn btn-outline-gold px-4 rounded-pill">
      <i class="bi bi-envelope"></i> contato@impactacademy.com
    </a>
  </div>
</div>
