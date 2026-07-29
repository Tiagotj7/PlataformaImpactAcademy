<?php
use App\Core\Csrf;
?>
<h1 class="h3 mb-3">Meu Perfil</h1>

<div class="row g-3">
  <div class="col-lg-5">
    <div class="ia-card p-3">
      <div class="text-white-75 small mb-2">Dados atuais</div>

      <?php if (!empty($profileUser['foto'])): ?>
        <img src="<?= e($profileUser['foto']) ?>" alt="Foto"
             style="width:72px;height:72px;object-fit:cover;border-radius:14px;border:1px solid rgba(212,175,55,.25);">
      <?php else: ?>
        <div class="text-white-75 small">Sem foto</div>
      <?php endif; ?>

      <div class="mt-3">
        <div class="fw-semibold"><?= e($profileUser['nome'] ?? '') ?></div>
        <div class="text-white-75 small"><?= e($profileUser['email'] ?? '') ?></div>
      </div>
    </div>
  </div>

  <div class="col-lg-7">
    <div class="ia-card p-4">
      <form method="post" action="<?= url('perfil') ?>" enctype="multipart/form-data">
        <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">

        <h2 class="h6 text-gold">Editar perfil</h2>

        <div class="mb-3">
          <label class="form-label">Nome</label>
          <input class="form-control ia-input" name="nome" required
                 value="<?= e($profileUser['nome'] ?? '') ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Foto de Perfil</label>
          
          <!-- Opção 1: Upload de Arquivo -->
          <div class="mb-2">
            <label class="small text-white-75">Fazer upload de imagem</label>
            <input type="file" class="form-control ia-input" name="foto_arquivo" accept="image/*">
          </div>

          <div class="text-center my-2">
            <span class="badge bg-dark text-white-50">OU</span>
          </div>

          <!-- Opção 2: URL da Imagem -->
          <div>
            <label class="small text-white-75">Usar link (URL) da imagem</label>
            <input class="form-control ia-input" name="foto"
                   value="<?= e($profileUser['foto'] ?? '') ?>" placeholder="https://exemplo.com/foto.jpg">
          </div>
          
          <div class="form-text text-white-75 mt-2">
            Você pode escolher fazer o upload de um arquivo do seu computador ou colar um link direto para uma imagem.
          </div>
        </div>

        <hr class="border-gold-25">

        <h2 class="h6 text-gold">Alterar senha (opcional)</h2>

        <div class="mb-3">
          <label class="form-label">Senha atual</label>
          <input class="form-control ia-input" type="password" name="senha_atual">
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nova senha</label>
            <input class="form-control ia-input" type="password" name="nova_senha" minlength="6">
          </div>
          <div class="col-md-6">
            <label class="form-label">Confirmar nova senha</label>
            <input class="form-control ia-input" type="password" name="confirmar_senha" minlength="6">
          </div>
        </div>

        <button class="btn btn-gold mt-3" type="submit">Salvar</button>
      </form>
    </div>
  </div>
</div>
