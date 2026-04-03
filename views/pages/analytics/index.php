<?php

$page_title   = 'Analytics Overview';
$page_current = 'analytics-overview';

$menu_items = build_main_menu_items();

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$date_range = '05 Mar ~ 03 Apr';

$metric_cards = [
  [
    'title'      => 'Pageviews',
    'value'      => '984',
    'trend'      => '+12.4%',
    'trend_mode' => 'positive',
    'note'       => 'vs previous 30 days',
    'icon_name'  => 'eye',
  ],
  [
    'title'      => 'Unique Visitors',
    'value'      => '542',
    'trend'      => '+8.1%',
    'trend_mode' => 'positive',
    'note'       => 'vs previous 30 days',
    'icon_name'  => 'users',
  ],
  [
    'title'      => 'Sessions',
    'value'      => '614',
    'trend'      => '+4.9%',
    'trend_mode' => 'positive',
    'note'       => 'vs previous 30 days',
    'icon_name'  => 'activity',
  ],
  [
    'title'      => 'Clicks',
    'value'      => '315',
    'trend'      => '+6.3%',
    'trend_mode' => 'positive',
    'note'       => 'vs previous 30 days',
    'icon_name'  => 'mouse-pointer-click',
  ],
];

$top_pages_headers = [
  ['label' => 'Page', 'align' => 'left'],
  ['label' => 'Pageviews', 'align' => 'right'],
  ['label' => 'Visitors', 'align' => 'right'],
];

$top_pages_rows = [
  ['cells' => [['primary' => 'Pilih Tema Anda - TheCameraGuyStudio', 'secondary' => '/'], ['value' => '685', 'align' => 'right'], ['value' => '506', 'align' => 'right']]],
  ['cells' => [['primary' => 'Serambi Raya | Tempahan Studio - TheCameraGuyStudio', 'secondary' => '/store/booking/form/SR26'], ['value' => '179', 'align' => 'right'], ['value' => '114', 'align' => 'right']]],
  ['cells' => [['primary' => 'Raya Kasih | Tempahan Studio - TheCameraGuyStudio', 'secondary' => '/store/booking/form/RK26'], ['value' => '47', 'align' => 'right'], ['value' => '40', 'align' => 'right']]],
  ['cells' => [['primary' => 'Laman Raya | Tempahan Studio - TheCameraGuyStudio', 'secondary' => '/store/booking/form/LR26'], ['value' => '34', 'align' => 'right'], ['value' => '28', 'align' => 'right']]],
  ['cells' => [['primary' => 'Raya Indah | Tempahan Studio - TheCameraGuyStudio', 'secondary' => '/store/booking/form/RI26'], ['value' => '11', 'align' => 'right'], ['value' => '9', 'align' => 'right']]],
  ['cells' => [['primary' => 'Something Went Wrong - TheCameraGuyStudio', 'secondary' => '/app/auth/login-post'], ['value' => '6', 'align' => 'right'], ['value' => '3', 'align' => 'right']]],
  ['cells' => [['primary' => 'Pilih Tema Anda - TheCameraGuyStudio', 'secondary' => '/store'], ['value' => '4', 'align' => 'right'], ['value' => '4', 'align' => 'right']]],
  ['cells' => [['primary' => 'Photography Session Experience Feedback - TheCameraGuyStudio', 'secondary' => '/store/order-feedback/2369ae08-060b-4807-93db-8cd334d1649d'], ['value' => '3', 'align' => 'right'], ['value' => '1', 'align' => 'right']]],
  ['cells' => [['primary' => 'Profile Update - TheCameraGuyStudio', 'secondary' => '/store/customer-profile/54db7128-2281-4fca-9ddd-9aff1d313d1e'], ['value' => '2', 'align' => 'right'], ['value' => '1', 'align' => 'right']]],
  ['cells' => [['primary' => '404 - Page Not Found - TheCameraGuyStudio', 'secondary' => '/login'], ['value' => '2', 'align' => 'right'], ['value' => '1', 'align' => 'right']]],
];

$top_click_headers = [
  ['label' => 'Label', 'align' => 'left'],
  ['label' => 'Clicks', 'align' => 'right'],
];

$top_click_rows = [
  ['cells' => [['value' => '/store/booking/form/SR26'], ['value' => '145', 'align' => 'right']]],
  ['cells' => [['value' => '/'], ['value' => '39', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form/RK26'], ['value' => '37', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form/LR26'], ['value' => '27', 'align' => 'right']]],
  ['cells' => [['value' => '/ul'], ['value' => '16', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form-post/SR26'], ['value' => '15', 'align' => 'right']]],
  ['cells' => [['value' => '/sitemap.xml'], ['value' => '13', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form/RI26'], ['value' => '10', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form-post/RK26'], ['value' => '5', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form-post/LR26'], ['value' => '3', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form-post/RI26'], ['value' => '3', 'align' => 'right']]],
  ['cells' => [['value' => '/store/order-feedback/2369ae08-060b-4807-93db-8cd334d1649d'], ['value' => '2', 'align' => 'right']]],
  ['cells' => [['value' => '/store/customer-profile/54db7128-2281-4fca-9ddd-9aff1d313d1e'], ['value' => '2', 'align' => 'right']]],
  ['cells' => [['value' => '/store/booking/form/PK26'], ['value' => '2', 'align' => 'right']]],
  ['cells' => [['value' => '/privacy-policy'], ['value' => '1', 'align' => 'right']]],
];

$top_referrers_headers = [
  ['label' => 'Source', 'align' => 'left'],
  ['label' => 'Sessions', 'align' => 'right'],
];

$top_referrers_rows = [
  ['cells' => [['primary' => 'l.instagram.com', 'secondary' => 'utm'], ['value' => '60', 'align' => 'right']]],
  ['cells' => [['primary' => 'm.facebook.com', 'secondary' => 'utm'], ['value' => '53', 'align' => 'right']]],
  ['cells' => [['primary' => 'l.instagram.com', 'secondary' => 'social'], ['value' => '18', 'align' => 'right']]],
  ['cells' => [['primary' => 'm.facebook.com', 'secondary' => 'social'], ['value' => '18', 'align' => 'right']]],
  ['cells' => [['primary' => 'google.com', 'secondary' => 'referral'], ['value' => '17', 'align' => 'right']]],
];

$top_social_headers = [
  ['label' => 'Network', 'align' => 'left'],
  ['label' => 'Sessions', 'align' => 'right'],
];

$top_social_rows = [
  ['cells' => [['value' => 'Facebook'], ['value' => '42', 'align' => 'right']]],
  ['cells' => [['value' => 'Instagram'], ['value' => '22', 'align' => 'right']]],
];

$top_campaigns_headers = [
  ['label' => 'Campaign', 'align' => 'left'],
  ['label' => 'Pageviews', 'align' => 'right'],
];

$top_campaigns_rows = [
  ['cells' => [['primary' => 'IG-AD-RAYA26', 'secondary' => 'IG-SOCIAL / instagram'], ['value' => '118', 'align' => 'right']]],
  ['cells' => [['primary' => 'FB-AD-RAYA26', 'secondary' => '120243728270780045 / facebook'], ['value' => '71', 'align' => 'right']]],
];

$activity_tabs = $capture('tabs', [
  'attributes' => [
    'class' => 'w-auto',
  ],
  'items' => [
    ['label' => '1 hour', 'href' => '#', 'active' => true],
    ['label' => '6 hour', 'href' => '#'],
    ['label' => '1 day', 'href' => '#'],
  ],
]);

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<section class="space-y-6">
  <section aria-label="Analytics page header">
    <?php
    component('page-header', [
      'title'       => 'Analytics Overview',
      'description' => 'Enhanced layout for traffic quality, acquisition mix, and click intent.',
    ]);
    ?>
  </section>

  <section aria-label="Analytics controls">
    <div class="inline-flex w-full flex-wrap items-end gap-3">
      <div class="w-52">
        <?php
        component('input', [
          'id'    => 'analytics-enhanced-date-from',
          'name'  => 'analytics_enhanced_date_from',
          'label' => 'Date From',
          'type'  => 'date',
          'value' => '2026-03-05',
        ]);
        ?>
      </div>
      <div class="w-52">
        <?php
        component('input', [
          'id'    => 'analytics-enhanced-date-to',
          'name'  => 'analytics_enhanced_date_to',
          'label' => 'Date To',
          'type'  => 'date',
          'value' => '2026-04-03',
        ]);
        ?>
      </div>
      <div class="w-40">
        <?= $capture('button', ['label' => 'Apply Filter', 'variant' => 'primary']) ?>
      </div>
      <div class="ml-auto">
        <?= $capture('button', ['label' => 'Export CSV', 'icon_name' => 'download-2-line']) ?>
      </div>
    </div>
  </section>

  <section class="grid gap-4 xl:grid-cols-2" aria-label="Recent activity and metric cards">
    <article class="card h-full">
      <header class="card__head flex items-center justify-between gap-3">
        <div>
          <h2 class="card__title">Recent Activity</h2>
          <p class="card__description">Trends for visitors, sessions, clicks.</p>
        </div>
        <div class="shrink-0">
          <?= $activity_tabs ?>
        </div>
      </header>
      <div class="card__body flex-1">
        <div class="flex h-full min-h-64 items-center justify-center rounded-md border border-gray-200 bg-gray-50 text-muted">
          Graph Placeholder
        </div>
      </div>
    </article>

    <div class="grid h-full gap-4 sm:grid-cols-2">
      <?php foreach ($metric_cards as $metric_card): ?>
        <?php component('card-metric', $metric_card); ?>
      <?php endforeach; ?>
    </div>
  </section>

  <section aria-label="Traffic quality section">
    <div class="grid gap-4 xl:grid-cols-2">
      <article class="card">
        <header class="card__head">
          <h3 class="card__title">Top Pages</h3>
          <p class="card__description">Highest viewed landing and booking pages in selected range.</p>
          <p class="card__description"><?= e($date_range) ?></p>
        </header>
        <div class="card__table">
          <?php component('table', ['headers' => $top_pages_headers, 'rows' => $top_pages_rows]); ?>
        </div>
      </article>

      <article class="card">
        <header class="card__head">
          <h3 class="card__title">Top Click Events</h3>
          <p class="card__description">Most frequent click destinations tracked across key flows.</p>
          <p class="card__description"><?= e($date_range) ?></p>
        </header>
        <div class="card__table">
          <?php component('table', ['headers' => $top_click_headers, 'rows' => $top_click_rows]); ?>
        </div>
      </article>
    </div>
  </section>

  <section aria-label="Acquisition mix section">
    <div class="grid items-start gap-4 xl:grid-cols-3">
      <article class="card">
        <header class="card__head">
          <h3 class="card__title">Top Referrers</h3>
          <p class="card__description"><?= e($date_range) ?></p>
        </header>
        <div class="card__table">
          <?php component('table', ['headers' => $top_referrers_headers, 'rows' => $top_referrers_rows]); ?>
        </div>
      </article>

      <article class="card">
        <header class="card__head">
          <h3 class="card__title">Top Social Traffic</h3>
          <p class="card__description"><?= e($date_range) ?></p>
        </header>
        <div class="card__table">
          <?php component('table', ['headers' => $top_social_headers, 'rows' => $top_social_rows]); ?>
        </div>
      </article>

      <article class="card">
        <header class="card__head">
          <h3 class="card__title">Top Campaigns</h3>
          <p class="card__description"><?= e($date_range) ?></p>
        </header>
        <div class="card__table">
          <?php component('table', ['headers' => $top_campaigns_headers, 'rows' => $top_campaigns_rows]); ?>
        </div>
      </article>
    </div>
  </section>
</section>
<?php layout('app-end'); ?>
