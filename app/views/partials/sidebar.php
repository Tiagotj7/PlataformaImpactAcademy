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
      <?php ia_nav_item('admin_dashboard', 'admin', 'bi-speedometer2', 'Painel Administrativo', $active); ?>
      <?php ia_nav_item('admin_programs', 'admin/programas', 'bi-collection-play', 'Programas', $active); ?>
      <?php ia_nav_item('admin_users', 'admin', 'bi-people', 'Usuários', $active, true); ?>
      <?php ia_nav_item('admin_reports', 'admin', 'bi-bar-chart', 'Relatórios', $active, true); ?>
    <?php else: ?>
      <?php ia_nav_item('dashboard', 'dashboard', 'bi-speedometer2', 'Dashboard', $active); ?>
      <?php ia_nav_item('my_programs', 'meus-programas', 'bi-collection-play', 'Meus Programas', $active); ?>
      <?php ia_nav_item('library', 'biblioteca', 'bi-book', 'Biblioteca', $active, true); ?>
      <?php ia_nav_item('game', 'jogo-olimpico', 'bi-trophy', 'Jogo Olímpico', $active, true); ?>
      <?php ia_nav_item('ranking', 'ranking', 'bi-bar-chart-steps', 'Ranking', $active); ?>
      <?php ia_nav_item('events', 'eventos', 'bi-calendar-event', 'Eventos', $active, true); ?>
      <?php ia_nav_item('certificates', 'certificados', 'bi-patch-check', 'Certificados', $active, true); ?>
    <?php endif; ?>
  </nav>

  <hr class="border-gold-25 my-3">

  <nav>
    <?php ia_nav_item('profile', 'perfil', 'bi-person-circle', 'Perfil', $active); ?>
    <?php ia_nav_item('settings', 'perfil', 'bi-gear', 'Configurações', $active, true); ?>
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
