<?php

$id         = isset($id) && trim((string) $id) !== '' ? trim((string) $id) : 'chart-' . uniqid();
$title      = isset($title) ? trim((string) $title) : 'Chart';
$subtitle   = isset($subtitle) ? trim((string) $subtitle) : '';
$type       = isset($type) ? trim((string) $type) : 'line';
$height     = isset($height) ? trim((string) $height) : 'h-72';
$labels     = isset($labels) && is_array($labels) ? $labels : [];
$datasets   = isset($datasets) && is_array($datasets) ? $datasets : [];
$y_prefix   = isset($y_prefix) ? (string) $y_prefix : '';
$attributes = isset($attributes) && is_array($attributes) ? $attributes : [];

$chart_payload = [
  'type'     => $type,
  'labels'   => $labels,
  'datasets' => $datasets,
  'y_prefix' => $y_prefix,
];

$config_json = json_encode($chart_payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
if (!is_string($config_json)) {
  $config_json = '{}';
}

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

$root_attributes          = $attributes;
$root_attributes['class'] = trim($component_class . ' ' . (($attributes['class'] ?? '')));
?>
<section<?= $render_attributes($root_attributes) ?>>
  <header class="chart-ui__header">
    <div class="chart-ui__title-group">
      <h3 class="chart-ui__title"><?= e($title) ?></h3>
      <?php if ($subtitle !== ''): ?>
        <p class="chart-ui__subtitle"><?= e($subtitle) ?></p>
      <?php endif; ?>
    </div>
  </header>

  <div class="chart-ui__canvas-wrap <?= e($height) ?>">
    <canvas id="<?= e($id) ?>" class="chart-ui__canvas" data-chart aria-label="<?= e($title) ?>"></canvas>
  </div>

  <script type="application/json" data-chart-config-for="<?= e($id) ?>">
    <?= $config_json ?>
  </script>
</section>
