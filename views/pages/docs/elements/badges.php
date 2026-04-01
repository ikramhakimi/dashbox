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

  <main class="content flex-1 p-4 lg:p-10">
    <section class="mx-auto max-w-7xl">
      <header class="mb-8 border-b border-gray-200 pb-6">
        <h1 class="type-h1">Badge UI Library</h1>
        <p class="mt-1 type-body-muted">
          Reference page for all badge modes and practical examples.
        </p>
      </header>

      <section class="mb-6">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Badge Modes</h2>
            <p class="mt-1 type-body-muted">
              Default visual variants supported by the badge component.
            </p>
          </header>
          <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <p class="mb-2 type-caption type-semibold">Positive</p>
              <span class="badge badge--positive">+12.4%</span>
            </div>
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <p class="mb-2 type-caption type-semibold">Negative</p>
              <span class="badge badge--negative">-4.1%</span>
            </div>
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <p class="mb-2 type-caption type-semibold">Neutral</p>
              <span class="badge badge--neutral">Pending</span>
            </div>
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <p class="mb-2 type-caption type-semibold">Warning</p>
              <span class="badge badge--warning">Awaiting Review</span>
            </div>
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <p class="mb-2 type-caption type-semibold">Info</p>
              <span class="badge badge--info">In Progress</span>
            </div>
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <p class="mb-2 type-caption type-semibold">Accent</p>
              <span class="badge badge--accent">Priority</span>
            </div>
          </div>
        </article>
      </section>

      <section>
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Badge Component Examples</h2>
            <p class="mt-1 type-body-muted">
              Output rendered through reusable badge component.
            </p>
          </header>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <div class="flex flex-wrap items-center gap-2">
              <?= $badge_sample('+6.8%', 'positive') ?>
              <?= $badge_sample('-2.3%', 'negative') ?>
              <?= $badge_sample('Stable', 'neutral') ?>
            </div>
          </div>
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
