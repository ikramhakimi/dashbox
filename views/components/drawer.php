<?php

$id           = isset($id) && $id !== '' ? (string) $id : 'drawer-' . uniqid();
$title        = isset($title) ? (string) $title : 'Drawer Title';
$description  = isset($description) ? (string) $description : '';
$content      = isset($content) ? (string) $content : '';
$footer       = isset($footer) ? (string) $footer : '';
$placement    = isset($placement) ? (string) $placement : 'right';
$size         = isset($size) ? (string) $size : 'md';
$dismissible  = isset($dismissible) ? (bool) $dismissible : true;
$attributes   = isset($attributes) && is_array($attributes) ? $attributes : [];

$supported_placements = ['left', 'right'];
if (!in_array($placement, $supported_placements, true)) {
  $placement = 'right';
}

$supported_sizes = ['sm', 'md', 'lg'];
if (!in_array($size, $supported_sizes, true)) {
  $size = 'md';
}

$title_id = $id . '-title';
$desc_id  = $description !== '' ? $id . '-description' : '';

$root_classes = [
  $component_class,
  'drawer--' . $placement,
  'drawer--' . $size,
  'hidden',
];

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

$root_attributes                    = $attributes;
$root_attributes['id']              = $id;
$root_attributes['class']           = trim(implode(' ', $root_classes) . ' ' . (($attributes['class'] ?? '')));
$root_attributes['data-drawer']     = 'true';
$root_attributes['aria-hidden']     = 'true';
$root_attributes['aria-labelledby'] = $title_id;
$root_attributes['aria-describedby']= $desc_id !== '' ? $desc_id : null;
?>
<div<?= $render_attributes($root_attributes) ?>>
  <button type="button" class="drawer__backdrop" data-drawer-close aria-label="Close drawer"></button>
  <div class="drawer__panel" role="dialog" aria-modal="true" tabindex="-1">
    <div class="drawer__header">
      <div class="drawer__title-group">
        <h3 id="<?= e($title_id) ?>" class="drawer__title"><?= e($title) ?></h3>
        <?php if ($description !== ''): ?>
          <p id="<?= e($desc_id) ?>" class="drawer__description"><?= e($description) ?></p>
        <?php endif; ?>
      </div>

      <?php if ($dismissible): ?>
        <button type="button" class="drawer__close" data-drawer-close aria-label="Close drawer">
          <svg viewBox="0 0 16 16" fill="none" aria-hidden="true">
            <path d="M5 5L11 11M11 5L5 11" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"></path>
          </svg>
        </button>
      <?php endif; ?>
    </div>

    <div class="drawer__body">
      <?= $content ?>
    </div>

    <?php if ($footer !== ''): ?>
      <div class="drawer__footer">
        <?= $footer ?>
      </div>
    <?php endif; ?>
  </div>
</div>
