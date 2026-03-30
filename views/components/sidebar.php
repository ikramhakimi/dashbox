<?php

$menu_items      = is_array($menu_items ?? null) ? $menu_items : [];
$filtered_items  = [];
$ui_items_map    = [];

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

$has_users_menu    = false;
$has_people_menu   = false;
$has_products_menu = false;
foreach ($menu_items as $menu_item) {
  $label = isset($menu_item['label']) ? strtolower((string) $menu_item['label']) : '';
  if ($label === 'users') {
    $has_users_menu = true;
  }
  if ($label === 'people') {
    $has_people_menu = true;
  }
  if ($label === 'products') {
    $has_products_menu = true;
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

if (!$has_people_menu) {
  $people_active = '';
  if ($normalized_path === '/people') {
    $people_active = 'people';
  } elseif ($normalized_path === '/people/team-members') {
    $people_active = 'people-team-members';
  } elseif ($normalized_path === '/people/roles-permissions') {
    $people_active = 'people-roles-permissions';
  } elseif ($normalized_path === '/people/invite') {
    $people_active = 'people-invite';
  }

  $menu_items[] = [
    'label'    => 'People',
    'children' => people_sidebar_children($people_active),
  ];
}

if (!$has_products_menu) {
  $products_active = '';
  if ($normalized_path === '/products') {
    $products_active = 'products';
  } elseif ($normalized_path === '/product-add') {
    $products_active = 'product-add';
  }

  $menu_items[] = [
    'label'    => 'Products',
    'children' => products_sidebar_children($products_active),
  ];
}

if (isset($ui_items_map['ui elements'])) {
  $menu_items[] = $ui_items_map['ui elements'];
}

if (isset($ui_items_map['ui patterns'])) {
  $menu_items[] = $ui_items_map['ui patterns'];
}
?>
<aside class="<?= e($component_class) ?> hidden h-screen w-72 shrink-0 lg:fixed lg:left-0 lg:top-0 lg:z-40 lg:block">
  <div class="flex h-full flex-col px-4 py-5">
    <div class="mb-6 border-b border-gray-200 pb-4">
      <a href="<?= e(asset('/')) ?>" class="text-lg font-semibold tracking-tight text-gray-900">Dashing AI</a>
      <p class="mt-1 text-xs text-gray-500">Clean SaaS Admin</p>
    </div>

    <nav class="space-y-2" aria-label="Sidebar menu">
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
              class="sidebar__toggle flex w-full items-center justify-between rounded-lg border border-transparent px-3 py-2 text-sm font-medium text-gray-600 transition hover:border-gray-200 hover:bg-gray-50"
            >
              <span><?= e($menu_item['label'] ?? 'Menu') ?></span>
              <svg
                data-submenu-icon
                class="h-4 w-4 text-gray-400 transition-transform duration-200 <?= $is_open ? 'rotate-180' : '' ?>"
                viewBox="0 0 20 20"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
              >
                <path d="M5 7L10 12L15 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </button>
            <div data-submenu-panel class="mt-2 space-y-0.5 pl-2 <?= $is_open ? '' : 'hidden' ?>">
              <?php foreach ($menu_item['children'] as $child_item): ?>
                <?php $child_active = !empty($child_item['active']); ?>
                <a
                  href="<?= e($child_item['href'] ?? '#') ?>"
                  class="sidebar__link block rounded-lg border px-3 py-1.5 text-sm transition <?= $child_active ? 'sidebar__link--active border-gray-200 bg-gray-100 text-gray-900' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' ?>"
                >
                  <?= e($child_item['label'] ?? 'Item') ?>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php else: ?>
          <a
            href="<?= e($menu_item['href'] ?? '#') ?>"
            class="sidebar__link block rounded-lg border px-3 py-2 text-sm font-medium transition <?= $is_active ? 'sidebar__link--active border-gray-200 bg-gray-100 text-gray-900' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' ?>"
          >
            <?= e($menu_item['label'] ?? 'Item') ?>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>
    </nav>

    <div class="mt-auto rounded-xl border border-gray-200 bg-gray-50 p-4">
      <p class="text-sm font-semibold text-gray-800">Need quick action?</p>
      <p class="mt-1 text-xs text-gray-500">Create report or export data in one click.</p>
      <button class="mt-3 w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100">
        Generate Report
      </button>
    </div>
  </div>
</aside>
