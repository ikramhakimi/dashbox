<?php

$page_title   = 'Sales Overview';
$page_current = 'sales';

$menu_items = build_main_menu_items();

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$sales_overview = [
  [
    'label'  => 'Sales Year',
    'value'  => 'RM 1,248,600',
    'meta'   => '+14.8% vs 2025',
    'tone'   => 'positive',
  ],
  [
    'label'  => 'Sales Month',
    'value'  => 'RM 128,400',
    'meta'   => '+9.2% vs Mar 2026',
    'tone'   => 'info',
  ],
  [
    'label'  => 'Sales Day',
    'value'  => 'RM 6,420',
    'meta'   => '38 paid orders today',
    'tone'   => 'warning',
  ],
];

$performance_metrics = [
  [
    'label' => 'Actual Sales',
    'value' => 'RM 128,400',
    'note'  => 'Month-to-date',
  ],
  [
    'label' => 'Target Sales',
    'value' => 'RM 150,000',
    'note'  => 'April 2026 target',
  ],
  [
    'label' => 'Achievement',
    'value' => '85.6%',
    'note'  => 'On track',
  ],
  [
    'label' => 'Remaining Target',
    'value' => 'RM 21,600',
    'note'  => 'Need by month end',
  ],
  [
    'label' => 'Daily Sales Target',
    'value' => 'RM 5,000',
    'note'  => 'Average per day',
  ],
];

$sales_chart_labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'];
$sales_chart_sets   = [
  [
    'label' => 'Actual Sales',
    'data'  => [112000, 126500, 119400, 128400, 134200, 138000, 142600],
    'fill'  => true,
  ],
  [
    'label' => 'Target Sales',
    'data'  => [110000, 118000, 122000, 130000, 136000, 140000, 145000],
    'fill'  => false,
  ],
];

$weekly_chart_labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
$weekly_chart_sets   = [
  [
    'label' => 'This Week',
    'data'  => [4200, 5100, 4800, 5900, 6200, 4400, 5200],
    'fill'  => false,
  ],
  [
    'label' => 'Last Week',
    'data'  => [3800, 4700, 4600, 5200, 5600, 4100, 4900],
    'fill'  => false,
  ],
];

$sales_search = $capture('search-input', [
  'id'          => 'sales-overview-search',
  'name'        => 'sales_overview_search',
  'label'       => '',
  'placeholder' => 'Find by customer, order, or package',
]);

$range_filter = $capture('select', [
  'id'      => 'sales-overview-range',
  'name'    => 'sales_overview_range',
  'label'   => '',
  'value'   => 'this_month',
  'options' => [
    ['label' => 'Today', 'value' => 'today'],
    ['label' => 'This Week', 'value' => 'this_week'],
    ['label' => 'This Month', 'value' => 'this_month'],
    ['label' => 'This Quarter', 'value' => 'this_quarter'],
  ],
]);

$channel_filter = $capture('select', [
  'id'      => 'sales-overview-channel',
  'name'    => 'sales_overview_channel',
  'label'   => '',
  'value'   => 'all',
  'options' => [
    ['label' => 'All Channels', 'value' => 'all'],
    ['label' => 'Website', 'value' => 'website'],
    ['label' => 'Walk-in', 'value' => 'walk_in'],
    ['label' => 'WhatsApp', 'value' => 'whatsapp'],
  ],
]);

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <div class="card__head">
      <?php
      component('page-header', [
        'title'       => 'Sales Overview',
        'description' => 'Dashboard for sales metrics and target tracking only.',
      ]);
      ?>
      </div>

      <div class="card__body inline-flex flex-wrap items-end gap-3" aria-label="Sales overview filters">
        <div class="w-80">
          <?= $sales_search ?>
        </div>
        <div class="w-48">
          <?= $range_filter ?>
        </div>
        <div class="w-48">
          <?= $channel_filter ?>
        </div>
      </div>

      <section class="card__body grid gap-4 lg:grid-cols-3" aria-label="Sales overview metrics">
        <?php foreach ($sales_overview as $metric): ?>
          <article class="card">
            <div class="card__body space-y-2">
              <p class="type-meta text-muted"><?= e((string) $metric['label']) ?></p>
              <p class="type-h2"><?= e((string) $metric['value']) ?></p>
              <div>
                <?php
                component('badge', [
                  'label' => (string) $metric['meta'],
                  'mode'  => (string) $metric['tone'],
                ]);
                ?>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </section>

      <section class="card__body grid gap-6 xl:grid-cols-2" aria-label="Sales chart placeholders">
        <article class="card">
          <header class="card__head">
            <h2 class="card__title">Sales Performance</h2>
            <p class="card__description type-meta text-muted">Monthly trend</p>
          </header>

          <div class="card__body">
          <?php
          component('chart', [
            'id'          => 'sales-performance-chart',
            'title'       => 'Sales Performance',
            'subtitle'    => 'Monthly trend',
            'type'        => 'line',
            'labels'      => $sales_chart_labels,
            'datasets'    => $sales_chart_sets,
            'y_prefix'    => 'RM ',
            'show_header' => false,
          ]);
          ?>
          </div>
        </article>

        <article class="card">
          <header class="card__head">
            <h2 class="card__title">Weekly Sales Performance</h2>
            <p class="card__description type-meta text-muted">Current week vs previous week</p>
          </header>

          <div class="card__body">
          <?php
          component('chart', [
            'id'          => 'sales-weekly-performance-chart',
            'title'       => 'Weekly Sales Performance',
            'subtitle'    => 'Current week vs previous week',
            'type'        => 'bar',
            'labels'      => $weekly_chart_labels,
            'datasets'    => $weekly_chart_sets,
            'y_prefix'    => 'RM ',
            'show_header' => false,
          ]);
          ?>
          </div>
        </article>
      </section>

      <article class="card__body" aria-label="Sales performance metrics">
        <header class="card__head">
          <h2 class="card__title">Sales Performance</h2>
          <p class="card__description type-meta text-muted">
            Actual, target, achievement, and remaining target snapshot.
          </p>
        </header>

        <div class="card__body">
          <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-5">
          <?php foreach ($performance_metrics as $metric): ?>
            <section class="rounded-md border border-gray-200 bg-gray-50 p-4">
              <p class="type-meta text-muted"><?= e((string) $metric['label']) ?></p>
              <p class="mt-1 type-h3"><?= e((string) $metric['value']) ?></p>
              <p class="mt-1 type-meta text-muted"><?= e((string) $metric['note']) ?></p>
            </section>
          <?php endforeach; ?>
          </div>
        </div>
      </article>
    </section>
<?php layout('app-end'); ?>
