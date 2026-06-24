<?php
use App\Core\Auth;
use App\Core\Csrf;
?>
<nav class="navbar navbar-expand-lg navbar-dark border-bottom border-gold-25">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= url('') ?>">
      <span class="text-gold">IMPACT</span> Academy
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="<?= url('programas') ?>">Programas</a></li>
        <?php if (Auth::check()): ?>
          <li class="nav-item"><a class="nav-link" href="<?= url('dashboard') ?>">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= url('meus-programas') ?>">Meus Programas</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= url('ranking') ?>">Ranking</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= url('perfil') ?>">Perfil</a></li>
          <?php if (is_admin()): ?>
            <li class="nav-item"><a class="nav-link" href="<?= url('admin') ?>">Admin</a></li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>

      <div class="d-flex gap-2">
        <?php if (!Auth::check()): ?>
          <a class="btn btn-outline-gold" href="<?= url('login') ?>">Entrar</a>
          <a class="btn btn-gold" href="<?= url('cadastro') ?>">Cadastrar</a>
        <?php else: ?>
          <span class="navbar-text small me-2">
            Olá, <?= e(Auth::user()['nome'] ?? '') ?>
          </span>
          <form method="post" action="<?= url('logout') ?>">
            <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">
            <button class="btn btn-outline-gold" type="submit">Sair</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>