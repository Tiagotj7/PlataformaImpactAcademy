<?php use App\Core\Csrf; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="ia-card p-4">
      <h1 class="h4 mb-3">Cadastro</h1>
      <form method="post" action="<?= url('cadastro') ?>">
        <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">
        <div class="mb-3">
          <label class="form-label">Nome</label>
          <input class="form-control ia-input" type="text" name="nome" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input class="form-control ia-input" type="email" name="email" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Senha (mín. 6)</label>
          <input class="form-control ia-input" type="password" name="senha" minlength="6" required>
        </div>
        <button class="btn btn-gold w-100" type="submit">Criar conta</button>
      </form>
      <div class="mt-3 small">
        Já tem conta? <a class="link-gold" href="<?= url('login') ?>">Entrar</a>
      </div>
    </div>
  </div>
</div>