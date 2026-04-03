<?php

$page_title   = 'Table Component';
$page_current = 'tables';

$menu_items = build_main_menu_items($page_current);

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
  'size'    => 'sm',
]) ?>
<?= $capture('button', [
  'label'   => 'Create Booking',
  'variant' => 'primary',
  'size'    => 'sm',
]) ?>
<?php
$booking_actions_right = (string) ob_get_clean();

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">Table</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Foundation table with minimal columns and flexible cell composition.
        </p>
      </header>

      <section class="card__list" aria-label="Table component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <?= $capture('alert', [
          'variant'     => 'info',
          'show_icon'   => true,
          'description' => 'Guideline: keep table to 3-5 columns max. Combine related info in stacked cells instead of adding new columns.',
        ]) ?>

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Mixed Elements Table (Recommended)</h2>
            <p class="mt-1 type-body-muted">
              Avatar, image placeholder, badges, button, and row actions in one structure.
            </p>
          </header>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <h4 class="type-h4">Table Demo</h4>
            <p class="mb-4 type-body-muted">
              Operational table composition with mixed row content and inline controls.
            </p>
            <div class="grid gap-3 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end">
              <div class="flex flex-wrap items-end gap-2">
                <?= $booking_actions_left ?>
              </div>
              <div class="flex flex-wrap items-center justify-start gap-2 lg:justify-end">
                <?= $booking_actions_right ?>
              </div>
            </div>

            <?php
            component('table', [
              'headers' => $booking_table['headers'],
              'rows'    => $booking_table['rows'],
            ]);
            ?>

            <?= $capture('pagination', [
              'current_page' => 1,
              'total_pages'  => 3,
              'show_info'    => true,
              'total_items'  => $booking_table['total'],
              'per_page'     => 1,
              'base_url'     => asset('/docs/components/tables?page=%d'),
            ]) ?>
          </div>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Empty State Table</h2>
            <p class="mt-1 type-body-muted">
              Default empty behavior when no records are available.
            </p>
          </header>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <h4 class="type-h4">Table Demo</h4>
            <p class="mb-4 type-body-muted">
              Empty-state rendering with fallback messaging and disabled pagination path.
            </p>
            <?php
            component('table', [
              'headers'       => $empty_table['headers'],
              'rows'          => $empty_table['rows'],
              'empty_title'   => 'No booking records yet',
              'empty_message' => 'Try creating a new booking or adjust your active filters.',
              'empty_deco'    => '(o_o)/',
            ]);
            ?>

            <?= $capture('pagination', [
              'current_page' => 1,
              'total_pages'  => 1,
              'show_info'    => true,
              'total_items'  => 0,
              'per_page'     => 10,
              'base_url'     => asset('/docs/components/tables?page=%d'),
            ]) ?>
          </div>
        </article>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
