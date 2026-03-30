<?php

$page_title   = 'Form Patterns';
$page_current = 'forms';

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
    'children' => ui_patterns_sidebar_children('forms'),
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

ob_start();
?>
  <form action="#" method="post">
    <?= $capture('alert', [
      'variant'     => 'info',
      'description' => 'Use this pattern for admin onboarding with role and access setup.',
      'show_icon'   => true,
    ]) ?>

    <section class="form-section">
      <div class="form-section__grid">
        <?= $capture('input', [
          'id'          => 'add-user-full-name',
          'name'        => 'full_name',
          'label'       => 'Full Name',
          'placeholder' => 'e.g. Aisyah Ahmad',
          'required'    => true,
        ]) ?>
        <?= $capture('input', [
          'id'          => 'add-user-email',
          'name'        => 'work_email',
          'type'        => 'email',
          'label'       => 'Work Email',
          'placeholder' => 'aisyah@company.com',
          'required'    => true,
        ]) ?>
        <?= $capture('select', [
          'id'       => 'add-user-role',
          'name'     => 'role',
          'label'    => 'Role',
          'value'    => 'editor',
          'required' => true,
          'options'  => [
            ['label' => 'Choose role', 'value' => '', 'disabled' => true],
            ['label' => 'Admin', 'value' => 'admin'],
            ['label' => 'Editor', 'value' => 'editor'],
            ['label' => 'Viewer', 'value' => 'viewer'],
          ],
        ]) ?>
        <?= $capture('select', [
          'id'      => 'add-user-team',
          'name'    => 'team',
          'label'   => 'Team',
          'value'   => 'product',
          'options' => [
            ['label' => 'Product', 'value' => 'product'],
            ['label' => 'Marketing', 'value' => 'marketing'],
            ['label' => 'Operations', 'value' => 'operations'],
          ],
        ]) ?>
      </div>
    </section>

    <section class="form-section form-section--last">
      <div class="form-section__grid">
        <div class="form-section__full grid gap-3 md:grid-cols-2">
          <?= $capture('radio', [
            'id'      => 'add-user-status-active',
            'name'    => 'status',
            'label'   => 'Activate now',
            'value'   => 'active',
            'checked' => true,
          ]) ?>
          <?= $capture('radio', [
            'id'    => 'add-user-status-invite',
            'name'  => 'status',
            'label' => 'Send invite first',
            'value' => 'invite',
          ]) ?>
          <?= $capture('checkbox', [
            'id'      => 'add-user-permission-export',
            'name'    => 'permission_export',
            'label'   => 'Can export sensitive reports',
            'value'   => '1',
            'checked' => false,
          ]) ?>
          <?= $capture('switch', [
            'id'      => 'add-user-welcome-email',
            'name'    => 'send_welcome_email',
            'label'   => 'Send welcome email after creation',
            'value'   => '1',
            'checked' => true,
          ]) ?>
        </div>
      </div>
    </section>

    <div class="form-actions">
      <?= $capture('button', ['label' => 'Create User', 'variant' => 'primary', 'type' => 'submit']) ?>
      <?= $capture('button', ['label' => 'Save Draft', 'type' => 'submit']) ?>
      <?= $capture('button', [
        'label'      => 'Open Add User Modal',
        'attributes' => ['data-modal-open' => 'form-modal-add-user'],
      ]) ?>
    </div>
  </form>
<?php
$pattern_add_user_content = (string) ob_get_clean();

ob_start();
?>
  <form action="#" method="post">
    <?= $capture('alert', [
      'variant'     => 'warning',
      'description' => 'Complete SKU and price before publishing to storefront.',
      'show_icon'   => true,
    ]) ?>

    <section class="form-section">
      <div class="form-section__grid">
        <?= $capture('input', [
          'id'          => 'add-product-name',
          'name'        => 'product_name',
          'label'       => 'Product Name',
          'placeholder' => 'e.g. Dashbox Starter Kit',
          'required'    => true,
        ]) ?>
        <?= $capture('input', [
          'id'          => 'add-product-sku',
          'name'        => 'sku',
          'label'       => 'SKU',
          'placeholder' => 'DBX-STARTER-001',
          'required'    => true,
        ]) ?>
        <?= $capture('select', [
          'id'      => 'add-product-category',
          'name'    => 'category',
          'label'   => 'Category',
          'value'   => 'software',
          'options' => [
            ['label' => 'Software', 'value' => 'software'],
            ['label' => 'Services', 'value' => 'services'],
            ['label' => 'Merchandise', 'value' => 'merchandise'],
          ],
        ]) ?>
        <?= $capture('input', [
          'id'          => 'add-product-price',
          'name'        => 'price',
          'type'        => 'number',
          'label'       => 'Price (RM)',
          'placeholder' => '99',
          'required'    => true,
        ]) ?>
        <div class="form-section__full">
          <?= $capture('textarea', [
            'id'          => 'add-product-description',
            'name'        => 'description',
            'label'       => 'Description',
            'rows'        => 4,
            'placeholder' => 'Explain key benefits and product scope',
          ]) ?>
        </div>
      </div>
    </section>

    <section class="form-section form-section--last">
      <div class="form-section__grid">
        <div class="form-section__full grid gap-3 md:grid-cols-2">
          <?= $capture('radio', [
            'id'      => 'add-product-visibility-public',
            'name'    => 'visibility',
            'label'   => 'Public listing',
            'value'   => 'public',
            'checked' => true,
          ]) ?>
          <?= $capture('radio', [
            'id'    => 'add-product-visibility-private',
            'name'  => 'visibility',
            'label' => 'Private draft',
            'value' => 'private',
          ]) ?>
          <?= $capture('checkbox', [
            'id'      => 'add-product-taxable',
            'name'    => 'taxable',
            'label'   => 'Apply sales tax',
            'value'   => '1',
            'checked' => true,
          ]) ?>
          <?= $capture('switch', [
            'id'      => 'add-product-publish',
            'name'    => 'publish_now',
            'label'   => 'Publish immediately',
            'value'   => '1',
            'checked' => false,
          ]) ?>
        </div>
      </div>
    </section>

    <div class="form-actions">
      <?= $capture('button', ['label' => 'Save Product', 'variant' => 'primary', 'type' => 'submit']) ?>
      <?= $capture('button', [
        'label'      => 'Bulk Variants Modal',
        'attributes' => ['data-modal-open' => 'form-modal-add-product'],
      ]) ?>
    </div>
  </form>
<?php
$pattern_add_product_content = (string) ob_get_clean();

ob_start();
?>
  <form action="#" method="post">
    <?= $capture('alert', [
      'variant'     => 'success',
      'description' => 'Theme changes are saved as draft first, then published to all tenants.',
      'show_icon'   => true,
    ]) ?>

    <section class="form-section">
      <div class="form-section__grid">
        <?= $capture('select', [
          'id'      => 'theme-color-preset',
          'name'    => 'color_preset',
          'label'   => 'Color Preset',
          'value'   => 'slate',
          'options' => [
            ['label' => 'Slate', 'value' => 'slate'],
            ['label' => 'Indigo', 'value' => 'indigo'],
            ['label' => 'Emerald', 'value' => 'emerald'],
          ],
        ]) ?>
        <?= $capture('select', [
          'id'      => 'theme-font-scale',
          'name'    => 'font_scale',
          'label'   => 'Font Scale',
          'value'   => 'base',
          'options' => [
            ['label' => 'Compact', 'value' => 'compact'],
            ['label' => 'Base', 'value' => 'base'],
            ['label' => 'Comfortable', 'value' => 'comfortable'],
          ],
        ]) ?>
        <div class="form-section__full">
          <?= $capture('textarea', [
            'id'          => 'theme-release-note',
            'name'        => 'release_note',
            'label'       => 'Release Note',
            'rows'        => 3,
            'placeholder' => 'Summarize what changed in this theme update',
          ]) ?>
        </div>
      </div>
    </section>

    <section class="form-section form-section--last">
      <div class="form-section__grid">
        <div class="form-section__full grid gap-3 md:grid-cols-2">
          <?= $capture('radio', [
            'id'      => 'theme-density-default',
            'name'    => 'density',
            'label'   => 'Default density',
            'value'   => 'default',
            'checked' => true,
          ]) ?>
          <?= $capture('radio', [
            'id'    => 'theme-density-compact',
            'name'  => 'density',
            'label' => 'Compact density',
            'value' => 'compact',
          ]) ?>
          <?= $capture('checkbox', [
            'id'      => 'theme-show-borders',
            'name'    => 'show_borders',
            'label'   => 'Show card borders across dashboard',
            'value'   => '1',
            'checked' => true,
          ]) ?>
          <?= $capture('switch', [
            'id'      => 'theme-live-preview',
            'name'    => 'live_preview',
            'label'   => 'Enable live preview before publish',
            'value'   => '1',
            'checked' => true,
          ]) ?>
        </div>
      </div>
    </section>

    <div class="form-actions">
      <?= $capture('button', [
        'label'      => 'Preview & Publish Modal',
        'variant'    => 'primary',
        'attributes' => ['data-modal-open' => 'form-modal-theme-settings'],
      ]) ?>
      <?= $capture('button', ['label' => 'Save Theme Draft', 'type' => 'submit']) ?>
    </div>
  </form>
<?php
$pattern_theme_settings_content = (string) ob_get_clean();

ob_start();
?>
  <form action="#" method="post">
    <?= $capture('alert', [
      'variant'     => 'warning',
      'description' => 'When date limit is disabled, date window controls become read-only for audit clarity.',
      'show_icon'   => true,
    ]) ?>

    <section class="form-section">
      <div class="form-section__grid">
        <div class="form-section__full">
          <?= $capture('input-group', [
            'id'          => 'booking-package-finder',
            'name'        => 'package_finder',
            'label'       => 'Package Finder',
            'placeholder' => 'Search package code or title',
            'icon_name'   => 'magnifying-glass',
            'icon_side'   => 'left',
          ]) ?>
        </div>

        <?= $capture('input', [
          'id'          => 'booking-title',
          'name'        => 'booking_title',
          'label'       => 'Package Title',
          'placeholder' => 'e.g. Langkawi Sunset Cruise',
          'required'    => true,
        ]) ?>

        <?= $capture('input', [
          'id'          => 'booking-pax-max',
          'name'        => 'pax_max',
          'type'        => 'number',
          'label'       => 'Pax Max',
          'placeholder' => '20',
          'required'    => true,
        ]) ?>
      </div>
    </section>

    <section class="form-section form-section--disabled" aria-disabled="true">
      <div class="form-section__grid">
        <div class="form-section__full">
          <?= $capture('switch', [
            'id'      => 'booking-enable-date-limit',
            'name'    => 'enable_date_limit',
            'label'   => 'Enable Date Limit',
            'checked' => false,
          ]) ?>
        </div>

        <fieldset class="form-section__fieldset form-section__full" disabled>
          <?= $capture('datetime-input', [
            'id'    => 'booking-date-from',
            'name'  => 'date_from',
            'label' => 'Date Limit From',
            'mode'  => 'date',
          ]) ?>

          <?= $capture('datetime-input', [
            'id'    => 'booking-date-end',
            'name'  => 'date_end',
            'label' => 'Date Limit End',
            'mode'  => 'date',
          ]) ?>
        </fieldset>
      </div>
    </section>

    <section class="form-section form-section--last">
      <div class="form-section__grid">
        <div class="form-section__full">
          <?= $capture('textarea', [
            'id'          => 'booking-excludes',
            'name'        => 'date_excludes',
            'label'       => 'Date Excludes',
            'rows'        => 3,
            'placeholder' => 'e.g. 2026-04-01, 2026-05-17',
          ]) ?>
        </div>
      </div>
    </section>

    <div class="form-actions">
      <?= $capture('button', ['label' => 'Publish Package', 'variant' => 'primary']) ?>
      <?= $capture('button', ['label' => 'Save Schedule Draft']) ?>
    </div>
  </form>
<?php
$pattern_booking_content = (string) ob_get_clean();

ob_start();
?>
  <form action="#" method="post">
    <?= $capture('alert', [
      'variant'     => 'info',
      'title'       => 'Bulk Import Configuration',
      'description' => 'Upload CSV, map required fields, and enable safe import options before sync.',
      'show_icon'   => true,
    ]) ?>

    <section class="form-section">
      <div class="form-section__grid">
        <div class="form-section__full">
          <?= $capture('dropzone', [
            'id'        => 'bulk-import-file',
            'name'      => 'import_file',
            'label'     => 'Import File',
            'accept'    => '.csv,.xlsx',
            'help_text' => 'Supported format: CSV or XLSX.',
          ]) ?>
        </div>
      </div>
    </section>

    <section class="form-section">
      <div class="form-section__grid">
        <?= $capture('select', [
          'id'      => 'bulk-import-target',
          'name'    => 'target_module',
          'label'   => 'Target Module',
          'value'   => 'customers',
          'options' => [
            ['label' => 'Customers', 'value' => 'customers'],
            ['label' => 'Products', 'value' => 'products'],
            ['label' => 'Orders', 'value' => 'orders'],
          ],
        ]) ?>

        <?= $capture('select', [
          'id'      => 'bulk-import-duplicate-policy',
          'name'    => 'duplicate_policy',
          'label'   => 'Duplicate Policy',
          'value'   => 'update',
          'options' => [
            ['label' => 'Skip duplicate rows', 'value' => 'skip'],
            ['label' => 'Update existing rows', 'value' => 'update'],
            ['label' => 'Create as new rows', 'value' => 'create_new'],
          ],
        ]) ?>

        <div class="form-section__full">
          <?= $capture('textarea', [
            'id'          => 'bulk-import-column-map',
            'name'        => 'column_map_note',
            'label'       => 'Column Mapping Notes',
            'rows'        => 3,
            'placeholder' => 'Optional mapping notes for teammates and QA handoff.',
          ]) ?>
        </div>
      </div>
    </section>

    <section class="form-section form-section--last">
      <div class="form-section__grid">
        <div class="form-section__full grid gap-3 md:grid-cols-2">
          <?= $capture('checkbox', [
            'id'      => 'bulk-import-dry-run',
            'name'    => 'dry_run',
            'label'   => 'Run validation only (no write operation)',
            'checked' => true,
          ]) ?>

          <?= $capture('checkbox', [
            'id'      => 'bulk-import-send-report',
            'name'    => 'send_report',
            'label'   => 'Send import report to operations email',
            'checked' => true,
          ]) ?>

          <?= $capture('switch', [
            'id'      => 'bulk-import-auto-tag',
            'name'    => 'auto_tag',
            'label'   => 'Auto-tag rows imported by this batch',
            'checked' => true,
          ]) ?>

          <?= $capture('switch', [
            'id'      => 'bulk-import-active-after-sync',
            'name'    => 'active_after_sync',
            'label'   => 'Activate records immediately after sync',
            'checked' => false,
          ]) ?>
        </div>
      </div>
    </section>

    <div class="form-actions">
      <?= $capture('button', ['label' => 'Start Import', 'variant' => 'primary']) ?>
      <?= $capture('button', ['label' => 'Validate File']) ?>
      <?= $capture('button', ['label' => 'Open Validation Modal', 'attributes' => ['data-modal-open' => 'form-modal-import-review']]) ?>
    </div>
  </form>
<?php
$pattern_import_content = (string) ob_get_clean();

$form_modal_add_user_body = '
  <div class="space-y-4">
    ' . $capture('tabs', [
      'compact' => true,
      'items'   => [
        ['label' => 'Identity', 'href' => '#', 'active' => true],
        ['label' => 'Permissions', 'href' => '#'],
      ],
    ]) . '
    ' . $capture('alert', [
      'variant'     => 'info',
      'description' => 'Modal version for quick user onboarding.',
      'show_icon'   => true,
    ]) . '
    <div class="grid gap-4 md:grid-cols-2">
      ' . $capture('input', [
        'id'          => 'form-modal-add-user-name',
        'name'        => 'full_name',
        'label'       => 'Full Name',
        'placeholder' => 'e.g. Nur Aina',
        'required'    => true,
      ]) . '
      ' . $capture('input', [
        'id'          => 'form-modal-add-user-email',
        'name'        => 'work_email',
        'type'        => 'email',
        'label'       => 'Work Email',
        'placeholder' => 'aina@company.com',
        'required'    => true,
      ]) . '
      <div class="md:col-span-2">
        ' . $capture('select', [
          'id'      => 'form-modal-add-user-role',
          'name'    => 'role',
          'label'   => 'Default Role',
          'value'   => 'editor',
          'options' => [
            ['label' => 'Admin', 'value' => 'admin'],
            ['label' => 'Editor', 'value' => 'editor'],
            ['label' => 'Viewer', 'value' => 'viewer'],
          ],
        ]) . '
      </div>
      <div class="md:col-span-2 grid gap-3 md:grid-cols-2">
        ' . $capture('checkbox', [
          'id'      => 'form-modal-add-user-export',
          'name'    => 'permission_export',
          'label'   => 'Allow export reports',
          'checked' => false,
        ]) . '
        ' . $capture('switch', [
          'id'      => 'form-modal-add-user-welcome',
          'name'    => 'send_welcome',
          'label'   => 'Send welcome email',
          'checked' => true,
        ]) . '
      </div>
    </div>
  </div>
';

$form_modal_add_user_footer = '
  <div class="flex items-center gap-2">
    ' . $capture('button', [
      'label'   => 'Create User',
      'variant' => 'primary',
      'type'    => 'submit',
    ]) . '
    ' . $capture('button', [
      'label'      => 'Cancel',
      'attributes' => ['data-modal-close' => true],
    ]) . '
  </div>
';

$form_modal_add_product_body = '
  <div class="space-y-4">
    ' . $capture('tabs', [
      'compact' => true,
      'items'   => [
        ['label' => 'Variants', 'href' => '#', 'active' => true],
        ['label' => 'Inventory', 'href' => '#'],
      ],
    ]) . '
    ' . $capture('alert', [
      'variant'     => 'warning',
      'title'       => 'Variant setup required',
      'description' => 'At least one size and one color are required.',
      'show_icon'   => true,
    ]) . '
    <div class="grid gap-4 md:grid-cols-2">
      ' . $capture('input', [
        'id'          => 'form-modal-add-product-sku-base',
        'name'        => 'sku_base',
        'label'       => 'Base SKU',
        'placeholder' => 'DBX-TSHIRT',
      ]) . '
      ' . $capture('input', [
        'id'          => 'form-modal-add-product-stock',
        'name'        => 'initial_stock',
        'type'        => 'number',
        'label'       => 'Initial Stock',
        'placeholder' => '100',
      ]) . '
      <div class="md:col-span-2 grid gap-3 md:grid-cols-2">
        ' . $capture('checkbox', [
          'id'      => 'form-modal-add-product-size-s',
          'name'    => 'size_s',
          'label'   => 'Size S',
          'checked' => true,
        ]) . '
        ' . $capture('checkbox', [
          'id'      => 'form-modal-add-product-size-m',
          'name'    => 'size_m',
          'label'   => 'Size M',
          'checked' => true,
        ]) . '
        ' . $capture('checkbox', [
          'id'      => 'form-modal-add-product-color-black',
          'name'    => 'color_black',
          'label'   => 'Color Black',
          'checked' => true,
        ]) . '
        ' . $capture('checkbox', [
          'id'      => 'form-modal-add-product-color-white',
          'name'    => 'color_white',
          'label'   => 'Color White',
          'checked' => false,
        ]) . '
      </div>
    </div>
  </div>
';

$form_modal_add_product_footer = '
  <div class="flex items-center gap-2">
    ' . $capture('button', [
      'label'   => 'Save Variants',
      'variant' => 'primary',
    ]) . '
    ' . $capture('button', [
      'label'      => 'Cancel',
      'attributes' => ['data-modal-close' => true],
    ]) . '
  </div>
';

$form_modal_theme_settings_body = '
  <div class="space-y-4">
    ' . $capture('tabs', [
      'compact' => true,
      'items'   => [
        ['label' => 'Preview', 'href' => '#', 'active' => true],
        ['label' => 'Rollout', 'href' => '#'],
      ],
    ]) . '
    ' . $capture('alert', [
      'variant'     => 'danger',
      'title'       => 'Typography scale has validation issue',
      'description' => 'Set heading scale before publishing.',
      'show_icon'   => true,
    ]) . '
    <div class="grid gap-4 md:grid-cols-2">
      ' . $capture('input', [
        'id'         => 'form-modal-theme-heading-scale',
        'name'       => 'heading_scale',
        'label'      => 'Heading Scale',
        'value'      => '',
        'error_text' => 'Heading scale is required.',
      ]) . '
      ' . $capture('select', [
        'id'      => 'form-modal-theme-release-stage',
        'name'    => 'release_stage',
        'label'   => 'Release Stage',
        'value'   => 'staging',
        'options' => [
          ['label' => 'Staging only', 'value' => 'staging'],
          ['label' => '10% production', 'value' => 'canary'],
          ['label' => '100% production', 'value' => 'full'],
        ],
      ]) . '
      <div class="md:col-span-2">
        ' . $capture('checkbox', [
          'id'      => 'form-modal-theme-confirm-backup',
          'name'    => 'confirm_backup',
          'label'   => 'I confirm snapshot backup is available before publish',
          'checked' => false,
        ]) . '
      </div>
      <div class="md:col-span-2">
        ' . $capture('switch', [
          'id'      => 'form-modal-theme-schedule',
          'name'    => 'schedule_publish',
          'label'   => 'Schedule publish outside working hours',
          'checked' => true,
        ]) . '
      </div>
    </div>
  </div>
';

$form_modal_theme_settings_footer = '
  <div class="flex items-center gap-2">
    ' . $capture('button', [
      'label'   => 'Publish Theme',
      'variant' => 'danger',
    ]) . '
    ' . $capture('button', [
      'label'      => 'Back',
      'attributes' => ['data-modal-close' => true],
    ]) . '
  </div>
';

$form_modal_import_review_body = '
  <div class="space-y-4">
    ' . $capture('alert', [
      'variant'     => 'warning',
      'title'       => '2 mapping issues found',
      'description' => 'Please review unmapped required columns before proceeding.',
      'show_icon'   => true,
    ]) . '
    <div class="grid gap-4 md:grid-cols-2">
      ' . $capture('input', [
        'id'       => 'form-modal-import-total-rows',
        'name'     => 'total_rows',
        'label'    => 'Total Rows Detected',
        'value'    => '480',
        'readonly' => true,
      ]) . '
      ' . $capture('input', [
        'id'       => 'form-modal-import-valid-rows',
        'name'     => 'valid_rows',
        'label'    => 'Valid Rows',
        'value'    => '478',
        'readonly' => true,
      ]) . '
      <div class="md:col-span-2">
        ' . $capture('textarea', [
          'id'          => 'form-modal-import-errors',
          'name'        => 'errors',
          'label'       => 'Validation Notes',
          'rows'        => 3,
          'value'       => 'Row 149: missing required email field. Row 312: invalid date format.',
          'readonly'    => true,
        ]) . '
      </div>
    </div>
  </div>
';

$form_modal_import_review_footer = '
  <div class="flex items-center gap-2">
    ' . $capture('button', [
      'label'   => 'Proceed Import',
      'variant' => 'primary',
    ]) . '
    ' . $capture('button', [
      'label'      => 'Close',
      'attributes' => ['data-modal-close' => true],
    ]) . '
  </div>
';

ob_start();
?>
<?= $capture('page-header', [
  'title'       => 'Form Patterns',
  'description' => 'Pattern-level guidance for composing form UI using existing foundation components.',
  'breadcrumb_items' => [
    ['label' => 'Home', 'href' => asset('/')],
    ['label' => 'UI Patterns', 'href' => '#'],
    ['label' => 'Form'],
  ],
]) ?>
<?php
$forms_header = (string) ob_get_clean();

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="content flex-1 p-4 lg:p-10">
    <section class="mx-auto max-w-7xl space-y-6">
      <?= $forms_header ?>

      <section class="space-y-6" aria-label="Form patterns showcase">
        <article class="card">
          <?= $pattern_add_user_content ?>
        </article>

        <article class="card">
          <?= $pattern_add_product_content ?>
        </article>

        <article class="card">
          <?= $pattern_theme_settings_content ?>
        </article>

        <article class="card">
          <?= $pattern_booking_content ?>
        </article>

        <article class="card">
          <?= $pattern_import_content ?>
        </article>
      </section>
    </section>
  </main>
</div>
<?php
component('modal', [
  'id'          => 'form-modal-add-user',
  'size'        => 'md',
  'title'       => 'Add New User (Modal)',
  'description' => 'Compact onboarding form with role/access options.',
  'content'     => $form_modal_add_user_body,
  'footer'      => $form_modal_add_user_footer,
  'dismissible' => true,
]);

component('modal', [
  'id'          => 'form-modal-add-product',
  'size'        => 'md',
  'title'       => 'Add Product Variants (Modal)',
  'description' => 'Configure variants and initial inventory quickly.',
  'content'     => $form_modal_add_product_body,
  'footer'      => $form_modal_add_product_footer,
  'dismissible' => true,
]);

component('modal', [
  'id'          => 'form-modal-theme-settings',
  'size'        => 'md',
  'title'       => 'Theme Publish Review (Modal)',
  'description' => 'Rollout controls, alert messaging, and error state before publish.',
  'content'     => $form_modal_theme_settings_body,
  'footer'      => $form_modal_theme_settings_footer,
  'dismissible' => true,
]);

component('modal', [
  'id'          => 'form-modal-import-review',
  'size'        => 'md',
  'title'       => 'Import Validation Review',
  'description' => 'Review row validation summary before import execution.',
  'content'     => $form_modal_import_review_body,
  'footer'      => $form_modal_import_review_footer,
  'dismissible' => true,
]);
?>
<?php layout('layout-end'); ?>
