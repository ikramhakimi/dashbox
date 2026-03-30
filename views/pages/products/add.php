<?php

$page_title   = 'Add Product';
$page_current = 'products-add';

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
        'title'       => 'Add Product',
        'description' => 'Create a new catalog item with pricing details and publish settings.',
      ]);
      ?>

      <article class="card" aria-label="Add Product form">
        <form action="#" method="post">
          <section class="form-section">
            <div class="form-section__grid">
              <div class="form-section__full">
                <?php
                component('dropzone', [
                  'id'        => 'product-photo',
                  'name'      => 'product_photo',
                  'label'     => 'Product Photo',
                  'accept'    => 'image/*',
                  'help_text' => 'Upload product image in JPG, PNG, or WEBP format.',
                ]);
                ?>
              </div>
            </div>
          </section>

          <section class="form-section">
            <div class="form-section__grid">
              <?php
              component('input', [
                'id'          => 'product-name',
                'name'        => 'product_name',
                'label'       => 'Product Name',
                'placeholder' => 'e.g. Sales Pipeline Template',
                'required'    => true,
              ]);

              component('input', [
                'id'          => 'product-sku',
                'name'        => 'product_sku',
                'label'       => 'Product SKU',
                'placeholder' => 'e.g. PRD-2001',
                'required'    => true,
              ]);

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

              ?>
              <div class="form-section__full">
                <?php
                component('switch', [
                  'id'      => 'product-active-package',
                  'name'    => 'active_package',
                  'label'   => 'Set as Active Package',
                  'value'   => '1',
                  'checked' => true,
                ]);
              ?>
            </div>
          </section>

          <section class="form-section">
            <div class="form-section__grid">
              <div class="form-section__full">
                <?php
                component('textarea', [
                  'id'          => 'product-description',
                  'name'        => 'description',
                  'label'       => 'Description',
                  'rows'        => 5,
                  'placeholder' => 'Summarize product value, usage context, and target users.',
                ]);
                ?>
              </div>
            </div>
          </section>

          <section class="form-section">
            <div class="form-section__grid">
              <?php
              component('input', [
                'id'          => 'product-pax-max',
                'name'        => 'pax_max',
                'type'        => 'number',
                'label'       => 'Pax Max',
                'placeholder' => 'e.g. 20',
                'required'    => true,
              ]);
              ?>

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
            </div>
          </section>

          <section
            class="form-section form-section--disabled"
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

          <section class="form-section form-section--last">
            <div class="form-section__grid">
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
          </section>

          <div class="form-actions">
            <div class="form-actions__group">
              <?php
              component('button', [
                'label'   => 'View',
                'href'    => asset('/products'),
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
<?php layout('layout-end'); ?>
