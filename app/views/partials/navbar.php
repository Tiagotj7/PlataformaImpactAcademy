<?php
use App\Core\Auth;
use App\Core\Csrf;
?>
<nav class="navbar navbar-expand-lg navbar-dark ia-navbar border-bottom border-gold-25">
  <div class="container">
    <a class="navbar-brand ia-brand" href="<?= url('') ?>">
      <span class="text-gold">IMPACT</span> ACADEMY
      <small>Transformando potencial em legado</small>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav mx-lg-auto mb-2 mb-lg-0 gap-lg-1">
        <li class="nav-item"><a class="nav-link" href="<?= url('/') ?>">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= url('') ?>/#programas">Programas</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= url('') ?>/#sobre">Sobre</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= url('') ?>/#depoimentos">Depoimentos</a></li>
        <li class="nav-item"><a class="nav-link" href="<?= url('') ?>/#contato">Contato</a></li>
        <?php if (Auth::check()): ?>
          <li class="nav-item"><a class="nav-link" href="<?= url('dashboard') ?>">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= url('ranking') ?>">Ranking</a></li>
          <?php if (is_admin()): ?>
            <li class="nav-item"><a class="nav-link" href="<?= url('admin') ?>">Admin</a></li>
          <?php endif; ?>
        <?php endif; ?>
      </ul>

      <div class="d-flex gap-2 align-items-center">
        <?php if (!Auth::check()): ?>
          <a class="btn btn-gold btn-sm px-3 rounded-pill" href="<?= url('login') ?>">Entrar</a>
        <?php else: ?>
          <a class="small text-white-75 text-decoration-none me-2" href="<?= url('perfil') ?>">
            Olá, <?= e(Auth::user()['nome'] ?? '') ?>
          </a>
          <form method="post" action="<?= url('logout') ?>">
            <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">
            <button class="btn btn-outline-gold btn-sm rounded-pill" type="submit">Sair</button>
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
