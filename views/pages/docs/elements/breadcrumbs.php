<?php

$page_title   = 'Breadcrumbs';
$page_current = 'breadcrumbs';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children('breadcrumbs'),
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

$capture = static function (array $props): string {
  ob_start();
  component('breadcrumb', $props);
  return (string) ob_get_clean();
};

ob_start();
?>
<div class="space-y-4">
  <div class="border border-gray-100 rounded-lg p-5">
    <p class="mb-3 type-caption type-semibold">Slash Separator</p>
    <?= $capture([
      'separator' => 'slash',
      'items'     => [
        ['label' => 'Home', 'href' => asset('/')],
        ['label' => 'Components', 'href' => asset('/docs/elements/buttons')],
        ['label' => 'Forms', 'href' => asset('/docs/elements/inputs')],
        ['label' => 'Breadcrumbs', 'current' => true],
      ],
    ]) ?>
  </div>

  <div class="border border-gray-100 rounded-lg p-5">
    <p class="mb-3 type-caption type-semibold">Chevron Separator (SVG)</p>
    <?= $capture([
      'separator' => 'chevron',
      'items'     => [
        ['label' => 'Home', 'href' => asset('/')],
        ['label' => 'Orders', 'href' => '#'],
        ['label' => 'Order Detail', 'current' => true],
      ],
    ]) ?>
  </div>

  <div class="border border-gray-100 rounded-lg p-5">
    <p class="mb-3 type-caption type-semibold">With Icon</p>
    <?= $capture([
      'separator' => 'chevron',
      'items'     => [
        ['label' => 'Dashboard', 'href' => asset('/'), 'icon_name' => 'activity'],
        ['label' => 'Team', 'href' => '#', 'icon_name' => 'users'],
        ['label' => 'Members', 'current' => true, 'icon_name' => 'star'],
      ],
    ]) ?>
  </div>

  <div class="border border-gray-100 rounded-lg p-5">
    <p class="mb-3 type-caption type-semibold">Compact</p>
    <?= $capture([
      'compact'   => true,
      'separator' => 'slash',
      'items'     => [
        ['label' => 'Root', 'href' => '#'],
        ['label' => 'Library', 'href' => '#'],
        ['label' => 'UI', 'href' => '#'],
        ['label' => 'Breadcrumbs', 'current' => true],
      ],
    ]) ?>
  </div>
</div>
<?php
$breadcrumb_content = (string) ob_get_clean();

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
        <p class="type-caption type-semibold">UI Elements</p>
        <h1 class="mt-2 type-h1">Breadcrumb UI Library</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Slash and chevron separators, icon support, and compact breadcrumb variant.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Breadcrumb component showcase">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Breadcrumb Variations</h2>
            <p class="mt-1 type-body-muted">
              Foundation breadcrumb styles for app navigation context.
            </p>
          </header>
          <?= $breadcrumb_content ?>
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
