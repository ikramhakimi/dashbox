<?php

$page_title   = 'Session Calendar';
$page_current = 'orders-session-calendar';

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

$month_label  = 'April 2026';
$today_key    = '2026-04-02';
$max_visible_sessions = 4;
$week_labels  = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
$grid_start   = new DateTimeImmutable('2026-03-30');
$session_map  = [
  '2026-04-01' => [
    ['time' => '09:00 AM', 'title' => 'Aina - Sunrise Session'],
    ['time' => '01:30 PM', 'title' => 'Nadia - Portrait Package'],
    ['time' => '04:00 PM', 'title' => 'Mei - Family Session'],
  ],
  '2026-04-02' => [
    ['time' => '10:30 AM', 'title' => 'Daniel - Studio Package'],
    ['time' => '03:00 PM', 'title' => 'Hakim - Corporate Pack'],
    ['time' => '05:00 PM', 'title' => 'Siti - Family Session'],
    ['time' => '06:00 PM', 'title' => 'Irfan - Product Session'],
    ['time' => '07:00 PM', 'title' => 'Lina - Couple Session'],
    ['time' => '08:00 PM', 'title' => 'Amos - Team Portrait'],
    ['time' => '08:30 PM', 'title' => 'Nora - Event Prep'],
    ['time' => '09:00 PM', 'title' => 'Zaid - Quick Session'],
    ['time' => '09:30 PM', 'title' => 'Aisyah - Follow-up'],
  ],
  '2026-04-03' => [
    ['time' => '11:15 AM', 'title' => 'Farah - Family Package'],
  ],
  '2026-04-05' => [
    ['time' => '02:00 PM', 'title' => 'Rina - Outdoor Package'],
    ['time' => '05:30 PM', 'title' => 'Azri - Premium Session'],
  ],
  '2026-04-08' => [
    ['time' => '09:30 AM', 'title' => 'Jason - Basic Session'],
  ],
  '2026-04-10' => [
    ['time' => '12:00 PM', 'title' => 'Amirah - Studio Package'],
    ['time' => '04:30 PM', 'title' => 'Darren - Corporate Pack'],
    ['time' => '06:00 PM', 'title' => 'Walk-in - Quick Shoot'],
  ],
  '2026-04-14' => [
    ['time' => '10:00 AM', 'title' => 'Omar - Outdoor Session'],
  ],
  '2026-04-15' => [
    ['time' => '11:00 AM', 'title' => 'Nurin - Product Shoot'],
    ['time' => '03:30 PM', 'title' => 'Benjamin - Team Portrait'],
  ],
  '2026-04-18' => [
    ['time' => '09:45 AM', 'title' => 'Ivy - Family Session'],
    ['time' => '01:00 PM', 'title' => 'Syafiq - Event Coverage'],
  ],
  '2026-04-21' => [
    ['time' => '10:00 AM', 'title' => 'Fatin - Maternity Shoot'],
  ],
  '2026-04-24' => [
    ['time' => '09:00 AM', 'title' => 'Jia Wen - Portrait Session'],
    ['time' => '02:30 PM', 'title' => 'Ravi - Brand Content'],
  ],
  '2026-04-27' => [
    ['time' => '11:30 AM', 'title' => 'Kamil - Corporate Headshot'],
  ],
  '2026-04-29' => [
    ['time' => '10:15 AM', 'title' => 'Aina - Follow-up Session'],
    ['time' => '04:00 PM', 'title' => 'Mei - Couple Session'],
  ],
];

$calendar_days = [];
$session_drawers = [];
for ($index = 0; $index < 35; $index++) {
  $date = $grid_start->modify('+' . $index . ' day');
  if (!$date instanceof DateTimeImmutable) {
    continue;
  }

  $date_key       = $date->format('Y-m-d');
  $sessions       = isset($session_map[$date_key]) ? $session_map[$date_key] : [];
  $drawer_id      = count($sessions) > 0 ? 'session-day-' . $date->format('Ymd') : '';
  $visible_items  = array_slice($sessions, 0, $max_visible_sessions);
  $extra_sessions = max(0, count($sessions) - count($visible_items));

  $calendar_days[] = [
    'date_key'       => $date_key,
    'day'            => $date->format('j'),
    'in_month'       => $date->format('m') === '04',
    'is_today'       => $date_key === $today_key,
    'drawer_id'      => $drawer_id,
    'visible_items'  => $visible_items,
    'extra_sessions' => $extra_sessions,
  ];

  if ($drawer_id !== '') {
    $session_drawers[] = [
      'id'       => $drawer_id,
      'date_key' => $date_key,
      'title'    => $date->format('l, d M Y'),
      'sessions' => $sessions,
      'is_today' => $date_key === $today_key,
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
        'title'       => 'Session Calendar',
        'description' => 'Month view with clickable session days that open detail drawer.',
      ]);
      ?>

      <?php
      component('calendar', [
        'month_label' => $month_label,
        'week_labels' => $week_labels,
        'days'        => $calendar_days,
        'attributes'  => ['aria-label' => 'Session calendar view'],
      ]);
      ?>
    </section>
  </main>
</div>
<?php foreach ($session_drawers as $session_drawer): ?>
  <?php
  ob_start();
  ?>
  <div class="space-y-4">
    <?php if ($session_drawer['is_today']): ?>
      <div class="rounded-md bg-amber-50 px-3 py-2 text-sm font-medium text-amber-800">
        Today session highlight
      </div>
    <?php endif; ?>

    <div class="space-y-3">
      <?php foreach ($session_drawer['sessions'] as $session_item): ?>
        <div class="rounded-md border border-gray-200 bg-white p-3">
          <p class="text-sm font-semibold text-gray-900"><?= e((string) ($session_item['time'] ?? '')) ?></p>
          <p class="mt-1 text-sm text-gray-600"><?= e((string) ($session_item['title'] ?? '')) ?></p>
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
        'label'   => 'Open Day Schedule',
        'variant' => 'primary',
      ]) . '
    </div>
  ';

  component('drawer', [
    'id'          => $session_drawer['id'],
    'title'       => 'Sessions • ' . $session_drawer['title'],
    'description' => 'Full list of sessions for selected day.',
    'content'     => $drawer_content,
    'footer'      => $drawer_footer,
    'placement'   => 'right',
    'size'        => 'lg',
  ]);
  ?>
<?php endforeach; ?>
<?php layout('layout-end'); ?>
