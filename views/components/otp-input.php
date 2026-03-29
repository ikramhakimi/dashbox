<?php

$label       = isset($label) ? (string) $label : 'Verification Code';
$name        = isset($name) && $name !== '' ? (string) $name : 'otp';
$length      = isset($length) ? max(4, min(8, (int) $length)) : 6;
$help_text   = isset($help_text) ? (string) $help_text : '';
$disabled    = !empty($disabled);
$required    = !empty($required);
?>
<div class="<?= e($component_class) ?>">
  <p class="otp__label"><?= e($label) ?></p>
  <div class="otp__group" role="group" aria-label="<?= e($label) ?>">
    <?php for ($i = 0; $i < $length; $i++): ?>
      <input
        type="text"
        inputmode="numeric"
        pattern="[0-9]*"
        maxlength="1"
        name="<?= e($name) ?>[]"
        class="otp__control"
        <?= $disabled ? 'disabled' : '' ?>
        <?= $required ? 'required' : '' ?>
      >
    <?php endfor; ?>
  </div>
  <?php if ($help_text !== ''): ?>
    <p class="otp__help"><?= e($help_text) ?></p>
  <?php endif; ?>
</div>
