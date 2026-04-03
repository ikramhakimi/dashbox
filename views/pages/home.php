<?php

$page_title   = 'Dashboard';
$page_current = 'dashboard';

$menu_items = build_main_menu_items();

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$kpi_cards = [
  [
    'title'      => 'Revenue Today',
    'value'      => 'RM 3,287',
    'trend'      => '+9.2%',
    'trend_mode' => 'positive',
    'note'       => 'vs yesterday',
    'icon_name'  => 'circle-dollar-sign',
  ],
  [
    'title'      => 'Sessions Today',
    'value'      => '24',
    'trend'      => '18 confirmed',
    'trend_mode' => 'info',
    'note'       => '6 pending check-in',
    'icon_name'  => 'calendar-days',
  ],
  [
    'title'      => 'Unpaid Exposure',
    'value'      => 'RM 2,140',
    'trend'      => '7 orders',
    'trend_mode' => 'warning',
    'note'       => 'follow-up before 6 PM',
    'icon_name'  => 'wallet',
  ],
  [
    'title'      => 'Avg Client Rating',
    'value'      => '4.8',
    'trend'      => '+0.2',
    'trend_mode' => 'positive',
    'note'       => 'last 30 days',
    'icon_name'  => 'star',
  ],
];

$today_focus_items = [
  [
    'title'       => 'Collect unpaid balances',
    'description' => '7 active bookings are still pending payment completion.',
    'badge_label' => 'Urgent',
    'badge_mode'  => 'negative',
    'href'        => asset('/orders/unpaid'),
    'cta'         => 'Review',
  ],
  [
    'title'       => 'Confirm session attendance',
    'description' => '6 customers have not completed today\'s check-in.',
    'badge_label' => 'High',
    'badge_mode'  => 'warning',
    'href'        => asset('/orders/sessions-today'),
    'cta'         => 'Open',
  ],
  [
    'title'       => 'Close feedback loop',
    'description' => '12 completed sessions are missing feedback/profile forms.',
    'badge_label' => 'Retention',
    'badge_mode'  => 'info',
    'href'        => asset('/feedback'),
    'cta'         => 'Follow Up',
  ],
];

$session_pipeline = [
  ['stage' => 'Leads Collected',      'count' => 64, 'hint' => 'last 7 days'],
  ['stage' => 'Quotation Sent',       'count' => 39, 'hint' => 'response pending'],
  ['stage' => 'Deposit Received',     'count' => 28, 'hint' => 'ready to schedule'],
  ['stage' => 'Session Confirmed',    'count' => 24, 'hint' => 'today + upcoming'],
  ['stage' => 'Feedback Completed',   'count' => 12, 'hint' => 'post-session'],
];

$upcoming_session_rows = [
  [
    'time'     => '11:00 AM',
    'customer' => 'Amira Sofea',
    'studio'   => 'Serambi Raya',
    'status'   => $capture('badge', ['label' => 'Confirmed', 'mode' => 'positive']),
    'action'   => $capture('button', ['label' => 'Open', 'href' => asset('/orders/sessions-today')]),
  ],
  [
    'time'     => '1:30 PM',
    'customer' => 'Nur Sofie',
    'studio'   => 'Laman Raya',
    'status'   => $capture('badge', ['label' => 'Pending', 'mode' => 'warning']),
    'action'   => $capture('button', ['label' => 'Open', 'href' => asset('/orders/sessions-today')]),
  ],
  [
    'time'     => '3:45 PM',
    'customer' => 'Mohamad Noor',
    'studio'   => 'Raya Kasih',
    'status'   => $capture('badge', ['label' => 'Confirmed', 'mode' => 'positive']),
    'action'   => $capture('button', ['label' => 'Open', 'href' => asset('/orders/sessions-today')]),
  ],
  [
    'time'     => '5:00 PM',
    'customer' => 'Zahirah',
    'studio'   => 'Serambi Raya',
    'status'   => $capture('badge', ['label' => 'Awaiting', 'mode' => 'neutral']),
    'action'   => $capture('button', ['label' => 'Open', 'href' => asset('/orders/sessions-today')]),
  ],
];

$payment_watch_rows = [
  [
    'order'   => 'SR2600-260324-00063',
    'amount'  => 'RM 450',
    'due'     => 'Today',
    'status'  => $capture('badge', ['label' => 'Follow Up', 'mode' => 'negative']),
    'action'  => $capture('button', ['label' => 'Collect', 'href' => asset('/orders/unpaid'), 'variant' => 'primary']),
  ],
  [
    'order'   => 'SR2600-260323-00062',
    'amount'  => 'RM 320',
    'due'     => 'Today',
    'status'  => $capture('badge', ['label' => 'Due Soon', 'mode' => 'warning']),
    'action'  => $capture('button', ['label' => 'Collect', 'href' => asset('/orders/unpaid')]),
  ],
  [
    'order'   => 'RK2600-260325-00064',
    'amount'  => 'RM 280',
    'due'     => 'Tomorrow',
    'status'  => $capture('badge', ['label' => 'Reminder', 'mode' => 'info']),
    'action'  => $capture('button', ['label' => 'Collect', 'href' => asset('/orders/unpaid')]),
  ],
  [
    'order'   => 'LR2600-260317-00056',
    'amount'  => 'RM 190',
    'due'     => 'Tomorrow',
    'status'  => $capture('badge', ['label' => 'Reminder', 'mode' => 'info']),
    'action'  => $capture('button', ['label' => 'Collect', 'href' => asset('/orders/unpaid')]),
  ],
];

$orders = [
  [
    'code'           => 'SR2600-260326-00065',
    'created_at'     => '26 Mar, 9:10 PM',
    'studio'         => 'Serambi Raya',
    'session'        => '28 Mar, 12:30 PM',
    'customer_name'  => 'Zahirah',
    'customer_phone' => '0137599060',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => asset('/orders'),
    'duplicate_url'  => asset('/orders'),
    'cancel_url'     => asset('/orders/unpaid'),
  ],
  [
    'code'           => 'RK2600-260325-00064',
    'created_at'     => '25 Mar, 10:03 PM',
    'studio'         => 'Raya Kasih',
    'session'        => '28 Mar, 5:00 PM',
    'customer_name'  => 'Mohamad Noor',
    'customer_phone' => '01126587133',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => asset('/orders'),
    'duplicate_url'  => asset('/orders'),
    'cancel_url'     => asset('/orders/unpaid'),
  ],
  [
    'code'           => 'SR2600-260324-00063',
    'created_at'     => '24 Mar, 10:41 AM',
    'studio'         => 'Serambi Raya',
    'session'        => '29 Mar, 1:30 PM',
    'customer_name'  => 'Amira Sofea',
    'customer_phone' => '0123456789',
    'payment'        => 'Processing',
    'status'         => 'In Progress',
    'manage_url'     => asset('/orders'),
    'duplicate_url'  => asset('/orders'),
    'cancel_url'     => asset('/orders/unpaid'),
  ],
  [
    'code'           => 'SR2600-260323-00062',
    'created_at'     => '23 Mar, 1:59 PM',
    'studio'         => 'Serambi Raya',
    'session'        => '28 Mar, 3:45 PM',
    'customer_name'  => 'Nur Sofie Anis Azman',
    'customer_phone' => '01119310272',
    'payment'        => 'Paid Deposit',
    'status'         => 'Pending',
    'manage_url'     => asset('/orders'),
    'duplicate_url'  => asset('/orders'),
    'cancel_url'     => asset('/orders/unpaid'),
  ],
  [
    'code'           => 'SR2600-260320-00061',
    'created_at'     => '20 Mar, 3:05 PM',
    'studio'         => 'Serambi Raya',
    'session'        => '20 Mar, 3:15 PM',
    'customer_name'  => 'Puteri Nur Amiera',
    'customer_phone' => '01111591577',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => asset('/orders'),
    'duplicate_url'  => asset('/orders'),
    'cancel_url'     => asset('/orders/unpaid'),
  ],
  [
    'code'           => 'SR2600-260319-00060',
    'created_at'     => '19 Mar, 4:32 PM',
    'studio'         => 'Serambi Raya',
    'session'        => '19 Mar, 11:30 AM',
    'customer_name'  => 'K Saito La Harza',
    'customer_phone' => '0163254170',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => asset('/orders'),
    'duplicate_url'  => asset('/orders'),
    'cancel_url'     => asset('/orders/unpaid'),
  ],
];

$dashboard_order_table = build_booking_table_dataset($orders, [
  'action_button_size'         => 'default',
  'action_menu_size'           => 'default',
  'default_action_href'        => asset('/orders'),
  'action_menu_view_href'      => asset('/orders'),
  'action_menu_duplicate_href' => asset('/orders'),
  'action_menu_cancel_href'    => asset('/orders/unpaid'),
]);

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<section class="space-y-6">
  <section aria-label="Overview page header">
    <?php
    component('page-header', [
      'title'       => 'Overview',
      'description' => 'Prioritize bookings, payments, and follow-up in one operational dashboard.',
      'actions'     => [
        [
          'label' => 'Open Analytics',
          'href'  => asset('/analytics'),
        ],
        [
          'label'   => 'Open Orders',
          'href'    => asset('/orders'),
          'variant' => 'primary',
        ],
      ],
    ]);
    ?>
  </section>

  <section aria-label="Primary KPI cards">
    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
      <?php foreach ($kpi_cards as $kpi_card): ?>
        <?php component('card-metric', $kpi_card); ?>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="grid gap-4 xl:grid-cols-12" aria-label="Decision center">
    <article class="card xl:col-span-5">
      <header class="card__head">
        <h2 class="card__title">Today&apos;s Focus</h2>
        <p class="card__description">Execute these tasks first to avoid revenue leakage and no-show risk.</p>
      </header>
      <div class="card__body space-y-3">
        <?php foreach ($today_focus_items as $focus_item): ?>
          <div class="flex flex-wrap items-start justify-between gap-3 rounded-md border border-gray-100 p-3">
            <div class="space-y-1">
              <p class="type-body"><?= e($focus_item['title']) ?></p>
              <p class="text-muted"><?= e($focus_item['description']) ?></p>
            </div>
            <div class="inline-flex items-center gap-2">
              <?php
              component('badge', [
                'label' => $focus_item['badge_label'],
                'mode'  => $focus_item['badge_mode'],
              ]);
              ?>
              <?php
              component('button', [
                'label' => $focus_item['cta'],
                'href'  => $focus_item['href'],
              ]);
              ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </article>

    <article class="card xl:col-span-4">
      <header class="card__head">
        <h2 class="card__title">Session Funnel</h2>
        <p class="card__description">See where leads are slowing down before they become lost bookings.</p>
      </header>
      <div class="card__body space-y-3">
        <?php foreach ($session_pipeline as $stage): ?>
          <div class="flex items-start justify-between gap-3 rounded-md border border-gray-100 p-3">
            <div>
              <p class="type-body"><?= e($stage['stage']) ?></p>
              <p class="text-muted mt-1"><?= e($stage['hint']) ?></p>
            </div>
            <p class="type-h2"><?= e((string) $stage['count']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
      <footer class="card__actions">
        <?php component('button', ['label' => 'Open Segments', 'href' => asset('/customers/segments'), 'variant' => 'primary']); ?>
      </footer>
    </article>

    <article class="card xl:col-span-3">
      <header class="card__head">
        <h2 class="card__title">Signal Board</h2>
        <p class="card__description">Live risk and momentum indicators from current activity.</p>
      </header>
      <div class="card__body space-y-3">
        <?php
        component('alert', [
          'variant'     => 'warning',
          'show_icon'   => true,
          'title'       => 'Peak slot pressure',
          'description' => 'Saturday 3:00 PM and 5:00 PM are above 85% utilization.',
        ]);
        ?>
        <?php
        component('alert', [
          'variant'     => 'negative',
          'show_icon'   => true,
          'title'       => 'Unpaid risk',
          'description' => 'Unpaid order amount crossed RM 2,000 today.',
        ]);
        ?>
        <?php
        component('alert', [
          'variant'     => 'info',
          'show_icon'   => true,
          'title'       => 'Feedback gap',
          'description' => '12 completed sessions need post-session forms.',
        ]);
        ?>
      </div>
      <footer class="card__actions">
        <div class="flex flex-wrap gap-2">
          <?php component('button', ['label' => 'Unpaid', 'href' => asset('/orders/unpaid')]); ?>
          <?php component('button', ['label' => 'Feedback', 'href' => asset('/feedback')]); ?>
          <?php component('button', ['label' => 'Calendar', 'href' => asset('/orders/session-calendar')]); ?>
        </div>
      </footer>
    </article>
  </section>

  <section class="grid gap-4 xl:grid-cols-2" aria-label="Execution tables">
    <article class="card">
      <header class="card__head">
        <h2 class="card__title">Upcoming Sessions</h2>
        <p class="card__description">Next active slots and readiness status for today.</p>
      </header>
      <div class="card__table">
        <?php
        component('table', [
          'class'   => 'table--comfortable',
          'headers' => ['Time', 'Customer', 'Studio', 'Status', 'Action'],
          'rows'    => array_map(static function (array $row): array {
            return [$row['time'], $row['customer'], $row['studio'], $row['status'], $row['action']];
          }, $upcoming_session_rows),
        ]);
        ?>
      </div>
      <footer class="card__actions">
        <?php component('button', ['label' => 'Open Session Today', 'href' => asset('/orders/sessions-today'), 'variant' => 'primary']); ?>
      </footer>
    </article>

    <article class="card">
      <header class="card__head">
        <h2 class="card__title">Payment Watchlist</h2>
        <p class="card__description">Orders requiring immediate follow-up to protect cash flow.</p>
      </header>
      <div class="card__table">
        <?php
        component('table', [
          'class'   => 'table--comfortable',
          'headers' => ['Order', 'Outstanding', 'Due', 'State', 'Action'],
          'rows'    => array_map(static function (array $row): array {
            return [$row['order'], $row['amount'], $row['due'], $row['status'], $row['action']];
          }, $payment_watch_rows),
        ]);
        ?>
      </div>
      <footer class="card__actions">
        <?php component('button', ['label' => 'Open Unpaid Orders', 'href' => asset('/orders/unpaid'), 'variant' => 'primary']); ?>
      </footer>
    </article>
  </section>

  <section aria-label="Recent orders table">
    <article class="card">
      <header class="card__head">
        <h2 class="card__title">Recent Orders</h2>
        <p class="card__description">Latest bookings with payment state and fulfillment progress.</p>
      </header>
      <div class="card__table">
        <?php
        component('table', [
          'class'   => 'table--comfortable',
          'headers' => $dashboard_order_table['headers'],
          'rows'    => $dashboard_order_table['rows'],
        ]);
        ?>
      </div>
      <footer class="card__actions">
        <?php
        component('pagination', [
          'current_page' => 1,
          'total_pages'  => 1,
          'show_info'    => true,
          'show_pages'   => true,
          'total_items'  => $dashboard_order_table['total'],
          'per_page'     => 10,
          'base_url'     => asset('/?page=%d'),
        ]);
        ?>
      </footer>
    </article>
  </section>
</section>
<?php layout('app-end'); ?>
