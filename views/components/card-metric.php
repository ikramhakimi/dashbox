<?php

$title = isset($title) ? (string) $title : 'Metric';
$value = isset($value) ? (string) $value : '0';
$trend = isset($trend) ? (string) $trend : '+0%';
$note  = isset($note) ? (string) $note : 'Compared to last period';

$icon_name = isset($icon_name) ? (string) $icon_name : 'plus';
$icon_size = isset($icon_size) ? (int) $icon_size : 24;
$show_icon = !isset($show_icon) || $show_icon;

$trend_mode = isset($trend_mode) ? (string) $trend_mode : '';

if ($trend_mode === '') {
  if (strpos($trend, '-') === 0) {
    $trend_mode = 'negative';
  } elseif (strpos($trend, '+') === 0) {
    $trend_mode = 'positive';
  } else {
    $trend_mode = 'neutral';
  }
}
?>
<article class="<?= e($component_class) ?>">
  <div class="card__body">
    <div class="card__metric-head">
      <p class="type-caption"><?= e($title) ?></p>
      <?php if ($show_icon): ?>
        <div class="card__icon">
          <?php
          component('icon', [
            'icon_name' => $icon_name,
            'icon_size' => $icon_size,
          ]);
          ?>
        </div>
      <?php endif; ?>
    </div>

    <p class="type-h2"><?= e($value) ?></p>

    <div class="card__meta">
      <?php
      component('badge', [
        'trend_value' => $trend,
        'trend_mode'  => $trend_mode,
      ]);
      ?>
      <p class="type-meta"><?= e($note) ?></p>
    </div>
  </div>
</article>
