<?php

$page_title   = 'Drawers (Interactive JS Component)';
$page_current = 'drawers';

$menu_items = build_main_menu_items($page_current);

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
      <p class="type-body-muted">Order ID</p>
      <p class="type-medium text-dark">ORD-2026-1042</p>
    </div>
    <div class="space-y-1">
      <p class="type-body-muted">Customer</p>
      <p class="type-medium text-dark">Aina Syafiqa</p>
      <p class="type-body-muted">+60 12-333 9191</p>
    </div>
    <div class="space-y-1">
      <p class="type-body-muted">Session</p>
      <p class="type-medium text-dark">Portrait Session</p>
      <p class="type-body-muted">2 Apr 2026, 10:30 AM</p>
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
    <p class="type-caption type-semibold">Source Module</p>
    <p class="mt-2 type-medium text-dark"><code>assets/js/drawer.js</code></p>
    <p class="mt-1 type-small text-muted">Open/close, outside-click dismiss, Escape, and focus trap.</p>
  </div>
  <div class="py-3">
    <p class="type-caption type-semibold">Bundle Entry</p>
    <p class="mt-2 type-medium text-dark"><code>assets/js/app.js</code></p>
    <p class="mt-1 type-small text-muted">Registers initDrawer together with other JS components.</p>
  </div>
  <div class="py-3">
    <p class="type-caption type-semibold">Compiled Output</p>
    <p class="mt-2 type-medium text-dark"><code>assets/build/app.js</code></p>
    <p class="mt-1 type-small text-muted">Single minified JS file loaded globally in layout.</p>
  </div>
</div>
<?php
$drawer_js_doc_content = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">
          Drawers (Interactive JS Component)
        </h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Slide-in side panel for profile editing, filter tools, and order detail preview.
        </p>
      </header>

      <section class="card__list" aria-label="Drawer component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <article class="space-y-4 py-7 first:pt-0 last:pb-0">
                <header>
                  <h2 class="type-h2">JS Documentation</h2>
                  <p class="mt-1 type-body-muted">Implementation paths for drawer interactive behavior.</p>
                </header>
                <?= $drawer_js_doc_content ?>
              </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <article class="space-y-4 py-7 first:pt-0 last:pb-0">
                <header>
                  <h2 class="type-h2">Drawer Trigger Variations</h2>
                  <p class="mt-1 type-body-muted">
                    Right, left, and large detail drawer for different workflows.
                  </p>
                </header>
                <?= $drawer_trigger_content ?>
              </article>
            </section>
          </li>
        </ul>
      </section>
    </section>

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
<?php layout('app-end'); ?>
