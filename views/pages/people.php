<?php

$page_title   = 'People Management';
$page_current = 'people';

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
    'label'    => 'People',
    'children' => people_sidebar_children($page_current),
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

$people_stats = [
  [
    'title'     => 'Team Members',
    'value'     => '24',
    'trend'     => '+3',
    'note'      => 'added this month',
    'icon_name' => 'users',
  ],
  [
    'title'     => 'Roles',
    'value'     => '5',
    'trend'     => 'stable',
    'note'      => 'system + custom',
    'icon_name' => 'star',
  ],
  [
    'title'     => 'Pending Invites',
    'value'     => '2',
    'trend'     => '-1',
    'note'      => 'last 7 days',
    'icon_name' => 'activity',
  ],
  [
    'title'     => 'MFA Coverage',
    'value'     => '92%',
    'trend'     => '+4%',
    'note'      => 'security health',
    'icon_name' => 'plus',
  ],
];

$quick_links = [
  [
    'title'       => 'Team Members',
    'description' => 'Browse, search, and manage all active team accounts.',
    'href'        => asset('/people/team-members'),
    'cta'         => 'Open Team Members',
  ],
  [
    'title'       => 'Roles & Permissions',
    'description' => 'Review role scope and module-level access in one place.',
    'href'        => asset('/people/roles-permissions'),
    'cta'         => 'Open Roles & Permissions',
  ],
  [
    'title'       => 'Invite Member',
    'description' => 'Onboard a new teammate quickly with default role assignment.',
    'href'        => asset('/people/invite'),
    'cta'         => 'Invite New Member',
  ],
];

layout('layout-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
<div class="flex min-h-screen">
  <?php component('sidebar', ['menu_items' => $menu_items]); ?>

  <main class="content flex-1 p-4 lg:p-10">
    <section class="mx-auto max-w-7xl space-y-8">
      <header class="border-b border-gray-200 pb-6">
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">People</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-gray-900">People Management</h1>
        <p class="mt-2 max-w-3xl text-sm text-gray-500">
          Startup-friendly control center for members, roles, and permissions.
        </p>
      </header>

      <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="People metrics overview">
        <?php foreach ($people_stats as $stat): ?>
          <?php component('card-widget', $stat); ?>
        <?php endforeach; ?>
      </section>

      <section class="card" aria-label="People quick links">
        <div class="card__main divide-y divide-gray-100">
          <?php foreach ($quick_links as $item): ?>
            <article class="py-5 first:pt-0 last:pb-0">
              <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                <div>
                  <h2 class="text-lg font-semibold text-gray-900"><?= e($item['title']) ?></h2>
                  <p class="mt-1 text-sm text-gray-500"><?= e($item['description']) ?></p>
                </div>
                <div>
                  <?= $capture('button', [
                    'label'   => $item['cta'],
                    'href'    => $item['href'],
                  ]) ?>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </section>
    </section>
  </main>
</div>
<?php layout('layout-end'); ?>
