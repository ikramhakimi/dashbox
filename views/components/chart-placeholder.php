<?php

$title       = isset($title) ? trim((string) $title) : 'Chart Title';
$subtitle    = isset($subtitle) ? trim((string) $subtitle) : '';
$height      = isset($height) ? trim((string) $height) : 'h-72';
$legend      = isset($legend) && is_array($legend) ? $legend : [];
$helper_text = isset($helper_text) ? trim((string) $helper_text) : 'Chart component placeholder (JS pending)';
$attributes  = isset($attributes) && is_array($attributes) ? $attributes : [];

$render_attributes = static function (array $attrs): string {
  $compiled = [];

  foreach ($attrs as $key => $value) {
    if (!is_string($key) || $key === '') {
      continue;
    }

    if (is_bool($value)) {
      if ($value) {
        $compiled[] = $key;
      }
      continue;
    }

    if ($value === null) {
      continue;
    }

    $compiled[] = $key . '="' . e((string) $value) . '"';
  }

  return $compiled === [] ? '' : ' ' . implode(' ', $compiled);
};

$root_attributes           = $attributes;
$root_attributes['class']  = trim($component_class . ' ' . (($attributes['class'] ?? '')));
$root_attributes['role']   = isset($attributes['role']) ? (string) $attributes['role'] : 'img';
$root_attributes['aria-label'] = isset($attributes['aria-label'])
  ? (string) $attributes['aria-label']
  : $title;
?>
<section<?= $render_attributes($root_attributes) ?>>
  <header class="chart__header">
    <div class="chart__title-group">
      <h3 class="chart__title"><?= e($title) ?></h3>
      <?php if ($subtitle !== ''): ?>
        <p class="chart__subtitle"><?= e($subtitle) ?></p>
      <?php endif; ?>
    </div>

    <?php if ($legend !== []): ?>
      <div class="chart__legend" aria-label="Chart legend">
        <?php foreach ($legend as $legend_item): ?>
          <?php
          if (!is_array($legend_item)) {
            continue;
          }

          $legend_label = isset($legend_item['label']) ? (string) $legend_item['label'] : '';
          $legend_tone  = isset($legend_item['tone']) ? (string) $legend_item['tone'] : 'neutral';
          ?>
          <span class="chart__legend-item">
            <span class="chart__legend-dot chart__legend-dot--<?= e($legend_tone) ?>"></span>
            <span class="chart__legend-label"><?= e($legend_label) ?></span>
          </span>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </header>

  <div class="chart__canvas <?= e($height) ?>">
    <div class="chart__grid" aria-hidden="true"></div>
    <div class="chart__bars" aria-hidden="true">
      <span class="chart__bar chart__bar--1"></span>
      <span class="chart__bar chart__bar--2"></span>
      <span class="chart__bar chart__bar--3"></span>
      <span class="chart__bar chart__bar--4"></span>
      <span class="chart__bar chart__bar--5"></span>
      <span class="chart__bar chart__bar--6"></span>
      <span class="chart__bar chart__bar--7"></span>
    </div>
    <p class="chart__helper"><?= e($helper_text) ?></p>
  </div>
</section>
