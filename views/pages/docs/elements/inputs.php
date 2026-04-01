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
    'children' => ui_elements_sidebar_children('inputs'),
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

ob_start();
?>
<div class="space-y-5">
  <div>
    <p class="type-caption type-semibold">Standard Inputs</p>
    <div class="mt-3 grid gap-4 md:grid-cols-2">
      <div class="py-4">
        <?= $capture('input', [
          'id'          => 'demo-input-text',
          'label'       => 'Text Input',
          'placeholder' => 'Enter value',
          'help_text'   => 'Default text field control.',
        ]) ?>
      </div>

      <div class="py-4">
        <?= $capture('search-input', [
          'id'          => 'demo-input-search',
          'label'       => 'Search Input',
          'placeholder' => 'Search by customer or code',
        ]) ?>
      </div>

      <div class="py-4">
        <?= $capture('input-group', [
          'id'          => 'demo-input-icon-right',
          'label'       => 'Icon + Input (Right)',
          'placeholder' => 'Enter amount',
          'icon_name'   => 'currency-dollar',
          'icon_side'   => 'right',
        ]) ?>
      </div>

      <div class="py-4">
        <?= $capture('password-input', [
          'id'          => 'demo-input-password',
          'label'       => 'Password Input',
          'placeholder' => 'Enter password',
          'help_text'   => 'Minimum 8 characters.',
        ]) ?>
      </div>

      <div class="py-4">
        <?= $capture('input', [
          'id'         => 'demo-input-error',
          'label'      => 'Input Error State',
          'value'      => 'invalid email format',
          'error_text' => 'Please enter a valid email address.',
        ]) ?>
      </div>
    </div>
  </div>
</div>
<?php
$text_search_content = (string) ob_get_clean();

ob_start();
?>
<div class="space-y-5">
  <div>
    <p class="type-caption type-semibold">Long Form Fields</p>
    <div class="mt-3 grid gap-4 md:grid-cols-2">
      <div class="py-4">
        <?= $capture('textarea', [
          'id'          => 'demo-textarea',
          'label'       => 'Textarea',
          'rows'        => 4,
          'placeholder' => 'Write your notes here',
        ]) ?>
      </div>

      <div class="py-4">
        <?= $capture('select', [
          'id'      => 'demo-select',
          'label'   => 'Select',
          'value'   => 'operations',
          'options' => [
            ['label' => 'Product', 'value' => 'product'],
            ['label' => 'Operations', 'value' => 'operations'],
            ['label' => 'Customer Success', 'value' => 'cs'],
          ],
        ]) ?>
      </div>

    </div>
  </div>
</div>
<?php
$textarea_select_content = (string) ob_get_clean();

ob_start();
?>
<div class="space-y-5">
  <div>
    <p class="type-caption type-semibold">Boolean & Single Choice</p>
    <div class="mt-3 grid gap-4 md:grid-cols-2">
      <div class="py-4">
        <?= $capture('checkbox', [
          'id'        => 'demo-checkbox',
          'label'     => 'Email notifications',
          'checked'   => true,
          'help_text' => 'Receive weekly summary updates.',
        ]) ?>
        <div class="mt-3">
          <?= $capture('checkbox', [
            'id'      => 'demo-checkbox-long',
            'label'   => 'I agree to receive product updates, billing notices, and security alerts via email for this workspace.',
            'checked' => false,
          ]) ?>
        </div>
      </div>

      <div class="py-4">
        <?= $capture('radio', [
          'id'      => 'demo-radio-a',
          'name'    => 'billing_cycle',
          'label'   => 'Monthly billing with auto-renew enabled and invoice summary sent to all finance admins.',
          'value'   => 'monthly',
          'checked' => true,
        ]) ?>
        <div class="mt-2">
          <?= $capture('radio', [
            'id'    => 'demo-radio-b',
            'name'  => 'billing_cycle',
            'label' => 'Annual billing (best for long-term contracts and centralized procurement cycles).',
            'value' => 'annual',
          ]) ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$choice_content = (string) ob_get_clean();

ob_start();
?>
<div class="space-y-5">
  <div>
    <p class="type-caption type-semibold">Switch Patterns</p>
    <div class="mt-3">
      <div class="py-4">
        <?= $capture('switch', [
          'id'        => 'demo-switch',
          'label'     => 'Enable dark mode',
          'checked'   => false,
          'help_text' => 'Switch this on to preview dark interface.',
        ]) ?>
        <div class="mt-4 border-t border-gray-100 pt-4">
          <p class="mb-2 type-caption type-semibold">Switch + Desc</p>
          <?= $capture('switch', [
            'id'        => 'demo-switch-desc',
            'label'     => 'Enable weekly digest email',
            'checked'   => true,
            'help_text' => 'Receive a summary of account activity every Monday.',
          ]) ?>
        </div>

        <div class="mt-4 border-t border-gray-100 pt-4">
          <p class="mb-2 type-caption type-semibold">Desc + Switch</p>
          <div class="flex items-start justify-between gap-4">
            <div class="space-y-1">
              <p class="type-body">Auto-archive completed tasks</p>
              <p class="type-small text-muted">Move completed tasks to archive after 30 days.</p>
            </div>
            <div class="shrink-0">
              <?= $capture('switch', [
                'id'      => 'demo-switch-right',
                'label'   => 'Toggle auto-archive',
                'checked' => false,
              ]) ?>
            </div>
          </div>
        </div>

        <div class="mt-4 border-t border-gray-100 pt-4">
          <p class="mb-2 type-caption type-semibold">Switch In Divided List</p>
          <div class="divide-y divide-gray-100">
            <div class="p-3">
              <?= $capture('switch', [
                'id'      => 'demo-switch-list-1',
                'label'   => 'Push notifications',
                'checked' => true,
              ]) ?>
            </div>
            <div class="p-3">
              <?= $capture('switch', [
                'id'      => 'demo-switch-list-2',
                'label'   => 'SMS alerts',
                'checked' => false,
              ]) ?>
            </div>
            <div class="p-3">
              <?= $capture('switch', [
                'id'      => 'demo-switch-list-3',
                'label'   => 'Security sign-in alerts',
                'checked' => true,
              ]) ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$switch_content = (string) ob_get_clean();

ob_start();
?>
<div class="space-y-5">
  <div>
    <p class="type-caption type-semibold">Specialized Inputs</p>
    <div class="mt-3 grid gap-4 md:grid-cols-2">
      <div class="py-4">
        <?= $capture('upload', [
          'id'        => 'demo-upload',
          'label'     => 'File Input / Upload',
          'accept'    => '.jpg,.jpeg,.png,.pdf',
          'help_text' => 'Allowed files: JPG, PNG, PDF. Max 5MB.',
        ]) ?>
      </div>

      <div class="py-4">
        <?= $capture('otp-input', [
          'label'     => 'OTP / PIN Input',
          'name'      => 'otp_code',
          'length'    => 6,
          'help_text' => 'Enter the 6-digit code sent to your phone.',
        ]) ?>
      </div>
    </div>
  </div>

  <div>
    <p class="type-caption type-semibold">Date & Time</p>
    <div class="mt-3 grid gap-4 md:grid-cols-2">
      <div class="py-4">
        <?= $capture('datetime-input', [
          'id'    => 'demo-date',
          'label' => 'Date Input',
          'mode'  => 'date',
        ]) ?>
      </div>

      <div class="py-4">
        <?= $capture('datetime-input', [
          'id'    => 'demo-time',
          'label' => 'Time Input',
          'mode'  => 'time',
        ]) ?>
      </div>

      <div class="py-4 md:col-span-2">
        <?= $capture('datetime-input', [
          'id'    => 'demo-datetime',
          'label' => 'Datetime-Local Input',
          'mode'  => 'datetime-local',
        ]) ?>
      </div>
    </div>
  </div>
</div>
<?php
$special_content = (string) ob_get_clean();

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
        <h1 class="mt-2 type-h1">Input UI Library</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Hierarchical reference for text, choice, and specialized form controls in the dashboard system.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Input component showcase">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Text & Search Inputs</h2>
            <p class="mt-1 type-body-muted">
              Base input, search input, and password input variants.
            </p>
          </header>
          <?= $text_search_content ?>
        </article>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Textarea & Select</h2>
            <p class="mt-1 type-body-muted">
              Multiline text area and dropdown selection controls.
            </p>
          </header>
          <?= $textarea_select_content ?>
        </article>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Checkbox & Radio</h2>
            <p class="mt-1 type-body-muted">
              Binary controls and mutually exclusive option controls.
            </p>
          </header>
          <?= $choice_content ?>
        </article>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Switch</h2>
            <p class="mt-1 type-body-muted">
              Comprehensive switch layouts: inline, reverse, and divided-list patterns.
            </p>
          </header>
          <?= $switch_content ?>
        </article>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Upload, OTP & DateTime</h2>
            <p class="mt-1 type-body-muted">
              Specialized form controls for files, codes, and date/time.
            </p>
          </header>
          <?= $special_content ?>
        </article>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
