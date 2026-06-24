<?php use App\Core\Csrf; ?>
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="ia-card p-4">
      <h1 class="h4 mb-3">Login</h1>
      <form method="post" action="<?= url('login') ?>">
        <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input class="form-control ia-input" type="email" name="email" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Senha</label>
          <input class="form-control ia-input" type="password" name="senha" required>
        </div>
        <button class="btn btn-gold w-100" type="submit">Entrar</button>
      </form>
      <div class="mt-3 small">
        Não tem conta? <a class="link-gold" href="<?= url('cadastro') ?>">Cadastrar</a>
      </div>
    </div>
  </div>
</div>