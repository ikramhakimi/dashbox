<?php

$menu_items      = is_array($menu_items ?? null) ? $menu_items : [];
$filtered_items  = [];
$ui_items_map    = [];
$menu_icons      = [
  'overview'    => 'home-5-fill',
  'users'       => 'user-3-line',
  'packages'    => 'shopping-bag-3-line',
  'products'    => 'shopping-bag-3-line',
  'portfolio'   => 'image-2-line',
  'orders'      => 'file-list-3-line',
  'sales'       => 'bar-chart-2-line',
  'ui elements' => 'apps-2-line',
  'ui patterns' => 'palette-line',
  'settings'    => 'settings-3-line',
];

foreach ($menu_items as $menu_item) {
  $raw_label = isset($menu_item['label']) ? (string) $menu_item['label'] : '';
  $label     = strtolower($raw_label);

  if (in_array($label, ['analytics', 'projects', 'settings'], true)) {
    continue;
  }

  if ($label === 'ui elements') {
    $ui_items_map['ui elements'] = $menu_item;
    continue;
  }

  if ($label === 'ui patterns') {
    $ui_items_map['ui patterns'] = $menu_item;
    continue;
  }

  $filtered_items[] = $menu_item;
}

$menu_items = $filtered_items;

$request_uri    = isset($_SERVER['REQUEST_URI']) ? (string) $_SERVER['REQUEST_URI'] : '';
$request_path   = (string) parse_url($request_uri, PHP_URL_PATH);
$normalized_path = '/' . trim($request_path, '/');

if (defined('BASE_PATH') && BASE_PATH !== '' && strpos($normalized_path, BASE_PATH) === 0) {
  $normalized_path = substr($normalized_path, strlen(BASE_PATH));
  $normalized_path = '/' . ltrim((string) $normalized_path, '/');
}

$has_users_menu     = false;
$has_packages_menu  = false;
$has_portfolio_menu = false;
$has_sales_menu     = false;
$has_orders_menu    = false;
foreach ($menu_items as $menu_item) {
  $label = isset($menu_item['label']) ? strtolower((string) $menu_item['label']) : '';
  if ($label === 'users') {
    $has_users_menu = true;
  }
  if ($label === 'packages' || $label === 'products') {
    $has_packages_menu = true;
  }
  if ($label === 'portfolio') {
    $has_portfolio_menu = true;
  }
  if ($label === 'sales') {
    $has_sales_menu = true;
  }
  if ($label === 'orders') {
    $has_orders_menu = true;
  }
}

if (!$has_users_menu) {
  $menu_items[] = [
    'label'    => 'Users',
    'children' => users_sidebar_children(
      $normalized_path === '/users/create' ? 'users-create' : ($normalized_path === '/users' ? 'users' : ''),
    ),
  ];
}

if (!$has_packages_menu) {
  $packages_active = '';
  if ($normalized_path === '/packages' || $normalized_path === '/products') {
    $packages_active = 'packages';
  } elseif (
    $normalized_path === '/packages/create' ||
    $normalized_path === '/products/add'
  ) {
    $packages_active = 'packages-create';
  }

  $menu_items[] = [
    'label'    => 'Packages',
    'children' => packages_sidebar_children($packages_active),
  ];
}

if (!$has_portfolio_menu) {
  $portfolio_active = '';
  if ($normalized_path === '/portfolio') {
    $portfolio_active = 'portfolio';
  } elseif ($normalized_path === '/portfolio/create') {
    $portfolio_active = 'portfolio-create';
  } elseif ($normalized_path === '/portfolio/trashed') {
    $portfolio_active = 'portfolio-trashed';
  }

  $portfolio_menu = [
    'label'    => 'Portfolio',
    'children' => portfolio_sidebar_children($portfolio_active),
  ];

  $packages_index = null;
  foreach ($menu_items as $index => $menu_item) {
    $label = isset($menu_item['label']) ? strtolower((string) $menu_item['label']) : '';
    if ($label === 'packages' || $label === 'products') {
      $packages_index = $index;
      break;
    }
  }

  if ($packages_index === null) {
    $menu_items[] = $portfolio_menu;
  } else {
    array_splice($menu_items, $packages_index + 1, 0, [$portfolio_menu]);
  }
}

if (!$has_orders_menu) {
  $orders_active = '';
  if ($normalized_path === '/orders') {
    $orders_active = 'orders';
  } elseif ($normalized_path === '/orders/unpaid') {
    $orders_active = 'orders-unpaid';
  } elseif ($normalized_path === '/orders/sessions-today') {
    $orders_active = 'orders-session-today';
  }

  $menu_items[] = [
    'label'    => 'Orders',
    'children' => orders_sidebar_children($orders_active),
  ];
}

if (!$has_sales_menu) {
  $sales_active = '';
  if ($normalized_path === '/sales') {
    $sales_active = 'sales';
  } elseif ($normalized_path === '/sales/calendar') {
    $sales_active = 'sales-calendar';
  }

  $sales_menu = [
    'label'    => 'Sales',
    'children' => sales_sidebar_children($sales_active),
  ];

  $orders_index = null;
  foreach ($menu_items as $index => $menu_item) {
    $label = isset($menu_item['label']) ? strtolower((string) $menu_item['label']) : '';
    if ($label === 'orders') {
      $orders_index = $index;
      break;
    }
  }

  if ($orders_index === null) {
    $menu_items[] = $sales_menu;
  } else {
    array_splice($menu_items, $orders_index, 0, [$sales_menu]);
  }
}

$menu_order_map = [
  'overview'  => 10,
  'sales'     => 20,
  'orders'    => 30,
  'packages'  => 40,
  'products'  => 40,
  'portfolio' => 50,
  'users'     => 60,
];

usort($menu_items, static function (array $left_item, array $right_item) use ($menu_order_map): int {
  $left_label  = strtolower((string) ($left_item['label'] ?? ''));
  $right_label = strtolower((string) ($right_item['label'] ?? ''));

  $left_order  = isset($menu_order_map[$left_label]) ? (int) $menu_order_map[$left_label] : 999;
  $right_order = isset($menu_order_map[$right_label]) ? (int) $menu_order_map[$right_label] : 999;

  if ($left_order === $right_order) {
    return strcmp($left_label, $right_label);
  }

  return $left_order <=> $right_order;
});

if (isset($ui_items_map['ui elements'])) {
  $ui_items_map['ui elements']['is_design_group'] = true;
}

if (isset($ui_items_map['ui patterns'])) {
  $ui_items_map['ui patterns']['is_design_group'] = true;
}

$design_group_items = [];
if (isset($ui_items_map['ui elements']) && is_array($ui_items_map['ui elements'])) {
  $design_group_items[] = $ui_items_map['ui elements'];
}
if (isset($ui_items_map['ui patterns']) && is_array($ui_items_map['ui patterns'])) {
  $design_group_items[] = $ui_items_map['ui patterns'];
}
?>
<aside class="<?= e($component_class) ?> hidden h-screen w-72 shrink-0 overflow-y-auto lg:fixed lg:left-0 lg:top-0 lg:z-40 lg:block">
  <div class="flex min-h-full flex-col px-1 py-5">
    <div class="mb-6 border-b border-gray-200 pb-4">
      <a href="<?= e(asset('/')) ?>" class="type-h3">Dashing AI</a>
      <p class="mt-1 type-small text-muted">Clean SaaS Admin</p>
    </div>

    <nav aria-label="Sidebar menu">
      <?php foreach ($menu_items as $menu_item): ?>
        <?php
        $is_collapsible   = !empty($menu_item['children']) && is_array($menu_item['children']);
        $is_active        = !empty($menu_item['active']);
        $menu_label       = isset($menu_item['label']) ? (string) $menu_item['label'] : '';
        $child_is_active  = false;

        if ($is_collapsible) {
          foreach ($menu_item['children'] as $child_item) {
            if (!empty($child_item['active'])) {
              $child_is_active = true;
              break;
            }
          }
        }

        $is_open     = $child_is_active;
        $submenu_key = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $menu_label), '-'));
        $icon_key    = strtolower(trim($menu_label));
        $menu_icon   = isset($menu_icons[$icon_key]) ? $menu_icons[$icon_key] : 'layout-grid-line';
        ?>

        <?php if ($is_collapsible): ?>
          <div
            data-submenu
            data-submenu-key="<?= e($submenu_key !== '' ? $submenu_key : 'menu') ?>"
            data-submenu-default-open="<?= $is_open ? 'true' : 'false' ?>"
          >
            <button
              type="button"
              data-submenu-trigger
              aria-expanded="<?= $is_open ? 'true' : 'false' ?>"
              class="sidebar__toggle flex w-full items-center justify-between rounded-lg border border-transparent px-3 py-2 type-medium text-body transition hover:border-gray-200 hover:bg-gray-50"
            >
              <span class="flex items-center gap-2">
                <?php component('icon', ['icon_name' => $menu_icon, 'icon_size' => 20, 'icon_set' => 'remix']); ?>
                <span><?= e($menu_item['label'] ?? 'Menu') ?></span>
              </span>
              <svg
                data-submenu-icon
                class="h-4 w-4 icon-muted transition-transform duration-200 <?= $is_open ? 'rotate-180' : '' ?>"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
              >
                <path d="M5 7L10 12L15 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </button>
            <div data-submenu-panel class="my-1 pl-10 <?= $is_open ? '' : 'hidden' ?>">
              <?php foreach ($menu_item['children'] as $child_item): ?>
                <?php $child_active = !empty($child_item['active']); ?>
                <a
                  href="<?= e($child_item['href'] ?? '#') ?>"
                  class="sidebar__link block py-1 type-normal transition <?= $child_active ? 'sidebar__link--active text-link' : 'text-secondary hover-text-link' ?>"
                >
                  <?= e($child_item['label'] ?? 'Item') ?>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php else: ?>
          <?php
          $icon_key  = strtolower(trim($menu_label));
          $menu_icon = isset($menu_icons[$icon_key]) ? $menu_icons[$icon_key] : 'layout-grid-line';
          ?>
          <a
            href="<?= e($menu_item['href'] ?? '#') ?>"
            class="sidebar__link flex items-center gap-2 rounded-lg border px-3 py-2 type-medium transition <?= $is_active ? 'sidebar__link--active border-gray-200 bg-gray-100 text-dark' : 'border-transparent text-body hover:border-gray-200 hover:bg-gray-50 hover-text-dark' ?>"
          >
            <?php component('icon', ['icon_name' => $menu_icon, 'icon_size' => 20, 'icon_set' => 'remix']); ?>
            <span><?= e($menu_item['label'] ?? 'Item') ?></span>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>

      <?php if ($design_group_items !== []): ?>
        <div class="mt-3">
          <p class="px-3 py-2 type-caption">Design</p>
          <?php foreach ($design_group_items as $menu_item): ?>
            <?php
            $is_collapsible   = !empty($menu_item['children']) && is_array($menu_item['children']);
            $menu_label       = isset($menu_item['label']) ? (string) $menu_item['label'] : '';
            $child_is_active  = false;

            if ($is_collapsible) {
              foreach ($menu_item['children'] as $child_item) {
                if (!empty($child_item['active'])) {
                  $child_is_active = true;
                  break;
                }
              }
            }

            $is_open     = $child_is_active;
            $submenu_key = strtolower(trim(preg_replace('/[^a-z0-9]+/i', '-', $menu_label), '-'));
            $icon_key    = strtolower(trim($menu_label));
            $menu_icon   = isset($menu_icons[$icon_key]) ? $menu_icons[$icon_key] : 'layout-grid-line';
            ?>

            <?php if ($is_collapsible): ?>
              <div
                data-submenu
                data-submenu-key="<?= e($submenu_key !== '' ? $submenu_key : 'menu') ?>"
                data-submenu-default-open="<?= $is_open ? 'true' : 'false' ?>"
              >
                <button
                  type="button"
                  data-submenu-trigger
                  aria-expanded="<?= $is_open ? 'true' : 'false' ?>"
                  class="sidebar__toggle flex w-full items-center justify-between rounded-lg border border-transparent px-3 py-2 type-medium text-body transition hover:border-gray-200 hover:bg-gray-50"
                >
                  <span class="flex items-center gap-2">
                    <?php component('icon', ['icon_name' => $menu_icon, 'icon_size' => 20, 'icon_set' => 'remix']); ?>
                    <span><?= e($menu_item['label'] ?? 'Menu') ?></span>
                  </span>
                  <svg
                    data-submenu-icon
                    class="h-4 w-4 icon-muted transition-transform duration-200 <?= $is_open ? 'rotate-180' : '' ?>"
                    viewBox="0 0 20 20"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                  >
                    <path d="M5 7L10 12L15 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
                </button>
                <div data-submenu-panel class="my-1 pl-10 <?= $is_open ? '' : 'hidden' ?>">
                  <?php foreach ($menu_item['children'] as $child_item): ?>
                    <?php $child_active = !empty($child_item['active']); ?>
                    <a
                      href="<?= e($child_item['href'] ?? '#') ?>"
                      class="sidebar__link block py-1 type-normal transition <?= $child_active ? 'sidebar__link--active text-link' : 'text-secondary hover-text-link' ?>"
                    >
                      <?= e($child_item['label'] ?? 'Item') ?>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </nav>
  </div>
</aside>
