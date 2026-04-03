<?php

$page_title   = 'Feedback';
$page_current = 'feedback';

$menu_items = build_main_menu_items();

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$kpi_cards = [
  [
    'label' => 'Pending Feedback',
    'value' => '47',
    'meta'  => 'awaiting customer response',
    'badge' => ['label' => '+6', 'mode' => 'warning'],
    'icon'  => 'message-3-line',
  ],
  [
    'label' => 'Avg Rating (30 days)',
    'value' => '4.7',
    'meta'  => 'from 318 completed sessions',
    'badge' => ['label' => '+0.2', 'mode' => 'positive'],
    'icon'  => 'star-line',
  ],
  [
    'label' => 'Completion Rate',
    'value' => '82%',
    'meta'  => 'feedback forms submitted',
    'badge' => ['label' => '+5%', 'mode' => 'positive'],
    'icon'  => 'checkbox-circle-line',
  ],
  [
    'label' => 'Profiles Completed',
    'value' => '63%',
    'meta'  => 'customer profiles enriched',
    'badge' => ['label' => '+9%', 'mode' => 'positive'],
    'icon'  => 'user-follow-line',
  ],
];

$feedback_entries = [
  ['order' => 'ORD-1048', 'session_date' => '02 Apr 2026', 'studio' => 'Bangsar South', 'customer' => 'Aisyah Rahman', 'rating' => '-',   'feedback_status' => 'Pending',     'profile_status' => 'Pending',  'sla' => '55h'],
  ['order' => 'ORD-1047', 'session_date' => '01 Apr 2026', 'studio' => 'Kota Damansara','customer' => 'Nurin Sofea',   'rating' => '4.9', 'feedback_status' => 'Complete',    'profile_status' => 'Complete', 'sla' => 'Done'],
  ['order' => 'ORD-1046', 'session_date' => '01 Apr 2026', 'studio' => 'PJ Uptown',     'customer' => 'Farid Salleh',  'rating' => '3.8', 'feedback_status' => 'In Progress', 'profile_status' => 'Complete', 'sla' => '31h'],
  ['order' => 'ORD-1045', 'session_date' => '31 Mar 2026', 'studio' => 'Shah Alam',     'customer' => 'Darren Wong',   'rating' => '-',   'feedback_status' => 'Pending',     'profile_status' => 'Pending',  'sla' => '76h'],
  ['order' => 'ORD-1044', 'session_date' => '31 Mar 2026', 'studio' => 'Cyberjaya',     'customer' => 'Nadia Ismail',  'rating' => '4.6', 'feedback_status' => 'Complete',    'profile_status' => 'Pending',  'sla' => '19h'],
];

$rows = [];
foreach ($feedback_entries as $feedback_entry) {
  $feedback_mode = 'warning';
  if ($feedback_entry['feedback_status'] === 'Complete') {
    $feedback_mode = 'positive';
  } elseif ($feedback_entry['feedback_status'] === 'In Progress') {
    $feedback_mode = 'info';
  }

  $profile_mode = $feedback_entry['profile_status'] === 'Complete' ? 'positive' : 'warning';

  $rows[] = [
    'cells' => [
      $feedback_entry['order'],
      $feedback_entry['session_date'],
      $feedback_entry['studio'],
      $feedback_entry['customer'],
      ['value' => $feedback_entry['rating'], 'align' => 'right'],
      [
        'html'  => $capture('badge', [
          'label' => $feedback_entry['feedback_status'],
          'mode'  => $feedback_mode,
        ]),
        'align' => 'right',
      ],
      [
        'html'  => $capture('badge', [
          'label' => $feedback_entry['profile_status'],
          'mode'  => $profile_mode,
        ]),
        'align' => 'right',
      ],
      ['value' => $feedback_entry['sla'], 'align' => 'right'],
      [
        'html'  => $capture('button', [
          'label' => 'Open Form',
          'href'  => asset('/customers/profile'),
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
        'title'       => 'Feedback',
        'description' => 'Single operational hub to track feedback completion, profile enrichment, and service quality signals.',
        'actions'     => [
          [
            'label'   => 'Open Customer Profile Form',
            'href'    => asset('/customers/profile'),
          ],
          [
            'label'   => 'Open Feedback Form',
            'href'    => '#',
            'variant' => 'primary',
          ],
        ],
      ]); ?>

      <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
        <?php foreach ($kpi_cards as $kpi_card): ?>
          <article class="card card--metric" aria-label="<?= e($kpi_card['label']) ?>">
            <div class="card__body">
              <div class="card__metric-head">
                <p class="type-caption"><?= e($kpi_card['label']) ?></p>
                <div class="card__icon">
                  <?php component('icon', [
                    'icon_name' => $kpi_card['icon'],
                    'icon_size' => 24,
                    'icon_set'  => 'remix',
                  ]); ?>
                </div>
              </div>
              <p class="type-h2"><?= e($kpi_card['value']) ?></p>
              <div class="card__meta">
                <?php component('badge', [
                  'label' => $kpi_card['badge']['label'],
                  'mode'  => $kpi_card['badge']['mode'],
                ]); ?>
                <p class="type-meta"><?= e($kpi_card['meta']) ?></p>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>

      <article class="card" aria-label="Feedback filters and actions">
        <div class="card__body">
          <div class="grid gap-4 lg:grid-cols-4">
            <div class="lg:col-span-2">
              <?php component('search-input', [
                'id'          => 'feedback-search',
                'name'        => 'feedback_search',
                'label'       => '',
                'placeholder' => 'Search by order, customer, or studio',
              ]); ?>
            </div>
            <div>
              <?php component('select', [
                'id'      => 'feedback-status-filter',
                'name'    => 'feedback_status',
                'label'   => '',
                'value'   => '',
                'options' => [
                  ['label' => 'Feedback Status', 'value' => '', 'disabled' => true],
                  ['label' => 'Pending', 'value' => 'pending'],
                  ['label' => 'In Progress', 'value' => 'in_progress'],
                  ['label' => 'Complete', 'value' => 'complete'],
                ],
              ]); ?>
            </div>
            <div>
              <?php component('select', [
                'id'      => 'feedback-rating-filter',
                'name'    => 'feedback_rating',
                'label'   => '',
                'value'   => '',
                'options' => [
                  ['label' => 'Rating Band', 'value' => '', 'disabled' => true],
                  ['label' => '5.0 - 4.5', 'value' => 'high'],
                  ['label' => '4.4 - 4.0', 'value' => 'mid'],
                  ['label' => '< 4.0', 'value' => 'low'],
                ],
              ]); ?>
            </div>
          </div>
        </div>
      </article>

      <article class="card" aria-label="Feedback queue table">
        <div class="card__table">
          <?php component('table', [
            'class'   => 'table--comfortable',
            'headers' => [
              'Order',
              'Session Date',
              'Studio',
              'Customer',
              ['label' => 'Rating', 'align' => 'right'],
              ['label' => 'Feedback', 'align' => 'right'],
              ['label' => 'Profile', 'align' => 'right'],
              ['label' => 'SLA', 'align' => 'right'],
              ['label' => 'Action', 'align' => 'right'],
            ],
            'rows' => $rows,
          ]); ?>
        </div>
      </article>

      <article class="card" aria-label="Feedback insights summary">
        <div class="card__body">
          <div class="grid gap-6 lg:grid-cols-3">
            <div>
              <h3 class="card__title">Rating Distribution</h3>
              <div class="mt-3 space-y-3">
                <div class="flex items-center gap-3">
                  <span class="type-meta w-12">5★</span>
                  <div class="h-2 flex-1 rounded bg-gray-100">
                    <div class="h-2 w-[62%] rounded bg-emerald-500"></div>
                  </div>
                  <span class="type-meta w-10 text-right">62%</span>
                </div>
                <div class="flex items-center gap-3">
                  <span class="type-meta w-12">4★</span>
                  <div class="h-2 flex-1 rounded bg-gray-100">
                    <div class="h-2 w-[24%] rounded bg-blue-500"></div>
                  </div>
                  <span class="type-meta w-10 text-right">24%</span>
                </div>
                <div class="flex items-center gap-3">
                  <span class="type-meta w-12">3★</span>
                  <div class="h-2 flex-1 rounded bg-gray-100">
                    <div class="h-2 w-[10%] rounded bg-amber-500"></div>
                  </div>
                  <span class="type-meta w-10 text-right">10%</span>
                </div>
                <div class="flex items-center gap-3">
                  <span class="type-meta w-12">1-2★</span>
                  <div class="h-2 flex-1 rounded bg-gray-100">
                    <div class="h-2 w-[4%] rounded bg-red-500"></div>
                  </div>
                  <span class="type-meta w-10 text-right">4%</span>
                </div>
              </div>
            </div>

            <div>
              <h3 class="card__title">Top Issue Tags</h3>
              <div class="mt-3 flex flex-wrap gap-2">
                <?php component('badge', ['label' => 'Turnaround Delay', 'mode' => 'warning']); ?>
                <?php component('badge', ['label' => 'Price Clarification', 'mode' => 'info']); ?>
                <?php component('badge', ['label' => 'Retouch Request', 'mode' => 'neutral']); ?>
                <?php component('badge', ['label' => 'Communication', 'mode' => 'neutral']); ?>
              </div>
            </div>

            <div>
              <h3 class="card__title">Needs Attention</h3>
              <ul class="mt-3 list list--comfortable">
                <li class="list__item">
                  <div class="list__main">
                    <p class="list__title">14 overdue feedback tasks</p>
                    <p class="list__meta">Older than 48 hours</p>
                  </div>
                </li>
                <li class="list__item">
                  <div class="list__main">
                    <p class="list__title">9 low-rating sessions</p>
                    <p class="list__meta">Rating below 4.0</p>
                  </div>
                </li>
                <li class="list__item">
                  <div class="list__main">
                    <p class="list__title">22 incomplete profiles</p>
                    <p class="list__meta">Missing occupation or interest data</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </article>
    </section>
<?php layout('app-end'); ?>
