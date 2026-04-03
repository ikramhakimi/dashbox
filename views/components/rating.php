<?php

$id         = isset($id) && $id !== '' ? (string) $id : 'rating-' . uniqid();
$name       = isset($name) && $name !== '' ? (string) $name : $id;
$label      = isset($label) ? (string) $label : '';
$value      = isset($value) ? max(0, (int) $value) : 0;
$max        = isset($max) ? max(1, (int) $max) : 5;
$help_text  = isset($help_text) ? (string) $help_text : '';
$error_text = isset($error_text) ? (string) $error_text : '';
$required   = !empty($required);
$disabled   = !empty($disabled);
$readonly   = !empty($readonly);
$class      = isset($class) ? trim((string) $class) : '';
$gradient_id = $id . '-star-gradient';

if ($value > $max) {
  $value = $max;
}

$described_by = [];
if ($help_text !== '') {
  $described_by[] = $id . '-help';
}
if ($error_text !== '') {
  $described_by[] = $id . '-error';
}
?>
<div class="<?= e(trim($component_class . ' ' . $class)) ?>" data-rating style="--rating-star-gradient: url(#<?= e($gradient_id) ?>);">
  <svg width="0" height="0" class="sr-only" aria-hidden="true" focusable="false">
    <defs>
      <linearGradient id="<?= e($gradient_id) ?>" x1="0%" y1="0%" x2="100%" y2="100%">
        <stop offset="0%" stop-color="#fcd34d" />
        <stop offset="40%" stop-color="#fbbf24" />
        <stop offset="60%" stop-color="#f59e0b" />
        <stop offset="100%" stop-color="#d97706" />
      </linearGradient>
    </defs>
  </svg>

  <?php if ($label !== ''): ?>
    <p class="rating__label">
      <?= e($label) ?>
      <?php if ($required): ?>
        <span class="rating__required" aria-hidden="true">*</span>
      <?php endif; ?>
    </p>
  <?php endif; ?>

  <?php if ($readonly): ?>
    <div class="rating__stars" aria-label="<?= e('Rating ' . $value . ' out of ' . $max) ?>">
      <?php for ($index = 1; $index <= $max; $index++): ?>
        <?php $star_class = $index <= $value ? 'rating__star rating__star--active' : 'rating__star'; ?>
        <span class="<?= e($star_class) ?>" aria-hidden="true">
          <?php component('icon', ['icon_name' => 'star-fill', 'icon_size' => 20, 'icon_set' => 'remix']); ?>
        </span>
      <?php endfor; ?>
    </div>
  <?php else: ?>
    <div class="rating__stars" data-rating-stars role="radiogroup" aria-invalid="<?= $error_text !== '' ? 'true' : 'false' ?>" <?= $described_by !== [] ? 'aria-describedby="' . e(implode(' ', $described_by)) . '"' : '' ?>>
      <?php for ($index = 1; $index <= $max; $index++): ?>
        <?php
        $radio_id    = $id . '-' . (string) $index;
        $is_checked  = $index === $value;
        $star_class  = $index <= $value ? 'rating__star rating__star--active' : 'rating__star';
        ?>
        <input
          class="rating__radio"
          type="radio"
          id="<?= e($radio_id) ?>"
          name="<?= e($name) ?>"
          value="<?= e((string) $index) ?>"
          data-rating-input
          <?= $is_checked ? 'checked' : '' ?>
          <?= $required ? 'required' : '' ?>
          <?= $disabled ? 'disabled' : '' ?>
        >
        <label class="<?= e($star_class) ?>" for="<?= e($radio_id) ?>" data-rating-star data-rating-value="<?= e((string) $index) ?>" aria-label="<?= e('Rate ' . $index . ' out of ' . $max) ?>">
          <?php component('icon', ['icon_name' => 'star-fill', 'icon_size' => 20, 'icon_set' => 'remix']); ?>
        </label>
      <?php endfor; ?>
    </div>
  <?php endif; ?>

  <?php if ($help_text !== ''): ?>
    <p id="<?= e($id) ?>-help" class="rating__hint input__help"><?= e($help_text) ?></p>
  <?php endif; ?>

  <?php if ($error_text !== ''): ?>
    <p id="<?= e($id) ?>-error" class="rating__error input__error"><?= e($error_text) ?></p>
  <?php endif; ?>
</div>
