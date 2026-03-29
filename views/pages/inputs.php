<?php

$page_title   = 'Inputs';
$page_current = 'inputs';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => [
      [
        'label'  => 'Buttons',
        'href'   => asset('/buttons'),
        'active' => false,
      ],
      [
        'label'  => 'Cards',
        'href'   => asset('/cards'),
        'active' => false,
      ],
      [
        'label'  => 'Badges',
        'href'   => asset('/badges'),
        'active' => false,
      ],
      [
        'label'  => 'Inputs',
        'href'   => asset('/inputs'),
        'active' => true,
      ],
    ],
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

  <main class="flex-1">
    <section class="mx-auto max-w-7xl px-6 py-8 lg:px-10">
      <header class="mb-8 border-b border-gray-200 pb-6">
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Input UI Library</h1>
        <p class="mt-1 text-sm text-gray-500">
          Showcase for all form control components used in this dashboard foundation.
        </p>
      </header>

      <section class="mb-6">
        <?php
        component('card-module', [
          'title'       => 'Text & Search Inputs',
          'subtitle'    => 'Base input, search input, and password input variants.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => '
            <div class="grid gap-4 md:grid-cols-2">
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('input', [
                  'id'          => 'demo-input-text',
                  'label'       => 'Text Input',
                  'placeholder' => 'Enter value',
                  'help_text'   => 'Default text field control.',
                ]) . '
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('search-input', [
                  'id'          => 'demo-input-search',
                  'label'       => 'Search Input',
                  'placeholder' => 'Search by customer or code',
                ]) . '
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('password-input', [
                  'id'          => 'demo-input-password',
                  'label'       => 'Password Input',
                  'placeholder' => 'Enter password',
                  'help_text'   => 'Minimum 8 characters.',
                ]) . '
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('input', [
                  'id'         => 'demo-input-error',
                  'label'      => 'Input Error State',
                  'value'      => 'invalid email format',
                  'error_text' => 'Please enter a valid email address.',
                ]) . '
              </div>
            </div>',
        ]);
        ?>
      </section>

      <section class="mb-6">
        <?php
        component('card-module', [
          'title'       => 'Textarea & Select',
          'subtitle'    => 'Multiline text area and dropdown selection controls.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => '
            <div class="grid gap-4 md:grid-cols-2">
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('textarea', [
                  'id'          => 'demo-textarea',
                  'label'       => 'Textarea',
                  'rows'        => 4,
                  'placeholder' => 'Write your notes here',
                ]) . '
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('select', [
                  'id'      => 'demo-select',
                  'label'   => 'Select',
                  'value'   => 'operations',
                  'options' => [
                    ['label' => 'Product', 'value' => 'product'],
                    ['label' => 'Operations', 'value' => 'operations'],
                    ['label' => 'Customer Success', 'value' => 'cs'],
                  ],
                ]) . '
              </div>
            </div>',
        ]);
        ?>
      </section>

      <section class="mb-6">
        <?php
        component('card-module', [
          'title'       => 'Checkbox, Radio & Switch',
          'subtitle'    => 'Binary controls and mutually exclusive option controls.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => '
            <div class="grid gap-4 md:grid-cols-3">
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('checkbox', [
                  'id'      => 'demo-checkbox',
                  'label'   => 'Email notifications',
                  'checked' => true,
                  'help_text' => 'Receive weekly summary updates.',
                ]) . '
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('radio', [
                  'id'      => 'demo-radio-a',
                  'name'    => 'billing_cycle',
                  'label'   => 'Monthly billing',
                  'value'   => 'monthly',
                  'checked' => true,
                ]) . '
                <div class="mt-2">
                  ' . $capture('radio', [
                    'id'    => 'demo-radio-b',
                    'name'  => 'billing_cycle',
                    'label' => 'Annual billing',
                    'value' => 'annual',
                  ]) . '
                </div>
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('switch', [
                  'id'        => 'demo-switch',
                  'label'     => 'Enable dark mode',
                  'checked'   => false,
                  'help_text' => 'Switch this on to preview dark interface.',
                ]) . '
              </div>
            </div>',
        ]);
        ?>
      </section>

      <section class="mb-6">
        <?php
        component('card-module', [
          'title'       => 'Upload, OTP & DateTime',
          'subtitle'    => 'Specialized form controls for files, codes, and date/time.',
          'show_graph'  => false,
          'show_footer' => false,
          'show_menu'   => false,
          'content'     => '
            <div class="grid gap-4 md:grid-cols-2">
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('upload', [
                  'id'        => 'demo-upload',
                  'label'     => 'File Input / Upload',
                  'accept'    => '.jpg,.jpeg,.png,.pdf',
                  'help_text' => 'Allowed files: JPG, PNG, PDF. Max 5MB.',
                ]) . '
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('otp-input', [
                  'label'     => 'OTP / PIN Input',
                  'name'      => 'otp_code',
                  'length'    => 6,
                  'help_text' => 'Enter the 6-digit code sent to your phone.',
                ]) . '
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('datetime-input', [
                  'id'    => 'demo-date',
                  'label' => 'Date Input',
                  'mode'  => 'date',
                ]) . '
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4">
                ' . $capture('datetime-input', [
                  'id'    => 'demo-time',
                  'label' => 'Time Input',
                  'mode'  => 'time',
                ]) . '
              </div>
              <div class="rounded-lg border border-gray-100 bg-white p-4 md:col-span-2">
                ' . $capture('datetime-input', [
                  'id'    => 'demo-datetime',
                  'label' => 'Datetime-Local Input',
                  'mode'  => 'datetime-local',
                ]) . '
              </div>
            </div>',
        ]);
        ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
