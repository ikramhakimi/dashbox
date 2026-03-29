<?php

$headers = is_array($headers ?? null) ? $headers : [];
$rows    = is_array($rows ?? null) ? $rows : [];
?>
<div class="overflow-x-auto">
  <table class="<?= e($component_class) ?>">
    <thead>
      <tr>
        <?php foreach ($headers as $header): ?>
          <?php
          $header_label = is_array($header) ? (string) ($header['label'] ?? '') : (string) $header;
          $header_align = is_array($header) ? (string) ($header['align'] ?? '') : '';
          $header_attr  = $header_align === 'right' ? ' align="right"' : '';
          ?>
          <th<?= $header_attr ?>><?= e($header_label) ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row): ?>
        <?php
        $cells   = is_array($row['cells'] ?? null) ? $row['cells'] : [];
        $actions = is_array($row['actions'] ?? null) ? $row['actions'] : [];
        ?>
        <tr>
          <?php foreach ($cells as $cell): ?>
            <?php
            $cell_align = is_array($cell) ? (string) ($cell['align'] ?? '') : '';
            $cell_attr  = $cell_align === 'right' ? ' align="right"' : '';
            ?>
            <td<?= $cell_attr ?>>
              <?php if (is_array($cell) && (array_key_exists('primary', $cell) || array_key_exists('secondary', $cell))): ?>
                <?php
                $primary   = isset($cell['primary']) ? (string) $cell['primary'] : '';
                $secondary = isset($cell['secondary']) ? (string) $cell['secondary'] : '';
                $tertiary  = isset($cell['tertiary']) ? (string) $cell['tertiary'] : '';
                $has_media = !empty($cell['media_placeholder']);
                ?>
                <div class="<?= e($has_media ? 'flex items-center gap-3' : '') ?>">
                  <?php if ($has_media): ?>
                    <div class="h-16 aspect-[4/3] rounded-lg bg-gray-100 shrink-0"></div>
                  <?php endif; ?>
                  <div class="leading-tight">
                    <div><?= e($primary) ?></div>
                    <?php if ($secondary !== ''): ?>
                      <div class="mt-1 text-sm text-gray-500"><?= e($secondary) ?></div>
                    <?php endif; ?>
                    <?php if ($tertiary !== ''): ?>
                      <div class="mt-1 text-sm text-gray-500"><?= e($tertiary) ?></div>
                    <?php endif; ?>
                  </div>
                </div>
              <?php elseif (is_array($cell) && isset($cell['badge']) && is_array($cell['badge'])): ?>
                <?php
                $badge_label = isset($cell['badge']['label']) ? (string) $cell['badge']['label'] : '-';
                $badge_mode  = isset($cell['badge']['mode']) ? (string) $cell['badge']['mode'] : 'neutral';

                $allowed_modes = ['positive', 'negative', 'neutral', 'warning', 'info', 'accent'];
                if (!in_array($badge_mode, $allowed_modes, true)) {
                  $badge_mode = 'neutral';
                }
                ?>
                <span class="badge badge--<?= e($badge_mode) ?>"><?= e($badge_label) ?></span>
              <?php else: ?>
                <?php
                $cell_value = is_array($cell) ? (string) ($cell['value'] ?? '') : (string) $cell;
                ?>
                <?= e($cell_value) ?>
              <?php endif; ?>
            </td>
          <?php endforeach; ?>
          <?php if ($actions !== []): ?>
            <td>
              <div class="flex items-center gap-2">
                <?php foreach ($actions as $action): ?>
                  <?php
                  $action_label = isset($action['label']) ? (string) $action['label'] : 'Action';
                  $action_href  = isset($action['href']) ? (string) $action['href'] : '#';
                  $action_kind  = isset($action['kind']) ? (string) $action['kind'] : 'default';

                  $action_classes = $action_kind === 'danger'
                    ? 'rounded-md border border-rose-200 px-3 py-1.5 font-medium text-rose-700 hover:bg-rose-50'
                    : 'rounded-md border border-gray-200 px-3 py-1.5 font-medium text-gray-700 hover:bg-gray-100';
                  ?>
                  <a href="<?= e($action_href) ?>" class="<?= e($action_classes) ?>"><?= e($action_label) ?></a>
                <?php endforeach; ?>
              </div>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
