<?php use App\Core\Csrf; ?>
<div class="row justify-content-center align-items-center g-4" style="min-height:60vh;">
  <div class="col-lg-5 d-none d-lg-block">
    <div class="ia-hero p-4 p-md-5 h-100 d-flex flex-column justify-content-center" data-aos="fade-right">
      <span class="ia-brand mb-3"><span class="text-gold">IMPACT</span> ACADEMY</span>
      <h1 class="h3 mb-3">Comece sua jornada.</h1>
      <p class="text-white-75 mb-4">
        Crie sua conta gratuita e comece a ganhar XP, subir no ranking e desbloquear conquistas
        enquanto desenvolve sua liderança.
      </p>
      <div class="d-flex gap-4">
        <div class="ia-badge-pill"><span class="ia-badge-icon"><i class="bi bi-flag"></i></span>Liderança</div>
        <div class="ia-badge-pill"><span class="ia-badge-icon"><i class="bi bi-lightning-charge"></i></span>Performance</div>
        <div class="ia-badge-pill"><span class="ia-badge-icon"><i class="bi bi-trophy"></i></span>Gamificação</div>
      </div>
    </div>
  </div>

  <div class="col-md-7 col-lg-5">
    <div class="ia-card p-4 p-md-5" data-aos="fade-left">
      <div class="text-center mb-4 d-lg-none">
        <span class="ia-brand"><span class="text-gold">IMPACT</span> ACADEMY</span>
      </div>

      <h1 class="h4 mb-1">Criar conta</h1>
      <p class="text-white-75 small mb-4">Toda conta nova entra como aluno.</p>

      <form method="post" action="<?= url('cadastro') ?>">
        <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">

        <div class="mb-3">
          <label class="form-label small">Nome</label>
          <div class="input-group">
            <span class="input-group-text ia-input border-end-0"><i class="bi bi-person"></i></span>
            <input class="form-control ia-input border-start-0" type="text" name="nome" required autofocus>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label small">Email</label>
          <div class="input-group">
            <span class="input-group-text ia-input border-end-0"><i class="bi bi-envelope"></i></span>
            <input class="form-control ia-input border-start-0" type="email" name="email" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label small">Senha (mín. 6 caracteres)</label>
          <div class="input-group">
            <span class="input-group-text ia-input border-end-0"><i class="bi bi-lock"></i></span>
            <input class="form-control ia-input border-start-0" type="password" name="senha" minlength="6" required>
          </div>
        </div>

        <button class="btn btn-gold w-100 rounded-pill py-2 mt-2" type="submit">
          Criar minha conta <i class="bi bi-arrow-right"></i>
        </button>
      </form>

      <div class="mt-4 text-center small text-white-75">
        Já tem conta? <a class="link-gold" href="<?= url('login') ?>">Entrar</a>
      </div>
    </div>
  </div>
</div>
