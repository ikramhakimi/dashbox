<?php

$page_title   = 'Table Component';
$page_current = 'tables';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children('tables'),
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

$orders = [
  [
    'code'           => 'SR2600-260326-00065',
    'created_at'     => '26 Mar, 09:10 PM',
    'studio'         => 'Serambi Raya',
    'session'        => '2026-03-28 12:30 PM',
    'customer_name'  => 'Zahirah',
    'customer_phone' => '0137599060',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '#',
  ],
  [
    'code'           => 'RK2600-260325-00064',
    'created_at'     => '25 Mar, 10:03 PM',
    'studio'         => 'Raya Kasih',
    'session'        => '2026-03-28 05:00 PM',
    'customer_name'  => 'Mohamad Noor',
    'customer_phone' => '01126587133',
    'payment'        => 'Paid Deposit',
    'status'         => 'Pending',
    'manage_url'     => '#',
  ],
  [
    'code'           => 'LR2600-260324-00063',
    'created_at'     => '24 Mar, 10:41 AM',
    'studio'         => 'Laman Raya',
    'session'        => '2026-03-29 01:30 PM',
    'customer_name'  => 'Amira Sofea',
    'customer_phone' => '0123456789',
    'payment'        => 'Processing',
    'status'         => 'In Progress',
    'manage_url'     => '#',
  ],
];

$booking_table = build_booking_table_dataset($orders);
$empty_table   = build_booking_table_dataset([]);

ob_start();
?>
<?= $capture('search-input', [
  'id'          => 'table-booking-finder',
  'name'        => 'booking_finder',
  'label'       => 'Finder',
  'size'        => 'sm',
  'placeholder' => 'Search booking or customer',
]) ?>
<?= $capture('select', [
  'id'      => 'table-booking-filter-payment',
  'name'    => 'payment_filter',
  'label'   => 'Payment',
  'size'    => 'sm',
  'value'   => 'all',
  'options' => [
    ['label' => 'All payment', 'value' => 'all'],
    ['label' => 'Paid Full', 'value' => 'paid_full'],
    ['label' => 'Paid Deposit', 'value' => 'paid_deposit'],
    ['label' => 'Processing', 'value' => 'processing'],
  ],
]) ?>
<?= $capture('select', [
  'id'      => 'table-booking-filter-status',
  'name'    => 'status_filter',
  'label'   => 'Status',
  'size'    => 'sm',
  'value'   => 'all',
  'options' => [
    ['label' => 'All status', 'value' => 'all'],
    ['label' => 'Completed', 'value' => 'completed'],
    ['label' => 'Pending', 'value' => 'pending'],
    ['label' => 'In Progress', 'value' => 'in_progress'],
  ],
]) ?>
<?php
$booking_actions_left = (string) ob_get_clean();

ob_start();
?>
<?= $capture('button', [
  'label'   => 'Export',
  'variant' => 'neutral',
  'size'    => 'sm',
]) ?>
<?= $capture('button', [
  'label'   => 'Create Booking',
  'variant' => 'primary',
  'size'    => 'sm',
]) ?>
<?php
$booking_actions_right = (string) ob_get_clean();

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
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">UI Elements</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">Table</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Foundation table with minimal columns and flexible cell composition.
        </p>
      </header>

      <section class="space-y-7" aria-label="Table component showcase">
        <?= $capture('alert', [
          'variant'     => 'info',
          'show_icon'   => true,
          'description' => 'Guideline: keep table to 3-5 columns max. Combine related info in stacked cells instead of adding new columns.',
        ]) ?>

        <?php
        component('card-table', [
          'title'       => 'Mixed Elements Table (Recommended)',
          'subtitle'    => 'Avatar, image placeholder, badges, button, and row actions in one structure.',
          'actions_left_html'  => $booking_actions_left,
          'actions_right_html' => $booking_actions_right,
          'record_label'       => 'bookings',
          'table_headers'      => $booking_table['headers'],
          'table_rows'         => $booking_table['rows'],
          'total_records'      => $booking_table['total'],
          'per_page'           => 1,
        ]);

        component('card-table', [
          'title'        => 'Empty State Table',
          'subtitle'     => 'Default empty behavior when no records are available.',
          'record_label' => 'bookings',
          'table_headers'=> $empty_table['headers'],
          'table_rows'   => $empty_table['rows'],
          'total_records'=> $empty_table['total'],
          'empty_title'  => 'No booking records yet',
          'empty_message'=> 'Try creating a new booking or adjust your active filters.',
          'empty_deco'   => '(o_o)/',
        ]);
        ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
