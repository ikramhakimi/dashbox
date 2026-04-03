<?php

$page_title   = 'Package Features (Interactive JS Component)';
$page_current = 'package-features';

$menu_items = build_main_menu_items($page_current);

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$feature_editor_id         = 'docs-package-feature-editor';
$package_preview_drawer_id = 'docs-package-feature-preview';
$feature_seed              = [
  'Guided onboarding checklist included',
  'Unlimited dashboard access',
  'Priority support channel',
];

ob_start();
?>
<div class="grid gap-3 md:grid-cols-3">
  <div class="py-3">
    <p class="type-caption type-semibold">Source Module</p>
    <p class="mt-2 type-medium text-dark"><code>assets/js/feature-editor.js</code></p>
    <p class="mt-1 text-muted">Feature list add/remove, numbering, and preview sync.</p>
  </div>
  <div class="py-3">
    <p class="type-caption type-semibold">Bundle Entry</p>
    <p class="mt-2 type-medium text-dark"><code>assets/js/app.js</code></p>
    <p class="mt-1 text-muted">Initializes feature editor with other interactive components.</p>
  </div>
  <div class="py-3">
    <p class="type-caption type-semibold">Compiled Output</p>
    <p class="mt-2 type-medium text-dark"><code>assets/build/app.js</code></p>
    <p class="mt-1 text-muted">Global minified script loaded from layout.</p>
  </div>
</div>
<?php
$package_features_js_doc_content = (string) ob_get_clean();

ob_start();
?>
<aside class="feature-preview" aria-label="Package card preview">
  <p class="feature-preview__label">Public Card Preview</p>
  <article class="feature-preview__card">
    <div class="feature-preview__thumb">
      <span class="feature-preview__thumb-text">Package Thumbnail</span>
    </div>
    <div class="feature-preview__body">
      <h3
        class="feature-preview__title"
        data-feature-preview-title
        data-feature-preview-for="<?= e($feature_editor_id) ?>"
      >
        Package title preview
      </h3>
      <p
        class="feature-preview__price"
        data-feature-preview-price
        data-feature-preview-for="<?= e($feature_editor_id) ?>"
      >
        RM 0
      </p>
      <ul
        class="feature-preview__list"
        data-feature-preview-list
        data-feature-preview-for="<?= e($feature_editor_id) ?>"
      >
        <li>No features yet</li>
      </ul>
      <?php component('button', ['label' => 'Book Package', 'variant' => 'primary']); ?>
    </div>
  </article>
</aside>
<?php
$package_preview_drawer_content = (string) ob_get_clean();

ob_start();
?>
<div class="max-w-3xl">
  <?=
  $capture('input', [
    'id'          => 'product-name',
    'name'        => 'product_name',
    'label'       => 'Package Name',
    'placeholder' => 'e.g. Studio Experience Package',
    'value'       => 'Studio Experience Package',
    'required'    => true,
  ])
  ?>
</div>
<div class="mt-5 max-w-3xl">
  <?=
  $capture('input', [
    'id'          => 'product-price',
    'name'        => 'price',
    'type'        => 'number',
    'label'       => 'Price (RM)',
    'placeholder' => '150',
    'value'       => '150',
    'required'    => true,
  ])
  ?>
</div>
<div class="mt-5 max-w-3xl">
  <?=
  $capture('package-features-editor', [
    'editor_id'            => $feature_editor_id,
    'features_seed'        => $feature_seed,
    'max_features'         => 8,
    'show_preview_trigger' => true,
    'preview_drawer_id'    => $package_preview_drawer_id,
  ])
  ?>
</div>
<?php
$package_features_editor_content = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">
          Package Features (Interactive JS Component)
        </h1>
        <p class="mt-2 max-w-3xl text-muted">
          Structured feature list editor with numbering, remove action, and preview drawer support.
        </p>
      </header>

      <section class="card__list" aria-label="Package features component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">JS Documentation</h2>
            <p class="mt-1 text-muted">
              Paths for package feature editor behavior and compiled assets.
            </p>
          </header>
          <?= $package_features_js_doc_content ?>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Feature List Editor</h2>
            <p class="mt-1 text-muted">
              Numbered feature rows with add/remove controls and preview card drawer.
            </p>
          </header>
          <?= $package_features_editor_content ?>
        </article>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php
component('drawer', [
  'id'          => $package_preview_drawer_id,
  'title'       => 'Public Card Preview',
  'description' => 'How this package card appears in public view.',
  'content'     => $package_preview_drawer_content,
  'placement'   => 'right',
  'size'        => 'lg',
]);
?>
<?php layout('app-end'); ?>
