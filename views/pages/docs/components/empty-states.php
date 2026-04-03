<?php

$page_title   = 'Empty State Component';
$page_current = 'empty-states';

$menu_items = build_main_menu_items($page_current);

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
    ['label' => 'Clear Filters'],
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
    ['label' => 'Open Settings'],
  ],
  'attributes'   => [
    'class' => 'bg-gray-50',
  ],
]) ?>
<?php
$empty_state_error_content = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Empty State</h1>
        <p class="mt-2 max-w-3xl text-muted">
          Reusable empty state blocks for no data, no search result, and temporary error states.
        </p>
      </header>

      <section class="card__list" aria-label="Empty state component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Default Empty State</h2>
            <p class="mt-1 text-muted">Primary CTA for first-time setup or onboarding flow.</p>
          </header>
          <?= $empty_state_default_content ?>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Search Empty State</h2>
            <p class="mt-1 text-muted">Use descriptive copy with recovery actions.</p>
          </header>
          <?= $empty_state_search_content ?>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Error Recovery Empty State</h2>
            <p class="mt-1 text-muted">Guides users when loading fails and offers next steps.</p>
          </header>
          <?= $empty_state_error_content ?>
        </article>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
