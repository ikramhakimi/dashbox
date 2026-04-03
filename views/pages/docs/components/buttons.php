<?php

$page_title   = 'Button Component';
$page_current = 'buttons';

$menu_items = build_main_menu_items($page_current);

$capture_button = static function (array $props): string {
  ob_start();
  component('button', $props);
  return (string) ob_get_clean();
};

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="type-h1">Button UI Component</h1>
        <p class="mt-2 max-w-3xl text-muted">
          High-fidelity button system for primary actions, secondary actions, and contextual controls.
        </p>
      </header>

      <section class="card__list" aria-label="Button component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Variants</h3>
              <p class="mb-4 text-muted">Primary, default, and danger buttons.</p>
              <div class="grid gap-4 md:grid-cols-2">
                  <div class="rounded-lg border border-gray-100 bg-white p-4">
                    <h4 class="type-h4">Primary</h4>
                    <p class="mb-4 text-muted">Primary CTA styles for dominant actions.</p>
                    <div class="flex flex-wrap gap-2">
                      <?= $capture_button(['label' => 'Primary', 'variant' => 'primary']) ?>
                      <?= $capture_button(['label' => 'Primary Link', 'variant' => 'primary', 'href' => '#']) ?>
                    </div>
                  </div>
                  <div class="rounded-lg border border-gray-100 bg-white p-4">
                    <h4 class="type-h4">Default</h4>
                    <p class="mb-4 text-muted">Standard button style for regular actions.</p>
                    <div class="flex flex-wrap gap-2">
                      <?= $capture_button(['label' => 'Default']) ?>
                      <?= $capture_button(['label' => 'Default Link', 'href' => '#']) ?>
                    </div>
                  </div>
                  <div class="rounded-lg border border-gray-100 bg-white p-4">
                    <h4 class="type-h4">Default (Alt)</h4>
                    <p class="mb-4 text-muted">Alternative neutral treatment in the same hierarchy.</p>
                    <div class="flex flex-wrap gap-2">
                      <?= $capture_button(['label' => 'Default Alt']) ?>
                      <?= $capture_button(['label' => 'Default Alt Link', 'href' => '#']) ?>
                    </div>
                  </div>
                  <div class="rounded-lg border border-gray-100 bg-white p-4">
                    <h4 class="type-h4">Danger</h4>
                    <p class="mb-4 text-muted">Destructive action style with stronger caution cue.</p>
                    <div class="flex flex-wrap gap-2">
                      <?= $capture_button(['label' => 'Danger', 'variant' => 'danger']) ?>
                      <?= $capture_button(['label' => 'Danger Link', 'variant' => 'danger', 'href' => '#']) ?>
                    </div>
                  </div>
              </div>
            </section>
          </li>

          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Sizes & States</h3>
              <p class="mb-4 text-muted">
                Scale and behavior examples for different interaction contexts.
              </p>
              <div class="grid gap-4 md:grid-cols-2">
                  <div class="rounded-lg border border-gray-100 bg-white p-4">
                    <h4 class="type-h4">Sizes</h4>
                    <p class="mb-4 text-muted">Default and large sizes for density flexibility.</p>
                    <div class="flex flex-wrap items-center gap-2">
                      <?= $capture_button(['label' => 'Default', 'variant' => 'primary']) ?>
                      <?= $capture_button(['label' => 'Large', 'variant' => 'primary', 'size' => 'lg']) ?>
                    </div>
                  </div>
                  <div class="rounded-lg border border-gray-100 bg-white p-4">
                    <h4 class="type-h4">States</h4>
                    <p class="mb-4 text-muted">Enabled and disabled examples across button types.</p>
                    <div class="flex flex-wrap items-center gap-2">
                      <?= $capture_button(['label' => 'Enabled']) ?>
                      <?= $capture_button(['label' => 'Disabled', 'disabled' => true]) ?>
                      <?= $capture_button(['label' => 'Disabled Link', 'href' => '#', 'disabled' => true]) ?>
                    </div>
                  </div>
              </div>
            </section>
          </li>

          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
              <h3 class="type-h3">Icon Variations</h3>
              <p class="mb-4 text-muted">
                Icon + text, text + icon, and icon-only button patterns.
              </p>
              <div class="grid gap-4 md:grid-cols-2">
                  <div class="rounded-lg border border-gray-100 bg-white p-4">
                    <h4 class="type-h4">Icon + Text</h4>
                    <p class="mb-4 text-muted">Leading icon with text label for clear intent.</p>
                    <div class="flex flex-wrap items-center gap-2">
                      <?= $capture_button([
                        'label'         => 'Add New',
                        'variant'       => 'primary',
                        'icon_name'     => 'plus',
                        'icon_position' => 'left',
                      ]) ?>
                    </div>
                  </div>
                  <div class="rounded-lg border border-gray-100 bg-white p-4">
                    <h4 class="type-h4">Text + Icon</h4>
                    <p class="mb-4 text-muted">Trailing icon pattern for forward actions.</p>
                    <div class="flex flex-wrap items-center gap-2">
                      <?= $capture_button([
                        'label'         => 'View Team',
                        'icon_name'     => 'users',
                        'icon_position' => 'right',
                      ]) ?>
                    </div>
                  </div>
                  <div class="rounded-lg border border-gray-100 bg-white p-4 md:col-span-2">
                    <h4 class="type-h4">Icon Only</h4>
                    <p class="mb-4 text-muted">Compact icon-only controls with explicit aria labels.</p>
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
                      <?= $capture_button([
                        'label'      => 'Create Item',
                        'aria_label' => 'Create Item',
                        'variant'    => 'primary',
                        'icon_name'  => 'plus',
                        'icon_only'  => true,
                      ]) ?>
                      <?= $capture_button([
                        'label'      => 'Open Team',
                        'aria_label' => 'Open Team',
                        'icon_name'  => 'users',
                        'icon_only'  => true,
                      ]) ?>
                      <?= $capture_button([
                        'label'      => 'Find Records',
                        'aria_label' => 'Find Records',
                        'icon_name'  => 'search',
                        'icon_only'  => true,
                      ]) ?>
                      <?= $capture_button([
                        'label'      => 'Open Layers',
                        'aria_label' => 'Open Layers',
                        'icon_name'  => 'layers',
                        'icon_only'  => true,
                      ]) ?>
                      <?= $capture_button([
                        'label'      => 'Open Grid',
                        'aria_label' => 'Open Grid',
                        'icon_name'  => 'layout-grid',
                        'icon_only'  => true,
                      ]) ?>
                      <?= $capture_button([
                        'label'      => 'Mark Favorite',
                        'aria_label' => 'Mark Favorite',
                        'variant'    => 'primary',
                        'icon_name'  => 'star',
                        'icon_only'  => true,
                      ]) ?>
                      <?= $capture_button([
                        'label'      => 'Open Code',
                        'aria_label' => 'Open Code',
                        'icon_name'  => 'code',
                        'icon_only'  => true,
                      ]) ?>
                      <?= $capture_button([
                        'label'      => 'Close Panel',
                        'aria_label' => 'Close Panel',
                        'variant'    => 'danger',
                        'icon_name'  => 'x',
                        'icon_only'  => true,
                      ]) ?>
                    </div>
                  </div>
              </div>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
