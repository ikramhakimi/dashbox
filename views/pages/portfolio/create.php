<?php

$page_title   = 'Create Portfolio';
$page_current = 'portfolio-create';

$menu_items = build_main_menu_items();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="mx-auto max-w-7xl space-y-6">
      <?php
      component('page-header', [
        'title'       => 'Create Portfolio',
        'description' => 'Build a portfolio set with cover image and up to 10 gallery images.',
      ]);
      ?>

      <article class="card" aria-label="Create portfolio form">
        <form class="card__body" action="#" method="post" enctype="multipart/form-data">
          <section class="form-section">
            <div class="form-section__grid">
              <div class="form-section__full">
                <?php
                component('dropzone', [
                  'id'        => 'portfolio-cover-image',
                  'name'      => 'cover_image',
                  'label'     => 'Cover Image (Square Large)',
                  'accept'    => 'image/*',
                  'help_text' => 'Upload a square cover image. Recommended 1200 x 1200.',
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
                  'id'               => 'portfolio-images',
                  'name'             => 'portfolio_images[]',
                  'label'            => 'Portfolio Images (10 images max)',
                  'accept'           => 'image/*',
                  'multiple'         => true,
                  'sortable'         => true,
                  'max_files'        => 10,
                  'order_input_name' => 'portfolio_images_order',
                  'help_text'        => 'Upload up to 10 images. Drag thumbnails to reorder.',
                ]);
                ?>
              </div>
            </div>
          </section>

          <section class="form-section">
            <div class="form-section__grid">
              <?php
              component('select', [
                'id'      => 'portfolio-type',
                'name'    => 'portfolio_type',
                'label'   => 'Portfolio Type',
                'value'   => 'product',
                'options' => [
                  ['label' => 'Product', 'value' => 'product'],
                ],
              ]);

              component('input', [
                'id'          => 'portfolio-title',
                'name'        => 'portfolio_title',
                'label'       => 'Portfolio Title',
                'placeholder' => 'e.g. Product Campaign Visuals',
                'required'    => true,
                'class'       => 'form-section__full',
              ]);
              ?>

              <div class="form-section__full">
                <?php
                component('textarea', [
                  'id'          => 'portfolio-description',
                  'name'        => 'portfolio_description',
                  'label'       => 'Portfolio Description',
                  'rows'        => 5,
                  'placeholder' => 'Summarize this portfolio concept and intended usage.',
                ]);
                ?>
              </div>
            </div>
          </section>

          <div class="form-actions">
            <div class="form-actions__group">
              <?php
              component('button', [
                'label'   => 'Publish Portfolio',
                'variant' => 'primary',
                'type'    => 'submit',
              ]);

              component('button', [
                'label' => 'Save Draft',
                'href'  => asset('/portfolio'),
              ]);
              ?>
            </div>
          </div>
        </form>
      </article>
    </section>
<?php layout('app-end'); ?>
