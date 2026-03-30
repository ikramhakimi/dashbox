<?php

$page_title   = 'Drawers (Interactive JS Component)';
$page_current = 'drawers';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children('drawers'),
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

$button_cancel = $capture('button', [
  'label'      => 'Cancel',
  'attributes' => ['data-drawer-close' => true],
]);

$button_save = $capture('button', [
  'label'   => 'Save Changes',
  'variant' => 'primary',
]);

$button_apply = $capture('button', [
  'label'   => 'Apply Filters',
  'variant' => 'primary',
]);

$button_close = $capture('button', [
  'label'      => 'Close',
  'attributes' => ['data-drawer-close' => true],
]);

$drawer_profile_content = '
  <form class="space-y-4">
    ' . $capture('input', [
      'id'          => 'drawer-profile-name',
      'label'       => 'Display Name',
      'placeholder' => 'e.g. Nadia Iskandar',
    ]) . '
    ' . $capture('input', [
      'id'          => 'drawer-profile-email',
      'label'       => 'Email',
      'placeholder' => 'nadia@company.com',
    ]) . '
    ' . $capture('select', [
      'id'      => 'drawer-profile-role',
      'label'   => 'Role',
      'value'   => 'editor',
      'options' => [
        ['label' => 'Admin', 'value' => 'admin'],
        ['label' => 'Editor', 'value' => 'editor'],
        ['label' => 'Support', 'value' => 'support'],
      ],
    ]) . '
    ' . $capture('switch', [
      'id'      => 'drawer-profile-active',
      'label'   => 'Set as active',
      'checked' => true,
    ]) . '
  </form>
';

$drawer_profile_footer = '
  <div class="flex items-center gap-2">
    ' . $button_cancel . '
    ' . $button_save . '
  </div>
';

$drawer_filter_content = '
  <form class="space-y-4">
    ' . $capture('search-input', [
      'id'            => 'drawer-filter-search',
      'label'         => 'Keyword',
      'hide_label'    => true,
      'placeholder'   => 'Search by customer, package, or order id',
    ]) . '
    <div class="grid gap-4 sm:grid-cols-2">
      ' . $capture('select', [
        'id'      => 'drawer-filter-payment',
        'label'   => 'Payment',
        'value'   => 'all',
        'options' => [
          ['label' => 'All', 'value' => 'all'],
          ['label' => 'Paid Full', 'value' => 'paid_full'],
          ['label' => 'Paid Deposit', 'value' => 'paid_deposit'],
          ['label' => 'Unpaid', 'value' => 'unpaid'],
        ],
      ]) . '
      ' . $capture('select', [
        'id'      => 'drawer-filter-status',
        'label'   => 'Status',
        'value'   => 'all',
        'options' => [
          ['label' => 'All', 'value' => 'all'],
          ['label' => 'Pending', 'value' => 'pending'],
          ['label' => 'Completed', 'value' => 'completed'],
          ['label' => 'Cancelled', 'value' => 'cancelled'],
        ],
      ]) . '
    </div>
  </form>
';

$drawer_filter_footer = '
  <div class="flex items-center gap-2">
    ' . $button_cancel . '
    ' . $capture('button', ['label' => 'Reset']) . '
    ' . $button_apply . '
  </div>
';

$drawer_detail_content = '
  <div class="space-y-4">
    <div class="space-y-1">
      <p class="text-sm text-gray-500">Order ID</p>
      <p class="font-medium text-gray-900">ORD-2026-1042</p>
    </div>
    <div class="space-y-1">
      <p class="text-sm text-gray-500">Customer</p>
      <p class="font-medium text-gray-900">Aina Syafiqa</p>
      <p class="text-sm text-gray-500">+60 12-333 9191</p>
    </div>
    <div class="space-y-1">
      <p class="text-sm text-gray-500">Session</p>
      <p class="font-medium text-gray-900">Portrait Session</p>
      <p class="text-sm text-gray-500">2 Apr 2026, 10:30 AM</p>
    </div>
  </div>
';

$drawer_detail_footer = '
  <div class="flex items-center gap-2">
    ' . $button_close . '
    ' . $capture('button', ['label' => 'Open Full Record', 'variant' => 'primary']) . '
  </div>
';

ob_start();
?>
<div class="flex flex-wrap gap-2">
  <?= $capture('button', [
    'label'      => 'Right Drawer (Profile)',
    'attributes' => ['data-drawer-open' => 'demo-drawer-profile'],
  ]) ?>
  <?= $capture('button', [
    'label'      => 'Left Drawer (Filter)',
    'attributes' => ['data-drawer-open' => 'demo-drawer-filter'],
  ]) ?>
  <?= $capture('button', [
    'label'      => 'Large Drawer (Details)',
    'attributes' => ['data-drawer-open' => 'demo-drawer-detail'],
  ]) ?>
</div>
<?php
$drawer_trigger_content = (string) ob_get_clean();

ob_start();
?>
<div class="grid gap-3 md:grid-cols-3">
  <div class="py-3">
    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Source Module</p>
    <p class="mt-2 font-medium text-gray-900"><code>assets/js/drawer.js</code></p>
    <p class="mt-1 text-xs text-gray-500">Open/close, outside-click dismiss, Escape, and focus trap.</p>
  </div>
  <div class="py-3">
    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Bundle Entry</p>
    <p class="mt-2 font-medium text-gray-900"><code>assets/js/app.js</code></p>
    <p class="mt-1 text-xs text-gray-500">Registers initDrawer together with other JS components.</p>
  </div>
  <div class="py-3">
    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Compiled Output</p>
    <p class="mt-2 font-medium text-gray-900"><code>assets/build/app.js</code></p>
    <p class="mt-1 text-xs text-gray-500">Single minified JS file loaded globally in layout.</p>
  </div>
</div>
<?php
$drawer_js_doc_content = (string) ob_get_clean();

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="content flex-1 p-4 lg:p-10">
    <section class="mx-auto max-w-7xl">
      <header class="mb-8 border-b border-gray-200 pb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">UI Elements</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">
          Drawers (Interactive JS Component)
        </h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Slide-in side panel for profile editing, filter tools, and order detail preview.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Drawer component showcase">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="text-lg font-semibold text-gray-900">JS Documentation</h2>
            <p class="mt-1 text-sm text-gray-500">Implementation paths for drawer interactive behavior.</p>
          </header>
          <?= $drawer_js_doc_content ?>
        </article>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="text-lg font-semibold text-gray-900">Drawer Trigger Variations</h2>
            <p class="mt-1 text-sm text-gray-500">
              Right, left, and large detail drawer for different workflows.
            </p>
          </header>
          <?= $drawer_trigger_content ?>
        </article>
      </section>
    </section>
  </main>
</div>

<?php
component('drawer', [
  'id'          => 'demo-drawer-profile',
  'title'       => 'Edit Profile',
  'description' => 'Update owner details and default role.',
  'content'     => $drawer_profile_content,
  'footer'      => $drawer_profile_footer,
  'placement'   => 'right',
  'size'        => 'md',
]);

component('drawer', [
  'id'          => 'demo-drawer-filter',
  'title'       => 'Order Filters',
  'description' => 'Refine order list before exporting report.',
  'content'     => $drawer_filter_content,
  'footer'      => $drawer_filter_footer,
  'placement'   => 'left',
  'size'        => 'md',
]);

component('drawer', [
  'id'          => 'demo-drawer-detail',
  'title'       => 'Order Snapshot',
  'description' => 'Quick read-only summary without leaving list.',
  'content'     => $drawer_detail_content,
  'footer'      => $drawer_detail_footer,
  'placement'   => 'right',
  'size'        => 'lg',
]);
?>
<?php layout('layout-end'); ?>
