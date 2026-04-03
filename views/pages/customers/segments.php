<?php

$page_title   = 'Customer Segments';
$page_current = 'customers-segments';

$menu_items = build_main_menu_items();

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$segment_widgets = [
  [
    'title'   => 'Campaign Ready',
    'value'   => '248',
    'meta'    => 'profiles with complete targeting data',
    'badge'   => ['label' => '+18', 'mode' => 'positive'],
    'icon'    => 'sparkles',
  ],
  [
    'title'   => 'At Risk',
    'value'   => '63',
    'meta'    => 'no new booking in the last 90 days',
    'badge'   => ['label' => '-7', 'mode' => 'positive'],
    'icon'    => 'alarm-warning-line',
  ],
  [
    'title'   => 'High Value',
    'value'   => '92',
    'meta'    => 'customers with 5+ completed orders',
    'badge'   => ['label' => '+12', 'mode' => 'positive'],
    'icon'    => 'diamond-line',
  ],
];

$segment_rows = [
  [
    'name'       => 'Wedding & Family Repeat',
    'criteria'   => 'Interests: Wedding / Kids / Family • Orders: 3+',
    'customers'  => '74',
    'avg_rating' => '4.8',
    'status'     => 'Active',
  ],
  [
    'name'       => 'Content Creators',
    'criteria'   => 'Interests: TikTok / Instagram / Personal Branding',
    'customers'  => '58',
    'avg_rating' => '4.6',
    'status'     => 'Active',
  ],
  [
    'name'       => 'Promo Hunters',
    'criteria'   => 'Interest: Promo Hunter • Intent: Asked for Pricing',
    'customers'  => '91',
    'avg_rating' => '4.4',
    'status'     => 'Review',
  ],
  [
    'name'       => 'At-Risk Repeat Clients',
    'criteria'   => 'Orders: 2+ • No order in 90 days',
    'customers'  => '63',
    'avg_rating' => '4.7',
    'status'     => 'Priority',
  ],
];

$rows = [];
foreach ($segment_rows as $segment_row) {
  $status_mode = 'neutral';
  if ($segment_row['status'] === 'Active') {
    $status_mode = 'positive';
  } elseif ($segment_row['status'] === 'Priority') {
    $status_mode = 'warning';
  } elseif ($segment_row['status'] === 'Review') {
    $status_mode = 'info';
  }

  $rows[] = [
    'cells' => [
      [
        'html' => '
          <div class="table__stack">
            <p class="table__primary">' . e($segment_row['name']) . '</p>
            <p class="table__secondary">' . e($segment_row['criteria']) . '</p>
          </div>',
      ],
      ['value' => $segment_row['customers'], 'align' => 'right'],
      ['value' => $segment_row['avg_rating'], 'align' => 'right'],
      [
        'html'  => $capture('badge', [
          'label' => $segment_row['status'],
          'mode'  => $status_mode,
        ]),
        'align' => 'right',
      ],
      [
        'html'  => $capture('button', [
          'label' => 'Open Segment',
          'href'  => '#',
        ]),
        'align' => 'right',
      ],
    ],
  ];
}

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="mx-auto max-w-7xl space-y-6">
      <?php component('page-header', [
        'title'       => 'Customers Segments',
        'description' => 'Build and track audience groups for targeted promotions, retargeting, and campaign planning.',
        'actions'     => [
          [
            'label' => 'Open Customer Profile Form',
            'href'  => asset('/customers/profile'),
          ],
          [
            'label'   => 'Create Segment',
            'href'    => '#',
            'variant' => 'primary',
          ],
        ],
      ]); ?>

      <div class="grid gap-4 md:grid-cols-3">
        <?php foreach ($segment_widgets as $segment_widget): ?>
          <?php component('card-metric', [
            'title'      => $segment_widget['title'],
            'value'      => $segment_widget['value'],
            'trend'      => $segment_widget['badge']['label'],
            'trend_mode' => $segment_widget['badge']['mode'],
            'note'       => $segment_widget['meta'],
            'icon_name'  => $segment_widget['icon'],
            'icon_set'   => 'remix',
          ]); ?>
        <?php endforeach; ?>
      </div>

      <article class="card" aria-label="Customer segments table">
        <div class="card__table">
          <?php component('table', [
            'class'   => 'table--comfortable',
            'headers' => [
              'Segment',
              ['label' => 'Customers', 'align' => 'right'],
              ['label' => 'Avg Rating', 'align' => 'right'],
              ['label' => 'Status', 'align' => 'right'],
              ['label' => 'Action', 'align' => 'right'],
            ],
            'rows' => $rows,
          ]); ?>
        </div>
      </article>
    </section>
<?php layout('app-end'); ?>
