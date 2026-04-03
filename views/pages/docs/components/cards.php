<?php

$page_title   = 'Card Component';
$page_current = 'cards';

$menu_items = build_main_menu_items($page_current);

$capture = static function (string $component_name, array $props): string {
  ob_start();
  component($component_name, $props);
  return (string) ob_get_clean();
};

$widget_samples = [
  [
    'title'     => 'New Signups',
    'value'     => '1,248',
    'trend'     => '+8.2%',
    'note'      => 'vs last month',
    'icon_name' => 'users',
  ],
  [
    'title'     => 'Open Tickets',
    'value'     => '38',
    'trend'     => '-6.1%',
    'note'      => 'faster resolution',
    'icon_name' => 'tickets',
  ],
  [
    'title'     => 'Revenue',
    'value'     => 'RM 82,480',
    'trend'     => '+4.7%',
    'note'      => 'monthly run rate',
    'icon_name' => 'plus',
  ],
];

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
    'manage_url'     => '#',
  ],
  [
    'code'           => 'RK2600-260325-00064',
    'created_at'     => '25 Mar, 22:03 PM',
    'studio'         => 'Raya Kasih',
    'session'        => '2026-03-28 05:00 PM',
    'customer_name'  => 'Mohamad Noor',
    'customer_phone' => '01126587133',
    'payment'        => 'Paid Deposit',
    'status'         => 'Pending',
    'manage_url'     => '#',
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
    'manage_url'     => '#',
  ],
];

$cards_booking_table = build_booking_table_dataset($orders, [
  'action_button_size'      => 'default',
  'action_menu_size'        => 'default',
  'action_button_icon_only' => true,
  'action_button_icon_name' => 'pencil-line',
]);

$anatomy_demo_actions = $capture('button', [
  'label'   => 'Save Changes',
  'variant' => 'primary',
]);

$anatomy_demo_secondary_action = $capture('button', [
  'label' => 'Cancel',
]);

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<section class="card">
  <header class="card__head">
    <h1 class="type-h1">Card UI Component</h1>
    <p class="mt-2 max-w-3xl text-muted">
      Reusable container pattern for summaries, forms, lists, and table-heavy operational screens.
    </p>
  </header>

  <section class="card__list" aria-label="Card component showcase">
    <ul class="list">
      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h3 class="type-h3">Card Anatomy</h3>
          <p class="mb-4 text-muted">
            Build cards with predictable sections so spacing, borders, and child composition remain consistent.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <pre class="overflow-x-auto rounded bg-gray-50 p-3 font-mono text-xs text-muted">.card
├── .card-media (optional)
├── .card__head
│   ├── .card__title
│   └── .card__description
├── .card__table (optional)
├── .card__list (optional)
├── .card__body
└── .card__actions</pre>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h3 class="type-h3">Section Responsibilities</h3>
          <p class="mb-4 text-muted">
            Keep each card area focused so content hierarchy is easy to scan and maintain.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <ul class="list-disc space-y-2 pl-5">
              <li><code>.card__head</code>: title, description, and high-level context.</li>
              <li><code>.card__body</code>: main content such as form fields, charts, or copy.</li>
              <li><code>.card__actions</code>: primary/secondary CTA row with top divider.</li>
              <li><code>.card__table</code>: table area with horizontal bleed to card edges.</li>
              <li><code>.card__list</code>: stacked sections using existing list rhythm.</li>
            </ul>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h3 class="type-h3">Metric Cards</h3>
          <p class="mb-4 text-muted">
            Use <code>card-metric</code> for compact KPI snapshots with clear value and trend.
          </p>
          <div class="grid gap-4 md:grid-cols-3">
            <?php foreach ($widget_samples as $widget): ?>
              <?php component('card-metric', $widget); ?>
            <?php endforeach; ?>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h3 class="type-h3">Form Card Recipe</h3>
          <p class="mb-4 text-muted">
            Typical form composition using head, body, and actions with clear CTA hierarchy.
          </p>
          <section class="card">
            <header class="card__head">
              <h4 class="card__title">Profile Settings</h4>
              <p class="card__description">Update contact and notification preferences.</p>
            </header>
            <div class="card__body grid gap-3 sm:grid-cols-2">
              <?php component('input', ['id' => 'cards-demo-name', 'name' => 'name', 'label' => 'Name', 'placeholder' => 'Nurin Aisyah']); ?>
              <?php component('input', ['id' => 'cards-demo-email', 'name' => 'email', 'label' => 'Email', 'placeholder' => 'nurin@email.com']); ?>
            </div>
            <div class="card__actions flex items-center justify-end gap-2">
              <?= $anatomy_demo_secondary_action ?>
              <?= $anatomy_demo_actions ?>
            </div>
          </section>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h3 class="type-h3">Table-in-Card Recipe</h3>
          <p class="mb-4 text-muted">
            Use <code>card__table</code> when table content should bleed to card edges while preserving card padding.
          </p>
          <section class="card">
            <header class="card__head">
              <h4 class="card__title">Recent Bookings</h4>
              <p class="card__description">Operational booking list with inline actions and pagination.</p>
            </header>
            <div class="card__table">
              <?php
              component('table', [
                'headers' => $cards_booking_table['headers'],
                'rows'    => $cards_booking_table['rows'],
              ]);
              ?>
            </div>
            <div class="card__actions">
              <?php
              component('pagination', [
                'current_page' => 1,
                'total_pages'  => 1,
                'show_info'    => true,
                'total_items'  => $cards_booking_table['total'],
                'per_page'     => 10,
                'base_url'     => asset('/docs/components/cards?page=%d'),
              ]);
              ?>
            </div>
          </section>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h3 class="type-h3">Spacing Rules</h3>
          <p class="mb-4 text-muted">
            Card rhythm is tokenized. Keep overrides minimal to preserve predictable composition.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <ul class="list-disc space-y-2 pl-5">
              <li>Default direct-child gap inside <code>.card</code> is 24px.</li>
              <li>Horizontal side padding is controlled per direct child section.</li>
              <li><code>.card__actions</code> includes divider and vertical padding by default.</li>
              <li><code>.card__table</code> uses negative horizontal margins for edge alignment.</li>
            </ul>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h3 class="type-h3">Do / Don’t</h3>
          <p class="mb-4 text-muted">
            Follow these checks to keep card implementations clean and reusable.
          </p>
          <div class="grid gap-4 md:grid-cols-2">
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <h4 class="mb-3 type-h4">Do</h4>
              <ul class="list-disc space-y-2 pl-5">
                <li>Use semantic section blocks: head, body, table, actions.</li>
                <li>Keep one clear primary action in action rows.</li>
                <li>Reuse component primitives inside cards.</li>
              </ul>
            </div>
            <div class="rounded-lg border border-gray-100 bg-white p-4">
              <h4 class="mb-3 type-h4">Don’t</h4>
              <ul class="list-disc space-y-2 pl-5">
                <li>Mix ad-hoc wrappers that duplicate card spacing rules.</li>
                <li>Use dense utility overrides to fight built-in anatomy rhythm.</li>
                <li>Overload card heads with full form controls.</li>
              </ul>
            </div>
          </div>
        </section>
      </li>

      <li class="list__item">
        <section class="w-full max-w-4xl py-4">
          <h3 class="type-h3">Accessibility Notes</h3>
          <p class="mb-4 text-muted">
            Cards often mix many controls; ensure structure and focus order remain accessible.
          </p>
          <div class="rounded-lg border border-gray-100 bg-white p-4">
            <ul class="list-disc space-y-2 pl-5">
              <li>Use proper heading levels for <code>.card__title</code> based on page hierarchy.</li>
              <li>Keep button labels explicit when using icon-only controls.</li>
              <li>Provide alt text for meaningful media in <code>.card-media</code>.</li>
              <li>Maintain visible focus styles for actions inside dense card content.</li>
            </ul>
          </div>
        </section>
      </li>
    </ul>
  </section>
</section>
<?php layout('app-end'); ?>
