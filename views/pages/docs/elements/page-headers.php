<?php

$page_title   = 'Page Header Component';
$page_current = 'page-headers';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children($page_current),
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
<?= $capture('page-header', [
  'title'       => 'Layout Contract: Main + Actions',
  'description' => 'This sample intentionally uses a longer description so the main block becomes taller. Actions stay anchored to the bottom-right edge.',
  'breadcrumb_items' => [
    ['label' => 'Home', 'href' => asset('/')],
    ['label' => 'Design System', 'href' => '#'],
    ['label' => 'Page Header'],
  ],
  'actions' => [
    ['label' => 'Cancel', 'size' => 'sm'],
    ['label' => 'Save Changes', 'variant' => 'primary', 'size' => 'sm'],
  ],
  'actions_html' => $capture('dropdown', [
    'trigger_label'     => 'More',
    'trigger_size'      => 'sm',
    'items'             => [
      ['label' => 'Duplicate', 'href' => '#'],
      ['label' => 'Archive', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Delete', 'href' => '#', 'kind' => 'danger'],
    ],
  ]),
  'actions_html_trusted' => true,
]) ?>
<?php
$page_header_layout_content = (string) ob_get_clean();

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
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Page Header</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Reusable top section for page title, supporting context, breadcrumbs, and actions.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Page header component showcase">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="text-lg font-semibold text-gray-900">Main + Actions Layout</h2>
            <p class="mt-1 text-sm text-gray-500">
              Explicit demo: actions stay bottom-right while main section grows.
            </p>
          </header>
          <?= $page_header_layout_content ?>
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
