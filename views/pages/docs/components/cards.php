<?php

$page_title   = 'Card Component';
$page_current = 'cards';

$menu_items = build_main_menu_items($page_current);

$widget_samples = [
  [
    'title'     => 'New Signups',
    'value'     => '1,248',
    'trend'     => '+8.2%',
    'note'      => 'vs last month',
    'icon_name' => 'users',
  ],
  [
    'title'     => 'Open Tickets',
    'value'     => '38',
    'trend'     => '-6.1%',
    'note'      => 'faster resolution',
    'icon_name' => 'tickets',
  ],
  [
    'title'     => 'Revenue',
    'value'     => 'RM 82,480',
    'trend'     => '+4.7%',
    'note'      => 'monthly run rate',
    'icon_name' => 'plus',
  ],
  [
    'title'     => 'Service Health',
    'value'     => '99.95%',
    'trend'     => 'stable',
    'note'      => '7-day uptime',
    'icon_name' => 'activity',
  ],
];

$orders = [
  [
    'code'           => 'SR2600-260326-00065',
    'created_at'     => '26 Mar, 21:10 PM',
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
    'created_at'     => '25 Mar, 22:03 PM',
    'studio'         => 'Raya Kasih',
    'session'        => '2026-03-28 05:00 PM',
    'customer_name'  => 'Mohamad Noor',
    'customer_phone' => '01126587133',
    'payment'        => 'Paid Deposit',
    'status'         => 'Pending',
    'manage_url'     => '#',
  ],
  [
    'code'           => 'SR2600-260324-00063',
    'created_at'     => '24 Mar, 10:41 AM',
    'studio'         => 'Serambi Raya',
    'session'        => '2026-03-29 01:30 PM',
    'customer_name'  => 'Amira Sofea',
    'customer_phone' => '0123456789',
    'payment'        => 'Processing',
    'status'         => 'In Progress',
    'manage_url'     => '#',
  ],
];

$cards_booking_table = build_booking_table_dataset($orders);

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="type-h1">Card UI Component</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Showcase for Card Widget, Card Module, and Card Table components.
        </p>
      </header>

      <section class="card__list" aria-label="Card component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="max-w-4xl py-4" aria-label="Card widget showcase">
              <h3 class="type-h3">Card Widget</h3>
              <p class="mb-4 type-body-muted">Compact metric cards used for quick KPI scanning.</p>
              <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <?php foreach ($widget_samples as $widget): ?>
                  <?php component('card-metric', $widget); ?>
                <?php endforeach; ?>
              </div>
            </section>
          </li>

          <li class="list__item">
            <section class="max-w-4xl py-4" aria-label="Card module showcase">
              <h3 class="type-h3">Card Module</h3>
              <p class="mb-4 type-body-muted">
                Structured module card that combines summary and grouped content.
              </p>
              <?php
              component('card', [
                'title'       => 'Card Module Demo',
                'subtitle'    => 'Module card with inline widgets and footer.',
                'show_graph'  => false,
                'show_footer' => true,
                'show_menu'   => false,
                'widgets'     => $widget_samples,
              ]);
              ?>
            </section>
          </li>

          <li class="list__item">
            <section class="max-w-4xl py-4" aria-label="Card table showcase">
              <h3 class="type-h3">Card Table</h3>
              <p class="mb-4 type-body-muted">Data-heavy card pattern for operational table views.</p>
              <?php
              component('table', [
                'headers' => $cards_booking_table['headers'],
                'rows'    => $cards_booking_table['rows'],
              ]);

              component('pagination', [
                'current_page' => 1,
                'total_pages'  => 1,
                'show_info'    => true,
                'total_items'  => $cards_booking_table['total'],
                'per_page'     => 10,
                'base_url'     => asset('/docs/components/cards?page=%d'),
              ]);
              ?>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
