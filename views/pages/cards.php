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
    'children' => [
      [
        'label'  => 'Buttons',
        'href'   => asset('/buttons'),
        'active' => false,
      ],
      [
        'label'  => 'Cards',
        'href'   => asset('/cards'),
        'active' => true,
      ],
      [
        'label'  => 'Badges',
        'href'   => asset('/badges'),
        'active' => false,
      ],
      [
        'label'  => 'Inputs',
        'href'   => asset('/inputs'),
        'active' => false,
      ],
    ],
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
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Card UI Library</h1>
        <p class="mt-1 text-sm text-gray-500">
          Showcase for Card Widget, Card Module, and Card Data components.
        </p>
      </header>

      <section class="mb-6">
        <h2 class="mb-3 text-lg font-semibold text-gray-900">Card Widget</h2>
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
          <?php foreach ($widget_samples as $widget): ?>
            <?php component('card-widget', $widget); ?>
          <?php endforeach; ?>
        </div>
      </section>

      <section class="mb-6">
        <h2 class="mb-3 text-lg font-semibold text-gray-900">Card Module</h2>
        <?php
        component('card-module', [
          'title'       => 'Card Module Demo',
          'subtitle'    => 'Module card with inline widgets and footer.',
          'show_graph'  => false,
          'show_footer' => true,
          'show_menu'   => false,
          'widgets'     => $widget_samples,
        ]);
        ?>
      </section>

      <section>
        <h2 class="mb-3 text-lg font-semibold text-gray-900">Card Data</h2>
        <?php component('card-data', ['orders' => $orders]); ?>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
