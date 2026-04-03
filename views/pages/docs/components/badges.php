<?php

$page_title   = 'Badges';
$page_current = 'badges';

$menu_items = build_main_menu_items($page_current);

$badge_sample = static function (string $value, string $mode): string {
  ob_start();
  component('badge', [
    'trend_value' => $value,
    'trend_mode'  => $mode,
  ]);
  return (string) ob_get_clean();
};

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Badge UI Component</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Reference page for all badge modes and practical examples.
        </p>
      </header>

      <section class="card__list" aria-label="Badge component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Badge Modes</h3>
              <p class="mb-4 type-body-muted">
                Default visual variants supported by the badge component.
              </p>
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
            </section>
          </li>

          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Badge Component Examples</h3>
              <p class="mb-4 type-body-muted">
                Output rendered through reusable badge component.
              </p>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <div class="flex flex-wrap items-center gap-2">
                  <?= $badge_sample('+6.8%', 'positive') ?>
                  <?= $badge_sample('-2.3%', 'negative') ?>
                  <?= $badge_sample('Stable', 'neutral') ?>
                </div>
              </div>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
