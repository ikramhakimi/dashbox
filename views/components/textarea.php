<?php

$id            = isset($id) && $id !== '' ? (string) $id : 'textarea-' . uniqid();
$name          = isset($name) && $name !== '' ? (string) $name : $id;
$label         = isset($label) ? (string) $label : '';
$size          = isset($size) && $size !== '' ? (string) $size : 'md';
$value         = isset($value) ? (string) $value : '';
$placeholder   = isset($placeholder) ? (string) $placeholder : '';
$rows          = isset($rows) ? max(2, (int) $rows) : 4;
$help_text     = isset($help_text) ? (string) $help_text : '';
$error_text    = isset($error_text) ? (string) $error_text : '';
$class         = isset($class) ? (string) $class : '';
$required      = !empty($required);
$disabled      = !empty($disabled);
$readonly      = !empty($readonly);
$attributes    = isset($attributes) && is_array($attributes) ? $attributes : [];

$size_classes = [
  'default' => '',
  'md'      => '',
  'lg'      => 'textarea--lg',
];

$size_class = isset($size_classes[$size]) ? $size_classes[$size] : $size_classes['md'];
$root_class = trim($component_class . ' ' . $size_class . ' ' . $class);

$described_by = [];
if ($help_text !== '') {
  $described_by[] = $id . '-help';
}
if ($error_text !== '') {
  $described_by[] = $id . '-error';
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

$textarea_control_class = 'textarea__control' . ($error_text !== '' ? ' textarea__control--invalid' : '');
if (isset($attributes['class']) && is_string($attributes['class']) && trim($attributes['class']) !== '') {
  $textarea_control_class .= ' ' . trim($attributes['class']);
}

$textarea_attributes                     = $attributes;
$textarea_attributes['id']               = $id;
$textarea_attributes['name']             = $name;
$textarea_attributes['rows']             = (string) $rows;
$textarea_attributes['class']            = $textarea_control_class;
$textarea_attributes['placeholder']      = $placeholder;
$textarea_attributes['required']         = $required;
$textarea_attributes['disabled']         = $disabled;
$textarea_attributes['readonly']         = $readonly;
$textarea_attributes['aria-invalid']     = $error_text !== '' ? 'true' : null;
$textarea_attributes['aria-describedby'] = $described_by !== [] ? implode(' ', $described_by) : null;
?>
<div class="<?= e($root_class) ?>">
  <?php if ($label !== ''): ?>
    <label class="textarea__label" for="<?= e($id) ?>">
      <?= e($label) ?>
      <?php if ($required): ?>
        <span class="textarea__required" aria-hidden="true">*</span>
      <?php endif; ?>
    </label>
  <?php endif; ?>

  <textarea<?= $render_attributes($textarea_attributes) ?>><?= e($value) ?></textarea>

  <?php if ($help_text !== ''): ?>
    <p id="<?= e($id) ?>-help" class="textarea__help"><?= e($help_text) ?></p>
  <?php endif; ?>

  <?php if ($error_text !== ''): ?>
    <p id="<?= e($id) ?>-error" class="textarea__error"><?= e($error_text) ?></p>
  <?php endif; ?>
</div>
