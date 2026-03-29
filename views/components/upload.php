<?php

$id          = isset($id) && $id !== '' ? (string) $id : 'upload-' . uniqid();
$name        = isset($name) && $name !== '' ? (string) $name : $id;
$label       = isset($label) ? (string) $label : 'Upload file';
$help_text   = isset($help_text) ? (string) $help_text : '';
$accept      = isset($accept) ? (string) $accept : '';
$multiple    = !empty($multiple);
$required    = !empty($required);
$disabled    = !empty($disabled);
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

$input_attributes             = $attributes;
$input_attributes['id']       = $id;
$input_attributes['name']     = $name;
$input_attributes['type']     = 'file';
$input_attributes['class']    = 'upload__control';
$input_attributes['required'] = $required;
$input_attributes['disabled'] = $disabled;
$input_attributes['multiple'] = $multiple;

if ($accept !== '') {
  $input_attributes['accept'] = $accept;
}
?>
<div class="<?= e($component_class) ?>">
  <label class="upload__label" for="<?= e($id) ?>"><?= e($label) ?></label>
  <input<?= $render_attributes($input_attributes) ?>>
  <?php if ($help_text !== ''): ?>
    <p class="upload__help"><?= e($help_text) ?></p>
  <?php endif; ?>
</div>
