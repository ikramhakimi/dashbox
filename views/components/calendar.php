<?php

$month_label  = isset($month_label) ? trim((string) $month_label) : 'Month';
$week_labels  = isset($week_labels) && is_array($week_labels) ? $week_labels : [];
$days         = isset($days) && is_array($days) ? $days : [];
$show_legend  = isset($show_legend) ? (bool) $show_legend : true;
$attributes   = isset($attributes) && is_array($attributes) ? $attributes : [];

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

$root_attributes               = $attributes;
$root_attributes['class']      = trim($component_class . ' ' . (($attributes['class'] ?? '')));
$root_attributes['aria-label'] = isset($attributes['aria-label'])
  ? (string) $attributes['aria-label']
  : 'Calendar';
?>
<div<?= $render_attributes($root_attributes) ?>>
  <div class="calendar__header">
    <h2 class="calendar__month"><?= e($month_label) ?></h2>

    <?php if ($show_legend): ?>
      <div class="calendar__legend" aria-label="Calendar legend">
        <span class="calendar__legend-dot calendar__legend-dot--empty"></span>
        <span class="calendar__legend-text">No session</span>
        <span class="calendar__legend-dot calendar__legend-dot--filled"></span>
        <span class="calendar__legend-text">Has session</span>
      </div>
    <?php endif; ?>
  </div>

  <div class="calendar__weekdays">
    <?php foreach ($week_labels as $week_label): ?>
      <div class="calendar__weekday"><?= e((string) $week_label) ?></div>
    <?php endforeach; ?>
  </div>

  <div class="calendar__grid">
    <?php foreach ($days as $day): ?>
      <?php
      $is_in_month     = !empty($day['in_month']);
      $is_today        = !empty($day['is_today']);
      $day_value       = isset($day['day']) ? (string) $day['day'] : '';
      $date_key        = isset($day['date_key']) ? (string) $day['date_key'] : '';
      $day_href        = isset($day['href']) ? trim((string) $day['href']) : '';
      $day_drawer_id   = isset($day['drawer_id']) ? trim((string) $day['drawer_id']) : '';
      $visible_items   = isset($day['visible_items']) && is_array($day['visible_items']) ? $day['visible_items'] : [];
      $extra_sessions  = isset($day['extra_sessions']) ? (int) $day['extra_sessions'] : 0;
      $sales_total     = isset($day['sales_total']) ? (string) $day['sales_total'] : '';
      $total_orders    = isset($day['total_orders']) ? (int) $day['total_orders'] : 0;
      $target_status   = isset($day['target_status']) ? (string) $day['target_status'] : 'neutral';
      $has_sessions    = $visible_items !== [] || $extra_sessions > 0;
      $is_clickable    = $has_sessions && ($day_drawer_id !== '' || $day_href !== '');
      $day_cell_class  = 'calendar__day';
      $number_class    = 'calendar__day-number';

      if (!$is_in_month) {
        $day_cell_class .= ' calendar__day--outside';
        $number_class   .= ' calendar__day-number--outside';
      }

      if ($is_today) {
        $day_cell_class .= ' calendar__day--today';
      }
      if ($has_sessions) {
        $day_cell_class .= ' calendar__day--has-session';
      }
      if ($is_clickable) {
        $day_cell_class .= ' calendar__day--interactive';
      }
      ?>
      <?php if ($is_clickable && $day_drawer_id !== ''): ?>
      <button
        type="button"
        class="<?= e($day_cell_class) ?>"
        data-drawer-open="<?= e($day_drawer_id) ?>"
        aria-label="View sessions for <?= e($date_key) ?>"
      >
      <?php elseif ($is_clickable): ?>
      <a
        href="<?= e($day_href) ?>"
        class="<?= e($day_cell_class) ?>"
        aria-label="View sessions for <?= e($date_key) ?>"
      >
      <?php else: ?>
      <div class="<?= e($day_cell_class) ?>">
      <?php endif; ?>
        <div class="calendar__day-header">
          <p class="<?= e($number_class) ?>"><?= e($day_value) ?></p>

          <?php if ($is_today): ?>
            <span class="calendar__today">Today</span>
          <?php endif; ?>
        </div>

        <?php if ($is_in_month && $has_sessions): ?>
          <div class="calendar__summary">
            <p class="calendar__sales-total"><?= e($sales_total !== '' ? $sales_total : 'RM 0') ?></p>
            <p class="calendar__sales-meta"><?= e((string) $total_orders) ?> orders</p>
            <span class="calendar__target calendar__target--<?= e($target_status) ?>">
              <?= e($target_status === 'hit' ? 'Target Hit' : ($target_status === 'risk' ? 'Below Target' : 'No Target')) ?>
            </span>
          </div>
        <?php endif; ?>

        <?php if ($visible_items !== []): ?>
          <div class="calendar__sessions">
            <?php foreach ($visible_items as $item): ?>
              <div class="calendar__session">
                <p class="calendar__session-time"><?= e((string) ($item['time'] ?? '')) ?></p>
                <p class="calendar__session-title"><?= e((string) ($item['title'] ?? '')) ?></p>
              </div>
            <?php endforeach; ?>

            <?php if ($extra_sessions > 0): ?>
              <p class="calendar__more">+<?= e((string) $extra_sessions) ?> more</p>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      <?php if ($is_clickable && $day_drawer_id !== ''): ?>
      </button>
      <?php elseif ($is_clickable): ?>
      </a>
      <?php else: ?>
      </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>
