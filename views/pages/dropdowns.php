<?php

$page_title   = 'Dropdown (Interactive JS Component)';
$page_current = 'dropdowns';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children('dropdowns'),
  ],
  [
    'label'    => 'UI Patterns',
    'children' => ui_patterns_sidebar_children(),
  ],
  [
    'label' => 'Settings',
    'href'  => '#',
  ],
];

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

ob_start();
?>
<div class="flex flex-wrap items-center gap-3">
  <?= $capture('dropdown', [
    'trigger_label' => 'Actions',
    'items'         => [
      ['label' => 'View details', 'href' => '#'],
      ['label' => 'Edit record', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Archive', 'href' => '#'],
      ['label' => 'Delete', 'href' => '#', 'kind' => 'danger'],
    ],
  ]) ?>

  <?= $capture('dropdown', [
    'trigger_label' => 'Menu',
    'align'         => 'left',
    'items'         => [
      ['type' => 'label', 'label' => 'Workspace'],
      ['label' => 'Team settings', 'href' => '#'],
      ['label' => 'Billing', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Disabled action', 'href' => '#', 'disabled' => true],
    ],
  ]) ?>
</div>
<?php
$dropdown_default_content = (string) ob_get_clean();

ob_start();
?>
<div class="flex flex-wrap items-center gap-3">
  <?= $capture('dropdown', [
    'trigger_label'     => 'Quick actions',
    'trigger_variant'   => 'ghost',
    'trigger_icon_name' => 'plus',
    'items'             => [
      ['label' => 'Create user', 'href' => '#', 'icon_name' => 'users'],
      ['label' => 'Open tickets', 'href' => '#', 'icon_name' => 'ticket'],
      ['label' => 'Pulse report', 'href' => '#', 'icon_name' => 'activity'],
    ],
  ]) ?>

  <?= $capture('dropdown', [
    'trigger_label'     => 'More options',
    'trigger_variant'   => 'ghost',
    'icon_only'         => true,
    'trigger_icon_name' => 'plus',
    'items'             => [
      ['label' => 'Pin to top', 'href' => '#'],
      ['label' => 'Duplicate', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Delete', 'href' => '#', 'kind' => 'danger'],
    ],
  ]) ?>
</div>
<?php
$dropdown_trigger_content = (string) ob_get_clean();

ob_start();
?>
<div class="flex flex-wrap items-center gap-3">
  <?= $capture('dropdown', [
    'trigger_label' => 'Small',
    'trigger_size'  => 'sm',
    'items'         => [
      ['label' => 'Open', 'href' => '#'],
      ['label' => 'Edit', 'href' => '#'],
    ],
  ]) ?>

  <?= $capture('dropdown', [
    'trigger_label' => 'Default',
    'trigger_size'  => 'md',
    'items'         => [
      ['label' => 'Open', 'href' => '#'],
      ['label' => 'Edit', 'href' => '#'],
    ],
  ]) ?>

  <?= $capture('dropdown', [
    'trigger_label' => 'Large',
    'trigger_size'  => 'lg',
    'items'         => [
      ['label' => 'Open', 'href' => '#'],
      ['label' => 'Edit', 'href' => '#'],
    ],
  ]) ?>

  <?= $capture('dropdown', [
    'trigger_label'     => 'Icon Small',
    'trigger_size'      => 'sm',
    'icon_only'         => true,
    'trigger_icon_name' => 'plus',
    'items'             => [
      ['label' => 'Create item', 'href' => '#'],
      ['label' => 'Import data', 'href' => '#'],
    ],
  ]) ?>
</div>
<?php
$dropdown_size_content = (string) ob_get_clean();

ob_start();
?>
<div class="flex flex-wrap items-center gap-3">
  <?= $capture('dropdown', [
    'trigger_tag'   => 'a',
    'trigger_label' => 'Open workspace',
    'trigger_href'  => '#workspace',
    'items'         => [
      ['label' => 'Workspace overview', 'href' => '#'],
      ['label' => 'Members', 'href' => '#'],
      ['label' => 'Billing', 'href' => '#'],
    ],
  ]) ?>

  <?= $capture('dropdown', [
    'trigger_tag'     => 'a',
    'trigger_label'   => 'More actions',
    'trigger_href'    => '#actions',
    'trigger_variant' => 'ghost',
    'items'           => [
      ['label' => 'Duplicate', 'href' => '#'],
      ['label' => 'Export', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Delete', 'href' => '#', 'kind' => 'danger'],
    ],
  ]) ?>
</div>
<?php
$dropdown_link_content = (string) ob_get_clean();

ob_start();
?>
<nav class="border-b border-gray-200 pb-2" aria-label="Navigation dropdown demo">
  <div class="flex flex-wrap items-center gap-1">
    <?= $capture('dropdown', [
      'trigger_tag'   => 'a',
      'trigger_label' => 'Dashboard',
      'trigger_href'  => '/dashboards',
      'align'         => 'left',
      'items'         => [
        ['label' => 'Overview', 'href' => '#'],
        ['label' => 'Sales', 'href' => '#'],
        ['label' => 'Customers', 'href' => '#'],
      ],
    ]) ?>
    <?= $capture('dropdown', [
      'trigger_tag'   => 'a',
      'trigger_label' => 'Products',
      'trigger_href'  => '/products',
      'align'         => 'left',
      'items'         => [
        ['label' => 'All products', 'href' => '#'],
        ['label' => 'Categories', 'href' => '#'],
        ['label' => 'Inventory', 'href' => '#'],
      ],
    ]) ?>
    <?= $capture('dropdown', [
      'trigger_tag'   => 'a',
      'trigger_label' => 'Settings',
      'trigger_href'  => '/settings',
      'align'         => 'left',
      'items'         => [
        ['label' => 'Team', 'href' => '#'],
        ['label' => 'Roles', 'href' => '#'],
        ['label' => 'API keys', 'href' => '#'],
      ],
    ]) ?>
  </div>
</nav>
<?php
$dropdown_navigation_content = (string) ob_get_clean();

ob_start();
?>
<div class="grid gap-3 md:grid-cols-3">
  <div class="rounded-md border border-gray-200 bg-white p-4">
    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Source Module</p>
    <p class="mt-2 text-sm font-medium text-gray-900"><code>assets/js/dropdown.js</code></p>
    <p class="mt-1 text-xs text-gray-500">Dropdown behavior and outside-click dismiss logic.</p>
  </div>
  <div class="rounded-md border border-gray-200 bg-white p-4">
    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Bundle Entry</p>
    <p class="mt-2 text-sm font-medium text-gray-900"><code>assets/js/app.js</code></p>
    <p class="mt-1 text-xs text-gray-500">Single entry that initializes submenu, dropdown, and modal.</p>
  </div>
  <div class="rounded-md border border-gray-200 bg-white p-4">
    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Compiled Output</p>
    <p class="mt-2 text-sm font-medium text-gray-900"><code>assets/build/app.js</code></p>
    <p class="mt-1 text-xs text-gray-500">Minified production script loaded globally in layout.</p>
  </div>
</div>
<?php
$dropdown_js_doc_content = (string) ob_get_clean();

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="flex-1">
    <section class="mx-auto max-w-7xl px-6 py-8 lg:px-10">
      <header class="mb-8 border-b border-gray-200 pb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">UI Elements</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Dropdown (Interactive JS Component)</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Reusable dropdown menu for action lists, row menus, and account navigation.
        </p>
      </header>

      <section class="space-y-7" aria-label="Dropdown component showcase">
        <?php
        component('card-module', [
          'title'       => 'JS Documentation',
          'subtitle'    => 'Implementation paths for dropdown interactive behavior.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $dropdown_js_doc_content,
        ]);

        component('card-module', [
          'title'       => 'Default Dropdown',
          'subtitle'    => 'Button trigger with dividers, labels, disabled and danger actions.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $dropdown_default_content,
        ]);

        component('card-module', [
          'title'       => 'Trigger Variations',
          'subtitle'    => 'Ghost style, icon+text trigger, and icon-only trigger.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $dropdown_trigger_content,
        ]);

        component('card-module', [
          'title'       => 'Button Size Variations',
          'subtitle'    => 'Dropdown trigger reuses button tokens: sm, default, lg, including icon-only.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $dropdown_size_content,
        ]);

        component('card-module', [
          'title'       => 'Link Trigger Dropdown',
          'subtitle'    => 'Use anchor trigger while keeping JS toggle and outside-click dismiss.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $dropdown_link_content,
        ]);

        component('card-module', [
          'title'       => 'Navigation Dropdown',
          'subtitle'    => 'Simple link-style trigger for navigation groups.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $dropdown_navigation_content,
        ]);
        ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
