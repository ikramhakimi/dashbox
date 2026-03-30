<?php

$page_title   = 'Session Today';
$page_current = 'orders-session-today';

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

$sessions = [
  ['time' => '09:00 AM', 'order_no' => 'ORD-1001', 'customer' => 'Aina Sofea',    'package' => 'Sunrise Session',  'payment' => 'Paid Full', 'status' => 'Checked In'],
  ['time' => '10:30 AM', 'order_no' => 'ORD-1002', 'customer' => 'Daniel Chua',   'package' => 'Studio Package',   'payment' => 'Deposit',   'status' => 'Arriving'],
  ['time' => '11:15 AM', 'order_no' => 'ORD-1003', 'customer' => 'Farah Nabila',  'package' => 'Family Package',   'payment' => 'Unpaid',    'status' => 'Pending'],
  ['time' => '01:00 PM', 'order_no' => 'ORD-1004', 'customer' => 'Ravi Kumar',    'package' => 'Outdoor Package',  'payment' => 'Paid Full', 'status' => 'Checked In'],
  ['time' => '02:00 PM', 'order_no' => 'ORD-1005', 'customer' => 'Nadia Zahir',   'package' => 'Portrait Package', 'payment' => 'Deposit',   'status' => 'Arriving'],
  ['time' => '03:00 PM', 'order_no' => 'ORD-1006', 'customer' => 'Hakim Rahman',  'package' => 'Corporate Pack',   'payment' => 'Paid Full', 'status' => 'Completed'],
  ['time' => '04:00 PM', 'order_no' => 'ORD-1007', 'customer' => 'Mei Ling',      'package' => 'Basic Session',    'payment' => 'Unpaid',    'status' => 'Pending'],
  ['time' => '05:30 PM', 'order_no' => 'ORD-1008', 'customer' => 'Azri Faiz',     'package' => 'Premium Session',  'payment' => 'Paid Full', 'status' => 'Arriving'],
];

$table_rows = [];
foreach ($sessions as $session) {
  $payment_mode = 'neutral';
  if ($session['payment'] === 'Paid Full') {
    $payment_mode = 'positive';
  } elseif ($session['payment'] === 'Deposit') {
    $payment_mode = 'warning';
  } elseif ($session['payment'] === 'Unpaid') {
    $payment_mode = 'negative';
  }

  $status_mode = 'neutral';
  if ($session['status'] === 'Checked In') {
    $status_mode = 'info';
  } elseif ($session['status'] === 'Arriving') {
    $status_mode = 'warning';
  } elseif ($session['status'] === 'Completed') {
    $status_mode = 'positive';
  }

  $payment_badge = $capture('badge', [
    'label' => $session['payment'],
    'mode'  => $payment_mode,
  ]);

  $status_badge = $capture('badge', [
    'label' => $session['status'],
    'mode'  => $status_mode,
  ]);

  $table_rows[] = [
    'cells' => [
      ['value' => $session['time']],
      ['value' => $session['order_no']],
      ['value' => $session['customer']],
      ['value' => $session['package']],
      ['html' => '<div class="table__badge-cell">' . $payment_badge . '</div>'],
      ['html' => '<div class="table__badge-cell">' . $status_badge . '</div>'],
    ],
  ];
}

$session_search = $capture('search-input', [
  'id'          => 'orders-session-today-search',
  'name'        => 'orders_session_today_search',
  'label'       => '',
  'placeholder' => 'Find session by order or customer',
]);

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="content flex-1 p-4 lg:p-10">
    <section class="mx-auto max-w-7xl space-y-6">
      <?php
      component('page-header', [
        'title'       => 'Session Today',
        'description' => 'Operational board for today\'s session timeline and payment readiness.',
      ]);
      ?>

      <div class="max-w-sm">
        <?= $session_search ?>
      </div>

      <article class="card" aria-label="Today sessions list">
        <?php
        component('table', [
          'headers' => [
            ['label' => 'Time', 'align' => 'left'],
            ['label' => 'Order', 'align' => 'left'],
            ['label' => 'Customer', 'align' => 'left'],
            ['label' => 'Package', 'align' => 'left'],
            ['label' => 'Payment', 'align' => 'left'],
            ['label' => 'Status', 'align' => 'left'],
          ],
          'rows' => $table_rows,
        ]);
        ?>
      </article>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
