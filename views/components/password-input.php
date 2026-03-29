<?php

$id            = isset($id) && $id !== '' ? (string) $id : 'password-' . uniqid();
$name          = isset($name) && $name !== '' ? (string) $name : $id;
$label         = isset($label) ? (string) $label : 'Password';
$value         = isset($value) ? (string) $value : '';
$placeholder   = isset($placeholder) ? (string) $placeholder : 'Enter password';
$help_text     = isset($help_text) ? (string) $help_text : '';
$error_text    = isset($error_text) ? (string) $error_text : '';
$required      = !empty($required);
$disabled      = !empty($disabled);
$autocomplete  = isset($autocomplete) ? (string) $autocomplete : 'current-password';
?>
<div class="<?= e($component_class) ?>">
  <?php
  component('input', [
    'id'           => $id,
    'name'         => $name,
    'label'        => $label,
    'type'         => 'password',
    'value'        => $value,
    'placeholder'  => $placeholder,
    'help_text'    => $help_text,
    'error_text'   => $error_text,
    'required'     => $required,
    'disabled'     => $disabled,
    'autocomplete' => $autocomplete,
    'class'        => 'password__input',
  ]);
  ?>
</div>
