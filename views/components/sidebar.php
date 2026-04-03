<?php

$menu_items      = is_array($menu_items ?? null) ? $menu_items : [];
$filtered_items  = [];
$ui_items_map    = [];
$menu_icons      = [
  'overview'    => 'home-6-line',
  'users'       => 'user-3-line',
  'customers'   => 'group-line',
  'packages'    => 'box-2-line',
  'products'    => 'shopping-bag-3-line',
  'portfolio'   => 'image-2-line',
  'orders'      => 'file-list-2-line',
  'feedback'    => 'chat-smile-3-line',
  'sales'       => 'bar-chart-2-line',
  'analytics'   => 'line-chart-line',
  'website'     => 'global-line',
  'payment gateway' => 'bank-card-line',
  'ui components' => 'layers',
  'ui elements' => 'apps-2-line',
  'ui patterns' => 'layout-grid',
  'settings'    => 'settings-3-line',
];

foreach ($menu_items as $menu_item) {
  $raw_label = isset($menu_item['label']) ? (string) $menu_item['label'] : '';
  $label     = strtolower($raw_label);

  if (in_array($label, ['analytics', 'projects', 'settings'], true)) {
    continue;
  }

  if ($label === 'ui components' || $label === 'ui elements') {
    $ui_items_map['ui components'] = $menu_item;
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
$has_customers_menu = false;
$has_packages_menu  = false;
$has_portfolio_menu = false;
$has_feedback_menu  = false;
$has_sales_menu     = false;
$has_analytics_menu = false;
$has_orders_menu    = false;
$has_website_menu   = false;
$has_payment_gateway_menu = false;
foreach ($menu_items as $menu_item) {
  $label = isset($menu_item['label']) ? strtolower((string) $menu_item['label']) : '';
  if ($label === 'users') {
    $has_users_menu = true;
  }
  if ($label === 'customers') {
    $has_customers_menu = true;
  }
  if ($label === 'packages' || $label === 'products') {
    $has_packages_menu = true;
  }
  if ($label === 'portfolio') {
    $has_portfolio_menu = true;
  }
  if ($label === 'feedback') {
    $has_feedback_menu = true;
  }
  if ($label === 'sales') {
    $has_sales_menu = true;
  }
  if ($label === 'analytics') {
    $has_analytics_menu = true;
  }
  if ($label === 'orders') {
    $has_orders_menu = true;
  }
  if ($label === 'website') {
    $has_website_menu = true;
  }
  if ($label === 'payment gateway') {
    $has_payment_gateway_menu = true;
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

if (!$has_customers_menu) {
  $customers_active = '';
  if ($normalized_path === '/customers') {
    $customers_active = 'customers';
  } elseif ($normalized_path === '/customers/segments') {
    $customers_active = 'customers-segments';
  } elseif ($normalized_path === '/customers/profile') {
    $customers_active = 'customers-profile';
  }

  $customers_menu = [
    'label'    => 'Customers',
    'children' => customers_sidebar_children($customers_active),
  ];

  $users_index = null;
  foreach ($menu_items as $index => $menu_item) {
    $label = isset($menu_item['label']) ? strtolower((string) $menu_item['label']) : '';
    if ($label === 'users') {
      $users_index = $index;
      break;
    }
  }

  if ($users_index === null) {
    $menu_items[] = $customers_menu;
  } else {
    array_splice($menu_items, $users_index, 0, [$customers_menu]);
  }
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

if (!$has_feedback_menu) {
  $menu_items[] = [
    'label'  => 'Feedback',
    'href'   => asset('/feedback'),
    'active' => $normalized_path === '/feedback',
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

if (!$has_analytics_menu) {
  $analytics_active = '';
  if ($normalized_path === '/analytics' || $normalized_path === '/analytics/enhanced') {
    $analytics_active = 'analytics-overview';
  } elseif ($normalized_path === '/analytics/pageviews') {
    $analytics_active = 'analytics-pageviews';
  } elseif ($normalized_path === '/analytics/sources') {
    $analytics_active = 'analytics-sources';
  } elseif ($normalized_path === '/analytics/campaigns') {
    $analytics_active = 'analytics-campaigns';
  } elseif ($normalized_path === '/analytics/clicks') {
    $analytics_active = 'analytics-clicks';
  }

  $analytics_menu = [
    'label'    => 'Analytics',
    'children' => analytics_sidebar_children($analytics_active),
  ];

  $sales_index = null;
  foreach ($menu_items as $index => $menu_item) {
    $label = isset($menu_item['label']) ? strtolower((string) $menu_item['label']) : '';
    if ($label === 'sales') {
      $sales_index = $index;
      break;
    }
  }

  if ($sales_index === null) {
    $menu_items[] = $analytics_menu;
  } else {
    array_splice($menu_items, $sales_index + 1, 0, [$analytics_menu]);
  }
}

if (!$has_website_menu) {
  $website_active = '';
  if ($normalized_path === '/website/settings') {
    $website_active = 'website-settings';
  } elseif ($normalized_path === '/website/content') {
    $website_active = 'website-content';
  }

  $menu_items[] = [
    'label'    => 'Website',
    'children' => website_sidebar_children($website_active),
  ];
}

if (!$has_payment_gateway_menu) {
  $menu_items[] = [
    'label'  => 'Payment Gateway',
    'href'   => asset('/payment-gateway'),
    'active' => $normalized_path === '/payment-gateway',
  ];
}

$menu_order_map = [
  'overview'  => 10,
  'sales'     => 20,
  'analytics' => 25,
  'orders'    => 30,
  'feedback'  => 61,
  'packages'  => 40,
  'products'  => 40,
  'portfolio' => 50,
  'customers' => 60,
  'users'     => 70,
  'website'   => 80,
  'payment gateway' => 90,
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

if (isset($ui_items_map['ui components'])) {
  $ui_items_map['ui components']['is_design_group'] = true;
}

if (isset($ui_items_map['ui patterns'])) {
  $ui_items_map['ui patterns']['is_design_group'] = true;
}

$design_group_items = [];
if (isset($ui_items_map['ui components']) && is_array($ui_items_map['ui components'])) {
  $design_group_items[] = $ui_items_map['ui components'];
}
if (isset($ui_items_map['ui patterns']) && is_array($ui_items_map['ui patterns'])) {
  $design_group_items[] = $ui_items_map['ui patterns'];
}

$setup_group_order = ['website', 'packages', 'portfolio', 'payment gateway', 'users'];
$setup_group_map   = [];
$primary_menu_items = [];
foreach ($menu_items as $menu_item) {
  $menu_label_key = strtolower((string) ($menu_item['label'] ?? ''));
  if ($menu_label_key === 'products') {
    $menu_label_key = 'packages';
  }
  if (in_array($menu_label_key, $setup_group_order, true)) {
    $setup_group_map[$menu_label_key] = $menu_item;
    continue;
  }
  $primary_menu_items[] = $menu_item;
}

$setup_group_items = [];
foreach ($setup_group_order as $setup_group_label) {
  if (isset($setup_group_map[$setup_group_label]) && is_array($setup_group_map[$setup_group_label])) {
    $setup_group_items[] = $setup_group_map[$setup_group_label];
  }
}
?>
<aside class="app-sidebar">
  <div class="app-sidebar__inner">
    <div class="mb-6 border-b border-gray-200 pb-4">
      <a href="<?= e(asset('/')) ?>" class="type-h3">Dashing AI</a>
      <p class="mt-1 type-small text-muted">Clean SaaS Admin</p>
    </div>

    <nav aria-label="Sidebar menu">
      <ul class="app-sidebar__list">
        <?php foreach ($primary_menu_items as $menu_item): ?>
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
          $icon_set    = preg_match('/-(line|fill)$/', $menu_icon) ? 'remix' : 'lucide';
          ?>

          <?php if ($is_collapsible): ?>
            <li
              class="sidebar__item"
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
                  <?php component('icon', ['icon_name' => $menu_icon, 'icon_size' => 20, 'icon_set' => $icon_set]); ?>
                  <span><?= e($menu_item['label'] ?? 'Menu') ?></span>
                </span>
                <svg
                  data-submenu-icon
                  class="sidebar__chevron h-4 w-4 icon-muted transition-transform duration-200"
                  viewBox="0 0 20 20"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  aria-hidden="true"
                >
                  <path d="M8 5L13 10L8 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </button>
              <ul data-submenu-panel class="app-sidebar__sublist sidebar__sublist my-1 pl-10 <?= $is_open ? '' : 'hidden' ?>">
                <?php foreach ($menu_item['children'] as $child_item): ?>
                  <?php $child_active = !empty($child_item['active']); ?>
                  <li class="sidebar__subitem">
                    <a
                      href="<?= e($child_item['href'] ?? '#') ?>"
                      class="sidebar__link block py-1 type-normal transition <?= $child_active ? 'sidebar__link--active text-link' : 'text-secondary hover-text-link' ?>"
                    >
                      <?= e($child_item['label'] ?? 'Item') ?>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>
            </li>
          <?php else: ?>
            <li class="sidebar__item">
              <a
                href="<?= e($menu_item['href'] ?? '#') ?>"
                class="sidebar__link flex items-center gap-2 rounded-lg border px-3 py-2 type-medium transition <?= $is_active ? 'sidebar__link--active border-gray-200 bg-gray-100 text-dark' : 'border-transparent text-body hover:border-gray-200 hover:bg-gray-50 hover-text-dark' ?>"
              >
                <?php component('icon', ['icon_name' => $menu_icon, 'icon_size' => 20, 'icon_set' => $icon_set]); ?>
                <span><?= e($menu_item['label'] ?? 'Item') ?></span>
              </a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>

      <?php if ($setup_group_items !== []): ?>
        <div class="mt-3">
          <p class="px-3 py-2 type-caption">Setup</p>
          <ul class="app-sidebar__list">
            <?php foreach ($setup_group_items as $menu_item): ?>
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
              $icon_set    = preg_match('/-(line|fill)$/', $menu_icon) ? 'remix' : 'lucide';
              ?>

              <?php if ($is_collapsible): ?>
                <li
                  class="sidebar__item"
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
                      <?php component('icon', ['icon_name' => $menu_icon, 'icon_size' => 20, 'icon_set' => $icon_set]); ?>
                      <span><?= e($menu_item['label'] ?? 'Menu') ?></span>
                    </span>
                    <svg
                      data-submenu-icon
                      class="sidebar__chevron h-4 w-4 icon-muted transition-transform duration-200"
                      viewBox="0 0 20 20"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true"
                    >
                      <path d="M8 5L13 10L8 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </button>
                  <ul data-submenu-panel class="app-sidebar__sublist sidebar__sublist my-1 pl-10 <?= $is_open ? '' : 'hidden' ?>">
                    <?php foreach ($menu_item['children'] as $child_item): ?>
                      <?php $child_active = !empty($child_item['active']); ?>
                      <li class="sidebar__subitem">
                        <a
                          href="<?= e($child_item['href'] ?? '#') ?>"
                          class="sidebar__link block py-1 type-normal transition <?= $child_active ? 'sidebar__link--active text-link' : 'text-secondary hover-text-link' ?>"
                        >
                          <?= e($child_item['label'] ?? 'Item') ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </li>
              <?php else: ?>
                <li class="sidebar__item">
                  <a
                    href="<?= e($menu_item['href'] ?? '#') ?>"
                    class="sidebar__link flex items-center gap-2 rounded-lg border px-3 py-2 type-medium transition <?= $is_active ? 'sidebar__link--active border-gray-200 bg-gray-100 text-dark' : 'border-transparent text-body hover:border-gray-200 hover:bg-gray-50 hover-text-dark' ?>"
                  >
                    <?php component('icon', ['icon_name' => $menu_icon, 'icon_size' => 20, 'icon_set' => $icon_set]); ?>
                    <span><?= e($menu_item['label'] ?? 'Item') ?></span>
                  </a>
                </li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if ($design_group_items !== []): ?>
        <div class="mt-3">
          <p class="px-3 py-2 type-caption">Design</p>
          <ul class="app-sidebar__list">
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
              $icon_set    = preg_match('/-(line|fill)$/', $menu_icon) ? 'remix' : 'lucide';
              ?>

              <?php if ($is_collapsible): ?>
                <li
                  class="sidebar__item"
                  data-submenu
                  data-submenu-key="<?= e($submenu_key !== '' ? $submenu_key : 'menu') ?>"
                  data-submenu-default-open="<?= $is_open ? 'true' : 'false' ?>"
                  data-submenu-lock-open="<?= $is_open ? 'true' : 'false' ?>"
                >
                  <button
                    type="button"
                    data-submenu-trigger
                    aria-expanded="<?= $is_open ? 'true' : 'false' ?>"
                    class="sidebar__toggle flex w-full items-center justify-between rounded-lg border border-transparent px-3 py-2 type-medium text-body transition hover:border-gray-200 hover:bg-gray-50"
                  >
                    <span class="flex items-center gap-2">
                      <?php component('icon', ['icon_name' => $menu_icon, 'icon_size' => 20, 'icon_set' => $icon_set]); ?>
                      <span><?= e($menu_item['label'] ?? 'Menu') ?></span>
                    </span>
                    <svg
                      data-submenu-icon
                      class="sidebar__chevron h-4 w-4 icon-muted transition-transform duration-200"
                      viewBox="0 0 20 20"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      aria-hidden="true"
                    >
                      <path d="M8 5L13 10L8 15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </button>
                  <ul data-submenu-panel class="app-sidebar__sublist sidebar__sublist my-1 pl-10 <?= $is_open ? '' : 'hidden' ?>">
                    <?php foreach ($menu_item['children'] as $child_item): ?>
                      <?php $child_active = !empty($child_item['active']); ?>
                      <li class="sidebar__subitem">
                        <a
                          href="<?= e($child_item['href'] ?? '#') ?>"
                          class="sidebar__link block py-1 type-normal transition <?= $child_active ? 'sidebar__link--active text-link' : 'text-secondary hover-text-link' ?>"
                        >
                          <?= e($child_item['label'] ?? 'Item') ?>
                        </a>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
    </nav>
  </div>
</aside>
