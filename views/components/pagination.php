<?php

$current_page = isset($current_page) ? max(1, (int) $current_page) : 1;
$total_pages  = isset($total_pages) ? max(1, (int) $total_pages) : 1;
$base_url     = isset($base_url) ? (string) $base_url : '#page=%d';
$show_info    = !empty($show_info);
$show_pages   = !empty($show_pages);
$total_items  = isset($total_items) ? max(0, (int) $total_items) : 0;
$per_page     = isset($per_page) ? max(1, (int) $per_page) : 10;
$attributes   = isset($attributes) && is_array($attributes) ? $attributes : [];

if ($current_page > $total_pages) {
  $current_page = $total_pages;
}

$build_page_url = static function (int $page) use ($base_url): string {
  if (strpos($base_url, '%d') !== false) {
    return sprintf($base_url, $page);
  }

  $glue = strpos($base_url, '?') === false ? '?' : '&';
  return $base_url . $glue . 'page=' . $page;
};

$pages = [];

if ($total_pages <= 7) {
  for ($i = 1; $i <= $total_pages; $i++) {
    $pages[] = $i;
  }
} else {
  $pages[] = 1;

  $start = max(2, $current_page - 1);
  $end   = min($total_pages - 1, $current_page + 1);

  if ($start > 2) {
    $pages[] = 'ellipsis';
  }

  for ($i = $start; $i <= $end; $i++) {
    $pages[] = $i;
  }

  if ($end < $total_pages - 1) {
    $pages[] = 'ellipsis';
  }

  $pages[] = $total_pages;
}

$from_item = $total_items > 0 ? (($current_page - 1) * $per_page) + 1 : 0;
$to_item   = $total_items > 0 ? min($current_page * $per_page, $total_items) : 0;

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

$root_attributes = $attributes;
$root_attributes['class'] = trim($component_class . ' ' . (($attributes['class'] ?? '')));
$root_attributes['aria-label'] = isset($attributes['aria-label']) ? (string) $attributes['aria-label'] : 'Pagination';

$render_control_button = static function (
  string $label,
  string $href,
  bool $disabled,
  string $aria_label
): string {
  ob_start();
  component('button', [
    'label'      => $label,
    'href'       => $href,
    'disabled'   => $disabled,
    'class'      => 'pagination__control-button',
    'attributes' => [
      'aria-label' => $aria_label,
    ],
  ]);
  return (string) ob_get_clean();
};
?>
<nav<?= $render_attributes($root_attributes) ?>>
  <?php if ($show_info): ?>
    <p class="pagination__info">
      Showing <?= e((string) $from_item) ?>-<?= e((string) $to_item) ?> of <?= e((string) $total_items) ?>
    </p>
  <?php endif; ?>

  <div class="pagination__controls">
    <?php $is_first = $current_page <= 1; ?>
    <?php $is_last = $current_page >= $total_pages; ?>
    <?php if ($show_pages): ?>
      <ul class="pagination__list">
        <li>
          <?= $render_control_button(
            'Prev',
            $is_first ? '#' : $build_page_url($current_page - 1),
            $is_first,
            'Previous page',
          ) ?>
        </li>

        <?php foreach ($pages as $page): ?>
          <?php if ($page === 'ellipsis'): ?>
            <li><span class="pagination__ellipsis" aria-hidden="true">...</span></li>
          <?php else: ?>
            <?php $is_active = $page === $current_page; ?>
            <li>
              <a
                href="<?= e($build_page_url((int) $page)) ?>"
                class="pagination__item<?= $is_active ? ' pagination__item--active' : '' ?>"
                aria-current="<?= $is_active ? 'page' : 'false' ?>"
              >
                <?= e((string) $page) ?>
              </a>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>

        <li>
          <?= $render_control_button(
            'Next',
            $is_last ? '#' : $build_page_url($current_page + 1),
            $is_last,
            'Next page',
          ) ?>
        </li>
      </ul>
    <?php else: ?>
      <div class="pagination__clamp">
        <?= $render_control_button(
          'Prev',
          $is_first ? '#' : $build_page_url($current_page - 1),
          $is_first,
          'Previous page',
        ) ?>

        <?= $render_control_button(
          'Next',
          $is_last ? '#' : $build_page_url($current_page + 1),
          $is_last,
          'Next page',
        ) ?>
      </div>
    <?php endif; ?>
  </div>
</nav>
