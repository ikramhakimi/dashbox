<?php

$page_title   = 'Sales Calendar';
$page_current = 'sales-calendar';

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

$month_label          = 'April 2026';
$today_key            = '2026-04-02';
$max_visible_sessions = 4;
$daily_sales_target   = 5000;
$week_labels          = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
$grid_start           = new DateTimeImmutable('2026-03-30');
$format_rm = static function (int $amount): string {
  return 'RM ' . number_format($amount, 0, '.', ',');
};
$session_thumbnail_pool = [
  'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&w=128&q=80',
  'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=128&q=80',
  'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=128&q=80',
  'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=128&q=80',
  'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=128&q=80',
  'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=128&q=80',
];
$derive_session_meta = static function (array $session_item) use ($session_thumbnail_pool): array {
  $title = isset($session_item['title']) ? (string) $session_item['title'] : '';
  $parts = explode(' - ', $title, 2);

  $customer_name = trim($parts[0] ?? '');
  $package_name  = trim($parts[1] ?? $title);

  if ($customer_name === '') {
    $customer_name = 'Walk-in Customer';
  }

  if ($package_name === '') {
    $package_name = 'Session Package';
  }

  $seed     = abs(crc32($title . '|' . ($session_item['time'] ?? '')));
  $name_suffixes = ['Ahmad', 'Ibrahim', 'Hassan', 'Rahman', 'Ismail', 'Yusof', 'Hakim'];
  if (strpos($customer_name, ' ') === false && strtolower($customer_name) !== 'walk-in customer') {
    $customer_name .= ' ' . $name_suffixes[$seed % count($name_suffixes)];
  }

  $pax      = ($seed % 6) + 1;
  $thumb    = $session_thumbnail_pool[$seed % count($session_thumbnail_pool)];

  return [
    'customer_name' => $customer_name,
    'customer_phone'=> '01' . str_pad((string) ($seed % 100000000), 8, '0', STR_PAD_LEFT),
    'package_name'  => $package_name,
    'pax'           => $pax,
    'thumbnail'     => $thumb,
  ];
};

$session_map = [
  '2026-04-01' => [
    ['time' => '09:00 AM', 'title' => 'Aina - Sunrise Session', 'amount' => 680],
    ['time' => '01:30 PM', 'title' => 'Nadia - Portrait Package', 'amount' => 920],
    ['time' => '04:00 PM', 'title' => 'Mei - Family Session', 'amount' => 760],
  ],
  '2026-04-02' => [
    ['time' => '10:30 AM', 'title' => 'Daniel - Studio Package', 'amount' => 840],
    ['time' => '03:00 PM', 'title' => 'Hakim - Corporate Pack', 'amount' => 1320],
    ['time' => '05:00 PM', 'title' => 'Siti - Family Session', 'amount' => 760],
    ['time' => '06:00 PM', 'title' => 'Irfan - Product Session', 'amount' => 580],
    ['time' => '07:00 PM', 'title' => 'Lina - Couple Session', 'amount' => 890],
    ['time' => '08:00 PM', 'title' => 'Amos - Team Portrait', 'amount' => 960],
    ['time' => '08:30 PM', 'title' => 'Nora - Event Prep', 'amount' => 540],
    ['time' => '09:00 PM', 'title' => 'Zaid - Quick Session', 'amount' => 460],
    ['time' => '09:30 PM', 'title' => 'Aisyah - Follow-up', 'amount' => 380],
  ],
  '2026-04-03' => [
    ['time' => '11:15 AM', 'title' => 'Farah - Family Package', 'amount' => 740],
  ],
  '2026-04-05' => [
    ['time' => '02:00 PM', 'title' => 'Rina - Outdoor Package', 'amount' => 1160],
    ['time' => '05:30 PM', 'title' => 'Azri - Premium Session', 'amount' => 1380],
  ],
  '2026-04-08' => [
    ['time' => '09:30 AM', 'title' => 'Jason - Basic Session', 'amount' => 560],
  ],
  '2026-04-10' => [
    ['time' => '12:00 PM', 'title' => 'Amirah - Studio Package', 'amount' => 880],
    ['time' => '04:30 PM', 'title' => 'Darren - Corporate Pack', 'amount' => 980],
    ['time' => '06:00 PM', 'title' => 'Walk-in - Quick Shoot', 'amount' => 420],
  ],
  '2026-04-14' => [
    ['time' => '10:00 AM', 'title' => 'Omar - Outdoor Session', 'amount' => 1280],
  ],
  '2026-04-15' => [
    ['time' => '11:00 AM', 'title' => 'Nurin - Product Shoot', 'amount' => 960],
    ['time' => '03:30 PM', 'title' => 'Benjamin - Team Portrait', 'amount' => 740],
  ],
  '2026-04-18' => [
    ['time' => '09:45 AM', 'title' => 'Ivy - Family Session', 'amount' => 820],
    ['time' => '01:00 PM', 'title' => 'Syafiq - Event Coverage', 'amount' => 1120],
  ],
  '2026-04-21' => [
    ['time' => '10:00 AM', 'title' => 'Fatin - Maternity Shoot', 'amount' => 920],
  ],
  '2026-04-24' => [
    ['time' => '09:00 AM', 'title' => 'Jia Wen - Portrait Session', 'amount' => 760],
    ['time' => '02:30 PM', 'title' => 'Ravi - Brand Content', 'amount' => 860],
  ],
  '2026-04-27' => [
    ['time' => '11:30 AM', 'title' => 'Kamil - Corporate Headshot', 'amount' => 1180],
  ],
  '2026-04-29' => [
    ['time' => '10:15 AM', 'title' => 'Aina - Follow-up Session', 'amount' => 620],
    ['time' => '04:00 PM', 'title' => 'Mei - Couple Session', 'amount' => 880],
  ],
];

$calendar_days    = [];
$session_drawers  = [];
for ($index = 0; $index < 35; $index++) {
  $date = $grid_start->modify('+' . $index . ' day');
  if (!$date instanceof DateTimeImmutable) {
    continue;
  }

  $date_key = $date->format('Y-m-d');
  $sessions = isset($session_map[$date_key]) ? $session_map[$date_key] : [];
  $drawer_id = count($sessions) > 0 ? 'sales-day-' . $date->format('Ymd') : '';

  $sales_total = 0;
  foreach ($sessions as $session_item) {
    $sales_total += isset($session_item['amount']) ? (int) $session_item['amount'] : 0;
  }

  $total_orders  = count($sessions);
  $target_status = 'neutral';
  if ($total_orders > 0 && $date->format('m') === '04') {
    $target_status = $sales_total >= $daily_sales_target ? 'hit' : 'risk';
  }

  $visible_items  = array_slice($sessions, 0, $max_visible_sessions);
  $extra_sessions = max(0, count($sessions) - count($visible_items));

  $calendar_days[] = [
    'date_key'       => $date_key,
    'day'            => $date->format('j'),
    'in_month'       => $date->format('m') === '04',
    'is_today'       => $date_key === $today_key,
    'drawer_id'      => $drawer_id,
    'sales_total'    => $format_rm($sales_total),
    'total_orders'   => $total_orders,
    'target_status'  => $target_status,
    'visible_items'  => $visible_items,
    'extra_sessions' => $extra_sessions,
  ];

  if ($drawer_id !== '') {
    $session_drawers[] = [
      'id'               => $drawer_id,
      'title'            => $date->format('l, d M Y'),
      'sessions'         => $sessions,
      'sales_total'      => $sales_total,
      'total_orders'     => $total_orders,
      'remaining_target' => max(0, $daily_sales_target - $sales_total),
      'is_today'         => $date_key === $today_key,
    ];
  }
}

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
        'title'       => 'Sales Calendar',
        'description' => 'Show total sales for each day in calendar mode.',
      ]);
      ?>

      <?php
      component('calendar', [
        'month_label' => $month_label,
        'week_labels' => $week_labels,
        'days'        => $calendar_days,
        'attributes'  => ['aria-label' => 'Sales calendar view'],
      ]);
      ?>
    </section>
  </main>
</div>

<?php foreach ($session_drawers as $session_drawer): ?>
  <?php
  ob_start();
  ?>
  <div>
    <div class="divide-y divide-gray-200">
      <?php foreach ($session_drawer['sessions'] as $session_item): ?>
        <?php $session_meta = $derive_session_meta($session_item); ?>
        <div class="grid grid-cols-[84px_minmax(0,1fr)_64px] items-start gap-3 px-6 py-4">
          <p class="type-body type-semibold text-dark"><?= e((string) ($session_item['time'] ?? '')) ?></p>

          <div class="space-y-1">
            <p class="type-body type-semibold text-dark"><?= e($session_meta['customer_name']) ?></p>
            <p class="type-body-muted"><?= e($session_meta['customer_phone']) ?></p>
            <p class="type-body type-secondary">
              <?= e($session_meta['package_name']) ?> (<?= e((string) $session_meta['pax']) ?> pax)
            </p>
            <p class="type-body">
              <span class="type-medium text-dark"><?= e($format_rm((int) ($session_item['amount'] ?? 0))) ?></span>
            </p>
          </div>

          <img
            src="<?= e($session_meta['thumbnail']) ?>"
            alt="<?= e($session_meta['package_name']) ?> thumbnail"
            class="h-16 w-16 rounded-md object-cover"
            loading="lazy"
          >
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php
  $drawer_content = (string) ob_get_clean();

  $drawer_footer = '
    <div class="flex items-center gap-2">
      ' . $capture('button', [
        'label'      => 'Close',
        'attributes' => ['data-drawer-close' => true],
      ]) . '
      ' . $capture('button', [
        'label'   => 'Open Day Sales',
        'variant' => 'primary',
      ]) . '
    </div>
  ';

  component('drawer', [
    'id'          => $session_drawer['id'],
    'title'       => 'Sales • ' . $session_drawer['title'],
    'description' => 'Daily session and sales breakdown.',
    'meta'        => 'Sales : ' . $format_rm((int) $session_drawer['sales_total']) . ' / ' . (string) $session_drawer['total_orders'] . ' orders',
    'content'     => $drawer_content,
    'footer'      => $drawer_footer,
    'placement'   => 'right',
    'size'        => 'lg',
  ]);
  ?>
<?php endforeach; ?>
<?php layout('layout-end'); ?>
