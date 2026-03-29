<?php

$page_title   = 'Empty State Component';
$page_current = 'empty-states';

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
<?= $capture('empty-state', [
  'icon_name'    => 'users',
  'title'        => 'No team members yet',
  'description'  => 'Invite your first teammate to start assigning ownership and project access.',
  'actions'      => [
    ['label' => 'Invite Member', 'variant' => 'primary', 'icon_name' => 'plus'],
  ],
]) ?>
<?php
$empty_state_default_content = (string) ob_get_clean();

ob_start();
?>
<?= $capture('empty-state', [
  'deco'        => '(._.)',
  'title'       => 'No results for "enterprise plan"',
  'description' => 'Try another keyword, remove filters, or search all statuses.',
  'actions'     => [
    ['label' => 'Clear Filters', 'variant' => 'neutral'],
    ['label' => 'Search Again', 'variant' => 'primary'],
  ],
]) ?>
<?php
$empty_state_search_content = (string) ob_get_clean();

ob_start();
?>
<?= $capture('empty-state', [
  'icon_name'    => 'activity',
  'title'        => 'Unable to load analytics data',
  'description'  => 'The request timed out. Retry now or review API configuration before trying again.',
  'actions'      => [
    ['label' => 'Retry', 'variant' => 'primary'],
    ['label' => 'Open Settings', 'variant' => 'ghost'],
  ],
  'attributes'   => [
    'class' => 'bg-gray-50',
  ],
]) ?>
<?php
$empty_state_error_content = (string) ob_get_clean();

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
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Empty State</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Reusable empty state blocks for no data, no search result, and temporary error states.
        </p>
      </header>

      <section class="space-y-7" aria-label="Empty state component showcase">
        <?php
        component('card-module', [
          'title'       => 'Default Empty State',
          'subtitle'    => 'Primary CTA for first-time setup or onboarding flow.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $empty_state_default_content,
        ]);

        component('card-module', [
          'title'       => 'Search Empty State',
          'subtitle'    => 'Use descriptive copy with recovery actions.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $empty_state_search_content,
        ]);

        component('card-module', [
          'title'       => 'Error Recovery Empty State',
          'subtitle'    => 'Guides users when loading fails and offers next steps.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $empty_state_error_content,
        ]);
        ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
