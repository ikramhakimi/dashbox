<?php

$title            = isset($title) ? trim((string) $title) : 'Page Title';
$description      = isset($description) ? trim((string) $description) : '';
$breadcrumb_items = isset($breadcrumb_items) && is_array($breadcrumb_items) ? $breadcrumb_items : [];
$actions          = isset($actions) && is_array($actions) ? $actions : [];
$actions_html     = isset($actions_html) ? (string) $actions_html : '';
$actions_html_trusted = !empty($actions_html_trusted);
$attributes       = isset($attributes) && is_array($attributes) ? $attributes : [];

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

$root_attributes              = $attributes;
$root_attributes['class']     = trim($component_class . ' ' . (($attributes['class'] ?? '')));
$root_attributes['aria-label']= isset($attributes['aria-label']) ? (string) $attributes['aria-label'] : 'Page header';
?>
<header<?= $render_attributes($root_attributes) ?>>
  <div class="page__header-main">
    <?php if ($breadcrumb_items !== []): ?>
      <div class="page__header-breadcrumb">
        <?php component('breadcrumb', ['items' => $breadcrumb_items, 'compact' => true]); ?>
      </div>
    <?php endif; ?>

    <h1 class="page__header-title type-h1"><?= e($title) ?></h1>

  <?php if ($description !== ''): ?>
      <p class="page__header-description type-body-muted"><?= e($description) ?></p>
    <?php endif; ?>
  </div>

  <?php if ($actions !== [] || $actions_html !== ''): ?>
    <div class="page__header-actions">
      <?php foreach ($actions as $action): ?>
        <?php
        if (!is_array($action)) {
          continue;
        }

        component('button', [
          'label'         => isset($action['label']) ? (string) $action['label'] : 'Action',
          'href'          => isset($action['href']) ? (string) $action['href'] : '',
          'variant'       => isset($action['variant']) ? (string) $action['variant'] : 'neutral',
          'size'          => isset($action['size']) ? (string) $action['size'] : 'md',
          'icon_name'     => isset($action['icon_name']) ? (string) $action['icon_name'] : '',
          'icon_position' => isset($action['icon_position']) ? (string) $action['icon_position'] : 'left',
          'icon_only'     => !empty($action['icon_only']),
          'aria_label'    => isset($action['aria_label']) ? (string) $action['aria_label'] : '',
          'disabled'      => !empty($action['disabled']),
          'attributes'    => isset($action['attributes']) && is_array($action['attributes']) ? $action['attributes'] : [],
        ]);
        ?>
      <?php endforeach; ?>

      <?php if ($actions_html !== '' && $actions_html_trusted): ?>
        <?= $actions_html ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</header>
