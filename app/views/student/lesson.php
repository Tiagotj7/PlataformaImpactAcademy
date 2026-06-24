<?php
use App\Core\Csrf;

function youtube_embed_url(?string $url): ?string {
  if (!$url) return null;

  // Aceita URL completa ou ID
  if (preg_match('~^[a-zA-Z0-9_-]{11}$~', $url)) {
    return "https://www.youtube.com/embed/" . $url;
  }

  // Extrai v=ID
  if (preg_match('~v=([a-zA-Z0-9_-]{11})~', $url, $m)) {
    return "https://www.youtube.com/embed/" . $m[1];
  }

  // youtu.be/ID
  if (preg_match('~youtu\.be/([a-zA-Z0-9_-]{11})~', $url, $m)) {
    return "https://www.youtube.com/embed/" . $m[1];
  }

  return null;
}
$embed = youtube_embed_url($lesson['video_url'] ?? null);
?>
<div class="d-flex justify-content-between align-items-start gap-3">
  <div>
    <h1 class="h3 mb-1"><?= e($lesson['titulo']) ?></h1>
    <p class="text-white-75 mb-3"><?= e((string)($lesson['descricao'] ?? '')) ?></p>
  </div>

  <form method="post" action="<?= url('aula/' . (int)$lesson['id'] . '/concluir') ?>">
    <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">
    <button class="btn <?= $completed ? 'btn-outline-gold' : 'btn-gold' ?>" type="submit">
      <?= $completed ? 'Já concluída' : 'Concluir aula (+10 XP)' ?>
    </button>
  </form>
</div>

<?php if ($embed): ?>
  <div class="ratio ratio-16x9 ia-card overflow-hidden mb-3">
    <iframe src="<?= e($embed) ?>" title="YouTube video" allowfullscreen></iframe>
  </div>
<?php else: ?>
  <div class="ia-card p-3 mb-3 text-white-75">Vídeo não configurado.</div>
<?php endif; ?>

<?php if (!empty($lesson['texto'])): ?>
  <div class="ia-card p-3 mb-3">
    <h2 class="h6 text-gold">Texto complementar</h2>
    <div class="text-white-75"><?= nl2br(e((string)$lesson['texto'])) ?></div>
  </div>
<?php endif; ?>

<?php if (!empty($lesson['pdf'])): ?>
  <div class="ia-card p-3">
    <h2 class="h6 text-gold">Material</h2>
    <a class="btn btn-outline-gold btn-sm" href="<?= e($lesson['pdf']) ?>" target="_blank" rel="noopener">
      Abrir PDF
    </a>
  </div>
<?php endif; ?>