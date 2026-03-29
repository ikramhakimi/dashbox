<?php

$title            = isset($title) ? (string) $title : 'Table';
$subtitle         = isset($subtitle) ? (string) $subtitle : '';
$actions_left_html  = isset($actions_left_html) ? trim((string) $actions_left_html) : '';
$actions_right_html = isset($actions_right_html) ? trim((string) $actions_right_html) : '';
$content_html       = isset($content_html) ? trim((string) $content_html) : '';
$table_headers    = is_array($table_headers ?? null) ? $table_headers : [];
$table_rows       = is_array($table_rows ?? null) ? $table_rows : [];
$record_label     = isset($record_label) && $record_label !== '' ? (string) $record_label : 'records';
$empty_message    = isset($empty_message) && $empty_message !== '' ? (string) $empty_message : 'No records found.';
$empty_title      = isset($empty_title) && $empty_title !== '' ? (string) $empty_title : 'No records to display';
$empty_deco       = isset($empty_deco) && $empty_deco !== '' ? (string) $empty_deco : '(o_o)';
$current_page     = isset($current_page) ? max(1, (int) $current_page) : 1;
$per_page         = isset($per_page) ? max(1, (int) $per_page) : 10;
$base_url         = isset($base_url) ? (string) $base_url : '#page=%d';
$total_records    = isset($total_records) ? max(0, (int) $total_records) : count($table_rows);
$show_pagination  = !isset($show_pagination) || !empty($show_pagination);
$show_footer      = !isset($show_footer) || !empty($show_footer);
$show_count_badge = !isset($show_count_badge) || !empty($show_count_badge);
$show_header      = !isset($show_header) || !empty($show_header);

$has_actions      = $actions_left_html !== '' || $actions_right_html !== '';
$has_content      = $content_html !== '';
$has_header       = $show_header && ($title !== '' || $subtitle !== '' || $show_count_badge);

$total_pages = max(1, (int) ceil($total_records / $per_page));
if ($current_page > $total_pages) {
  $current_page = $total_pages;
}

$from_item = $total_records > 0 ? (($current_page - 1) * $per_page) + 1 : 0;
$to_item   = $total_records > 0 ? min($current_page * $per_page, $total_records) : 0;
?>
<section class="<?= e($component_class) ?>">
  <?php if ($has_header): ?>
    <header class="card__header">
      <div>
        <?php if ($title !== ''): ?>
          <h2 class="text-xl font-semibold text-gray-900"><?= e($title) ?></h2>
        <?php endif; ?>
        <?php if ($subtitle !== ''): ?>
          <p class="mt-1 text-gray-500"><?= e($subtitle) ?></p>
        <?php endif; ?>
      </div>
      <?php if ($show_count_badge): ?>
        <span class="badge badge--neutral"><?= e((string) $total_records) ?> <?= e($record_label) ?></span>
      <?php endif; ?>
    </header>
  <?php endif; ?>

  <?php if ($has_actions): ?>
    <div class="card__actions">
      <div class="card__actions-left card__filters"><?= $actions_left_html ?></div>
      <div class="card__actions-right"><?= $actions_right_html ?></div>
    </div>
  <?php endif; ?>

  <?php if ($has_content): ?>
    <div class="card__content">
      <?= $content_html ?>
    </div>
  <?php endif; ?>

  <div class="card__table">
    <?php
    component('table', [
      'headers'       => $table_headers,
      'rows'          => $table_rows,
      'empty_message' => $empty_message,
      'empty_title'   => $empty_title,
      'empty_deco'    => $empty_deco,
    ]);
    ?>
  </div>

  <?php if ($show_footer): ?>
    <footer class="card__footer">
      <p class="text-sm text-gray-500">
        Showing <?= e((string) $from_item) ?> to <?= e((string) $to_item) ?>
        of <?= e((string) $total_records) ?> <?= e($record_label) ?>
      </p>
      <?php if ($show_pagination): ?>
        <?php
        component('pagination', [
          'current_page' => $current_page,
          'total_pages'  => $total_pages,
          'base_url'     => $base_url,
          'show_pages'   => true,
          'attributes'   => [
            'class' => 'justify-end',
          ],
        ]);
        ?>
      <?php endif; ?>
    </footer>
  <?php endif; ?>
</section>
