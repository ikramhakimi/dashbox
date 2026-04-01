<?php

$id          = isset($id) && $id !== '' ? (string) $id : 'dropzone-' . uniqid();
$name        = isset($name) && $name !== '' ? (string) $name : $id;
$label       = isset($label) ? (string) $label : 'Upload file';
$help_text   = isset($help_text) ? (string) $help_text : '';
$accept      = isset($accept) ? (string) $accept : '';
$required    = !empty($required);
$disabled    = !empty($disabled);
$attributes  = isset($attributes) && is_array($attributes) ? $attributes : [];
$previewable = isset($previewable) ? (bool) $previewable : true;
$multiple    = !empty($multiple);
$sortable    = !empty($sortable) && $multiple;
$max_files   = isset($max_files) ? max(0, (int) $max_files) : 0;
$states      = isset($states) && is_array($states) ? $states : [];
$is_square   = !empty($states['square']);
$order_input_name = isset($order_input_name) && $order_input_name !== ''
  ? (string) $order_input_name
  : ($name . '_order');
$surface_title_default = isset($surface_title_default) && $surface_title_default !== ''
  ? (string) $surface_title_default
  : ($is_square ? 'Click to upload image' : 'Drag and drop file here');
$surface_title_change = isset($surface_title_change) && $surface_title_change !== ''
  ? (string) $surface_title_change
  : ($is_square ? 'Click to change image' : 'Drag and drop file here');
$surface_hint = isset($surface_hint) && $surface_hint !== ''
  ? (string) $surface_hint
  : 'or click to browse';

if ($multiple && substr($name, -2) !== '[]') {
  $name .= '[]';
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

$input_attributes             = $attributes;
$input_attributes['id']       = $id;
$input_attributes['name']     = $name;
$input_attributes['type']     = 'file';
$input_attributes['class']    = 'dropzone__input';
$input_attributes['required'] = $required;
$input_attributes['disabled'] = $disabled;
$input_attributes['multiple'] = $multiple;

if ($accept !== '') {
  $input_attributes['accept'] = $accept;
}
?>
<div
  class="dropzone <?= e($component_class) ?><?= $disabled ? ' dropzone--disabled' : '' ?>"
  data-dropzone
  data-dropzone-mode="<?= e($multiple ? 'multi' : 'single') ?>"
  data-dropzone-previewable="<?= $previewable ? 'true' : 'false' ?>"
  data-dropzone-sortable="<?= $sortable ? 'true' : 'false' ?>"
  data-dropzone-max-files="<?= e((string) $max_files) ?>"
>
  <label class="dropzone__label" for="<?= e($id) ?>"><?= e($label) ?></label>

  <?php if ($help_text !== ''): ?>
    <p class="dropzone__help"><?= e($help_text) ?></p>
  <?php endif; ?>

  <input<?= $render_attributes($input_attributes) ?> data-dropzone-input>

  <div class="dropzone__meta">
    <p class="dropzone__file-name" data-dropzone-file-name>No file selected</p>
    <?php if (!$is_square || $multiple): ?>
      <button type="button" class="dropzone__clear hidden" data-dropzone-clear>
        <?= e($multiple ? 'Clear all' : 'Remove') ?>
      </button>
    <?php endif; ?>
  </div>

  <?php if ($multiple): ?>
    <div class="dropzone__multi-wrap hidden" data-dropzone-multi-wrap>
      <div class="dropzone__multi-grid" data-dropzone-multi-grid>
        <label class="dropzone__item dropzone__add-tile hidden" for="<?= e($id) ?>" data-dropzone-add-tile>
          <span class="dropzone__add-surface">
            <span class="dropzone__icon" aria-hidden="true">
              <?php component('icon', ['icon_name' => 'arrow-up-tray', 'icon_size' => 24]); ?>
            </span>
            <span class="dropzone__add-title">Add image</span>
          </span>
        </label>
      </div>
    </div>

    <label class="dropzone__surface" for="<?= e($id) ?>" data-dropzone-surface>
      <span class="dropzone__icon" aria-hidden="true">
        <?php component('icon', ['icon_name' => 'arrow-up-tray', 'icon_size' => 24]); ?>
      </span>
      <span
        class="dropzone__title"
        data-dropzone-title
        data-dropzone-title-default="<?= e($surface_title_default) ?>"
        data-dropzone-title-change="<?= e($surface_title_change) ?>"
      >
        <?= e($surface_title_default) ?>
      </span>
      <span class="dropzone__hint"><?= e($surface_hint) ?></span>
    </label>
  <?php endif; ?>

  <?php if (!$multiple): ?>
    <div class="dropzone__stage">
      <div class="dropzone__preview-wrap hidden" data-dropzone-preview-wrap>
        <img class="dropzone__preview-image" data-dropzone-preview alt="Selected file preview">
      </div>

      <?php if ($is_square): ?>
        <button
          type="button"
          class="dropzone__clear dropzone__clear--overlay hidden"
          data-dropzone-clear
          aria-label="Remove uploaded image"
        >
          <?php component('icon', ['icon_name' => 'trash', 'icon_size' => 16]); ?>
        </button>
      <?php endif; ?>

      <label class="dropzone__surface" for="<?= e($id) ?>" data-dropzone-surface>
        <span class="dropzone__icon" aria-hidden="true">
          <?php component('icon', ['icon_name' => 'arrow-up-tray', 'icon_size' => 24]); ?>
        </span>
        <span
          class="dropzone__title"
          data-dropzone-title
          data-dropzone-title-default="<?= e($surface_title_default) ?>"
          data-dropzone-title-change="<?= e($surface_title_change) ?>"
        >
          <?= e($surface_title_default) ?>
        </span>
        <span class="dropzone__hint"><?= e($surface_hint) ?></span>
      </label>
    </div>
  <?php endif; ?>

  <?php if ($multiple): ?>
    <input
      type="hidden"
      name="<?= e($order_input_name) ?>"
      value=""
      data-dropzone-order
    >
  <?php endif; ?>
</div>
