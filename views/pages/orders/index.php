<?php

$page_title   = 'All Orders';
$page_current = 'orders';

$menu_items = build_main_menu_items();

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$orders = [
  ['order_no' => 'ORD-1001', 'customer' => 'Aina Sofea',      'email' => 'aina@nova.com',   'session' => '31 Mar 2026, 09:00 AM', 'payment' => 'Paid Full', 'status' => 'Confirmed'],
  ['order_no' => 'ORD-1002', 'customer' => 'Daniel Chua',     'email' => 'daniel@forge.io', 'session' => '31 Mar 2026, 10:30 AM', 'payment' => 'Deposit',   'status' => 'Pending'],
  ['order_no' => 'ORD-1003', 'customer' => 'Farah Nabila',    'email' => 'farah@blue.co',   'session' => '31 Mar 2026, 11:15 AM', 'payment' => 'Unpaid',    'status' => 'Pending'],
  ['order_no' => 'ORD-1004', 'customer' => 'Ravi Kumar',      'email' => 'ravi@atlas.com',  'session' => '31 Mar 2026, 01:00 PM', 'payment' => 'Paid Full', 'status' => 'Confirmed'],
  ['order_no' => 'ORD-1005', 'customer' => 'Nadia Zahir',     'email' => 'nadia@urban.co',  'session' => '31 Mar 2026, 02:00 PM', 'payment' => 'Deposit',   'status' => 'Pending'],
  ['order_no' => 'ORD-1006', 'customer' => 'Hakim Rahman',    'email' => 'hakim@green.io',  'session' => '31 Mar 2026, 03:00 PM', 'payment' => 'Paid Full', 'status' => 'Completed'],
  ['order_no' => 'ORD-1007', 'customer' => 'Mei Ling',        'email' => 'mei@sunrise.com', 'session' => '31 Mar 2026, 04:00 PM', 'payment' => 'Unpaid',    'status' => 'Pending'],
  ['order_no' => 'ORD-1008', 'customer' => 'Azri Faiz',       'email' => 'azri@peak.my',    'session' => '31 Mar 2026, 05:30 PM', 'payment' => 'Paid Full', 'status' => 'Confirmed'],
  ['order_no' => 'ORD-1009', 'customer' => 'Nurin Izzati',    'email' => 'nurin@cloud.com', 'session' => '01 Apr 2026, 09:00 AM', 'payment' => 'Deposit',   'status' => 'Pending'],
  ['order_no' => 'ORD-1010', 'customer' => 'Benjamin Tan',    'email' => 'ben@hexa.io',     'session' => '01 Apr 2026, 10:00 AM', 'payment' => 'Paid Full', 'status' => 'Confirmed'],
  ['order_no' => 'ORD-1011', 'customer' => 'Ivy Chan',        'email' => 'ivy@nova.my',     'session' => '01 Apr 2026, 10:45 AM', 'payment' => 'Unpaid',    'status' => 'Pending'],
  ['order_no' => 'ORD-1012', 'customer' => 'Kamil Ariff',     'email' => 'kamil@hub.co',    'session' => '01 Apr 2026, 11:30 AM', 'payment' => 'Paid Full', 'status' => 'Completed'],
  ['order_no' => 'ORD-1013', 'customer' => 'Rina Abdullah',   'email' => 'rina@orbit.com',  'session' => '01 Apr 2026, 01:30 PM', 'payment' => 'Deposit',   'status' => 'Pending'],
  ['order_no' => 'ORD-1014', 'customer' => 'Jason Lee',       'email' => 'jason@lake.ag',   'session' => '01 Apr 2026, 02:15 PM', 'payment' => 'Paid Full', 'status' => 'Confirmed'],
  ['order_no' => 'ORD-1015', 'customer' => 'Amirah Zulkifli', 'email' => 'amirah@sprint.io','session' => '01 Apr 2026, 03:45 PM', 'payment' => 'Unpaid',    'status' => 'Pending'],
  ['order_no' => 'ORD-1016', 'customer' => 'Darren Wong',     'email' => 'darren@motive.co','session' => '01 Apr 2026, 04:30 PM', 'payment' => 'Paid Full', 'status' => 'Completed'],
  ['order_no' => 'ORD-1017', 'customer' => 'Fatin Zahra',     'email' => 'fatin@crate.com', 'session' => '02 Apr 2026, 09:15 AM', 'payment' => 'Deposit',   'status' => 'Pending'],
  ['order_no' => 'ORD-1018', 'customer' => 'Omar Idris',      'email' => 'omar@frontier.my','session' => '02 Apr 2026, 10:45 AM', 'payment' => 'Paid Full', 'status' => 'Confirmed'],
  ['order_no' => 'ORD-1019', 'customer' => 'Jia Wen',         'email' => 'jia@lotus.com',   'session' => '02 Apr 2026, 11:30 AM', 'payment' => 'Unpaid',    'status' => 'Pending'],
  ['order_no' => 'ORD-1020', 'customer' => 'Syafiq Ismail',   'email' => 'syafiq@track.app','session' => '02 Apr 2026, 02:00 PM', 'payment' => 'Paid Full', 'status' => 'Completed'],
];

$current_page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
$per_page     = 8;
$total_items  = count($orders);
$total_pages  = max(1, (int) ceil($total_items / $per_page));

if ($current_page > $total_pages) {
  $current_page = $total_pages;
}

$offset         = ($current_page - 1) * $per_page;
$orders_on_page = array_slice($orders, $offset, $per_page);
$table_rows     = [];
$order_drawers  = [];

foreach ($orders_on_page as $order_index => $order) {
  $order_row_number = $offset + $order_index + 1;
  $drawer_id        = 'orders-quick-edit-' . (string) $order_row_number;

  $payment_mode = 'neutral';
  if ($order['payment'] === 'Paid Full') {
    $payment_mode = 'positive';
  } elseif ($order['payment'] === 'Deposit') {
    $payment_mode = 'warning';
  } elseif ($order['payment'] === 'Unpaid') {
    $payment_mode = 'negative';
  }

  $status_mode = 'neutral';
  if ($order['status'] === 'Confirmed') {
    $status_mode = 'info';
  } elseif ($order['status'] === 'Completed') {
    $status_mode = 'positive';
  } elseif ($order['status'] === 'Pending') {
    $status_mode = 'warning';
  }

  $payment_badge = $capture('badge', [
    'label' => $order['payment'],
    'mode'  => $payment_mode,
  ]);

  $status_badge = $capture('badge', [
    'label' => $order['status'],
    'mode'  => $status_mode,
  ]);

  $view_button = $capture('button', [
    'label'      => 'View order',
    'aria_label' => 'View ' . $order['order_no'],
    'icon_name'  => 'eye',
    'icon_only'  => true,
    'attributes' => [
      'data-drawer-open' => $drawer_id,
    ],
  ]);

  $more_dropdown = $capture('dropdown', [
    'trigger_label' => 'More',
    'trigger_size'  => 'sm',
    'items'         => [
      ['label' => 'Open Order', 'href' => '#'],
      ['label' => 'Mark as Paid', 'href' => '#'],
      ['type' => 'divider'],
      ['label' => 'Cancel Order', 'href' => '#', 'kind' => 'danger'],
    ],
  ]);

  $table_rows[] = [
    'cells' => [
      [
        'html' => '
          <div class="table__stack">
            <p class="table__primary">' . e($order['order_no']) . '</p>
            <p class="table__secondary">' . e($order['session']) . '</p>
          </div>
        ',
      ],
      [
        'html' => '
          <div class="table__stack">
            <p class="table__primary">' . e($order['customer']) . '</p>
            <p class="table__secondary">' . e($order['email']) . '</p>
          </div>
        ',
      ],
      [
        'html' => '<div class="table__badge-cell">' . $payment_badge . '</div>',
      ],
      [
        'html' => '<div class="table__badge-cell">' . $status_badge . '</div>',
      ],
      [
        'html'  => '<div class="table__actions">' . $view_button . $more_dropdown . '</div>',
        'align' => 'right',
      ],
    ],
  ];

  ob_start();
  ?>
  <form action="#" method="post" class="space-y-5">
    <div class="grid gap-5 sm:grid-cols-2">
      <?php
      component('input', [
        'id'       => 'quick-order-no-' . (string) $order_row_number,
        'name'     => 'order_no',
        'label'    => 'Order No',
        'value'    => $order['order_no'],
        'disabled' => true,
      ]);

      component('input', [
        'id'       => 'quick-order-session-' . (string) $order_row_number,
        'name'     => 'session_time',
        'label'    => 'Session',
        'value'    => $order['session'],
        'disabled' => true,
      ]);
      ?>
    </div>

    <?php
    component('input', [
      'id'       => 'quick-order-customer-' . (string) $order_row_number,
      'name'     => 'customer_name',
      'label'    => 'Customer',
      'value'    => $order['customer'] . ' (' . $order['email'] . ')',
      'disabled' => true,
    ]);
    ?>

    <div class="grid gap-5 sm:grid-cols-2">
      <?php
      component('select', [
        'id'      => 'quick-order-payment-' . (string) $order_row_number,
        'name'    => 'payment_status',
        'label'   => 'Payment',
        'value'   => strtolower(str_replace(' ', '_', $order['payment'])),
        'options' => [
          ['label' => 'Paid Full', 'value' => 'paid_full'],
          ['label' => 'Deposit', 'value' => 'deposit'],
          ['label' => 'Unpaid', 'value' => 'unpaid'],
        ],
      ]);

      component('select', [
        'id'      => 'quick-order-status-' . (string) $order_row_number,
        'name'    => 'order_status',
        'label'   => 'Status',
        'value'   => strtolower($order['status']),
        'options' => [
          ['label' => 'Pending', 'value' => 'pending'],
          ['label' => 'Confirmed', 'value' => 'confirmed'],
          ['label' => 'Completed', 'value' => 'completed'],
        ],
      ]);
      ?>
    </div>

    <?php
    component('textarea', [
      'id'          => 'quick-order-note-' . (string) $order_row_number,
      'name'        => 'order_note',
      'label'       => 'Internal Note',
      'rows'        => 4,
      'placeholder' => 'Add update for operation team...',
    ]);
    ?>
  </form>
  <?php
  $drawer_content = (string) ob_get_clean();

  $drawer_footer = '
    <div class="flex items-center gap-2">
      ' . $capture('button', [
        'label'      => 'Close',
        'attributes' => ['data-drawer-close' => true],
      ]) . '
      ' . $capture('button', [
        'label'   => 'Save Order',
        'variant' => 'primary',
        'type'    => 'submit',
      ]) . '
    </div>
  ';

  $order_drawers[] = [
    'id'          => $drawer_id,
    'title'       => 'Quick Edit • ' . $order['order_no'],
    'description' => 'Update payment and status without leaving order list.',
    'content'     => $drawer_content,
    'footer'      => $drawer_footer,
  ];
}

$orders_search = $capture('search-input', [
  'id'          => 'orders-search',
  'name'        => 'orders_search',
  'label'       => '',
  'placeholder' => 'Find by order no or customer',
]);

$orders_filter = $capture('select', [
  'id'      => 'orders-filter',
  'name'    => 'orders_filter',
  'label'   => '',
  'value'   => '',
  'options' => [
    ['label' => 'Filter By', 'value' => '', 'disabled' => true],
    ['label' => 'Paid Full', 'value' => 'paid_full'],
    ['label' => 'Deposit', 'value' => 'deposit'],
    ['label' => 'Unpaid', 'value' => 'unpaid'],
    ['label' => 'Pending', 'value' => 'pending'],
  ],
]);

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card" aria-label="Orders list">
      <div class="card__head">
        <?php
        component('page-header', [
          'title'       => 'All Orders',
          'description' => 'Track all bookings, payment progress, and session status in one list.',
        ]);
        ?>
      </div>

      <div class="card__body inline-flex flex-wrap items-end gap-3">
        <div class="w-72">
          <?= $orders_search ?>
        </div>
        <div class="w-56">
          <?= $orders_filter ?>
        </div>
      </div>

      <article class="card__table">
        <?php
        component('table', [
          'class' => 'table--comfortable',
          'headers' => [
            ['label' => 'Order', 'align' => 'left'],
            ['label' => 'Customer', 'align' => 'left'],
            ['label' => 'Payment', 'align' => 'left'],
            ['label' => 'Status', 'align' => 'left'],
            ['label' => '', 'align' => 'right'],
          ],
          'rows' => $table_rows,
        ]);
        ?>
      </article>

      <footer class="card__actions">
        <?php
        component('pagination', [
          'current_page' => $current_page,
          'total_pages'  => $total_pages,
          'show_info'    => true,
          'show_pages'   => true,
          'total_items'  => $total_items,
          'per_page'     => $per_page,
          'base_url'     => asset('/orders?page=%d'),
        ]);
        ?>
      </footer>
    </section>
<?php foreach ($order_drawers as $order_drawer): ?>
  <?php
  component('drawer', [
    'id'          => $order_drawer['id'],
    'title'       => $order_drawer['title'],
    'description' => $order_drawer['description'],
    'content'     => $order_drawer['content'],
    'footer'      => $order_drawer['footer'],
    'placement'   => 'right',
    'size'        => 'lg',
  ]);
  ?>
<?php endforeach; ?>
<?php layout('app-end'); ?>
