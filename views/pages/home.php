<?php

$page_title   = 'Dashboard';
$page_current = 'dashboard';

$menu_items = [
  [
    'label'  => 'Overview',
    'href'   => '#',
    'active' => true,
  ],
  [
    'label' => 'Analytics',
    'href'  => '#',
  ],
  [
    'label' => 'Projects',
    'href'  => '#',
  ],
  [
    'label'    => 'UI Elements',
    'children' => ui_elements_sidebar_children(),
  ],
  [
    'label'    => 'Management',
    'children' => [
      [
        'label'  => 'Team Members',
        'href'   => '#',
        'active' => false,
      ],
      [
        'label'  => 'User Roles',
        'href'   => '#',
        'active' => true,
      ],
      [
        'label'  => 'Permissions',
        'href'   => '#',
        'active' => false,
      ],
    ],
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

$widgets_overview = [
  [
    'title'     => 'New Signups',
    'value'     => '2,180',
    'trend'     => '+7.1%',
    'note'      => 'last 30 days',
    'icon_name' => 'users',
  ],
  [
    'title'     => 'Churn Risk',
    'value'     => '1.9%',
    'trend'     => '-0.4%',
    'note'      => 'improved retention',
    'icon_name' => 'pulse',
  ],
  [
    'title'     => 'Monthly Revenue',
    'value'     => '$42,890',
    'trend'     => '+12.4%',
    'note'      => 'vs previous month',
    'icon_name' => 'plus',
  ],
  [
    'title'     => 'Open Tickets',
    'value'     => '74',
    'trend'     => '-11.2%',
    'note'      => 'support backlog',
    'icon_name' => 'tickets',
  ],
];

$widgets_plain = [
  [
    'title'     => 'Server Uptime',
    'value'     => '99.98%',
    'trend'     => '+0.2%',
    'note'      => 'weekly stability',
    'show_icon' => false,
  ],
  [
    'title'     => 'Avg Response Time',
    'value'     => '184ms',
    'trend'     => '-12ms',
    'note'      => 'faster than last week',
    'show_icon' => false,
  ],
  [
    'title'     => 'Resolved Tickets',
    'value'     => '312',
    'trend'     => '+18',
    'note'      => 'this week',
    'show_icon' => false,
  ],
  [
    'title'     => 'Active Sessions',
    'value'     => '1,247',
    'trend'     => '+4.6%',
    'note'      => 'live users now',
    'show_icon' => false,
  ],
];

$widgets_target_inline = [
  [
    'title'     => 'Conversion Rate',
    'value'     => '4.82%',
    'trend'     => '+0.6%',
    'note'      => 'week over week',
    'show_icon' => false,
  ],
  [
    'title'     => 'Avg Order Value',
    'value'     => 'RM 248',
    'trend'     => '+3.1%',
    'note'      => 'vs previous cycle',
    'show_icon' => false,
  ],
  [
    'title'     => 'Refund Requests',
    'value'     => '18',
    'trend'     => '-5',
    'note'      => 'better than last week',
    'show_icon' => false,
  ],
  [
    'title'     => 'Support SLA',
    'value'     => '97.4%',
    'trend'     => '+1.2%',
    'note'      => 'resolved within target',
    'show_icon' => false,
  ],
];

$widgets_target_inline_soft = [
  [
    'title'     => 'Pipeline Value',
    'value'     => 'RM 1.24M',
    'trend'     => '+5.7%',
    'note'      => 'active opportunities',
    'show_icon' => false,
  ],
  [
    'title'     => 'SQL to Win',
    'value'     => '22.3%',
    'trend'     => '+1.1%',
    'note'      => 'last 30 days',
    'show_icon' => false,
  ],
  [
    'title'     => 'Sales Cycle',
    'value'     => '18 days',
    'trend'     => '-2 days',
    'note'      => 'faster conversion',
    'show_icon' => false,
  ],
  [
    'title'     => 'Renewal Rate',
    'value'     => '91.6%',
    'trend'     => '+0.8%',
    'note'      => 'annual contracts',
    'show_icon' => false,
  ],
];

ob_start();
?>
<div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
  <div class="rounded-lg border border-gray-100 bg-white p-4">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Primary</p>
    <div class="flex flex-wrap items-center gap-2">
      <?php component('button', ['label' => 'Primary / SM', 'variant' => 'primary', 'size' => 'sm']); ?>
      <?php component('button', ['label' => 'Primary / MD', 'variant' => 'primary', 'size' => 'md']); ?>
      <?php component('button', ['label' => 'Primary / LG', 'variant' => 'primary', 'size' => 'lg']); ?>
    </div>
  </div>

  <div class="rounded-lg border border-gray-100 bg-white p-4">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Neutral</p>
    <div class="flex flex-wrap items-center gap-2">
      <?php component('button', ['label' => 'Neutral / SM', 'variant' => 'neutral', 'size' => 'sm']); ?>
      <?php component('button', ['label' => 'Neutral / MD', 'variant' => 'neutral', 'size' => 'md']); ?>
      <?php component('button', ['label' => 'Neutral / LG', 'variant' => 'neutral', 'size' => 'lg']); ?>
    </div>
  </div>

  <div class="rounded-lg border border-gray-100 bg-white p-4">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Ghost</p>
    <div class="flex flex-wrap items-center gap-2">
      <?php component('button', ['label' => 'Ghost / SM', 'variant' => 'ghost', 'size' => 'sm']); ?>
      <?php component('button', ['label' => 'Ghost / MD', 'variant' => 'ghost', 'size' => 'md']); ?>
      <?php component('button', ['label' => 'Ghost / LG', 'variant' => 'ghost', 'size' => 'lg']); ?>
    </div>
  </div>

  <div class="rounded-lg border border-gray-100 bg-white p-4">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">Danger</p>
    <div class="flex flex-wrap items-center gap-2">
      <?php component('button', ['label' => 'Danger / SM', 'variant' => 'danger', 'size' => 'sm']); ?>
      <?php component('button', ['label' => 'Danger / MD', 'variant' => 'danger', 'size' => 'md']); ?>
      <?php component('button', ['label' => 'Danger / LG', 'variant' => 'danger', 'size' => 'lg']); ?>
    </div>
  </div>

  <div class="rounded-lg border border-gray-100 bg-white p-4 sm:col-span-2 lg:col-span-2">
    <p class="mb-3 text-xs font-semibold uppercase tracking-wide text-gray-500">States & Link</p>
    <div class="flex flex-wrap items-center gap-2">
      <?php component('button', ['label' => 'Disabled', 'variant' => 'neutral', 'disabled' => true]); ?>
      <?php component('button', ['label' => 'As Link', 'variant' => 'primary', 'href' => '#']); ?>
      <?php component('button', ['label' => 'Danger Link', 'variant' => 'danger', 'href' => '#']); ?>
    </div>
  </div>
</div>
<?php
$button_showcase_content = (string) ob_get_clean();

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
    'manage_url'     => '/app/order/view-order/65',
  ],
  [
    'code'           => 'RK2600-260325-00064',
    'created_at'     => '25 Mar, 22:03 PM',
    'studio'         => 'Raya Kasih',
    'session'        => '2026-03-28 05:00 PM',
    'customer_name'  => 'Mohamad Noor',
    'customer_phone' => '01126587133',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '/app/order/view-order/64',
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
    'manage_url'     => '/app/order/view-order/63',
  ],
  [
    'code'           => 'SR2600-260323-00062',
    'created_at'     => '23 Mar, 13:59 PM',
    'studio'         => 'Serambi Raya',
    'session'        => '2026-03-28 03:45 PM',
    'customer_name'  => 'Nur Sofie Anis Azman',
    'customer_phone' => '01119310272',
    'payment'        => 'Paid Deposit',
    'status'         => 'Pending',
    'manage_url'     => '/app/order/view-order/62',
  ],
  [
    'code'           => 'SR2600-260320-00061',
    'created_at'     => '20 Mar, 15:05 PM',
    'studio'         => 'Serambi Raya',
    'session'        => '2026-03-20 03:15 PM',
    'customer_name'  => 'Puteri Nur Amiera Binti Mohd Anuar',
    'customer_phone' => '01111591577',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '/app/order/view-order/61',
  ],
  [
    'code'           => 'SR2600-260319-00060',
    'created_at'     => '19 Mar, 16:32 PM',
    'studio'         => 'Serambi Raya',
    'session'        => '2026-03-19 11:30 PM',
    'customer_name'  => 'K Saito La Harza',
    'customer_phone' => '0163254170',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '/app/order/view-order/60',
  ],
  [
    'code'           => 'RK2600-260318-00059',
    'created_at'     => '18 Mar, 23:48 PM',
    'studio'         => 'Raya Kasih',
    'session'        => '2026-03-19 03:45 PM',
    'customer_name'  => 'SITI NUR BALQIS',
    'customer_phone' => '0179150001',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '/app/order/view-order/59',
  ],
  [
    'code'           => 'SR2600-260318-00058',
    'created_at'     => '18 Mar, 19:54 PM',
    'studio'         => 'Serambi Raya',
    'session'        => '2026-03-19 10:15 PM',
    'customer_name'  => 'Arni Nazirah',
    'customer_phone' => '0183671517',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '/app/order/view-order/58',
  ],
  [
    'code'           => 'SR2600-260318-00057',
    'created_at'     => '18 Mar, 02:13 AM',
    'studio'         => 'Serambi Raya',
    'session'        => '2026-03-18 09:00 PM',
    'customer_name'  => 'Dewi Anggraeni',
    'customer_phone' => '0172257065',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '/app/order/view-order/57',
  ],
  [
    'code'           => 'LR2600-260317-00056',
    'created_at'     => '17 Mar, 16:55 PM',
    'studio'         => 'Laman Raya',
    'session'        => '2026-03-18 10:15 PM',
    'customer_name'  => 'Khairunnisa Munirah',
    'customer_phone' => '0143378481',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '/app/order/view-order/56',
  ],
  [
    'code'           => 'LR2600-260317-00055',
    'created_at'     => '17 Mar, 14:16 PM',
    'studio'         => 'Laman Raya',
    'session'        => '2026-03-19 01:00 PM',
    'customer_name'  => 'Syafawati Samudi',
    'customer_phone' => '0166264176',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '/app/order/view-order/55',
  ],
  [
    'code'           => 'SR2600-260316-00054',
    'created_at'     => '16 Mar, 11:24 AM',
    'studio'         => 'Serambi Raya',
    'session'        => '2026-03-20 12:45 PM',
    'customer_name'  => 'Nur Izzati',
    'customer_phone' => '01122334455',
    'payment'        => 'Paid Deposit',
    'status'         => 'Pending',
    'manage_url'     => '/app/order/view-order/54',
  ],
  [
    'code'           => 'RK2600-260315-00053',
    'created_at'     => '15 Mar, 08:30 AM',
    'studio'         => 'Raya Kasih',
    'session'        => '2026-03-21 05:30 PM',
    'customer_name'  => 'Farhan Hafiz',
    'customer_phone' => '0129988776',
    'payment'        => 'Processing',
    'status'         => 'In Progress',
    'manage_url'     => '/app/order/view-order/53',
  ],
  [
    'code'           => 'LR2600-260314-00052',
    'created_at'     => '14 Mar, 18:45 PM',
    'studio'         => 'Laman Raya',
    'session'        => '2026-03-22 11:00 AM',
    'customer_name'  => 'Ainul Mardhiah',
    'customer_phone' => '0131111222',
    'payment'        => 'Paid Full',
    'status'         => 'Priority',
    'manage_url'     => '/app/order/view-order/52',
  ],
  [
    'code'           => 'SR2600-260313-00051',
    'created_at'     => '13 Mar, 13:12 PM',
    'studio'         => 'Serambi Raya',
    'session'        => '2026-03-23 02:15 PM',
    'customer_name'  => 'Nabil Aiman',
    'customer_phone' => '0170001122',
    'payment'        => 'Paid Deposit',
    'status'         => 'Pending',
    'manage_url'     => '/app/order/view-order/51',
  ],
  [
    'code'           => 'RK2600-260312-00050',
    'created_at'     => '12 Mar, 09:54 AM',
    'studio'         => 'Raya Kasih',
    'session'        => '2026-03-24 09:45 AM',
    'customer_name'  => 'Siti Adibah',
    'customer_phone' => '01133334444',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '/app/order/view-order/50',
  ],
  [
    'code'           => 'LR2600-260311-00049',
    'created_at'     => '11 Mar, 21:20 PM',
    'studio'         => 'Laman Raya',
    'session'        => '2026-03-24 04:00 PM',
    'customer_name'  => 'Arif Hakim',
    'customer_phone' => '0195544332',
    'payment'        => 'Processing',
    'status'         => 'In Progress',
    'manage_url'     => '/app/order/view-order/49',
  ],
  [
    'code'           => 'SR2600-260310-00048',
    'created_at'     => '10 Mar, 17:38 PM',
    'studio'         => 'Serambi Raya',
    'session'        => '2026-03-25 01:15 PM',
    'customer_name'  => 'Qistina Amani',
    'customer_phone' => '0148899776',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '/app/order/view-order/48',
  ],
  [
    'code'           => 'RK2600-260309-00047',
    'created_at'     => '09 Mar, 12:02 PM',
    'studio'         => 'Raya Kasih',
    'session'        => '2026-03-26 08:30 PM',
    'customer_name'  => 'Shafiq Iskandar',
    'customer_phone' => '0167008899',
    'payment'        => 'Paid Deposit',
    'status'         => 'Pending',
    'manage_url'     => '/app/order/view-order/47',
  ],
  [
    'code'           => 'LR2600-260308-00046',
    'created_at'     => '08 Mar, 15:47 PM',
    'studio'         => 'Laman Raya',
    'session'        => '2026-03-27 03:00 PM',
    'customer_name'  => 'Hanisah Zulaikha',
    'customer_phone' => '0136677889',
    'payment'        => 'Paid Full',
    'status'         => 'Completed',
    'manage_url'     => '/app/order/view-order/46',
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
      <header class="mb-8 flex flex-col gap-4 border-b border-gray-200 pb-6 md:flex-row md:items-end md:justify-between">
        <div>
          <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Overview</p>
          <h1 class="text-2xl font-semibold tracking-tight text-gray-900">Performance Dashboard</h1>
          <p class="mt-2 max-w-3xl text-sm text-gray-500">
            Structured overview with focused KPIs and operational insights.
          </p>
        </div>
        <button class="rounded-lg border border-gray-200 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100">
          Export Snapshot
        </button>
      </header>

      <div class="space-y-5">
        <section class="grid gap-4 xl:grid-cols-5" aria-label="Dashboard overview">
          <div class="xl:col-span-3">
            <div class="grid gap-4 sm:grid-cols-2">
              <?php foreach ($widgets_overview as $widget): ?>
                <?php component('card-widget', $widget); ?>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="xl:col-span-2">
            <?php component('card-module'); ?>
          </div>
        </section>

        <section aria-label="Plain widget cards">
          <div class="grid gap-4 md:grid-cols-4">
            <?php foreach ($widgets_plain as $widget): ?>
              <?php component('card-widget', $widget); ?>
            <?php endforeach; ?>
          </div>
        </section>

        <section aria-label="Target summary with inline widgets">
          <?php
          component('card-module', [
            'title'       => 'Acquisition Snapshot',
            'subtitle'    => 'Quick summary for this quarter',
            'show_graph'  => false,
            'show_footer' => false,
            'widgets'     => $widgets_target_inline,
          ]);
          ?>
        </section>

        <section aria-label="Soft acquisition snapshot with inline widgets">
          <?php
          component('card-module', [
            'title'       => 'Revenue Pulse',
            'subtitle'    => 'Soft theme variation for balanced emphasis',
            'show_graph'  => false,
            'show_footer' => false,
            'widgets'     => $widgets_target_inline_soft,
            'states'      => [
              'soft' => true,
            ],
          ]);
          ?>
        </section>

        <section aria-label="Button foundation showcase">
          <?php
          component('card-module', [
            'title'       => 'Button Foundation',
            'subtitle'    => 'All available button variants, sizes, and states in one module.',
            'show_graph'  => false,
            'show_footer' => false,
            'show_menu'   => false,
            'content'     => $button_showcase_content,
          ]);
          ?>
        </section>

        <section aria-label="Orders data table">
          <?php component('card-data', ['orders' => $orders]); ?>
        </section>
      </div>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
