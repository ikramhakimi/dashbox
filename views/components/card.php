<?php
$title       = isset($title) ? (string) $title : 'Monthly Target';
$subtitle    = isset($subtitle) ? (string) $subtitle : 'Target you have set for each month';
$show_graph  = !isset($show_graph) || $show_graph;
$show_footer = !isset($show_footer) || $show_footer;
$show_menu   = !isset($show_menu) || $show_menu;
$widgets     = isset($widgets) && is_array($widgets) ? $widgets : [];
$content     = isset($content) ? (string) $content : '';
$footer      = isset($footer) ? (string) $footer : '';
$actions     = isset($actions) ? (string) $actions : '';
?>
<section class="<?= e($component_class) ?>">
  <div class="card__main space-y-4">
    <header class="card__header flex items-start justify-between gap-3">
      <div class="min-w-0">
        <h2 class="text-xl font-semibold text-gray-900"><?= e($title) ?></h2>
        <p class="mt-1 text-sm text-gray-500"><?= e($subtitle) ?></p>
      </div>

      <?php if ($actions !== ''): ?>
        <div class="card__actions"><?= $actions ?></div>
      <?php elseif ($show_menu): ?>
        <button
          type="button"
          class="rounded-md p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700"
          aria-label="More options"
        >
          <svg
            class="h-5 w-5"
            viewBox="0 0 24 24"
            fill="currentColor"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true"
          >
            <circle cx="12" cy="5" r="1.75"></circle>
            <circle cx="12" cy="12" r="1.75"></circle>
            <circle cx="12" cy="19" r="1.75"></circle>
          </svg>
        </button>
      <?php endif; ?>
    </header>

    <div class="card__content space-y-4">
      <?php if ($show_graph): ?>
        <div class="card__chart relative rounded-lg bg-gray-50" style="height: 190px">
          <div class="card__chart-placeholder flex h-full items-center justify-center text-sm font-medium text-gray-400">
            Graph Placeholder
          </div>
          <span class="badge badge--positive absolute bottom-4 left-1/2 -translate-x-1/2">+10%</span>
        </div>
        <p class="text-center text-sm text-gray-500">
          You earned RM 3,287 today, higher than last month.
          <br>
          Keep up your momentum!
        </p>
      <?php endif; ?>

      <?php if (!empty($widgets)): ?>
        <div class="grid gap-4 md:grid-cols-4">
          <?php foreach ($widgets as $widget): ?>
            <?php component('card-widget', $widget); ?>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <?php if ($content !== ''): ?>
        <?= $content ?>
      <?php endif; ?>
    </div>
  </div>

  <?php if ($footer !== ''): ?>
    <footer class="card__footer mt-4 border-t border-gray-200 pt-4">
      <?= $footer ?>
    </footer>
  <?php elseif ($show_footer): ?>
    <footer class="card__footer mt-4 grid grid-cols-3 divide-x divide-gray-200 border-t border-gray-200 pt-4">
      <div class="card__stat px-4 text-center first:pl-0 last:pr-0">
        <p class="card__stat-label mb-1 text-xs text-gray-500 sm:text-sm">Target</p>
        <p class="card__stat-value text-base font-semibold text-gray-900 sm:text-lg">RM 20K</p>
      </div>
      <div class="card__stat px-4 text-center first:pl-0 last:pr-0">
        <p class="card__stat-label mb-1 text-xs text-gray-500 sm:text-sm">Revenue</p>
        <p class="card__stat-value text-base font-semibold text-gray-900 sm:text-lg">RM 20K</p>
      </div>
      <div class="card__stat px-4 text-center first:pl-0 last:pr-0">
        <p class="card__stat-label mb-1 text-xs text-gray-500 sm:text-sm">Today</p>
        <p class="card__stat-value text-base font-semibold text-gray-900 sm:text-lg">RM 20K</p>
      </div>
    </footer>
  <?php endif; ?>
</section>
