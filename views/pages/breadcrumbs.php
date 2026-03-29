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
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Slash Separator</p>
    <?= $capture([
      'separator' => 'slash',
      'items'     => [
        ['label' => 'Home', 'href' => asset('/')],
        ['label' => 'Components', 'href' => asset('/buttons')],
        ['label' => 'Forms', 'href' => asset('/inputs')],
        ['label' => 'Breadcrumbs', 'current' => true],
      ],
    ]) ?>
  </div>

  <div class="border border-gray-100 rounded-lg p-5">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Chevron Separator (SVG)</p>
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
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">With Icon</p>
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
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Compact</p>
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

  <main class="flex-1">
    <section class="mx-auto max-w-7xl px-6 py-8 lg:px-10">
      <header class="mb-8 border-b border-gray-200 pb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">UI Elements</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Breadcrumb UI Library</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Slash and chevron separators, icon support, and compact breadcrumb variant.
        </p>
      </header>

      <section class="space-y-7" aria-label="Breadcrumb component showcase">
        <?php
        component('card-module', [
          'title'       => 'Breadcrumb Variations',
          'subtitle'    => 'Foundation breadcrumb styles for app navigation context.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $breadcrumb_content,
        ]);
        ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
