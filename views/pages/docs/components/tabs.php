<?php

$page_title   = 'Tabs';
$page_current = 'tabs';

$menu_items = build_main_menu_items($page_current);

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
<div class="grid gap-4">
  <div class="rounded-lg border border-gray-100 bg-white p-4">
    <h4 class="type-h4">Default</h4>
    <p class="mb-4 type-body-muted">Base tab navigation for common section switching.</p>
    <?= $capture([
      'items' => [
        ['label' => 'Overview', 'href' => '#', 'active' => true],
        ['label' => 'Details', 'href' => '#'],
        ['label' => 'History', 'href' => '#'],
      ],
    ]) ?>
  </div>

  <div class="rounded-lg border border-gray-100 bg-white p-4">
    <h4 class="type-h4">With Icons</h4>
    <p class="mb-4 type-body-muted">Tab labels with icons to reinforce section meaning.</p>
    <?= $capture([
      'items' => [
        ['label' => 'Overview', 'href' => '#', 'icon_name' => 'activity', 'active' => true],
        ['label' => 'Team', 'href' => '#', 'icon_name' => 'users'],
        ['label' => 'Priority', 'href' => '#', 'icon_name' => 'star'],
      ],
    ]) ?>
  </div>

  <div class="rounded-lg border border-gray-100 bg-white p-4">
    <h4 class="type-h4">Tabs + Button Side By Side</h4>
    <p class="mb-4 type-body-muted">Combine tab navigation with inline action controls.</p>
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
  </div>
</div>
<?php
$tabs_content = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Tabs UI Library</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Foundation tabs with icon support and active states.
        </p>
      </header>

      <section class="card__list" aria-label="Tabs component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
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
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
