<?php

$page_title   = 'Cards';
$page_current = 'cards';

$menu_items = [
  [
    'label' => 'Overview',
    'href'  => asset('/'),
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children('cards'),
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
        <h1 class="type-h1">Card UI Library</h1>
        <p class="mt-2 max-w-3xl type-body-muted">
          Showcase for Card Widget, Card Module, and Card Table components.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Card component showcase">
        <section class="py-7 first:pt-0 last:pb-0" aria-label="Card widget showcase">
          <h2 class="type-h2">Card Widget</h2>
          <p class="mt-1 mb-4 type-body-muted">Compact metric cards used for quick KPI scanning.</p>
          <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <?php foreach ($widget_samples as $widget): ?>
              <?php component('card-widget', $widget); ?>
            <?php endforeach; ?>
          </div>
        </section>

        <section class="py-7 first:pt-0 last:pb-0" aria-label="Card module showcase">
          <h2 class="type-h2">Card Module</h2>
          <p class="mt-1 mb-4 type-body-muted">Structured module card that combines summary and grouped content.</p>
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

        <section class="py-7 first:pt-0 last:pb-0" aria-label="Card table showcase">
          <h2 class="type-h2">Card Table</h2>
          <p class="mt-1 mb-4 type-body-muted">Data-heavy card pattern for operational table views.</p>
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
            'base_url'     => asset('/docs/elements/cards?page=%d'),
          ]);
          ?>
        </section>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
