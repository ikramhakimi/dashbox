<?php

$page_title   = 'Badges';
$page_current = 'badges';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children('badges'),
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

$badge_sample = static function (string $value, string $mode): string {
  ob_start();
  component('badge', [
    'trend_value' => $value,
    'trend_mode'  => $mode,
  ]);
  return (string) ob_get_clean();
};

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
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Badge UI Library</h1>
        <p class="mt-1 text-sm text-gray-500">
          Reference page for all badge modes and practical examples.
        </p>
      </header>

      <section class="mb-6">
        <?php
        component('card-module', [
          'title'       => 'Badge Modes',
          'subtitle'    => 'Default visual variants supported by the badge component.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => '
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-gray-500">Positive</p>
                <span class="badge badge--positive">+12.4%</span>
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-gray-500">Negative</p>
                <span class="badge badge--negative">-4.1%</span>
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-gray-500">Neutral</p>
                <span class="badge badge--neutral">Pending</span>
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-gray-500">Warning</p>
                <span class="badge badge--warning">Awaiting Review</span>
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-gray-500">Info</p>
                <span class="badge badge--info">In Progress</span>
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-2 text-xs font-semibold uppercase tracking-wide text-gray-500">Accent</p>
                <span class="badge badge--accent">Priority</span>
              </div>
            </div>',
        ]);
        ?>
      </section>

      <section>
        <?php
        component('card-module', [
          'title'       => 'Badge Component Examples',
          'subtitle'    => 'Output rendered through reusable badge component.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => '
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <div class="flex flex-wrap items-center gap-2">
                ' . $badge_sample('+6.8%', 'positive') . '
                ' . $badge_sample('-2.3%', 'negative') . '
                ' . $badge_sample('Stable', 'neutral') . '
              </div>
            </div>',
        ]);
        ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
