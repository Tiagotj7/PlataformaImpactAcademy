<?php
use App\Core\Auth;

function app_cfg(string $key, $default = null) {
  static $cfg = null;
  if ($cfg === null) $cfg = require __DIR__ . '/../../config/app.php';
  return $cfg[$key] ?? $default;
}

function url(string $path = ''): string
{
  $base = '/' . trim((string)app_cfg('base_path', ''), '/');
  $base = $base === '/' ? '' : $base;

  $path = '/' . trim($path, '/');
  return $base . ($path === '/' ? '' : $path);
}

function e(string $value): string
{
  return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function flash(string $key, ?string $message = null): ?string
{
  if ($message !== null) {
    $_SESSION['_flash'][$key] = $message;
    return null;
  }
  $msg = $_SESSION['_flash'][$key] ?? null;
  unset($_SESSION['_flash'][$key]);
  return $msg;
}

function is_admin(): bool {
  $u = Auth::user();
  return $u && ($u['tipo'] ?? null) === 'admin';
}

/**
 * Placeholder embutido (não depende de arquivo).
 */
function program_placeholder_src(): string
{
  $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="450" viewBox="0 0 800 450">
  <defs>
    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0" stop-color="#0B0B0B"/>
      <stop offset="1" stop-color="#1E1E1E"/>
    </linearGradient>
  </defs>
  <rect width="800" height="450" fill="url(#g)"/>
  <circle cx="120" cy="110" r="80" fill="#D4AF37" opacity="0.12"/>
  <circle cx="680" cy="320" r="140" fill="#D4AF37" opacity="0.08"/>
  <text x="50%" y="52%" text-anchor="middle" dominant-baseline="middle"
        font-family="Arial, Helvetica, sans-serif" font-size="48" fill="#D4AF37" font-weight="700">
    IMPACT
  </text>
  <text x="50%" y="62%" text-anchor="middle" dominant-baseline="middle"
        font-family="Arial, Helvetica, sans-serif" font-size="24" fill="#FFFFFF" opacity="0.85">
    Academy
  </text>
</svg>
SVG;

  return 'data:image/svg+xml;charset=UTF-8,' . rawurlencode($svg);
}

/**
 * Converte o valor de "programas.imagem" em um SRC válido.
 * Aceita:
 * - URL completa (https://...)
 * - caminho interno (assets/... ou uploads/...)
 * - apenas nome do arquivo (ex: capa.jpg) => assume assets/img/programs/capa.jpg
 * Também tenta normalizar links do Google Drive/Dropbox.
 */
function media_url(?string $path): ?string
{
  if (!$path) return null;

  $path = trim($path);
  if ($path === '') return null;

  // Normaliza espaços (evita 404 quando tem espaço no nome)
  $path = str_replace(' ', '%20', $path);

  // URL externa
  if (preg_match('~^https?://~i', $path)) {

    // Google Drive: transforma link em link direto
    if (preg_match('~drive\.google\.com/file/d/([a-zA-Z0-9_-]+)~', $path, $m)) {
      return 'https://drive.google.com/uc?export=view&id=' . $m[1];
    }
    if (preg_match('~drive\.google\.com/(?:open|uc)\?id=([a-zA-Z0-9_-]+)~', $path, $m)) {
      return 'https://drive.google.com/uc?export=view&id=' . $m[1];
    }

    // Dropbox: força link direto
    if (str_contains($path, 'dropbox.com')) {
      $path = preg_replace('~\?dl=0$~', '?raw=1', $path);
      if (!str_contains($path, '?')) $path .= '?raw=1';
      return $path;
    }

    return $path;
  }

  // Caminho interno
  $path = ltrim($path, '/');

  // Se vier só nome do arquivo (ex: capa.jpg), assume assets/img/programs/
  if (!str_contains($path, '/')) {
    return url('assets/img/programs/' . $path);
  }

  return url($path);
}