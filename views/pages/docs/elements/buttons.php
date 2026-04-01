<?php

$page_title   = 'Buttons';
$page_current = 'buttons';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children('buttons'),
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

$capture_button = static function (array $props): string {
  ob_start();
  component('button', $props);
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
        <p class="type-caption type-semibold">UI Elements</p>
        <h1 class="type-h1">Button UI Library</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          High-fidelity button system for primary actions, secondary actions, and contextual controls.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Button component showcase">
        <section>
          <article class="space-y-4 py-7 first:pt-0 last:pb-0">
            <header>
              <h2 class="type-h2">Variants</h2>
              <p class="mt-1 type-body-muted">Primary, default, and danger buttons.</p>
            </header>
            <div class="grid gap-4 md:grid-cols-2">
              <div class="py-4">
                <p class="mb-3 type-caption type-semibold">Primary</p>
                <div class="flex flex-wrap gap-2">
                  <?= $capture_button(['label' => 'Primary', 'variant' => 'primary']) ?>
                  <?= $capture_button(['label' => 'Primary Link', 'variant' => 'primary', 'href' => '#']) ?>
                </div>
              </div>
              <div class="py-4">
                <p class="mb-3 type-caption type-semibold">Default</p>
                <div class="flex flex-wrap gap-2">
                  <?= $capture_button(['label' => 'Default']) ?>
                  <?= $capture_button(['label' => 'Default Link', 'href' => '#']) ?>
                </div>
              </div>
              <div class="py-4">
                <p class="mb-3 type-caption type-semibold">Default (Alt)</p>
                <div class="flex flex-wrap gap-2">
                  <?= $capture_button(['label' => 'Default Alt']) ?>
                  <?= $capture_button(['label' => 'Default Alt Link', 'href' => '#']) ?>
                </div>
              </div>
              <div class="py-4">
                <p class="mb-3 type-caption type-semibold">Danger</p>
                <div class="flex flex-wrap gap-2">
                  <?= $capture_button(['label' => 'Danger', 'variant' => 'danger']) ?>
                  <?= $capture_button(['label' => 'Danger Link', 'variant' => 'danger', 'href' => '#']) ?>
                </div>
              </div>
            </div>
          </article>
        </section>

        <section>
          <article class="space-y-4 py-7 first:pt-0 last:pb-0">
            <header>
              <h2 class="type-h2">Sizes & States</h2>
              <p class="mt-1 type-body-muted">
                Scale and behavior examples for different interaction contexts.
              </p>
            </header>
            <div class="grid gap-4 md:grid-cols-2">
              <div class="py-4">
                <p class="mb-3 type-caption type-semibold">Sizes</p>
                <div class="flex flex-wrap items-center gap-2">
                  <?= $capture_button(['label' => 'Default', 'variant' => 'primary']) ?>
                  <?= $capture_button(['label' => 'Large', 'variant' => 'primary', 'size' => 'lg']) ?>
                </div>
              </div>
              <div class="py-4">
                <p class="mb-3 type-caption type-semibold">States</p>
                <div class="flex flex-wrap items-center gap-2">
                  <?= $capture_button(['label' => 'Enabled']) ?>
                  <?= $capture_button(['label' => 'Disabled', 'disabled' => true]) ?>
                  <?= $capture_button(['label' => 'Disabled Link', 'href' => '#', 'disabled' => true]) ?>
                </div>
              </div>
            </div>
          </article>
        </section>

        <section>
          <article class="space-y-4 py-7 first:pt-0 last:pb-0">
            <header>
              <h2 class="type-h2">Icon Variations</h2>
              <p class="mt-1 type-body-muted">
                Icon + text, text + icon, and icon-only button patterns.
              </p>
            </header>
            <div class="grid gap-4 md:grid-cols-3">
              <div class="py-4">
                <p class="mb-3 type-caption type-semibold">Icon + Text</p>
                <div class="flex flex-wrap items-center gap-2">
                  <?= $capture_button([
                    'label'         => 'Add New',
                    'variant'       => 'primary',
                    'icon_name'     => 'plus',
                    'icon_position' => 'left',
                  ]) ?>
                </div>
              </div>
              <div class="py-4">
                <p class="mb-3 type-caption type-semibold">Text + Icon</p>
                <div class="flex flex-wrap items-center gap-2">
                  <?= $capture_button([
                    'label'         => 'View Team',
                    'icon_name'     => 'users',
                    'icon_position' => 'right',
                  ]) ?>
                </div>
              </div>
              <div class="py-4">
                <p class="mb-3 type-caption type-semibold">Icon Only</p>
                <div class="flex flex-wrap items-center gap-2">
                  <?= $capture_button([
                    'label'      => 'Open Tickets',
                    'aria_label' => 'Open Tickets',
                    'icon_name'  => 'ticket',
                    'icon_only'  => true,
                  ]) ?>
                  <?= $capture_button([
                    'label'      => 'View Metrics',
                    'aria_label' => 'View Metrics',
                    'variant'    => 'primary',
                    'icon_name'  => 'activity',
                    'icon_only'  => true,
                  ]) ?>
                </div>
              </div>
            </div>
          </article>
        </section>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
