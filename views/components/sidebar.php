<?php

$menu_items = is_array($menu_items ?? null) ? $menu_items : [];
?>
<aside class="<?= e($component_class) ?> hidden h-screen w-72 shrink-0 border-r border-gray-200 bg-transparent lg:block">
  <div class="flex h-full flex-col px-4 py-5">
    <div class="mb-6 border-b border-gray-200 pb-4">
      <a href="<?= e(asset('/')) ?>" class="text-lg font-semibold tracking-tight text-gray-900">Dashing AI</a>
      <p class="mt-1 text-xs text-gray-500">Clean SaaS Admin</p>
    </div>

    <nav class="space-y-2" aria-label="Sidebar menu">
      <?php foreach ($menu_items as $menu_item): ?>
        <?php
        $is_collapsible = !empty($menu_item['children']) && is_array($menu_item['children']);
        $is_active      = !empty($menu_item['active']);
        ?>

        <?php if ($is_collapsible): ?>
          <button
            type="button"
            data-submenu-trigger
            class="sidebar__toggle flex w-full items-center justify-between rounded-lg border border-transparent px-3 py-2 text-sm font-medium text-gray-600 transition hover:border-gray-200 hover:bg-gray-50"
          >
            <span><?= e($menu_item['label'] ?? 'Menu') ?></span>
            <svg
              data-submenu-icon
              class="h-4 w-4 text-gray-400 transition-transform duration-200"
              viewBox="0 0 20 20"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true"
            >
              <path d="M5 7L10 12L15 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </button>
          <div data-submenu-panel class="mt-2 space-y-1 pl-2">
            <?php foreach ($menu_item['children'] as $child_item): ?>
              <?php $child_active = !empty($child_item['active']); ?>
              <a
                href="<?= e($child_item['href'] ?? '#') ?>"
                class="sidebar__link block rounded-lg border px-3 py-2 text-sm transition <?= $child_active ? 'sidebar__link--active border-gray-200 bg-gray-100 text-gray-900' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' ?>"
              >
                <?= e($child_item['label'] ?? 'Item') ?>
              </a>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <a
            href="<?= e($menu_item['href'] ?? '#') ?>"
            class="sidebar__link block rounded-lg border px-3 py-2 text-sm font-medium transition <?= $is_active ? 'sidebar__link--active border-gray-200 bg-gray-100 text-gray-900' : 'border-transparent text-gray-600 hover:border-gray-200 hover:bg-gray-50 hover:text-gray-900' ?>"
          >
            <?= e($menu_item['label'] ?? 'Item') ?>
          </a>
        <?php endif; ?>
      <?php endforeach; ?>
    </nav>

    <div class="mt-auto rounded-xl border border-gray-200 bg-gray-50 p-4">
      <p class="text-sm font-semibold text-gray-800">Need quick action?</p>
      <p class="mt-1 text-xs text-gray-500">Create report or export data in one click.</p>
      <button class="mt-3 w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100">
        Generate Report
      </button>
    </div>
  </div>
</aside>
