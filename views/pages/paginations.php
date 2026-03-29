<?php

$page_title   = 'Pagination Component';
$page_current = 'paginations';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children('paginations'),
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
<div class="space-y-4">
  <?= $capture('pagination', [
    'current_page' => 3,
    'total_pages'  => 10,
    'show_pages'   => true,
    'base_url'     => asset('/paginations?page=%d'),
  ]) ?>
</div>
<?php
$pagination_default_content = (string) ob_get_clean();

ob_start();
?>
<div class="space-y-4">
  <?= $capture('pagination', [
    'current_page' => 7,
    'total_pages'  => 24,
    'show_info'    => true,
    'show_pages'   => true,
    'total_items'  => 240,
    'per_page'     => 10,
    'base_url'     => asset('/paginations?page=%d'),
  ]) ?>
</div>
<?php
$pagination_info_content = (string) ob_get_clean();

ob_start();
?>
<div class="space-y-4">
  <?= $capture('pagination', [
    'current_page' => 1,
    'total_pages'  => 1,
    'show_info'    => true,
    'total_items'  => 0,
    'per_page'     => 10,
    'base_url'     => asset('/paginations?page=%d'),
  ]) ?>
</div>
<?php
$pagination_single_content = (string) ob_get_clean();

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
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Pagination</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Foundation pagination with active state, disabled edges, and optional result info.
        </p>
      </header>

      <section class="space-y-7" aria-label="Pagination component showcase">
        <?php
        component('card-module', [
          'title'       => 'Default (Prev + Next Clamp)',
          'subtitle'    => 'Connected previous and next controls as primary pagination navigation.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $pagination_default_content,
        ]);

        component('card-module', [
          'title'       => 'Pagination with Info',
          'subtitle'    => 'Include showing range and total items for better context.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $pagination_info_content,
        ]);

        component('card-module', [
          'title'       => 'Single Page / Empty State',
          'subtitle'    => 'Disabled controls when only one page is available.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $pagination_single_content,
        ]);
        ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
