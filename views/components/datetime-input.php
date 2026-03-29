<?php

$id            = isset($id) && $id !== '' ? (string) $id : 'datetime-' . uniqid();
$name          = isset($name) && $name !== '' ? (string) $name : $id;
$label         = isset($label) ? (string) $label : 'Date & Time';
$mode          = isset($mode) ? (string) $mode : 'datetime-local';
$value         = isset($value) ? (string) $value : '';
$help_text     = isset($help_text) ? (string) $help_text : '';
$error_text    = isset($error_text) ? (string) $error_text : '';
$required      = !empty($required);
$disabled      = !empty($disabled);

$allowed_modes = ['date', 'time', 'datetime-local'];
if (!in_array($mode, $allowed_modes, true)) {
  $mode = 'datetime-local';
}
?>
<div class="<?= e($component_class) ?>">
  <?php
  component('input', [
    'id'        => $id,
    'name'      => $name,
    'label'     => $label,
    'type'      => $mode,
    'value'     => $value,
    'help_text' => $help_text,
    'error_text'=> $error_text,
    'required'  => $required,
    'disabled'  => $disabled,
    'class'     => 'datetime__input',
  ]);
  ?>
</div>
