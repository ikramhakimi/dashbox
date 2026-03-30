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
  <div class="card__content relative flex flex-col gap-3">
    <div class="card__heading flex flex-col items-start justify-start gap-2">
      <?php if ($show_icon): ?>
        <div class="card__icon absolute right-0 top-0 inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-600">
        <?php
        component('icon', [
          'icon_name' => $icon_name,
          'icon_size' => $icon_size,
        ]);
        ?>
        </div>
      <?php endif; ?>
      <div class="card__label text-sm text-gray-500"><?= e($title) ?></div>
    </div>
    <p class="card__value text-3xl font-normal tracking-tight text-gray-900"><?= e($value) ?></p>
    <div class="card__meta flex items-center justify-start gap-2">
      <?php
      component('badge', [
        'trend_value' => $trend,
        'trend_mode'  => $trend_mode,
      ]);
      ?>
      <span class="card__note text-sm text-gray-500"><?= e($note) ?></span>
    </div>
  </div>
</article>
