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
<div class="divide-y divide-gray-100">
  <section class="py-5 first:pt-0 last:pb-0">
    <p class="mb-3 type-caption type-semibold">Default</p>
    <?= $capture([
      'items' => [
        ['label' => 'Overview', 'href' => '#', 'active' => true],
        ['label' => 'Details', 'href' => '#'],
        ['label' => 'History', 'href' => '#'],
      ],
    ]) ?>
  </section>

  <section class="py-5 first:pt-0 last:pb-0">
    <p class="mb-3 type-caption type-semibold">With Icons</p>
    <?= $capture([
      'items' => [
        ['label' => 'Overview', 'href' => '#', 'icon_name' => 'activity', 'active' => true],
        ['label' => 'Team', 'href' => '#', 'icon_name' => 'users'],
        ['label' => 'Priority', 'href' => '#', 'icon_name' => 'star'],
      ],
    ]) ?>
  </section>

  <section class="py-5 first:pt-0 last:pb-0">
    <p class="mb-3 type-caption type-semibold">Tabs + Button Side By Side</p>
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
        ]) ?>
      </div>
    </div>
  </section>
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

  <main class="content flex-1 p-4 lg:p-10">
    <section class="mx-auto max-w-7xl">
      <header class="mb-8 border-b border-gray-200 pb-6">
        <p class="type-caption type-semibold">UI Elements</p>
        <h1 class="mt-2 type-h1">Tabs UI Library</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Foundation tabs with icon support and active states.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Tabs component showcase">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Tabs Variations</h2>
            <p class="mt-1 type-body-muted">
              Default and icon tab patterns for dashboard sections.
            </p>
          </header>
          <?= $tabs_content ?>
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
