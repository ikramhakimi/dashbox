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

if ($accept !== '') {
  $input_attributes['accept'] = $accept;
}
?>
<div
  class="<?= e($component_class) ?><?= $disabled ? ' dropzone--disabled' : '' ?>"
  data-dropzone
  data-dropzone-previewable="<?= $previewable ? 'true' : 'false' ?>"
>
  <label class="dropzone__label" for="<?= e($id) ?>"><?= e($label) ?></label>

  <input<?= $render_attributes($input_attributes) ?> data-dropzone-input>

  <label class="dropzone__surface" for="<?= e($id) ?>" data-dropzone-surface>
    <span class="dropzone__icon" aria-hidden="true">
      <?php component('icon', ['icon_name' => 'arrow-up-tray', 'icon_size' => 24]); ?>
    </span>
    <span class="dropzone__title">Drag and drop file here</span>
    <span class="dropzone__hint">or click to browse</span>
  </label>

  <div class="dropzone__preview-wrap hidden" data-dropzone-preview-wrap>
    <img class="dropzone__preview-image" data-dropzone-preview alt="Selected file preview">
  </div>

  <div class="dropzone__meta">
    <p class="dropzone__file-name" data-dropzone-file-name>No file selected</p>
    <button type="button" class="dropzone__clear hidden" data-dropzone-clear>Remove</button>
  </div>

  <?php if ($help_text !== ''): ?>
    <p class="dropzone__help"><?= e($help_text) ?></p>
  <?php endif; ?>
</div>
