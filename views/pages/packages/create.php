<?php

$page_title   = 'Create Package';
$page_current = 'packages-create';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children(),
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

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$package_features_seed = [
  '2-hour studio session',
  '10 edited high-resolution photos',
  'On-site lighting setup included',
];
$feature_editor_id         = 'package-feature-editor';
$package_preview_drawer_id = 'package-card-preview-drawer';

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

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="content flex-1 p-4 lg:p-10">
    <section class="mx-auto max-w-7xl space-y-6">
      <?php
      component('page-header', [
        'title'       => 'Create Package',
        'description' => 'Create a new package with pricing details and publish settings.',
      ]);
      ?>

      <article class="card" aria-label="Create package form">
        <form action="#" method="post">
          <section class="form-section hidden">
            <div class="form-section__grid">
              <div class="form-section__full">
                <?php
                component('dropzone', [
                  'id'        => 'product-photo',
                  'name'      => 'product_photo',
                  'label'     => 'Package Main Photo',
                  'accept'    => 'image/*',
                  'help_text' => 'Upload package image in JPG, PNG, or WEBP format.',
                  'states'    => [
                    'square' => true,
                  ],
                ]);
                ?>
              </div>
            </div>
          </section>

          <section class="form-section">
            <div class="form-section__grid">
              <div class="form-section__full">
                <?php
                component('dropzone', [
                  'id'               => 'package-photos',
                  'name'             => 'package_photos[]',
                  'label'            => 'Package Gallery Photos (Max 10)',
                  'accept'           => 'image/*',
                  'multiple'         => true,
                  'sortable'         => true,
                  'max_files'        => 10,
                  'order_input_name' => 'package_photos_order',
                  'help_text'        => 'Upload additional gallery photos and drag to reorder.',
                ]);
                ?>
              </div>
            </div>
          </section>

          <section class="form-section">
            <div class="form-section__grid">
              <div class="form-section__full w-full lg:w-3/4">
                <?php
                component('input', [
                  'id'          => 'product-name',
                  'name'        => 'product_name',
                  'label'       => 'Package Name',
                  'placeholder' => 'e.g. Sales Pipeline Template',
                  'required'    => true,
                ]);
                ?>
              </div>

              <div class="form-section__full grid gap-5 lg:grid-cols-3">
                <?php
                component('input', [
                  'id'          => 'product-price',
                  'name'        => 'price',
                  'type'        => 'number',
                  'label'       => 'Price (RM)',
                  'placeholder' => '150',
                  'required'    => true,
                ]);

                component('input', [
                  'id'          => 'product-deposit',
                  'name'        => 'deposit',
                  'type'        => 'number',
                  'label'       => 'Deposit (RM)',
                  'placeholder' => '50',
                  'required'    => true,
                ]);

                component('input', [
                  'id'          => 'product-pax-max',
                  'name'        => 'pax_max',
                  'type'        => 'number',
                  'label'       => 'Pax Max',
                  'placeholder' => 'e.g. 20',
                  'required'    => true,
                ]);
                ?>
              </div>
            </div>
          </section>

          <section class="form-section">
            <div class="form-section__grid">
              <div class="form-section__full w-full lg:w-3/4">
                <?php
                component('textarea', [
                  'id'          => 'product-description',
                  'name'        => 'description',
                  'label'       => 'Description',
                  'help_text'   => 'Write a short overview for package details page.',
                  'rows'        => 5,
                  'placeholder' => 'Summarize package value, usage context, and target users.',
                ]);
                ?>
              </div>
            </div>
          </section>

          <section class="form-section">
            <div class="form-section__grid">
              <div
                class="form-section__full w-full lg:w-3/4"
              >
                <?php
                component('package-features-editor', [
                  'editor_id'     => $feature_editor_id,
                  'features_seed' => $package_features_seed,
                  'max_features'  => 8,
                ]);
                ?>
              </div>
            </div>
          </section>

          <section class="form-section">
            <div class="form-section__grid">
              <div class="form-section__full grid gap-5 lg:grid-cols-3">
                <div>
                  <div class="relative">
                    <?php
                    component('textarea', [
                      'id'          => 'product-time-slots',
                      'name'        => 'time_slots',
                      'label'       => 'Time Slots',
                      'rows'        => 5,
                      'placeholder' => 'e.g. 09:00-11:00, 14:00-16:00',
                    ]);
                    ?>
                    <div class="absolute bottom-2 right-2 flex flex-wrap items-center gap-1">
                      <?php
                      component('button', [
                        'label'   => 'Copy',
                        'size'    => 'sm',
                        'type'    => 'button',
                      ]);

                      component('button', [
                        'label'   => 'Edit',
                        'size'    => 'sm',
                        'type'    => 'button',
                      ]);
                      ?>
                    </div>
                  </div>
                </div>

              <div>
                <div class="relative">
                  <?php
                  component('textarea', [
                    'id'          => 'product-date-excludes',
                    'name'        => 'date_excludes',
                    'label'       => 'Date Excludes',
                    'rows'        => 5,
                    'placeholder' => 'List blocked dates or periods.',
                  ]);
                  ?>
                  <div class="absolute bottom-2 right-2 flex flex-wrap items-center gap-1">
                    <?php
                    component('button', [
                      'label'   => 'Copy',
                      'size'    => 'sm',
                      'type'    => 'button',
                    ]);

                    component('button', [
                      'label'   => 'Edit',
                      'size'    => 'sm',
                      'type'    => 'button',
                    ]);
                    ?>
                  </div>
                </div>
              </div>

              <div>
                <div class="relative">
                  <?php
                  component('textarea', [
                    'id'          => 'product-pax-price-setup',
                    'name'        => 'pax_price_setup',
                    'label'       => 'Pax Price Setup',
                    'rows'        => 5,
                    'placeholder' => 'Set pricing rules by pax count.',
                  ]);
                  ?>
                <div class="absolute bottom-2 right-2 flex flex-wrap items-center gap-1">
                  <?php
                  component('button', [
                    'label'   => 'Copy',
                    'size'    => 'sm',
                    'type'    => 'button',
                  ]);

                  component('button', [
                    'label'   => 'Edit',
                    'size'    => 'sm',
                    'type'    => 'button',
                  ]);
                  ?>
                </div>
              </div>
              </div>
              </div>
            </div>
          </section>

          <section
            class="form-section form-section--disabled form-section--last"
            data-date-limit-section
            aria-disabled="true"
          >
            <div class="form-section__grid">
              <div class="form-section__full">
                <?php
                component('switch', [
                  'id'      => 'product-enable-date-limit',
                  'name'    => 'enable_date_limit',
                  'label'   => 'Enable Date Limit',
                  'value'   => '1',
                  'checked' => false,
                ]);
                ?>
              </div>

              <fieldset
                class="form-section__fieldset form-section__full"
                data-date-limit-fields
                disabled
              >
                <?php
                component('datetime-input', [
                  'id'       => 'product-date-limit-from',
                  'name'     => 'date_limit_from',
                  'label'    => 'Date Limit From',
                  'mode'     => 'date',
                  'required' => true,
                ]);

                component('datetime-input', [
                  'id'       => 'product-date-limit-end',
                  'name'     => 'date_limit_end',
                  'label'    => 'Date Limit End',
                  'mode'     => 'date',
                  'required' => true,
                ]);
                ?>
              </fieldset>
            </div>
          </section>

          <div class="form-actions">
            <div class="form-actions__group">
              <?php
              component('button', [
                'label'      => 'Preview Card',
                'type'       => 'button',
                'attributes' => ['data-drawer-open' => $package_preview_drawer_id],
              ]);

              component('button', [
                'label'   => 'Save Package',
                'variant' => 'primary',
                'type'    => 'submit',
              ]);
              ?>
            </div>
          </div>
        </form>
      </article>
    </section>
  </main>
</div>
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
<?php layout('layout-end'); ?>
