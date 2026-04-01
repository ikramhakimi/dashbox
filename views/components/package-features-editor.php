<?php

$editor_id           = isset($editor_id) && $editor_id !== '' ? (string) $editor_id : 'package-feature-editor-' . uniqid();
$features_seed       = isset($features_seed) && is_array($features_seed) ? $features_seed : [];
$max_features        = isset($max_features) ? max(1, (int) $max_features) : 8;
$preview_drawer_id   = isset($preview_drawer_id) ? (string) $preview_drawer_id : '';
$show_preview_trigger = !empty($show_preview_trigger) && $preview_drawer_id !== '';
?>
<div
  class="<?= e($component_class) ?> feature-editor"
  id="<?= e($editor_id) ?>"
  data-feature-editor
  data-max-features="<?= e((string) $max_features) ?>"
>
  <div class="feature-editor__header">
    <div>
      <p class="input__label">Package Features</p>
      <p class="feature-editor__help">
        Add short feature points for public package cards.
      </p>
    </div>
  </div>

  <div class="feature-editor__list" data-feature-list>
    <?php foreach ($features_seed as $feature_index => $feature_value): ?>
      <div class="feature-editor__item" data-feature-item>
        <div class="input-group feature-editor__group">
          <div class="input-group__field">
            <span class="feature-editor__prefix" data-feature-index>
              <?= e((string) ($feature_index + 1)) ?>.
            </span>
            <input
              type="text"
              class="input__control feature-editor__input feature-editor__input--indexed"
              name="package_features[]"
              value="<?= e((string) $feature_value) ?>"
              maxlength="80"
              placeholder="Feature text"
              aria-label="Feature <?= e((string) ($feature_index + 1)) ?>"
            >
          </div>
        </div>
        <button
          type="button"
          class="feature-editor__remove"
          data-feature-remove
          aria-label="Remove feature"
        >
          <?php component('icon', ['icon_name' => 'trash', 'icon_size' => 16]); ?>
        </button>
      </div>
    <?php endforeach; ?>
  </div>

  <template data-feature-template>
    <div class="feature-editor__item" data-feature-item>
      <div class="input-group feature-editor__group">
        <div class="input-group__field">
          <span class="feature-editor__prefix" data-feature-index>1.</span>
          <input
            type="text"
            class="input__control feature-editor__input feature-editor__input--indexed"
            name="package_features[]"
            maxlength="80"
            placeholder="Feature text"
          >
        </div>
      </div>
      <button
        type="button"
        class="feature-editor__remove"
        data-feature-remove
        aria-label="Remove feature"
      >
        <?php component('icon', ['icon_name' => 'trash', 'icon_size' => 16]); ?>
      </button>
    </div>
  </template>

  <div class="feature-editor__actions">
    <?php
    component('button', [
      'label'      => 'Add Feature',
      'type'       => 'button',
      'attributes' => ['data-feature-add' => true],
    ]);

    if ($show_preview_trigger) {
      component('button', [
        'label'      => 'Preview Card',
        'type'       => 'button',
        'attributes' => ['data-drawer-open' => $preview_drawer_id],
      ]);
    }
    ?>
    <p class="feature-editor__count" data-feature-count>0/<?= e((string) $max_features) ?></p>
  </div>
</div>
