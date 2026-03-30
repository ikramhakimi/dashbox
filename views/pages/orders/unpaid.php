<?php

$page_title   = 'Unpaid Orders';
$page_current = 'orders-unpaid';

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

$orders = [
  ['order_no' => 'ORD-1003', 'customer' => 'Farah Nabila',    'session' => '31 Mar 2026, 11:15 AM', 'payment' => 'Unpaid',  'balance' => 'RM 150'],
  ['order_no' => 'ORD-1005', 'customer' => 'Nadia Zahir',     'session' => '31 Mar 2026, 02:00 PM', 'payment' => 'Deposit', 'balance' => 'RM 100'],
  ['order_no' => 'ORD-1007', 'customer' => 'Mei Ling',        'session' => '31 Mar 2026, 04:00 PM', 'payment' => 'Unpaid',  'balance' => 'RM 100'],
  ['order_no' => 'ORD-1009', 'customer' => 'Nurin Izzati',    'session' => '01 Apr 2026, 09:00 AM', 'payment' => 'Deposit', 'balance' => 'RM 80'],
  ['order_no' => 'ORD-1011', 'customer' => 'Ivy Chan',        'session' => '01 Apr 2026, 10:45 AM', 'payment' => 'Unpaid',  'balance' => 'RM 150'],
  ['order_no' => 'ORD-1013', 'customer' => 'Rina Abdullah',   'session' => '01 Apr 2026, 01:30 PM', 'payment' => 'Deposit', 'balance' => 'RM 70'],
  ['order_no' => 'ORD-1015', 'customer' => 'Amirah Zulkifli', 'session' => '01 Apr 2026, 03:45 PM', 'payment' => 'Unpaid',  'balance' => 'RM 100'],
  ['order_no' => 'ORD-1017', 'customer' => 'Fatin Zahra',     'session' => '02 Apr 2026, 09:15 AM', 'payment' => 'Deposit', 'balance' => 'RM 90'],
];

$table_rows = [];
foreach ($orders as $order) {
  $payment_mode = $order['payment'] === 'Unpaid' ? 'negative' : 'warning';

  $payment_badge = $capture('badge', [
    'label' => $order['payment'],
    'mode'  => $payment_mode,
  ]);

  $view_button = $capture('button', [
    'label'      => 'View order',
    'aria_label' => 'View ' . $order['order_no'],
    'icon_name'  => 'eye',
    'icon_only'  => true,
    'href'       => '#',
  ]);

  $more_dropdown = $capture('dropdown', [
    'trigger_label' => 'More',
    'trigger_size'  => 'sm',
    'items'         => [
      ['label' => 'Open Order', 'href' => '#'],
      ['label' => 'Send Reminder', 'href' => '#'],
      ['label' => 'Mark as Paid', 'href' => '#'],
    ],
  ]);

  $table_rows[] = [
    'cells' => [
      ['value' => $order['order_no']],
      ['value' => $order['customer']],
      ['value' => $order['session']],
      ['html' => '<div class="table__badge-cell">' . $payment_badge . '</div>'],
      ['value' => $order['balance']],
      ['html' => '<div class="table__actions">' . $view_button . $more_dropdown . '</div>', 'align' => 'right'],
    ],
  ];
}

$orders_search = $capture('search-input', [
  'id'          => 'orders-unpaid-search',
  'name'        => 'orders_unpaid_search',
  'label'       => '',
  'placeholder' => 'Find unpaid orders',
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
        'title'       => 'Unpaid Orders',
        'description' => 'Focus queue for outstanding payments and follow-ups.',
      ]);
      ?>

      <div class="max-w-sm">
        <?= $orders_search ?>
      </div>

      <article class="card space-y-6" aria-label="Unpaid orders list">
        <?php
        component('table', [
          'headers' => [
            ['label' => 'Order', 'align' => 'left'],
            ['label' => 'Customer', 'align' => 'left'],
            ['label' => 'Session', 'align' => 'left'],
            ['label' => 'Payment', 'align' => 'left'],
            ['label' => 'Balance', 'align' => 'left'],
            ['label' => '', 'align' => 'right'],
          ],
          'rows' => $table_rows,
        ]);
        ?>
      </article>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
