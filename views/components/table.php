<?php

$headers       = is_array($headers ?? null) ? $headers : [];
$rows          = is_array($rows ?? null) ? $rows : [];
$caption       = isset($caption) ? (string) $caption : '';
$empty_message = isset($empty_message) && $empty_message !== '' ? (string) $empty_message : 'No records found.';
$empty_title   = isset($empty_title) && $empty_title !== '' ? (string) $empty_title : 'Nothing here yet';
$empty_deco    = isset($empty_deco) && $empty_deco !== '' ? (string) $empty_deco : '(o_o)';
$zebra         = !empty($zebra);

$table_classes = [$component_class];
if ($zebra) {
  $table_classes[] = 'table--zebra';
}

$build_align_class = static function (string $align): string {
  if ($align === 'right') {
    return 'table__cell--right';
  }
  if ($align === 'center') {
    return 'table__cell--center';
  }
  return '';
};

$capture_badge = static function (string $label, string $mode): string {
  ob_start();
  component('badge', [
    'label' => $label,
    'mode'  => $mode,
  ]);
  return (string) ob_get_clean();
};
?>
<div class="table__container">
  <table class="<?= e(implode(' ', $table_classes)) ?>">
    <?php if ($caption !== ''): ?>
      <caption class="table__caption"><?= e($caption) ?></caption>
    <?php endif; ?>
    <thead class="table__head">
      <tr class="table__row table__row--head">
        <?php foreach ($headers as $header): ?>
          <?php
          $header_label = is_array($header) ? (string) ($header['label'] ?? '') : (string) $header;
          $header_align = is_array($header) ? (string) ($header['align'] ?? 'left') : 'left';
          $header_class = $build_align_class($header_align);
          ?>
          <th scope="col" class="table__cell table__cell--head <?= e($header_class) ?>">
            <?= e($header_label) ?>
          </th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody class="table__body">
      <?php if ($rows === []): ?>
        <tr class="table__row">
          <td class="table__cell table__cell--empty" colspan="<?= e((string) max(1, count($headers))) ?>">
            <div class="table__empty">
              <p class="table__empty-deco" aria-hidden="true"><?= e($empty_deco) ?></p>
              <p class="table__empty-title"><?= e($empty_title) ?></p>
              <p class="table__empty-hint"><?= e($empty_message) ?></p>
            </div>
          </td>
        </tr>
      <?php endif; ?>

      <?php foreach ($rows as $row): ?>
        <?php
        $cells = is_array($row['cells'] ?? null) ? $row['cells'] : [];
        $menu_items = is_array($row['menu_items'] ?? null) ? $row['menu_items'] : [];
        ?>
        <tr class="table__row">
          <?php foreach ($cells as $cell): ?>
            <?php
            $cell_align = is_array($cell) ? (string) ($cell['align'] ?? 'left') : 'left';
            $cell_class = $build_align_class($cell_align);
            ?>
            <td class="table__cell <?= e($cell_class) ?>">
              <?php if (is_array($cell) && isset($cell['html'])): ?>
                <?= (string) $cell['html'] ?>
              <?php elseif (is_array($cell) && isset($cell['badge']) && is_array($cell['badge'])): ?>
                <?php
                $badge_label = isset($cell['badge']['label']) ? (string) $cell['badge']['label'] : '-';
                $badge_mode  = isset($cell['badge']['mode']) ? (string) $cell['badge']['mode'] : 'neutral';
                $allowed_modes = ['positive', 'negative', 'neutral', 'warning', 'info', 'accent'];
                if (!in_array($badge_mode, $allowed_modes, true)) {
                  $badge_mode = 'neutral';
                }
                ?>
                <?= $capture_badge($badge_label, $badge_mode) ?>
              <?php elseif (is_array($cell) && (isset($cell['primary']) || isset($cell['secondary']) || isset($cell['tertiary']))): ?>
                <?php
                $primary   = isset($cell['primary']) ? (string) $cell['primary'] : '';
                $secondary = isset($cell['secondary']) ? (string) $cell['secondary'] : '';
                $tertiary  = isset($cell['tertiary']) ? (string) $cell['tertiary'] : '';
                ?>
                <div class="table__stack">
                  <?php if ($primary !== ''): ?>
                    <p class="table__primary"><?= e($primary) ?></p>
                  <?php endif; ?>
                  <?php if ($secondary !== ''): ?>
                    <p class="table__secondary"><?= e($secondary) ?></p>
                  <?php endif; ?>
                  <?php if ($tertiary !== ''): ?>
                    <p class="table__tertiary"><?= e($tertiary) ?></p>
                  <?php endif; ?>
                </div>
              <?php else: ?>
                <?php $cell_value = is_array($cell) ? (string) ($cell['value'] ?? '') : (string) $cell; ?>
                <?= e($cell_value) ?>
              <?php endif; ?>
            </td>
          <?php endforeach; ?>

          <?php if ($menu_items !== []): ?>
            <td class="table__cell table__cell--right">
              <?php
              component('dropdown', [
                'trigger_label'   => 'More',
                'align'           => 'right',
                'items'           => $menu_items,
              ]);
              ?>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
