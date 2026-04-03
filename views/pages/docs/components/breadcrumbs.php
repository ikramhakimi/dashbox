<?php

$page_title   = 'Breadcrumb Component';
$page_current = 'breadcrumbs';

$menu_items = build_main_menu_items($page_current);

$capture = static function (array $props): string {
  ob_start();
  component('breadcrumb', $props);
  return (string) ob_get_clean();
};

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Breadcrumb UI Component</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Slash and chevron separators, icon support, and compact breadcrumb variant.
        </p>
      </header>

      <section class="card__list" aria-label="Breadcrumb component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Slash Separator</h3>
              <p class="mb-4 type-body-muted">
                Classic slash-style breadcrumb for straightforward nested paths.
              </p>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <?= $capture([
                  'separator' => 'slash',
                  'items'     => [
                    ['label' => 'Home', 'href' => asset('/')],
                    ['label' => 'Components', 'href' => asset('/docs/components/buttons')],
                    ['label' => 'Forms', 'href' => asset('/docs/components/inputs')],
                    ['label' => 'Breadcrumbs', 'current' => true],
                  ],
                ]) ?>
              </div>
            </section>
          </li>

          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Chevron Separator (SVG)</h3>
              <p class="mb-4 type-body-muted">
                Directional breadcrumb separators to emphasize hierarchy flow.
              </p>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <?= $capture([
                  'separator' => 'chevron',
                  'items'     => [
                    ['label' => 'Home', 'href' => asset('/')],
                    ['label' => 'Orders', 'href' => '#'],
                    ['label' => 'Order Detail', 'current' => true],
                  ],
                ]) ?>
              </div>
            </section>
          </li>

          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">With Icon</h3>
              <p class="mb-4 type-body-muted">
                Icon-assisted breadcrumb items for richer navigation context.
              </p>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <?= $capture([
                  'separator' => 'chevron',
                  'items'     => [
                    ['label' => 'Dashboard', 'href' => asset('/'), 'icon_name' => 'activity'],
                    ['label' => 'Team', 'href' => '#', 'icon_name' => 'users'],
                    ['label' => 'Members', 'current' => true, 'icon_name' => 'star'],
                  ],
                ]) ?>
              </div>
            </section>
          </li>

          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Compact</h3>
              <p class="mb-4 type-body-muted">
                Dense variant for constrained layouts and compact utility contexts.
              </p>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <?= $capture([
                  'compact'   => true,
                  'separator' => 'slash',
                  'items'     => [
                    ['label' => 'Root', 'href' => '#'],
                    ['label' => 'Library', 'href' => '#'],
                    ['label' => 'UI', 'href' => '#'],
                    ['label' => 'Breadcrumbs', 'current' => true],
                  ],
                ]) ?>
              </div>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
