<?php

$title       = isset($title) ? trim((string) $title) : 'Nothing to show yet';
$description = isset($description) ? trim((string) $description) : 'Try a different filter or create your first item.';
$deco        = isset($deco) ? trim((string) $deco) : '';
$icon_name   = isset($icon_name) ? trim((string) $icon_name) : '';
$actions     = isset($actions) && is_array($actions) ? $actions : [];
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

$root_attributes = $attributes;
$root_attributes['class'] = trim($component_class . ' ' . (($attributes['class'] ?? '')));
$root_attributes['role']  = isset($attributes['role']) ? (string) $attributes['role'] : 'status';
?>
<section<?= $render_attributes($root_attributes) ?>>
  <?php if ($icon_name !== ''): ?>
    <span class="empty__icon" aria-hidden="true">
      <?php component('icon', ['icon_name' => $icon_name, 'icon_size' => 24]); ?>
    </span>
  <?php elseif ($deco !== ''): ?>
    <p class="empty__deco" aria-hidden="true"><?= e($deco) ?></p>
  <?php endif; ?>

  <h3 class="empty__title"><?= e($title) ?></h3>
  <p class="empty__description"><?= e($description) ?></p>

  <?php if ($actions !== []): ?>
    <div class="empty__actions">
      <?php foreach ($actions as $action): ?>
        <?php
        if (!is_array($action)) {
          continue;
        }

        component('button', [
          'label'      => isset($action['label']) ? (string) $action['label'] : 'Action',
          'href'       => isset($action['href']) ? (string) $action['href'] : '',
          'variant'    => isset($action['variant']) ? (string) $action['variant'] : 'neutral',
          'size'       => isset($action['size']) ? (string) $action['size'] : 'md',
          'icon_name'  => isset($action['icon_name']) ? (string) $action['icon_name'] : '',
          'disabled'   => !empty($action['disabled']),
          'attributes' => isset($action['attributes']) && is_array($action['attributes']) ? $action['attributes'] : [],
        ]);
        ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>
