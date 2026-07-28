<?php
use App\Core\Auth;
use App\Core\Csrf;

// $active é passado pela view (ex: 'dashboard', 'ranking', 'perfil'...)
$active = $active ?? '';

function ia_nav_item(string $key, string $route, string $icon, string $label, string $active, bool $soon = false): void {
  $isActive = $active === $key;
  $classes = 'ia-nav-link' . ($isActive ? ' active' : '') . ($soon ? ' disabled' : '');
  $href = $soon ? '#' : url($route);
  echo '<a class="' . $classes . '" href="' . e($href) . '">';
  echo '<i class="bi ' . e($icon) . '"></i> <span>' . e($label) . '</span>';
  if ($soon) echo '<span class="ia-nav-soon">Em breve</span>';
  echo '</a>';
}
?>
<aside class="ia-sidebar" id="iaSidebar">
  <a class="ia-brand d-block text-decoration-none" href="<?= url('') ?>">
    <span class="text-gold">IMPACT</span> ACADEMY
  </a>

  <nav>
    <?php if (is_admin()): ?>
      <?php ia_nav_item('dashboard', 'admin', 'bi-speedometer2', 'Dashboard', $active); ?>
      <?php ia_nav_item('programs', 'admin/programas', 'bi-collection-play', 'Programas', $active); ?>
    <?php else: ?>
      <?php ia_nav_item('dashboard', 'dashboard', 'bi-speedometer2', 'Dashboard', $active); ?>
      <?php ia_nav_item('programs', 'meus-programas', 'bi-collection-play', 'Programas', $active); ?>
    <?php endif; ?>
    <?php ia_nav_item('ranking', 'ranking', 'bi-bar-chart-steps', 'Ranking', $active); ?>
    <?php ia_nav_item('settings', 'perfil', 'bi-gear', 'Configurações do Perfil', $active); ?>
  </nav>

  <div class="mt-3">
    <form method="post" action="<?= url('logout') ?>">
      <input type="hidden" name="_csrf" value="<?= e(Csrf::token()) ?>">
      <button class="ia-nav-link w-100 text-start border-0 bg-transparent" type="submit" style="cursor:pointer">
        <i class="bi bi-box-arrow-right"></i> <span>Sair</span>
      </button>
    </form>
  </div>
</aside>
