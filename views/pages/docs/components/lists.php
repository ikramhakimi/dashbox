<?php

$page_title   = 'Lists';
$page_current = 'lists';

$menu_items = build_main_menu_items($page_current);

layout('app-start', [
  'page_title'   => $page_title,
  'page_current' => $page_current,
]);
?>
    <section class="card">
      <header class="card__head">
        <h1 class="mt-2 type-h1">List UI</h1>
        <p class="mt-2 max-w-3xl type-body">
          Structured list rows for concise item overviews with optional metadata and right-aligned content.
        </p>
      </header>

      <section class="card__list" aria-label="List component showcase">
        <ul class="list">
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Default</h2>
            <p class="mt-1 text-muted">
              Compact list rows for dense feeds and activity timelines.
            </p>
          </header>

          <div class="card">
            <div class="card__head">
              <h3 class="card__title">Recent Deliverables</h3>
              <p class="card__description">Latest output from studio projects.</p>
            </div>
            <div class="card__list">
              <ul class="list">
                <li class="list__item">
                  <div class="list__main">
                    <p class="list__title">Corporate Team Portraits</p>
                    <p class="list__meta">Delivered 2 hours ago</p>
                  </div>
                  <div class="list__aside">42 files</div>
                </li>
                <li class="list__item">
                  <div class="list__main">
                    <p class="list__title">Wedding Highlights Edit</p>
                    <p class="list__meta">Pending client approval</p>
                  </div>
                  <div class="list__aside">18 files</div>
                </li>
                <li class="list__item">
                  <div class="list__main">
                    <p class="list__title">Family Session Album</p>
                    <p class="list__meta">Queued for export</p>
                  </div>
                  <div class="list__aside">27 files</div>
                </li>
              </ul>
            </div>
          </div>
        </article>
            </section>
          </li>
          <li class="list__item">
            <section class="w-full max-w-4xl py-4">
        <article class="space-y-4 py-7 first:pt-0 last:pb-0">
          <header>
            <h2 class="type-h2">Comfortable</h2>
            <p class="mt-1 text-muted">
              Relaxed spacing for profile or team assignment lists.
            </p>
          </header>

          <div class="card">
            <div class="card__head">
              <h3 class="card__title">Assigned Editors</h3>
              <p class="card__description">People currently attached to active projects.</p>
            </div>
            <div class="card__list">
              <ul class="list list--comfortable">
                <li class="list__item">
                  <div class="flex min-w-0 items-center gap-3">
                    <?php component('avatar', ['name' => 'Aisyah Rahman', 'size' => 'sm']); ?>
                    <div class="list__main">
                      <p class="list__title">Aisyah Rahman</p>
                      <p class="list__meta">Lead Retoucher</p>
                    </div>
                  </div>
                  <div class="list__aside">12 projects</div>
                </li>
                <li class="list__item">
                  <div class="flex min-w-0 items-center gap-3">
                    <?php component('avatar', ['name' => 'Farid Salleh', 'size' => 'sm']); ?>
                    <div class="list__main">
                      <p class="list__title">Farid Salleh</p>
                      <p class="list__meta">Color Specialist</p>
                    </div>
                  </div>
                  <div class="list__aside">9 projects</div>
                </li>
                <li class="list__item">
                  <div class="flex min-w-0 items-center gap-3">
                    <?php component('avatar', ['name' => 'Nadia Zulkifli', 'size' => 'sm']); ?>
                    <div class="list__main">
                      <p class="list__title">Nadia Zulkifli</p>
                      <p class="list__meta">Album Designer</p>
                    </div>
                  </div>
                  <div class="list__aside">7 projects</div>
                </li>
              </ul>
            </div>
          </div>
        </article>
            </section>
          </li>
        </ul>
      </section>
    </section>
<?php layout('app-end'); ?>
