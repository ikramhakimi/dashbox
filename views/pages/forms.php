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
<div class="space-y-4">
  <?= $capture('tabs', [
    'items' => [
      ['label' => 'Profile', 'href' => '#', 'active' => true, 'icon_name' => 'users'],
      ['label' => 'Access', 'href' => '#', 'icon_name' => 'ticket'],
      ['label' => 'Security', 'href' => '#', 'icon_name' => 'star'],
    ],
  ]) ?>

  <form action="#" method="post" class="space-y-4">
    <?= $capture('alert', [
      'variant'     => 'info',
      'description' => 'Use this pattern for admin onboarding with role and access setup.',
      'show_icon'   => true,
    ]) ?>

    <div class="grid gap-4 md:grid-cols-2">
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
      <div class="md:col-span-2 grid gap-3 md:grid-cols-2">
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

    <div class="flex flex-wrap items-center gap-2">
      <?= $capture('button', ['label' => 'Save Draft', 'variant' => 'ghost', 'type' => 'submit']) ?>
      <?= $capture('button', ['label' => 'Create User', 'variant' => 'primary', 'type' => 'submit']) ?>
      <?= $capture('button', [
        'label'      => 'Open Add User Modal',
        'variant'    => 'neutral',
        'attributes' => ['data-modal-open' => 'form-modal-add-user'],
      ]) ?>
    </div>
  </form>
</div>
<?php
$pattern_add_user_content = (string) ob_get_clean();

ob_start();
?>
<div class="space-y-4">
  <?= $capture('tabs', [
    'items' => [
      ['label' => 'Basic', 'href' => '#', 'active' => true, 'icon_name' => 'ticket'],
      ['label' => 'Pricing', 'href' => '#', 'icon_name' => 'star'],
      ['label' => 'Inventory', 'href' => '#', 'icon_name' => 'activity'],
    ],
  ]) ?>

  <form action="#" method="post" class="space-y-4">
    <?= $capture('alert', [
      'variant'     => 'warning',
      'description' => 'Complete SKU and price before publishing to storefront.',
      'show_icon'   => true,
    ]) ?>

    <div class="grid gap-4 md:grid-cols-2">
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
      <div class="md:col-span-2">
        <?= $capture('textarea', [
          'id'          => 'add-product-description',
          'name'        => 'description',
          'label'       => 'Description',
          'rows'        => 4,
          'placeholder' => 'Explain key benefits and product scope',
        ]) ?>
      </div>
      <div class="md:col-span-2 grid gap-3 md:grid-cols-2">
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

    <div class="flex flex-wrap items-center gap-2">
      <?= $capture('button', ['label' => 'Save Product', 'variant' => 'primary', 'type' => 'submit']) ?>
      <?= $capture('button', [
        'label'      => 'Bulk Variants Modal',
        'variant'    => 'neutral',
        'attributes' => ['data-modal-open' => 'form-modal-add-product'],
      ]) ?>
    </div>
  </form>
</div>
<?php
$pattern_add_product_content = (string) ob_get_clean();

ob_start();
?>
<div class="space-y-4">
  <?= $capture('tabs', [
    'items' => [
      ['label' => 'Brand', 'href' => '#', 'active' => true, 'icon_name' => 'star'],
      ['label' => 'Typography', 'href' => '#', 'icon_name' => 'users'],
      ['label' => 'Layout', 'href' => '#', 'icon_name' => 'activity'],
    ],
  ]) ?>
  <form action="#" method="post" class="space-y-4">
    <?= $capture('alert', [
      'variant'     => 'success',
      'description' => 'Theme changes are saved as draft first, then published to all tenants.',
      'show_icon'   => true,
    ]) ?>

    <div class="grid gap-4 md:grid-cols-2">
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
      <div class="md:col-span-2 grid gap-3 md:grid-cols-2">
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
      <div class="md:col-span-2">
        <?= $capture('textarea', [
          'id'          => 'theme-release-note',
          'name'        => 'release_note',
          'label'       => 'Release Note',
          'rows'        => 3,
          'placeholder' => 'Summarize what changed in this theme update',
        ]) ?>
      </div>
    </div>

    <div class="flex flex-wrap items-center gap-2">
      <?= $capture('button', ['label' => 'Save Theme Draft', 'variant' => 'neutral', 'type' => 'submit']) ?>
      <?= $capture('button', [
        'label'      => 'Preview & Publish Modal',
        'variant'    => 'primary',
        'attributes' => ['data-modal-open' => 'form-modal-theme-settings'],
      ]) ?>
    </div>
  </form>
</div>
<?php
$pattern_theme_settings_content = (string) ob_get_clean();

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
      'label'      => 'Cancel',
      'variant'    => 'ghost',
      'attributes' => ['data-modal-close' => true],
    ]) . '
    ' . $capture('button', [
      'label'   => 'Create User',
      'variant' => 'primary',
      'type'    => 'submit',
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
      'label'      => 'Cancel',
      'variant'    => 'ghost',
      'attributes' => ['data-modal-close' => true],
    ]) . '
    ' . $capture('button', [
      'label'   => 'Save Variants',
      'variant' => 'primary',
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
      'label'      => 'Back',
      'variant'    => 'ghost',
      'attributes' => ['data-modal-close' => true],
    ]) . '
    ' . $capture('button', [
      'label'   => 'Publish Theme',
      'variant' => 'danger',
    ]) . '
  </div>
';

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="flex-1">
    <section class="mx-auto max-w-7xl px-6 py-8 lg:px-10">
      <header class="mb-8 border-b border-gray-200 pb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">UI Patterns</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Form Patterns</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Pattern-level guidance for composing form UI using existing foundation components.
        </p>
      </header>

      <section class="space-y-7" aria-label="Form patterns showcase">
        <?php
        component('card-module', [
          'title'       => 'Pattern 1: Add New User',
          'subtitle'    => 'Tabs, role/access choices, and modal-based quick onboarding.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $pattern_add_user_content,
        ]);

        component('card-module', [
          'title'       => 'Pattern 2: Add New Product',
          'subtitle'    => 'Product creation flow with publish choices and variants modal.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $pattern_add_product_content,
        ]);

        component('card-module', [
          'title'       => 'Pattern 3: Website Theme Settings',
          'subtitle'    => 'Theme controls with rollout checks and publish modal validation.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => $pattern_theme_settings_content,
        ]);
        ?>
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
?>
<?php layout('layout-end'); ?>
