<?php

$page_title   = 'Nuggets';
$page_current = 'nuggets';

$menu_items = build_main_menu_items('', $page_current);

$nugget_cards = [
  [
    'title'     => 'Component Coverage',
    'value'     => 'Comprehensive',
    'trend'     => '+Growing',
    'note'      => 'Core UI families represented',
    'icon_name' => 'layout-grid',
  ],
  [
    'title'     => 'Composition Depth',
    'value'     => 'Flexible',
    'trend'     => '+Reusable',
    'note'      => 'Cards, forms, states, and actions',
    'icon_name' => 'layers',
  ],
  [
    'title'     => 'Presentation Readiness',
    'value'     => 'High',
    'trend'     => '+Improving',
    'note'      => 'Suitable for UI review and planning',
    'icon_name' => 'code',
  ],
];

$system_icons_used = [
  'users',
  'activity',
  'plus',
  'search',
  'eye',
  'trash',
  'star',
  'ticket',
  'arrow-up-tray',
  'tickets',
  'magnifying-glass',
  'pulse',
  'layout-grid',
  'layers',
  'currency-dollar',
  'code',
];

$nugget_icon_color_classes = [
  'icon-dark',
  'icon-default',
  'icon-muted',
  'icon-primary',
  'icon-secondary',
  'icon-positive',
  'icon-negative',
];

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="mx-auto max-w-7xl space-y-6">
      <header class="mb-8 border-b border-gray-200 pb-6">
        <p class="type-caption type-semibold">UI Patterns</p>
        <h1 class="mt-2 type-h1">Nuggets</h1>
        <p class="mt-2 max-w-3xl type-body">
          Bird's-eye UI overview for quick visual scanning. Detailed implementation documentation
          is maintained in UI Components.
        </p>
      </header>

      <section class="divide-y divide-gray-100" aria-label="Nuggets pattern page">

        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <div class="grid gap-4 md:grid-cols-3">
            <?php foreach ($nugget_cards as $nugget_card): ?>
              <?php component('card-metric', $nugget_card); ?>
            <?php endforeach; ?>
          </div>
          
          <div class="grid gap-4 md:grid-cols-3">
            <div class="space-y-4">
              <article class="card nugget-color-system">
                <header class="card__head">
                  <h3 class="card__title">Color System Overview</h3>
                  <p class="card__description">
                    Design-system color utilities compiled into six grouped tiles.
                  </p>
                </header>
                <div class="card__body">
                  <div class="grid grid-cols-1 gap-3">
                    <section>
                      <h4 class="text-xs font-semibold uppercase tracking-wide text-muted">Surface</h4>
                      <ul class="mt-2 grid grid-cols-5 gap-2">
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="card-bg (white)" class="w-full aspect-square rounded-md bg-white ring-1 ring-gray-200"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="card-border" class="w-full aspect-square rounded-md bg-gray-200"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="divider / table-border" class="w-full aspect-square rounded-md bg-gray-100"></div></li>
                      </ul>
                    </section>

                    <section>
                      <h4 class="text-xs font-semibold uppercase tracking-wide text-muted">Icon</h4>
                      <ul class="mt-2 grid grid-cols-5 gap-2">
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="icon-dark" class="w-full aspect-square rounded-md bg-current icon-dark"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="icon-default" class="w-full aspect-square rounded-md bg-current icon-default"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="icon-muted" class="w-full aspect-square rounded-md bg-current icon-muted"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="icon-primary" class="w-full aspect-square rounded-md bg-current icon-primary"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="icon-secondary" class="w-full aspect-square rounded-md bg-current icon-secondary"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="icon-positive" class="w-full aspect-square rounded-md bg-current icon-positive"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="icon-negative" class="w-full aspect-square rounded-md bg-current icon-negative"></div></li>
                      </ul>
                    </section>

                    <section>
                      <h4 class="text-xs font-semibold uppercase tracking-wide text-muted">Brand</h4>
                      <ul class="mt-2 grid grid-cols-5 gap-2">
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-primary" class="w-full aspect-square rounded-md bg-current text-primary"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-link" class="w-full aspect-square rounded-md bg-current text-link"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-link-hover" class="w-full aspect-square rounded-md bg-current text-link-hover"></div></li>
                      </ul>
                    </section>

                    <section>
                      <h4 class="text-xs font-semibold uppercase tracking-wide text-muted">Neutral</h4>
                      <ul class="mt-2 grid grid-cols-5 gap-2">
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-dark" class="w-full aspect-square rounded-md bg-current text-dark"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-body" class="w-full aspect-square rounded-md bg-current text-body"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-secondary" class="w-full aspect-square rounded-md bg-current text-secondary"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-muted" class="w-full aspect-square rounded-md bg-current text-muted"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-disabled" class="w-full aspect-square rounded-md bg-current text-disabled"></div></li>
                      </ul>
                    </section>

                    <section>
                      <h4 class="text-xs font-semibold uppercase tracking-wide text-muted">Semantic</h4>
                      <ul class="mt-2 grid grid-cols-5 gap-2">
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-success" class="w-full aspect-square rounded-md bg-current text-success"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-info" class="w-full aspect-square rounded-md bg-current text-info"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-info-strong" class="w-full aspect-square rounded-md bg-current text-info-strong"></div></li>
                      </ul>
                    </section>

                    <section>
                      <h4 class="text-xs font-semibold uppercase tracking-wide text-muted">Warning / Danger</h4>
                      <ul class="mt-2 grid grid-cols-5 gap-2">
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-warning" class="w-full aspect-square rounded-md bg-current text-warning"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-on-warning" class="w-full aspect-square rounded-md bg-current text-on-warning ring-1 ring-amber-700/40"></div></li>
                        <li class="flex items-center gap-2 text-sm"><div data-tooltip="text-danger" class="w-full aspect-square rounded-md bg-current text-danger"></div></li>
                      </ul>
                    </section>
                  </div>
                </div>
              </article>

              <article class="card nugget-typography">
                <div class="card__body flex flex-col gap-3">
                  <h2 class="type-h2">Typography sets the pace before color does.</h2>
                  <p class="type-body">
                    In a photography studio dashboard, type hierarchy is what helps teams move fast under pressure.
                    When heading, body, and supporting text are clearly separated, coordinators can scan client details
                    and booking updates without second-guessing what matters most.
                  </p>
                  <p class="type-body">
                    This card is meant to preview rhythm across key text styles before a screen goes live. Use it as a
                    quick check for readability, emphasis, and whether long-form content still feels calm on dense pages.
                  </p>
                  <p class="type-meta">
                    Pair strong headlines with neutral body text, then reserve meta styles for status hints, timestamps,
                    and helper notes.
                  </p>

                  <h3 class="type-h3">Numbered flow for copy hierarchy checks</h3>
                  <ol class="list-decimal space-y-1 pl-5">
                    <li class="type-body">Start with one clear headline that states intent immediately.</li>
                    <li class="type-body">Use body copy to explain context and expected action.</li>
                    <li class="type-body">Use meta text for constraints, caveats, or non-blocking details.</li>
                  </ol>

                  <h3 class="type-h3">Disc list for feature-style messaging</h3>
                  <ul class="list-disc space-y-1 pl-5">
                    <li class="type-body">Consistent line-height improves scan speed in operational screens.</li>
                    <li class="type-body">Predictable spacing reduces cognitive load between sections.</li>
                    <li class="type-body">Clear contrast keeps supporting text readable without visual noise.</li>
                  </ul>
                </div>
                <footer class="card__actions">
                  <button class="button w-full" type="button">Sample Button</button>
                </footer>
              </article>

              <article class="card nugget-invoice">
                <header class="card__head">
                  <div class="flex items-start justify-between gap-3">
                    <div>
                      <h3 class="card__title">Invoice #INV-2847</h3>
                      <p class="card__description">Due March 30, 2026</p>
                    </div>
                    <?php component('badge', ['label' => 'Pending', 'mode' => 'warning']); ?>
                  </div>
                </header>
                <div class="card__body">
                  <div class="table__container overflow-x-auto">
                    <table class="table">
                      <caption class="table__caption">Invoice #INV-2847 breakdown</caption>
                      <thead class="table__head">
                        <tr class="table__row table__row--head">
                          <th class="table__cell table__cell--head">Item</th>
                          <th class="table__cell table__cell--head table__cell--right">Amount</th>
                        </tr>
                      </thead>
                      <tbody class="table__body">
                        <tr class="table__row">
                          <td class="table__cell">Design System License</td>
                          <td class="table__cell table__cell--right">$499.00</td>
                        </tr>
                        <tr class="table__row">
                          <td class="table__cell">Priority Support</td>
                          <td class="table__cell table__cell--right">$1,188.00</td>
                        </tr>
                        <tr class="table__row">
                          <td class="table__cell">Custom Components</td>
                          <td class="table__cell table__cell--right">$750.00</td>
                        </tr>
                        <tr class="table__row">
                          <td class="table__cell table__cell--right text-gray-600">Subtotal</td>
                          <td class="table__cell table__cell--right">$2,437.00</td>
                        </tr>
                        <tr class="table__row">
                          <td class="table__cell table__cell--right text-gray-600">Tax</td>
                          <td class="table__cell table__cell--right">$0.00</td>
                        </tr>
                        <tr class="table__row font-semibold">
                          <td class="table__cell table__cell--right">Total Due</td>
                          <td class="table__cell table__cell--right">$2,437.00</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <footer class="card__actions flex items-center justify-between gap-2">
                  <button class="button" type="button">Download PDF</button>
                  <button class="button button--primary" type="button">Pay Now</button>
                </footer>
              </article>

            </div>

            <div class="space-y-4">
              <article class="card nugget-icons">
                <div class="card__body">
                  <ul class="grid grid-cols-8 gap-2">
                    <?php foreach ($system_icons_used as $icon_index => $system_icon_name): ?>
                      <?php
                      $icon_color_class = $nugget_icon_color_classes[$icon_index % count($nugget_icon_color_classes)];
                      ?>
                      <li>
                        <div
                          class="flex aspect-square items-center justify-center rounded-md border border-gray-100 <?= e($icon_color_class) ?>"
                          data-tooltip="<?= e($system_icon_name) ?>"
                        >
                          <?php
                          component('icon', [
                            'icon_name' => $system_icon_name,
                            'icon_size' => 16,
                          ]);
                          ?>
                        </div>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </article>

              <article class="card nugget-shipping-address">
                <header class="card__head">
                  <h3 class="card__title">Shipping Address</h3>
                  <p class="card__description">Where should we deliver?</p>
                </header>
                <div class="card__body">
                  <form class="space-y-3" action="#" method="post">
                    <?php component('input', [
                      'id'          => 'shipping-street',
                      'name'        => 'shipping_street',
                      'label'       => 'Street address',
                      'placeholder' => '123 Main Street',
                    ]); ?>

                    <?php component('input', [
                      'id'          => 'shipping-suite',
                      'name'        => 'shipping_suite',
                      'label'       => 'Apt / Suite',
                      'placeholder' => 'Unit 12-08',
                    ]); ?>

                    <div class="grid grid-cols-2 gap-3">
                      <?php component('input', [
                        'id'          => 'shipping-city',
                        'name'        => 'shipping_city',
                        'label'       => 'City',
                        'placeholder' => 'Petaling Jaya',
                      ]); ?>

                      <?php component('select', [
                        'id'      => 'shipping-state',
                        'name'    => 'shipping_state',
                        'label'   => 'State',
                        'value'   => '',
                        'options' => [
                          ['label' => 'Select state',   'value' => '', 'disabled' => true],
                          ['label' => 'Selangor',       'value' => 'selangor'],
                          ['label' => 'Kuala Lumpur',   'value' => 'kuala-lumpur'],
                          ['label' => 'Penang',         'value' => 'penang'],
                          ['label' => 'Johor',          'value' => 'johor'],
                          ['label' => 'California',     'value' => 'california'],
                        ],
                      ]); ?>

                      <?php component('input', [
                        'id'          => 'shipping-zipcode',
                        'name'        => 'shipping_zipcode',
                        'label'       => 'Zipcode',
                        'placeholder' => '47800',
                      ]); ?>

                      <?php component('select', [
                        'id'      => 'shipping-country',
                        'name'    => 'shipping_country',
                        'label'   => 'Country',
                        'value'   => '',
                        'options' => [
                          ['label' => 'Select country', 'value' => '', 'disabled' => true],
                          ['label' => 'Malaysia',      'value' => 'my'],
                          ['label' => 'Singapore',     'value' => 'sg'],
                          ['label' => 'Indonesia',     'value' => 'id'],
                          ['label' => 'Thailand',      'value' => 'th'],
                          ['label' => 'United States', 'value' => 'us'],
                        ],
                      ]); ?>
                    </div>

                    <?php component('checkbox', [
                      'id'      => 'shipping-default',
                      'name'    => 'shipping_default',
                      'label'   => 'Save as default address',
                      'checked' => false,
                    ]); ?>
                  </form>
                </div>
                <footer class="card__actions flex items-center justify-between gap-2">
                  <button class="button" type="button">Cancel</button>
                  <button class="button button--primary" type="button">Save Address</button>
                </footer>
              </article>

              <article class="card nugget-package">
                <div class="card-media">
                  <div class="aspect-square w-full rounded-md bg-gray-50"></div>
                </div>
                <div class="card__body space-y-3">
                  <div class="flex items-start justify-between gap-3">
                    <div>
                      <h3 class="card__title">Starter Portrait Package</h3>
                      <p class="card__description">For personal profiles and portfolio updates.</p>
                    </div>
                    <?php component('badge', ['label' => 'Published', 'mode' => 'positive']); ?>
                  </div>
                  <p class="type-body">RM 480 · 60 minutes · 1 location</p>
                  <ul class="list-disc space-y-1 pl-5">
                    <li class="type-body">8 edited high-resolution photos</li>
                    <li class="type-body">2 outfit changes</li>
                    <li class="type-body">Online gallery delivery in 3 days</li>
                  </ul>
                </div>
                <footer class="card__actions flex items-center justify-between gap-2">
                  <button class="button" type="button">Preview Package</button>
                  <button class="button button--primary" type="button">Edit Package</button>
                </footer>
              </article>

              <article class="card nugget-studio-growth">
                <header class="card__head">
                  <h3 class="card__title">Grow faster with Studio Campaign Assistant</h3>
                  <p class="card__description">
                    Designed for photography studios to plan promotions, convert leads, and retain repeat clients.
                  </p>
                </header>
                <div class="card__body space-y-3">
                  <ul class="space-y-2">
                    <li class="flex items-start gap-3">
                      <div class="text-success leading-none">
                        <?php component('icon', ['icon_name' => 'circle-check', 'icon_size' => 16]); ?>
                      </div>
                      <span class="type-body">Launch seasonal portrait campaigns with ready-to-use messaging and offer angles.</span>
                    </li>
                    <li class="flex items-start gap-3">
                      <div class="text-success leading-none">
                        <?php component('icon', ['icon_name' => 'circle-check', 'icon_size' => 16]); ?>
                      </div>
                      <span class="type-body">Turn enquiries into confirmed sessions using follow-up flows for WhatsApp and email.</span>
                    </li>
                    <li class="flex items-start gap-3">
                      <div class="text-success leading-none">
                        <?php component('icon', ['icon_name' => 'circle-check', 'icon_size' => 16]); ?>
                      </div>
                      <div class="space-y-2">
                        <p class="type-body">
                          Recover slow months with upsell playbooks for albums, add-ons, and premium edits.
                        </p>
                        <?php component('badge', ['label' => 'Best for Growing Studios', 'mode' => 'info']); ?>
                      </div>
                    </li>
                  </ul>
                  <?php component('alert', [
                    'variant'   => 'info',
                    'show_icon' => true,
                    'description' => 'Studios on the Pro plan get campaign templates and retention scripts for the first 14 days.',
                  ]); ?>
                </div>
              </article>
            </div>

            <div class="space-y-4">
              <article class="card nugget-widget-sales-month">
                <div class="card__body space-y-3">
                  <div class="relative flex items-center gap-2">
                    <p class="type-caption">Sales this month</p>
                    <div class="card__icon absolute right-0 top-0">
                      <?php component('icon', ['icon_name' => 'currency-dollar', 'icon_size' => 24]); ?>
                    </div>
                  </div>
                  <p class="type-h2">RM 10,750</p>
                  <div class="flex items-center gap-2">
                    <?php component('badge', ['label' => '+9.4%', 'mode' => 'positive']); ?>
                    <p class="type-meta">monthly gross growth</p>
                  </div>
                </div>
              </article>

              <article class="card nugget-widget-revenue">
                <div class="card__body space-y-3">
                  <div class="flex items-center justify-between gap-2">
                    <p class="type-caption type-semibold">Revenue Mix</p>
                    <?php component('icon', ['icon_name' => 'currency-dollar', 'icon_size' => 16]); ?>
                  </div>

                  <div class="flex items-center gap-3">
                    <div
                      class="relative h-16 w-16 rounded-full"
                      style="background: conic-gradient(#059669 0 62%, #0ea5e9 62% 86%, #d1d5db 86% 100%);"
                    >
                      <div class="absolute inset-2 rounded-full bg-white"></div>
                      <div class="absolute inset-0 flex items-center justify-center">
                        <span class="type-meta">RM</span>
                      </div>
                    </div>
                    <div class="space-y-1">
                      <p class="type-meta">Total this month</p>
                      <p class="type-h3">RM 10,750</p>
                      <p class="type-meta">Portrait, event and add-on packages</p>
                    </div>
                  </div>

                  <div class="flex items-center gap-2">
                    <?php component('badge', ['label' => '+9.4%', 'mode' => 'positive']); ?>
                    <p class="type-meta">monthly gross growth</p>
                  </div>
                </div>
              </article>

              <article class="card nugget-widget-bookings">
                <div class="card__body space-y-3">
                  <div class="flex items-center justify-between gap-2">
                    <p class="type-caption type-semibold">Booking Channels</p>
                    <?php component('icon', ['icon_name' => 'calendar', 'icon_size' => 16]); ?>
                  </div>

                  <div class="space-y-2">
                    <div class="space-y-1">
                      <div class="flex items-center justify-between gap-2">
                        <p class="type-meta">Instagram DM</p>
                        <p class="type-meta">42%</p>
                      </div>
                      <div class="h-2 rounded-full bg-gray-100">
                        <div class="h-2 rounded-full bg-indigo-600" style="width: 42%"></div>
                      </div>
                    </div>

                    <div class="space-y-1">
                      <div class="flex items-center justify-between gap-2">
                        <p class="type-meta">Website Form</p>
                        <p class="type-meta">33%</p>
                      </div>
                      <div class="h-2 rounded-full bg-gray-100">
                        <div class="h-2 rounded-full bg-emerald-600" style="width: 33%"></div>
                      </div>
                    </div>

                    <div class="space-y-1">
                      <div class="flex items-center justify-between gap-2">
                        <p class="type-meta">Referrals</p>
                        <p class="type-meta">25%</p>
                      </div>
                      <div class="h-2 rounded-full bg-gray-100">
                        <div class="h-2 rounded-full bg-amber-600" style="width: 25%"></div>
                      </div>
                    </div>
                  </div>

                  <div class="flex items-center gap-2">
                    <?php component('badge', ['label' => '+6.2%', 'mode' => 'info']); ?>
                    <p class="type-meta">inbound leads this week</p>
                  </div>
                </div>
              </article>

              <article class="card nugget-widget-visitors">
                <header class="card__head">
                  <h3 class="card__title">Traffic channels</h3>
                  <p class="card__description">
                    Monthly desktop and mobile traffic for the last six months—compare volume and mix across platforms and devices at a glance.
                  </p>
                </header>
                <div class="card__body">
                  <?php component('chart', [
                    'id'              => 'nugget-traffic-desktop-mobile',
                    'show_header'     => false,
                    'type'            => 'bar',
                    'legend_position' => 'bottom',
                    'height'    => 'h-56',
                    'y_ticks_display' => false,
                    'labels'          => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    'datasets'        => [
                      [
                        'label'            => 'Desktop',
                        'data'             => [186, 305, 237, 73, 209, 214],
                        'border_color'     => 'rgb(199 210 254)',
                        'background_color' => 'rgb(199 210 254)',
                        'border_width'     => 1,
                        'border_radius'    => 8,
                        'border_skipped'   => 'bottom',
                      ],
                      [
                        'label'            => 'Mobile',
                        'data'             => [80, 200, 102, 190, 130, 140],
                        'border_color'     => 'rgb(99 102 241)',
                        'background_color' => 'rgb(99 102 241)',
                        'border_width'     => 1,
                        'border_radius'    => 8,
                        'border_skipped'   => 'bottom',
                      ],
                    ],
                  ]); ?>
                </div>

                <div class="card__body">
                  <div class="grid grid-cols-3 divide-x divide-gray-200 text-center">
                    <div class="px-3">
                      <p class="type-meta">Desktop</p>
                      <p class="type-h3 mt-1">1,224</p>
                    </div>
                    <div class="px-3">
                      <p class="type-meta">Mobile</p>
                      <p class="type-h3 mt-1">860</p>
                    </div>
                    <div class="px-3">
                      <p class="type-meta">Visitors</p>
                      <p class="type-h3 mt-1">2,084</p>
                    </div>
                  </div>
                </div>

                <div class="card__body">
                  <button class="button button--primary w-full" type="button">View Report</button>
                </div>
              </article>

              <article class="card nugget-invite-team">
                <header class="card__head">
                  <h3 class="card__title">Invite Team</h3>
                  <p class="card__description">Add members to your workspace</p>
                </header>
                <div class="card__body space-y-3">
                  <div class="grid grid-cols-3 gap-2">
                    <?php component('input', [
                      'id'          => 'invite-team-email-1',
                      'name'        => 'invite_team_email_1',
                      'placeholder' => 'email@team',
                      'type'        => 'email',
                      'class'       => 'col-span-2',
                    ]); ?>
                    <?php component('select', [
                      'id'      => 'invite-team-role-1',
                      'name'    => 'invite_team_role_1',
                      'value'   => 'admin',
                      'class'   => 'col-span-1',
                      'options' => [
                        ['label' => 'Admin', 'value' => 'admin'],
                        ['label' => 'Editor', 'value' => 'editor'],
                        ['label' => 'Viewer', 'value' => 'viewer'],
                      ],
                    ]); ?>
                  </div>

                  <div class="grid grid-cols-3 gap-2">
                    <?php component('input', [
                      'id'          => 'invite-team-email-2',
                      'name'        => 'invite_team_email_2',
                      'placeholder' => 'email@team',
                      'type'        => 'email',
                      'class'       => 'col-span-2',
                    ]); ?>
                    <?php component('select', [
                      'id'      => 'invite-team-role-2',
                      'name'    => 'invite_team_role_2',
                      'value'   => 'editor',
                      'class'   => 'col-span-1',
                      'options' => [
                        ['label' => 'Admin', 'value' => 'admin'],
                        ['label' => 'Editor', 'value' => 'editor'],
                        ['label' => 'Viewer', 'value' => 'viewer'],
                      ],
                    ]); ?>
                  </div>
                  <button class="button w-full" type="button">Add New</button>

                  <div class="mt-1 border-t border-gray-100 pt-3">
                    <?php component('input-group', [
                      'id'        => 'invite-team-link',
                      'name'      => 'invite_team_link',
                      'label'     => 'Or share invite link',
                      'value'     => 'https://app.co/invite/x8f2k',
                      'icon_name' => 'copy',
                      'icon_side' => 'right',
                      'readonly'  => true,
                    ]); ?>
                  </div>
                </div>
                <footer class="card__actions">
                  <button class="button button--primary w-full" type="button">Send Invites</button>
                </footer>
              </article>

              <article class="card nugget-multi-photo-upload">
                <header class="card__head">
                  <h3 class="card__title">Multi Photo Upload</h3>
                  <p class="card__description">Upload gallery images and keep them in your preferred order.</p>
                </header>
                <div class="card__body">
                  <?php component('dropzone', [
                    'id'               => 'nugget-multi-photo-upload',
                    'name'             => 'nugget_multi_photos[]',
                    'label'            => 'Gallery Photos',
                    'multiple'         => true,
                    'sortable'         => true,
                    'max_files'        => 12,
                    'accept'           => 'image/*',
                    'order_input_name' => 'nugget_multi_photos_order',
                    'help_text'        => 'Upload JPG, PNG, or WEBP files. Drag and drop to reorder.',
                  ]); ?>
                </div>
              </article>

              <article class="card nugget-empty-state">
                <header class="card__head">
                  <h3 class="card__title">Recent Albums</h3>
                  <p class="card__description">Empty-state preview for post-session delivery lists.</p>
                </header>
                <div class="card__body">
                  <?php component('empty-state', [
                    'icon_name'    => 'images',
                    'title'        => 'No albums yet',
                    'description'  => 'Create your first delivery album to start sharing photos with clients.',
                    'actions'      => [
                      [
                        'label'   => 'Create Album',
                        'variant' => 'primary',
                        'size'    => 'default',
                      ],
                    ],
                  ]); ?>
                </div>
              </article>

              <article class="card nugget-avatar-table-cell">
                <header class="card__head">
                  <h3 class="card__title">Studio Team Directory</h3>
                  <p class="card__description">Assigned team members for active studio operations.</p>
                </header>
                <div class="card__list">
                  <ul class="list">
                    <li class="list__item">
                      <div class="flex min-w-0 flex-1 items-center gap-3">
                        <?php component('avatar', [
                          'name' => 'Aisyah Rahman',
                          'src'  => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=200&q=80',
                          'size' => 'md',
                        ]); ?>
                        <div class="list__main">
                          <p class="list__title truncate">Aisyah Rahman</p>
                          <p class="list__meta truncate">aisyah@studio.co</p>
                        </div>
                      </div>
                      <div class="list__aside">
                        <?php component('badge', [
                          'label' => 'Editor',
                          'mode'  => 'info',
                        ]); ?>
                      </div>
                    </li>

                    <li class="list__item">
                      <div class="flex min-w-0 flex-1 items-center gap-3">
                        <?php component('avatar', [
                          'name' => 'Farid Salleh',
                          'src'  => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80',
                          'size' => 'md',
                        ]); ?>
                        <div class="list__main">
                          <p class="list__title truncate">Farid Salleh</p>
                          <p class="list__meta truncate">farid@studio.co</p>
                        </div>
                      </div>
                      <div class="list__aside">
                        <?php component('badge', [
                          'label' => 'Viewer',
                          'mode'  => 'neutral',
                        ]); ?>
                      </div>
                    </li>
                  </ul>
                </div>
              </article>

              <article class="card nugget-team-member-item">
                <header class="card__head">
                  <h3 class="card__title">Team Member Item</h3>
                  <p class="card__description">Avatar row with role, status, and quick actions.</p>
                </header>
                <div class="card__body">
                  <div class="flex items-center gap-3 rounded-md border border-gray-100 p-3">
                    <?php component('avatar', [
                      'name' => 'Nadia Sofia',
                      'src'  => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=200&q=80',
                      'size' => 'md',
                    ]); ?>
                    <div class="min-w-0 flex-1">
                      <p class="type-body truncate">Nadia Sofia</p>
                      <p class="type-meta truncate">Lead Photographer</p>
                    </div>
                    <?php component('badge', [
                      'label' => 'Online',
                      'mode'  => 'positive',
                    ]); ?>
                    <?php component('dropdown', [
                      'trigger_label'   => 'More',
                      'trigger_variant' => 'ghost',
                      'trigger_size'    => 'default',
                      'align'           => 'right',
                      'items'           => [
                        ['label' => 'View Profile', 'href' => '#'],
                        ['label' => 'Change Role', 'href' => '#'],
                        ['type' => 'divider'],
                        ['label' => 'Remove', 'href' => '#', 'kind' => 'danger'],
                      ],
                    ]); ?>
                  </div>
                </div>
              </article>

              <article class="card nugget-review-testimonial">
                <header class="card__head">
                  <h3 class="card__title">Review Testimonial</h3>
                  <p class="card__description">Avatar with rating, quote, and follow-up action.</p>
                </header>
                <div class="card__body space-y-3">
                  <div class="flex items-center gap-3">
                    <?php component('avatar', [
                      'name' => 'Hana Maisarah',
                      'src'  => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&w=200&q=80',
                      'size' => 'md',
                    ]); ?>
                    <div class="min-w-0">
                      <p class="type-body">Hana Maisarah</p>
                      <p class="type-meta">Family Portrait Session</p>
                    </div>
                  </div>

                  <div class="flex items-center gap-1 text-amber-600">
                    <?php component('icon', ['icon_name' => 'star', 'icon_size' => 16]); ?>
                    <?php component('icon', ['icon_name' => 'star', 'icon_size' => 16]); ?>
                    <?php component('icon', ['icon_name' => 'star', 'icon_size' => 16]); ?>
                    <?php component('icon', ['icon_name' => 'star', 'icon_size' => 16]); ?>
                    <?php component('icon', ['icon_name' => 'star', 'icon_size' => 16]); ?>
                  </div>

                  <p class="type-body">
                    The team was responsive, the studio setup was beautiful, and our gallery was delivered right on time.
                  </p>
                </div>
                <footer class="card__actions">
                  <button class="button button--primary w-full" type="button">Reply Review</button>
                </footer>
              </article>

              <article class="card nugget-list-items">
                <header class="card__head">
                  <h3 class="card__title">List Items</h3>
                  <p class="card__description">Standard list rhythm with default and comfortable density.</p>
                </header>

                <div class="card__body">
                  <p class="type-caption">Default</p>
                </div>
                <div class="card__list">
                  <ul class="list">
                    <li class="list__item">
                      <div class="list__main">
                        <p class="list__title">Edited wedding highlights</p>
                        <p class="list__meta">Delivered 2 hours ago</p>
                      </div>
                      <div class="list__aside">32 files</div>
                    </li>
                    <li class="list__item">
                      <div class="list__main">
                        <p class="list__title">Family studio album</p>
                        <p class="list__meta">Ready for client review</p>
                      </div>
                      <div class="list__aside">18 files</div>
                    </li>
                    <li class="list__item">
                      <div class="list__main">
                        <p class="list__title">Corporate headshots</p>
                        <p class="list__meta">Upload queued</p>
                      </div>
                      <div class="list__aside">11 files</div>
                    </li>
                  </ul>
                </div>

                <div class="card__body">
                  <p class="type-caption">Comfortable</p>
                </div>
                <div class="card__list">
                  <ul class="list list--comfortable">
                    <li class="list__item">
                      <div class="list__main">
                        <p class="list__title">Edited wedding highlights</p>
                        <p class="list__meta">Delivered 2 hours ago</p>
                      </div>
                      <div class="list__aside">32 files</div>
                    </li>
                    <li class="list__item">
                      <div class="list__main">
                        <p class="list__title">Family studio album</p>
                        <p class="list__meta">Ready for client review</p>
                      </div>
                      <div class="list__aside">18 files</div>
                    </li>
                    <li class="list__item">
                      <div class="list__main">
                        <p class="list__title">Corporate headshots</p>
                        <p class="list__meta">Upload queued</p>
                      </div>
                      <div class="list__aside">11 files</div>
                    </li>
                  </ul>
                </div>
              </article>
            </div>
          </div>
    
        </article>
      </section>
    </section>
<?php layout('app-end'); ?>
