<?php
$title = isset($title) ? (string) $title : 'Monthly Target';
$subtitle = isset($subtitle) ? (string) $subtitle : 'Target you have set for each month';
$show_graph = !isset($show_graph) || $show_graph;
$show_footer = !isset($show_footer) || $show_footer;
$show_menu = !isset($show_menu) || $show_menu;
$widgets = isset($widgets) && is_array($widgets) ? $widgets : [];
?>
<section class="<?= e($component_class) ?>">
  <div class="card__main">
    <header class="card__header">
      <div>
        <h2 class="text-xl font-semibold text-gray-900"><?= e($title) ?></h2>
        <p class="mt-1 text-gray-500"><?= e($subtitle) ?></p>
      </div>
      <?php if ($show_menu): ?>
        <button type="button" class="rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-700" aria-label="More options">
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <circle cx="12" cy="5" r="1.75"></circle>
            <circle cx="12" cy="12" r="1.75"></circle>
            <circle cx="12" cy="19" r="1.75"></circle>
          </svg>
        </button>
      <?php endif; ?>
    </header>

    <div class="card__content">
      <?php if ($show_graph): ?>
        <div class="card__chart rounded-xl bg-gray-50" style="height: 190px">
          <div class="card__chart-placeholder">Graph Placeholder</div>
          <span class="badge badge--positive card__chart-badge">+10%</span>
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
    </div>
  </div>

  <?php if ($show_footer): ?>
    <footer class="card__footer">
      <div class="card__stat">
        <p class="card__stat-label">Target</p>
        <p class="card__stat-value">RM 20K</p>
      </div>
      <div class="card__stat">
        <p class="card__stat-label">Revenue</p>
        <p class="card__stat-value">RM 20K</p>
      </div>
      <div class="card__stat">
        <p class="card__stat-label">Today</p>
        <p class="card__stat-value">RM 20K</p>
      </div>
    </footer>
  <?php endif; ?>
</section>
