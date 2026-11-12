<?php
// Acworth Water Damage Restoration — front controller / router. Plain PHP 8.
// Clean URLs, no trailing slash except the homepage. Slash forms of a
// no-slash route answer 308 to the no-slash form.
// Local only: no deploy, no domain, no external service calls.
$ROOT = __DIR__;
require $ROOT . '/data/pages.php';
require $ROOT . '/data/media.php';
require $ROOT . '/includes/functions.php';
require $ROOT . '/includes/lead-handler.php';

$PAGES = build_pages();
$SERVICES_BY_SLUG = [];
foreach ($SERVICES as $s) $SERVICES_BY_SLUG[$s['slug']] = $s;
$TODAY = date('Y-m-d');

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$rawPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = rawurldecode($rawPath);

// 1. Slash form of a no-slash route -> 308 to the no-slash form.
if ($path !== '/' && strlen($path) > 1 && str_ends_with($path, '/')) {
    $target = rtrim($path, '/');
    header('Location: ' . $target, true, 308);
    exit;
}

// 2. Sitemap (dynamic, loc + date-only lastmod).
if ($path === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=utf-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    $all = array_merge(['/'], array_keys($PAGES));
    foreach ($all as $slug) {
        echo '  <url><loc>' . esc(site_url($slug)) . '</loc><lastmod>' . $TODAY . '</lastmod></url>' . "\n";
    }
    echo '</urlset>';
    exit;
}

// 3. Static files (assets, favicons, manifest, robots, llms).
$MIME = [
    'css' => 'text/css', 'js' => 'text/javascript', 'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg', 'png' => 'image/png', 'ico' => 'image/x-icon',
    'svg' => 'image/svg+xml', 'json' => 'application/manifest+json',
    'webmanifest' => 'application/manifest+json', 'txt' => 'text/plain',
    'xml' => 'application/xml',
];
$isStatic = str_starts_with($path, '/assets/') ||
    in_array($path, ['/favicon.ico', '/favicon.svg', '/favicon-16x16.png', '/favicon-32x32.png',
        '/favicon-48x48.png', '/favicon-192x192.png', '/favicon-512x512.png',
        '/apple-touch-icon.png', '/site.webmanifest', '/robots.txt', '/llms.txt'], true);
if ($isStatic) {
    $file = $ROOT . $path;
    if (is_file($file)) {
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        header('Content-Type: ' . ($MIME[$ext] ?? 'application/octet-stream'));
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
    http_response_code(404);
    echo 'Not found';
    exit;
}

// 4. Lead form submission (homepage or any known page). No mail is sent;
// the renderer shows an honest notice instead.
$form = null;
if ($method === 'POST' && ($path === '/' || isset($PAGES[$path]))) {
    $form = handle_lead_post($_POST);
}

// 5. Routes.
if ($path === '/') {
    render_home($form);
    exit;
}
if (isset($PAGES[$path])) {
    render_page($path, $PAGES[$path], $form);
    exit;
}

// 6. 404.
http_response_code(404);
$HEAD = [
    'title' => 'Page Not Found | ' . $SITE['brand'],
    'description' => 'The page you asked for is not here. Call ' . $SITE['phone'] . ' for 24/7 emergency water damage help in Acworth, GA 30101 and 30102.',
    'canonical' => site_url('/'),
    'og_type' => 'website',
    'ld' => ld_json([ld_local_business()]),
];
$currentSlug = $path;
$show_map = false;
require $ROOT . '/includes/header.php';
?>
<section class="hero hero-short">
  <div class="container hero-content">
    <p class="eyebrow on-navy"><?= esc($HOME_META['eyebrow']) ?></p>
    <h1>Page Not Found</h1>
    <p class="hero-intro">The page you asked for is not here.</p>
    <div class="hero-ctas">
      <a class="btn btn-ocean" href="<?= esc($SITE['phone_href']) ?>"><?= esc($SITE['phone']) ?></a>
      <a class="btn btn-cream" href="/">Back to home</a>
    </div>
  </div>
</section>
<?php
require $ROOT . '/includes/footer.php';
exit;

// ---------------------------------------------------------------------------
function hero_buttons($formTarget = '#request-service') {
    global $SITE;
    return '<div class="hero-ctas">' .
        '<a class="btn btn-ocean" href="' . esc($SITE['phone_href']) . '">' . esc($SITE['phone']) . '</a>' .
        '<a class="btn btn-cream" href="' . esc($formTarget) . '">Request Emergency Help</a>' .
        '</div>';
}

function call_strip() {
    global $SITE;
    return '<section class="call-strip"><div class="container">' .
        '<p>Call ' . esc($SITE['phone']) . ' now for water damage in Acworth, GA 30101 and 30102. A crew is dispatched immediately.</p>' .
        '<a class="btn btn-navy" href="' . esc($SITE['phone_href']) . '">' . esc($SITE['phone']) . '</a>' .
        '</div></section>';
}

function final_cta_compact($formTarget = '#request-service') {
    global $FINAL_CTA_H2, $FINAL_CTA_PARAS;
    $out = '<section class="final-cta"><div class="container"><div class="final-cta-card reveal">';
    $out .= '<h2>' . esc($FINAL_CTA_H2) . '</h2>';
    $out .= '<p>' . esc($FINAL_CTA_PARAS[0]) . '</p>';
    $out .= hero_buttons($formTarget);
    $out .= '</div></div></section>';
    return $out;
}

function render_home($form = null) {
    global $ROOT, $SITE, $HOME_META, $TRUST, $QUICK, $CARDS, $SERVICES_BY_SLUG,
        $SERVICES_H2, $SERVICES_INTRO, $SERVICES_CLOSE, $CAUSES_H2, $CAUSES_INTRO,
        $CAUSES, $SIGNS_H2, $SIGNS_INTRO, $SIGNS, $SIGNS_CLOSE, $PROCESS_H2,
        $PROCESS_INTRO, $PROCESS_STEPS, $PROCESS_CLOSE, $MITIGATION_H2,
        $MITIGATION_TABLE, $MITIGATION_CLOSE, $DRYING_H2, $DRYING_TABLE,
        $DRYING_CLOSE, $CATEGORY_H2, $CATEGORY_TABLE, $CATEGORY_CLOSE,
        $EQUIPMENT_H2, $EQUIPMENT, $ZIPS_H2, $ZIPS_INTRO, $ZIPS_PARAS,
        $ZIPS_CLOSE, $SCENARIOS_H2, $SCENARIOS, $PAYS_H2, $PAYS, $COST_H2,
        $COST_PARA, $COST_INTRO, $COST_BULLETS, $FIRST_HOUR_H2, $FIRST_HOUR,
        $CHOOSING_H2, $CHOOSING_INTRO, $CHOOSING, $NEARBY_H2, $NEARBY_INTRO,
        $AREAS, $AREAS_HUB_LINE, $FAQ_H2, $FAQS, $FINAL_CTA_H2, $FINAL_CTA_PARAS;
    $homeHero = page_img('/', 'hero');
    $HEAD = [
        'title' => $HOME_META['title'],
        'description' => $HOME_META['description'],
        'canonical' => site_url('/'),
        'og_type' => 'website',
        'og_image' => $homeHero ? site_url($homeHero['src']) : null,
        'ld' => ld_json([ld_local_business(), ld_website(), ld_breadcrumb([['label' => 'Home', 'href' => '/']]), ld_faq($FAQS), ld_howto($PROCESS_H2, $PROCESS_INTRO, $PROCESS_STEPS), ld_speakable()]),
    ];
    $currentSlug = '/';
    $show_map = true;
    require $ROOT . '/includes/header.php';
    ?>
<section class="hero">
  <?php if ($homeHero): ?><div class="hero-media"><img src="<?= esc($homeHero['src']) ?>" alt="<?= esc($homeHero['alt']) ?>" width="1600" height="900" fetchpriority="high"></div><?php endif; ?>
  <div class="container hero-content">
    <p class="eyebrow on-navy"><?= esc($HOME_META['eyebrow']) ?></p>
    <h1><?= esc($HOME_META['h1']) ?></h1>
    <p class="hero-intro"><?= esc($HOME_META['intro']) ?></p>
    <?= hero_buttons() ?>
  </div>
</section>
<section class="trust-band"><div class="container"><ul>
  <?php foreach ($TRUST as $t): ?>
  <li><span class="check" aria-hidden="true">&#10003;</span><?= esc($t) ?></li>
  <?php endforeach; ?>
</ul></div></section>
<section class="section"><div class="container content-block reveal">
  <h2><?= esc($QUICK['h2']) ?></h2>
  <?php foreach ($QUICK['paras'] as $p): ?><p><?= esc($p) ?></p><?php endforeach; ?>
  <h3><?= esc($QUICK['h3']) ?></h3>
  <dl class="quick-list">
    <?php foreach ($QUICK['defs'] as $d): ?>
    <div><dt><?= esc($d['label']) ?></dt><dd><?= esc($d['text']) ?></dd></div>
    <?php endforeach; ?>
  </dl>
</div></section>
<section class="section section-cream"><div class="container content-block reveal">
  <h2><?= esc($SERVICES_H2) ?></h2>
  <p class="lead"><?= esc($SERVICES_INTRO) ?></p>
  <div class="cards">
    <?php foreach ($CARDS as $c): $cimg = card_img($c); ?>
    <article class="card">
      <?php if ($cimg): ?><div class="card-media"><?= img_tag($cimg, 1200, 675) ?></div><?php endif; ?>
      <div class="card-body"><h3><?= esc($c['h3']) ?></h3><?= card_para_multi($c, $SERVICES_BY_SLUG, '/') ?></div>
    </article>
    <?php endforeach; ?>
  </div>
  <p class="services-close"><?= esc($SERVICES_CLOSE) ?></p>
</div></section>
<section class="section"><div class="container content-block reveal">
  <h2><?= esc($CAUSES_H2) ?></h2>
  <p class="lead"><?= esc($CAUSES_INTRO) ?></p>
  <?= bullets_labeled_html($CAUSES) ?>
</div></section>
<section class="section section-cream"><div class="container content-block reveal">
  <h2><?= esc($SIGNS_H2) ?></h2>
  <p class="lead"><?= esc($SIGNS_INTRO) ?></p>
  <?= bullets_html($SIGNS) ?>
  <p><?= esc($SIGNS_CLOSE) ?></p>
</div></section>
<section class="section section-navy"><div class="container content-block reveal">
  <h2><?= esc($PROCESS_H2) ?></h2>
  <p class="lead"><?= esc($PROCESS_INTRO) ?></p>
  <div class="phase-grid">
    <?php foreach ($PROCESS_STEPS as $i => $s): $pimg = page_img('process-' . ($i + 1), 'img'); ?>
    <div class="phase-card">
      <?php if ($pimg): ?><div class="phase-media"><img src="<?= esc($pimg['src']) ?>" alt="<?= esc($pimg['alt']) ?>" width="1200" height="675" loading="lazy"></div><?php endif; ?>
      <p class="step-title"><?= ($i + 1) ?>. <?= esc($s['label']) ?></p><p><?= esc($s['text']) ?></p>
    </div>
    <?php endforeach; ?>
  </div>
  <p class="process-close"><?= esc($PROCESS_CLOSE) ?></p>
</div></section>
<section class="section"><div class="container content-block reveal">
  <h2><?= esc($MITIGATION_H2) ?></h2>
  <?= table_html($MITIGATION_TABLE) ?>
  <p><?= esc($MITIGATION_CLOSE) ?></p>
  <hr class="doc-divide">
  <h2><?= esc($DRYING_H2) ?></h2>
  <?= table_html($DRYING_TABLE) ?>
  <p><?= esc($DRYING_CLOSE) ?></p>
  <hr class="doc-divide">
  <h2><?= esc($CATEGORY_H2) ?></h2>
  <?= table_html($CATEGORY_TABLE) ?>
  <p><?= esc($CATEGORY_CLOSE) ?></p>
</div></section>
<section class="section section-tint"><div class="container content-block reveal">
  <h2><?= esc($EQUIPMENT_H2) ?></h2>
  <?= bullets_html($EQUIPMENT) ?>
</div></section>
<section class="section"><div class="container content-block reveal">
  <h2><?= esc($ZIPS_H2) ?></h2>
  <p class="lead"><?= esc($ZIPS_INTRO) ?></p>
  <?php foreach ($ZIPS_PARAS as $p): ?><p><?= esc($p) ?></p><?php endforeach; ?>
  <p><?= esc($ZIPS_CLOSE) ?></p>
</div></section>
<section class="section section-cream"><div class="container content-block reveal">
  <h2><?= esc($SCENARIOS_H2) ?></h2>
  <div class="scenario-grid">
  <?php foreach ($SCENARIOS as $sc): ?>
  <div class="scenario-card"><h3><?= esc($sc['h3']) ?></h3><p><?= esc($sc['text']) ?></p></div>
  <?php endforeach; ?>
  </div>
</div></section>
<section class="section"><div class="container content-block reveal">
  <h2><?= esc($PAYS_H2) ?></h2>
  <?php foreach ($PAYS as $pay): ?>
  <h3><?= esc($pay['h3']) ?></h3>
  <?= render_para($pay['para'], '/') ?>
  <?php endforeach; ?>
</div></section>
<section class="section section-tint"><div class="container content-block reveal">
  <h2><?= esc($COST_H2) ?></h2>
  <p><?= esc($COST_PARA) ?></p>
  <p><?= esc($COST_INTRO) ?></p>
  <?= bullets_html($COST_BULLETS) ?>
  <hr class="doc-divide">
  <h2><?= esc($FIRST_HOUR_H2) ?></h2>
  <?= bullets_html($FIRST_HOUR) ?>
  <hr class="doc-divide">
  <h2><?= esc($CHOOSING_H2) ?></h2>
  <p><?= esc($CHOOSING_INTRO) ?></p>
  <?= bullets_html($CHOOSING) ?>
</div></section>
<section class="section"><div class="container content-block reveal">
  <h2><?= esc($NEARBY_H2) ?></h2>
  <p><?= esc($NEARBY_INTRO) ?></p>
  <ul>
    <?php foreach ($AREAS as $a): ?>
    <li><?= linkify($a['line'], $a['anchor'], $a['slug'], '/') ?></li>
    <?php endforeach; ?>
  </ul>
  <?= render_para($AREAS_HUB_LINE, '/') ?>
  <div class="area-strip">
    <?php foreach ($AREAS as $a): $aimg = page_img($a['slug'], 'card'); ?>
    <a class="area-card-link" href="<?= esc($a['slug']) ?>">
      <div class="area-card">
        <?php if ($aimg): ?><?= img_tag($aimg, 1200, 675) ?><?php endif; ?>
        <span><?= esc($a['city']) ?>, GA</span>
      </div>
    </a>
    <?php endforeach; ?>
  </div>
</div></section>
<section class="section section-cream"><div class="container content-block reveal">
  <h2><?= esc($FAQ_H2) ?></h2>
  <div class="faq-list">
    <?php foreach ($FAQS as $f): ?>
    <details>
      <summary><h3><?= esc($f['q']) ?></h3><span class="faq-toggle" aria-hidden="true">+</span></summary>
      <div class="faq-answer"><p><?= esc($f['a']) ?></p></div>
    </details>
    <?php endforeach; ?>
  </div>
</div></section>
<?= call_strip() ?>
<section class="final-cta"><div class="container"><div class="final-cta-card reveal">
  <h2><?= esc($FINAL_CTA_H2) ?></h2>
  <?php foreach ($FINAL_CTA_PARAS as $p): ?><p><?= esc($p) ?></p><?php endforeach; ?>
  <?= hero_buttons() ?>
</div>
<div class="form-wrap">
  <?php require $ROOT . '/includes/lead-form.php'; ?>
</div></div></section>
<?php
    require $ROOT . '/includes/footer.php';
}

function render_page($slug, $page, $form = null) {
    global $ROOT, $SITE, $HOME_META, $PAGES, $AREAS, $NEARBY_INTRO, $AREAS_ZIP_LINE;
    $meta = page_meta($slug, $PAGES);
    $crumbs = [['label' => 'Home', 'href' => '/']];
    if (!empty($page['parent'])) $crumbs[] = $page['parent'];
    if ($page['type'] === 'service') {
        $crumbLabel = $page['summary']['nav'];
    } elseif ($page['type'] === 'area') {
        $crumbLabel = $page['area']['city'] . ', GA';
    } else {
        $crumbLabel = 'Service Areas';
    }
    $crumbs[] = ['label' => $crumbLabel];
    $graph = [ld_local_business(), ld_breadcrumb($crumbs)];
    if ($page['type'] === 'service') {
        $graph[] = ld_service($page['summary']['h3'], 'Acworth');
    }
    if ($page['type'] === 'area') {
        $graph[] = ld_service('Water Damage Restoration', $page['area']['city']);
    }
    $pageHero = page_img($slug, 'hero');
    $HEAD = [
        'title' => $meta['title'],
        'description' => $meta['description'],
        'canonical' => site_url($slug),
        'og_type' => 'website',
        'og_image' => $pageHero ? site_url($pageHero['src']) : null,
        'ld' => ld_json($graph),
    ];
    $currentSlug = $slug;
    $show_map = !in_array($page['type'], ['area', 'area-hub'], true);
    // The lead form lives on the homepage + service pages only. On area/hub
    // pages the "Request Emergency Help" button goes to the homepage form.
    $formTarget = ($page['type'] === 'service') ? '#request-service' : '/#request-service';
    require $ROOT . '/includes/header.php';
    if ($page['type'] === 'service'):
    ?>
<section class="hero hero-short hero-service">
  <?php if ($pageHero): ?><div class="hero-media"><img src="<?= esc($pageHero['src']) ?>" alt="<?= esc($pageHero['alt']) ?>" width="1600" height="900" fetchpriority="high"></div><?php endif; ?>
  <div class="container hero-content hero-service-grid">
    <div class="hero-service-main">
      <p class="eyebrow on-navy"><?= esc($HOME_META['eyebrow']) ?></p>
      <h1><?= esc($page['h1']) ?></h1>
      <div class="hero-service-summary"><?= card_para($page['summary'], $slug) ?></div>
      <?= hero_buttons($formTarget) ?>
    </div>
    <div class="hero-service-form">
      <?php $formCompact = true; require $ROOT . '/includes/lead-form.php'; $formCompact = false; ?>
    </div>
  </div>
</section>
<?php else: ?>
<section class="hero hero-short">
  <?php if ($pageHero): ?><div class="hero-media"><img src="<?= esc($pageHero['src']) ?>" alt="<?= esc($pageHero['alt']) ?>" width="1600" height="900" fetchpriority="high"></div><?php endif; ?>
  <div class="container hero-content">
    <p class="eyebrow on-navy"><?= esc($HOME_META['eyebrow']) ?></p>
    <h1><?= esc($page['h1']) ?></h1>
    <?= hero_buttons($formTarget) ?>
  </div>
</section>
<?php endif; ?>
<section class="section"><div class="container content-block reveal">
  <?= crumbs_html($crumbs) ?>
  <?php if ($page['type'] === 'area'): ?>
    <p><?= esc($page['area']['line']) ?></p>
  <?php elseif ($page['type'] === 'area-hub'): ?>
    <p><?= esc($NEARBY_INTRO) ?></p>
    <ul>
      <?php foreach ($AREAS as $a): ?>
      <li><?= linkify($a['line'], $a['anchor'], $a['slug'], $slug) ?></li>
      <?php endforeach; ?>
    </ul>
    <p><?= esc($AREAS_ZIP_LINE) ?></p>
    <div class="area-strip">
      <?php foreach ($AREAS as $a): $aimg = page_img($a['slug'], 'card'); ?>
      <a class="area-card-link" href="<?= esc($a['slug']) ?>">
        <div class="area-card">
          <?php if ($aimg): ?><?= img_tag($aimg, 1200, 675) ?><?php endif; ?>
          <span><?= esc($a['city']) ?>, GA</span>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <p class="back-home"><a href="/">Back to home</a></p>
</div></section>
<?= call_strip() ?>
<?= final_cta_compact($formTarget) ?>
<?php
    require $ROOT . '/includes/footer.php';
}
