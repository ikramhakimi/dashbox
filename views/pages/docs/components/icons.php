<?php

$page_title   = 'Icons';
$page_current = 'icons';

$menu_items = build_main_menu_items($page_current);

$capture_icon = static function (array $props): string {
  ob_start();
  component('icon', $props);
  return (string) ob_get_clean();
};

$capture_remix_icon = static function (string $icon_path, int $icon_size = 24): string {
  $svg_attributes = '';
  $svg_inner = '';
  $svg_markup = is_file($icon_path) ? (string) file_get_contents($icon_path) : '';

  $svg_markup = preg_replace('/<!--.*?-->/s', '', $svg_markup);
  $svg_markup = is_string($svg_markup) ? $svg_markup : '';

  if (preg_match('/<svg\b([^>]*)>(.*?)<\/svg>/is', $svg_markup, $matches) === 1) {
    $svg_attributes = trim((string) ($matches[1] ?? ''));
    $svg_attributes = preg_replace('/\s(width|height|class|aria-hidden)="[^"]*"/i', '', $svg_attributes);
    $svg_attributes = is_string($svg_attributes) ? trim($svg_attributes) : '';
    $svg_inner = (string) ($matches[1] ?? '');
    $svg_inner = (string) ($matches[2] ?? '');
  }

  return '<svg class="icon icon--' . e((string) $icon_size) . '" aria-hidden="true"'
    . ($svg_attributes !== '' ? ' ' . $svg_attributes : '')
    . '>'
    . $svg_inner
    . '</svg>';
};

$icon_sizes = [16, 24, 32, 64];

$icon_category_paths = glob(__DIR__ . '/../../../../node_modules/remixicon/icons/*', GLOB_ONLYDIR);
$icon_categories = [];
if (is_array($icon_category_paths)) {
  sort($icon_category_paths);

  foreach ($icon_category_paths as $icon_category_path) {
    $icon_category_name = basename($icon_category_path);
    $icon_paths = glob($icon_category_path . '/*.svg');
    if (!is_array($icon_paths) || $icon_paths === []) {
      continue;
    }

    sort($icon_paths);
    $category_icons = [];
    foreach ($icon_paths as $icon_path) {
      $icon_name = pathinfo($icon_path, PATHINFO_FILENAME);
      if (is_string($icon_name) && $icon_name !== '') {
        $category_icons[] = [
          'name' => $icon_name,
          'path' => $icon_path,
        ];
      }
    }

    if ($category_icons !== []) {
      $icon_categories[] = [
        'name'  => $icon_category_name,
        'icons' => $category_icons,
      ];
    }
  }
}

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<section class="card">
  <header class="card__head">
    <h1 class="mt-2 type-h1">Icons UI Component</h1>
    <p class="mt-2 max-w-3xl text-muted">
      Shared icon set with reusable sizes for buttons, inputs, cards, and navigation.
    </p>
  </header>

  <section class="card__list" aria-label="Icon component showcase">
    <ul class="list">
      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h3 class="type-h3">Icon Sizes</h3>
          <p class="mb-4 text-muted">Available <code>icon_size</code> values for the icon component.</p>

          <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            <?php foreach ($icon_sizes as $icon_size): ?>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                <p class="mb-3 type-medium text-body">Size <?= e((string) $icon_size) ?></p>
                <div class="flex items-center gap-3 text-body">
                  <?= $capture_icon(['icon_name' => 'activity', 'icon_size' => $icon_size]) ?>
                  <?= $capture_icon(['icon_name' => 'star', 'icon_size' => $icon_size]) ?>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full py-4">
          <h3 class="type-h3">Remix Icon Categories</h3>
          <p class="mb-4 text-muted">Browse icons by category and filter by name instantly.</p>

          <div class="space-y-4" data-icon-finder>
            <?php
            component('input-group', [
              'id'          => 'icons-finder',
              'name'        => 'icons_finder',
              'placeholder' => 'Find icon by name or category',
              'icon_name'   => 'search',
              'attributes'  => [
                'data-icon-finder-input' => true,
              ],
            ]);
            ?>

            <p class="hidden text-muted" data-icon-finder-empty>
              No icons found. Try another keyword.
            </p>
          </div>

          <div class="mt-4 space-y-6" data-icon-finder-grid>
            <?php foreach ($icon_categories as $icon_category): ?>
              <section data-icon-finder-group>
                <header class="mb-3 flex items-center justify-between gap-3">
                  <h3 class="type-h4"><?= e($icon_category['name']) ?></h3>
                  <p class="text-muted"><?= e((string) count($icon_category['icons'])) ?> icons</p>
                </header>

                <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                  <?php foreach ($icon_category['icons'] as $category_icon): ?>
                    <div
                      class="rounded-lg border border-gray-100 bg-white px-4 py-3"
                      data-icon-finder-item
                      data-icon-name="<?= e(strtolower($category_icon['name'])) ?>"
                      data-icon-category="<?= e(strtolower($icon_category['name'])) ?>"
                    >
                      <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 text-body">
                          <?= $capture_remix_icon($category_icon['path'], 24) ?>
                          <span class="type-medium text-dark"><?= e($category_icon['name']) ?></span>
                        </div>
                        <code class="text-muted">24</code>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </section>
            <?php endforeach; ?>
          </div>
        </section>
      </li>
    </ul>
  </section>
</section>
<?php layout('app-end'); ?>
