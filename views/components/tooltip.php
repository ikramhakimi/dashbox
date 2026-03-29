<?php

$content       = isset($content) ? trim((string) $content) : 'Tooltip content';
$trigger_label = isset($trigger_label) ? trim((string) $trigger_label) : 'Hover me';
$trigger_tag   = isset($trigger_tag) ? (string) $trigger_tag : 'button';
$trigger_href  = isset($trigger_href) ? (string) $trigger_href : '#';
$trigger_html  = isset($trigger_html) ? (string) $trigger_html : '';
$placement     = isset($placement) ? (string) $placement : 'top';
$max_width     = isset($max_width) ? (string) $max_width : '220px';
$attributes    = isset($attributes) && is_array($attributes) ? $attributes : [];

$allowed_tags = ['button', 'a', 'span'];
if (!in_array($trigger_tag, $allowed_tags, true)) {
  $trigger_tag = 'button';
}

$allowed_placements = ['top', 'right', 'bottom', 'left'];
if (!in_array($placement, $allowed_placements, true)) {
  $placement = 'top';
}

$tooltip_id = isset($tooltip_id) && trim((string) $tooltip_id) !== ''
  ? trim((string) $tooltip_id)
  : 'tooltip-' . uniqid();

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

$root_attributes = $attributes;
$root_attributes['class'] = trim($component_class . ' tooltip--' . $placement . ' ' . (($attributes['class'] ?? '')));

$trigger_attributes = [
  'class' => 'tooltip__trigger',
  'aria-describedby' => $tooltip_id,
];

if ($trigger_tag === 'button') {
  $trigger_attributes['type'] = 'button';
}

if ($trigger_tag === 'a') {
  $trigger_attributes['href'] = $trigger_href;
}

if ($trigger_tag === 'span') {
  $trigger_attributes['tabindex'] = '0';
}
?>
<span<?= $render_attributes($root_attributes) ?>>
  <?php if ($trigger_html !== ''): ?>
    <span class="tooltip__trigger" aria-describedby="<?= e($tooltip_id) ?>" tabindex="0">
      <?= $trigger_html ?>
    </span>
  <?php else: ?>
    <<?= e($trigger_tag) ?><?= $render_attributes($trigger_attributes) ?>>
      <?= e($trigger_label) ?>
    </<?= e($trigger_tag) ?>>
  <?php endif; ?>

  <span
    id="<?= e($tooltip_id) ?>"
    class="tooltip__content"
    role="tooltip"
    style="max-width: <?= e($max_width) ?>;"
  >
    <?= e($content) ?>
  </span>
</span>
