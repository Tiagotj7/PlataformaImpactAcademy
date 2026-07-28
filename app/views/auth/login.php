<?php use App\Core\Csrf; ?>
<div class="row justify-content-center align-items-center g-4" style="min-height:60vh;">
  <div class="col-lg-5 d-none d-lg-block">
    <div class="ia-hero p-4 p-md-5 h-100 d-flex flex-column justify-content-center" data-aos="fade-right">
      <span class="ia-brand mb-3"><span class="text-gold">IMPACT</span> ACADEMY</span>
      <h1 class="h3 mb-3">Bem-vindo de volta.</h1>
      <p class="text-white-75 mb-0">
        Continue sua jornada de liderança e alta performance. Acesse como aluno ou administrador
        com a mesma conta — o sistema te leva direto para o seu painel.
      </p>
    </div>
  </div>

  <div class="col-md-7 col-lg-5">
    <div class="ia-card p-4 p-md-5" data-aos="fade-left">
      <div class="text-center mb-4 d-lg-none">
        <span class="ia-brand"><span class="text-gold">IMPACT</span> ACADEMY</span>
      </div>

      <h1 class="h4 mb-1">Entrar</h1>
      <p class="text-white-75 small mb-4">
        <i class="bi bi-person-check text-gold"></i> Acesso de Aluno ou Administrador
      </p>

      <form method="post" action="<?= url('login') ?>">
        <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">

        <div class="mb-3">
          <label class="form-label small">Email</label>
          <div class="input-group">
            <span class="input-group-text ia-input border-end-0"><i class="bi bi-envelope"></i></span>
            <input class="form-control ia-input border-start-0" type="email" name="email" required autofocus>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label small">Senha</label>
          <div class="input-group">
            <span class="input-group-text ia-input border-end-0"><i class="bi bi-lock"></i></span>
            <input class="form-control ia-input border-start-0" type="password" name="senha" required>
          </div>
        </div>

        <button class="btn btn-gold w-100 rounded-pill py-2 mt-2" type="submit">
          Entrar <i class="bi bi-arrow-right"></i>
        </button>
      </form>

      <div class="mt-4 text-center small text-white-75">
        Não tem conta? <a class="link-gold" href="<?= url('cadastro') ?>">Cadastre-se</a>
      </div>
    </div>
  </div>
</div>
