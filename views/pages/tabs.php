<?php

$page_title   = 'Tabs';
$page_current = 'tabs';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children('tabs'),
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
  component('tabs', $props);
  return (string) ob_get_clean();
};

$capture_button = static function (array $props): string {
  ob_start();
  component('button', $props);
  return (string) ob_get_clean();
};

ob_start();
?>
<div class="space-y-4">
  <div class="border border-gray-100 rounded-lg p-5">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Default</p>
    <?= $capture([
      'items' => [
        ['label' => 'Overview', 'href' => '#', 'active' => true],
        ['label' => 'Details', 'href' => '#'],
        ['label' => 'History', 'href' => '#'],
      ],
    ]) ?>
  </div>

  <div class="border border-gray-100 rounded-lg p-5">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">With Icons</p>
    <?= $capture([
      'items' => [
        ['label' => 'Overview', 'href' => '#', 'icon_name' => 'activity', 'active' => true],
        ['label' => 'Team', 'href' => '#', 'icon_name' => 'users'],
        ['label' => 'Priority', 'href' => '#', 'icon_name' => 'star'],
      ],
    ]) ?>
  </div>

  <div class="border border-gray-100 rounded-lg p-5">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Compact</p>
    <?= $capture([
      'compact' => true,
      'items'   => [
        ['label' => 'All', 'href' => '#', 'active' => true],
        ['label' => 'Open', 'href' => '#'],
        ['label' => 'Closed', 'href' => '#'],
        ['label' => 'Archived', 'href' => '#', 'disabled' => true],
      ],
    ]) ?>
  </div>

  <div class="border border-gray-100 rounded-lg p-5">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Tabs + Button Side By Side</p>
    <div class="max-w-full overflow-x-auto">
      <div class="inline-flex items-center gap-3 whitespace-nowrap">
        <?= $capture([
          'items' => [
            ['label' => 'Overview', 'href' => '#', 'active' => true],
            ['label' => 'Activity', 'href' => '#'],
            ['label' => 'Settings', 'href' => '#'],
          ],
        ]) ?>
        <?= $capture_button([
          'label'   => 'Create New',
          'variant' => 'neutral',
        ]) ?>
      </div>
    </div>
  </div>

  <div class="border border-gray-100 rounded-lg p-5">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Compact Tabs + Button--sm Side By Side</p>
    <div class="max-w-full overflow-x-auto">
      <div class="inline-flex items-center gap-3 whitespace-nowrap">
        <?= $capture([
          'compact' => true,
          'items'   => [
            ['label' => 'All', 'href' => '#', 'active' => true],
            ['label' => 'Open', 'href' => '#'],
            ['label' => 'Closed', 'href' => '#'],
          ],
        ]) ?>
        <?= $capture_button([
          'label'   => 'Create',
          'variant' => 'neutral',
          'size'    => 'sm',
        ]) ?>
      </div>
    </div>
  </div>
</div>
<?php
$tabs_content = (string) ob_get_clean();

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
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Tabs UI Library</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Foundation tabs with icon support, active states, and compact variant.
        </p>
      </header>

      <section class="space-y-7" aria-label="Tabs component showcase">
        <?php
        component('card-module', [
          'title'       => 'Tabs Variations',
          'subtitle'    => 'Default, icon, and compact tab patterns for dashboard sections.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $tabs_content,
        ]);
        ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
