<?php

$page_title   = 'Pagination Component';
$page_current = 'paginations';

$menu_items = build_main_menu_items($page_current);

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
    'base_url'     => asset('/docs/components/paginations?page=%d'),
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
    'base_url'     => asset('/docs/components/paginations?page=%d'),
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
    'base_url'     => asset('/docs/components/paginations?page=%d'),
  ]) ?>
</div>
<?php
$pagination_single_content = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Pagination</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Foundation pagination with active state, disabled edges, and optional result info.
        </p>
      </header>

      <section class="card__list" aria-label="Pagination component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Default (Prev + Next Clamp)</h2>
            <p class="mt-1 type-body-muted">
              Connected previous and next controls as primary pagination navigation.
            </p>
          </header>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <?= $pagination_default_content ?>
          </div>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Pagination with Info</h2>
            <p class="mt-1 type-body-muted">
              Include showing range and total items for better context.
            </p>
          </header>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <?= $pagination_info_content ?>
          </div>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Single Page / Empty State</h2>
            <p class="mt-1 type-body-muted">
              Disabled controls when only one page is available.
            </p>
          </header>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <?= $pagination_single_content ?>
          </div>
        </article>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
