<?php
// Acworth Water Damage Restoration — front controller / router. Plain PHP 8.
// Clean URLs, no trailing slash except the homepage. Slash forms of a
// no-slash route answer 308 to the no-slash form.
// Local only: no deploy, no domain, no external service calls.
$ROOT = __DIR__;
require $ROOT . '/data/pages.php';
require $ROOT . '/data/pages-full.php';
require $ROOT . '/data/media.php';
require $ROOT . '/includes/functions.php';

$PAGES = build_pages();
$SERVICES_BY_SLUG = [];
foreach ($SERVICES as $s) $SERVICES_BY_SLUG[$s['slug']] = $s;

$rawPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = rawurldecode($rawPath);

// 1. Slash form of a no-slash route -> 308 to the no-slash form.
if ($path !== '/' && strlen($path) > 1 && str_ends_with($path, '/')) {
    $target = rtrim($path, '/');
    header('Location: ' . $target, true, 308);
    exit;
}

// 2. Sitemap (dynamic, loc + date-only lastmod + image entries).
// SEO FIX 2026-11-13 (P2-2): pages that have a hero image declare it as
// <image:image><image:loc> (same URL as og:image). The 4 zero-image pages
// carry no image entry — their slots are still open for the image team.
// SITEMAP LASTMOD 2026-11-16: three REAL push-history dates, not one
// identical stamp on all 41 URLs (mass-content signal). 2026-11-16 =
// homepage + 10 most important services (the 7 footer services + the
// first 3 remaining services in $SERVICES order); 2026-11-15 = the
// remaining 15 services; everything else defaults to 2026-11-14
// (5 areas + /locations hub + 7 resources + /about + /contact).
// Counts: 11 + 15 + 15 = 41.
$SITEMAP_LASTMOD_2026_11_16 = ['/',
    '/emergency-water-extraction-acworth-ga',
    '/water-mitigation-acworth-ga',
    '/flood-damage-restoration-acworth-ga',
    '/burst-pipe-water-damage-acworth-ga',
    '/flooded-basement-cleanup-acworth-ga',
    '/sewage-backup-cleanup-acworth-ga',
    '/mold-remediation-acworth-ga',
    '/crawl-space-water-removal-acworth-ga',
    '/ceiling-water-damage-repair-acworth-ga',
    '/storm-roof-leak-water-damage-acworth-ga'];
$SITEMAP_LASTMOD_2026_11_15 = [
    '/water-heater-leak-cleanup-acworth-ga',
    '/appliance-leak-water-damage-acworth-ga',
    '/ac-leak-water-damage-acworth-ga',
    '/hardwood-floor-water-damage-acworth-ga',
    '/carpet-water-damage-acworth-ga',
    '/water-damage-repair-acworth-ga',
    '/commercial-water-damage-acworth-ga',
    '/lake-allatoona-water-damage',
    '/water-damage-insurance-claim-acworth-ga',
    '/mold-inspection-acworth-ga',
    '/slab-leak-water-damage-acworth-ga',
    '/townhome-water-damage-acworth-ga',
    '/mobile-home-water-damage-acworth-ga',
    '/rental-property-water-damage-acworth-ga',
    '/fire-water-damage-acworth-ga'];
if ($path === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=utf-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";
    $all = array_merge(['/'], array_keys($PAGES));
    foreach ($all as $slug) {
        $hero = page_img($slug, 'hero');
        $lastmod = in_array($slug, $SITEMAP_LASTMOD_2026_11_16, true) ? '2026-11-16'
            : (in_array($slug, $SITEMAP_LASTMOD_2026_11_15, true) ? '2026-11-15' : '2026-11-14');
        echo '  <url><loc>' . esc(site_url($slug)) . '</loc><lastmod>' . $lastmod . '</lastmod>';
        if ($hero) echo '<image:image><image:loc>' . esc(site_url($hero['src'])) . '</image:loc></image:image>';
        echo '</url>' . "\n";
    }
    echo '</urlset>';
    exit;
}

// 3. Static files (assets, favicons, manifest, robots, llms).
$MIME = [
    'css' => 'text/css', 'js' => 'text/javascript', 'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg', 'png' => 'image/png', 'ico' => 'image/x-icon',
    'svg' => 'image/svg+xml', 'json' => 'application/manifest+json',
    'woff2' => 'font/woff2',
    'webmanifest' => 'application/manifest+json', 'txt' => 'text/plain',
    'xml' => 'application/xml',
];
$isStatic = str_starts_with($path, '/assets/') ||
    in_array($path, ['/favicon.ico', '/favicon.svg', '/favicon-16x16.png', '/favicon-32x32.png',
        '/favicon-48x48.png', '/favicon-192x192.png', '/favicon-512x512.png',
        '/apple-touch-icon.png', '/site.webmanifest', '/robots.txt', '/llms.txt',
        '/6aa940faa13a339621b16a5bd98b6d0f.txt'], true);
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

// 4. Lead/contact forms POST straight to the Google Sheets webhook
// (Apps Script) from the browser — there is no PHP form handling here.
// The live site is static (Cloudflare Pages), so a PHP POST endpoint
// could never run live anyway; the old lead-handler.php is deleted.
// (Section 4 intentionally has no code.)

// 5. Routes.
if ($path === '/') {
    render_home();
    exit;
}
if (isset($PAGES[$path])) {
    render_page($path, $PAGES[$path]);
    exit;
}

// 6. 404.
http_response_code(404);
$HEAD = [
    'title' => 'Page Not Found | ' . $SITE['brand'],
    'description' => 'The page you asked for is not here. Call ' . $SITE['phone'] . ' for 24/7 emergency water damage help in Acworth, GA 30101 and 30102.',
    // DEEP FIX 2026-11-14 (P1-1/P2-1/P2-2): a 404 carries noindex and NO
    // homepage canonical/og:url — a 404 must never canonicalize to the
    // homepage (soft-404 signal). header.php omits both tags when
    // canonical is empty. Normal pages are untouched.
    'robots' => 'noindex, follow',
    'canonical' => null,
    'og_type' => 'website',
    // P3-6: error pages carry no business JSON-LD.
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
function hero_buttons($formTarget = '#request-service', $label = 'Request Emergency Help') {
    global $SITE;
    return '<div class="hero-ctas">' .
        '<a class="btn btn-ocean" href="' . esc($SITE['phone_href']) . '">' . esc($SITE['phone']) . '</a>' .
        '<a class="btn btn-cream" href="' . esc($formTarget) . '">' . esc($label) . '</a>' .
        '</div>';
}

function call_strip() {
    global $SITE;
    return '<section class="call-strip"><div class="container">' .
        '<p>Call ' . esc($SITE['phone']) . ' now for water damage in Acworth, GA 30101 and 30102. A crew is dispatched immediately.</p>' .
        '<a class="btn btn-navy" href="' . esc($SITE['phone_href']) . '">' . esc($SITE['phone']) . '</a>' .
        '</div></section>';
}

function final_cta_compact($formTarget = '#request-service', $withForm = false, $btn2 = 'Request Emergency Help', $showH2 = false, $slug = '/', $showPara = false) {
    global $FINAL_CTA_H2, $FINAL_CTA_PARAS, $ROOT;
    $out = '<section class="final-cta"><div class="container"><div class="final-cta-card">';
    // FINAL-CTA FIX 2026-11-16: the card's H2 / paragraph render only
    // when the caller passes $showH2 / $showPara — i.e. only when the
    // page's own tab contains that exact string AND the body has not
    // already shown it. Defaults are off (no template words unless a
    // caller opts in with a data-driven reason). render_page passes
    // false for both; render_home prints the homepage tab's own words
    // inline instead of calling this function.
    if ($showH2) $out .= '<h2>' . esc($FINAL_CTA_H2) . '</h2>';
    if ($showPara) $out .= '<p>' . esc($FINAL_CTA_PARAS[0]) . '</p>';
    // DEEP FIX 2026-11-14 (P3-10): the final CTA uses the page's own
    // Button 2 text ($btn2) so hero and final CTA match on every page.
    $out .= hero_buttons($formTarget, $btn2);
    $out .= '</div>';
    // AZ P2-5: pages with no hero form convert in place — the compact
    // final CTA carries the same compact lead form the service hero does.
    // $slug is this page's slug: the compact form's hidden "page" /
    // "return_url" fields must carry THIS page's URL, not the homepage's
    // (lead-form.php reads $currentSlug, which is out of scope in this
    // function without it).
    if ($withForm) {
        $formCompact = true;
        $currentSlug = $slug;
        ob_start();
        require $ROOT . '/includes/lead-form.php';
        $out .= '<div class="form-wrap">' . ob_get_clean() . '</div>';
        $formCompact = false;
    }
    $out .= '</div></section>';
    return $out;
}

function render_home() {
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
        'ld' => ld_json([ld_local_business(ld_offer_catalog()), ld_website(), ld_webpage('/', ['title' => $HOME_META['title'], 'description' => $HOME_META['description']], 'WebPage', null, false), ld_faq($FAQS, '/'), ld_howto($PROCESS_H2, $PROCESS_INTRO, $PROCESS_STEPS, '/'), ld_speakable()]),
    ];
    $currentSlug = '/';
    $show_map = true;
    require $ROOT . '/includes/header.php';
    ?>
<section class="hero">
  <?php if ($homeHero): ?><div class="hero-media"><?= hero_img_tag($homeHero, 'fetchpriority="high"') ?></div><?php endif; ?>
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
<section class="section"><div class="container content-block">
  <h2><?= esc($QUICK['h2']) ?></h2>
  <?php foreach ($QUICK['paras'] as $p): ?><p><?= esc($p) ?></p><?php endforeach; ?>
  <h3><?= esc($QUICK['h3']) ?></h3>
  <dl class="quick-list">
    <?php foreach ($QUICK['defs'] as $d): ?>
    <div><dt><?= esc($d['label']) ?></dt><dd><?= esc($d['text']) ?></dd></div>
    <?php endforeach; ?>
  </dl>
</div></section>
<section class="section section-cream" id="services"><div class="container content-block">
  <h2><?= esc($SERVICES_H2) ?></h2>
  <p class="lead"><?= esc($SERVICES_INTRO) ?></p>
  <div class="cards">
    <?php foreach ($CARDS as $c): $cimg = card_img($c); ?>
    <article class="card">
      <?php if ($cimg): ?><div class="card-media"><?= img_tag($cimg, 1200, 675, 'lazy', '(max-width: 700px) 348px, 313px') ?></div><?php else: ?><div class="card-media card-media--empty" aria-hidden="true"></div><?php endif; ?>
      <div class="card-body"><h3><?= esc($c['h3']) ?></h3><?= card_para_multi($c, $SERVICES_BY_SLUG, '/') ?></div>
    </article>
    <?php endforeach; ?>
  </div>
  <p class="services-close"><?= esc($SERVICES_CLOSE) ?></p>
</div></section>
<section class="section"><div class="container content-block">
  <h2><?= esc($CAUSES_H2) ?></h2>
  <p class="lead"><?= esc($CAUSES_INTRO) ?></p>
  <?= bullets_labeled_html($CAUSES) ?>
</div></section>
<section class="section section-cream"><div class="container content-block">
  <h2><?= esc($SIGNS_H2) ?></h2>
  <p class="lead"><?= esc($SIGNS_INTRO) ?></p>
  <?= bullets_html($SIGNS) ?>
  <p><?= esc($SIGNS_CLOSE) ?></p>
</div></section>
<section class="section section-navy"><div class="container content-block">
  <h2><?= esc($PROCESS_H2) ?></h2>
  <p class="lead"><?= esc($PROCESS_INTRO) ?></p>
  <div class="phase-grid">
    <?php foreach ($PROCESS_STEPS as $i => $s): $pimg = page_img('process-' . ($i + 1), 'img'); ?>
    <div class="phase-card">
      <?php if ($pimg): ?><div class="phase-media"><?= img_tag($pimg, 1200, 675, 'lazy', '(max-width: 700px) 348px, 230px') ?></div><?php else: ?><div class="phase-media phase-media--empty" aria-hidden="true"></div><?php endif; ?>
      <p class="step-title"><?= ($i + 1) ?>. <?= esc($s['label']) ?></p><p><?= esc($s['text']) ?></p>
    </div>
    <?php endforeach; ?>
  </div>
  <p class="process-close"><?= esc($PROCESS_CLOSE) ?></p>
</div></section>
<section class="section"><div class="container content-block">
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
<section class="section section-tint"><div class="container content-block">
  <h2><?= esc($EQUIPMENT_H2) ?></h2>
  <?= bullets_html($EQUIPMENT) ?>
</div></section>
<section class="section"><div class="container content-block">
  <h2><?= esc($ZIPS_H2) ?></h2>
  <p class="lead"><?= esc($ZIPS_INTRO) ?></p>
  <?php foreach ($ZIPS_PARAS as $p): ?><p><?= esc($p) ?></p><?php endforeach; ?>
  <p><?= esc($ZIPS_CLOSE) ?></p>
</div></section>
<section class="section section-cream"><div class="container content-block">
  <h2><?= esc($SCENARIOS_H2) ?></h2>
  <div class="scenario-grid">
  <?php foreach ($SCENARIOS as $sc): ?>
  <div class="scenario-card"><h3><?= esc($sc['h3']) ?></h3><p><?= esc($sc['text']) ?></p></div>
  <?php endforeach; ?>
  </div>
</div></section>
<section class="section"><div class="container content-block">
  <h2><?= esc($PAYS_H2) ?></h2>
  <?php foreach ($PAYS as $pay): ?>
  <h3><?= esc($pay['h3']) ?></h3>
  <?= render_para($pay['para'], '/') ?>
  <?php endforeach; ?>
</div></section>
<section class="section section-tint"><div class="container content-block">
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
<section class="section"><div class="container content-block">
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
    <div class="area-card-link">
      <div class="area-card">
        <?php if ($aimg): ?><?= img_tag($aimg, 1200, 675, 'lazy', '(max-width: 700px) 165px, 184px') ?><?php endif; ?>
        <span><?= esc($a['city']) ?>, GA</span>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div></section>
<section class="section section-cream"><div class="container content-block">
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
<?php // FINAL-CTA FIX 2026-11-16: this H2 + paragraph ARE the homepage
   // tab's own last two blocks (tabs-parsed.json tab 1) — the homepage
   // renders them nowhere else, so they appear exactly once, here. ?>
<section class="final-cta"><div class="container"><div class="final-cta-card">
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

function render_page($slug, $page) {
    global $ROOT, $SITE, $HOME_META, $PAGES, $AREAS;
    $meta = page_meta($slug, $PAGES);
    $type = $page['type'];
    $isContact = ($slug === '/contact');
    $isService = ($type === 'service');
    $crumbs = [['label' => 'Home', 'href' => '/']];
    if (!empty($page['parent'])) $crumbs[] = $page['parent'];
    if ($isService) {
        $crumbLabel = $page['summary']['nav'] ?? $page['nav'] ?? $page['h1'];
    } elseif ($type === 'area') {
        $crumbLabel = $page['area']['city'] . ', GA';
    } elseif ($type === 'area-hub') {
        $crumbLabel = 'Service Areas';
    } else {
        $crumbLabel = $page['h1'];
    }
    $crumbs[] = ['label' => $crumbLabel];
    // Chain 3 schema fix 2026-11-14: WebPage (+ AboutPage/ContactPage) on
    // every route; Service with @id/url/description, provider as a bare
    // #business @id, full areaServed and its own hero image; Article on
    // resource pages; HowTo only where the doc yields clean verbatim steps.
    $graph = [ld_local_business()];
    $webpageType = ($slug === '/about') ? 'AboutPage' : (($slug === '/contact') ? 'ContactPage' : 'WebPage');
    $mainEntityId = null;
    if ($isService) {
        // P2-6: serviceType from the page's own H1 on the 3 mislabelled
        // pages only; the other 22 keep 'Water Damage Restoration'.
        $serviceType = match ($slug) {
            '/fire-water-damage-acworth-ga' => 'Fire Damage Restoration',
            '/mold-inspection-acworth-ga' => 'Mold Inspection',
            '/water-damage-insurance-claim-acworth-ga' => 'Water Damage Insurance Claim Help',
            default => 'Water Damage Restoration',
        };
        $graph[] = ld_service($slug, $page['h1'], $meta['description'],
            ['serviceType' => $serviceType, 'areaServed' => ld_area_served_full()]);
        $mainEntityId = site_url($slug) . '#service';
    }
    if ($type === 'area') {
        // P3-5: name is the page H1, not the generic service name.
        $graph[] = ld_service($slug, $page['h1'], $meta['description'],
            ['serviceType' => 'Water Damage Restoration', 'areaServed' => ld_area_served_city($page['area']['city'])]);
        $mainEntityId = site_url($slug) . '#service';
    }
    if ($type === 'resource') {
        $graph[] = ld_article($slug, $page['h1']);
        $mainEntityId = site_url($slug) . '#article';
    }
    $graph[] = ld_breadcrumb($crumbs, $slug);
    $graph[] = ld_webpage($slug, $meta, $webpageType, $mainEntityId, true);
    if (!empty($page['faqs'])) {
        $graph[] = ld_faq($page['faqs'], $slug);
    }
    // P2-8: HowTo only where the doc prose yields clean verbatim steps;
    // a null return means the candidate was skipped (see the helpers).
    $howtoExtra = null;
    if ($slug === '/resources/water-damage-first-24-hours') $howtoExtra = howto_first24($page['blocks'] ?? []);
    elseif ($slug === '/locations/dallas-ga') $howtoExtra = howto_dallas_crawlspace($page['blocks'] ?? []);
    elseif ($slug === '/water-damage-insurance-claim-acworth-ga') $howtoExtra = howto_claim_process($page['blocks'] ?? []);
    if ($howtoExtra) $graph[] = ld_howto($howtoExtra['name'], $howtoExtra['description'], $howtoExtra['steps'], $slug);
    $pageHero = page_img($slug, 'hero');
    // DEEP FIX 2026-11-14 (P3-5): NO og:image fallback. The 4 pages with
    // no hero image (water-mitigation, crawl-space, ceiling, hardwood)
    // carry no og:image (and twitter:card falls back to summary in
    // header.php) — a share preview must not show a photo that is not on
    // the page. The sitemap already omits image:loc for them. The old
    // homepage-hero fallback is removed.
    $ogHero = $pageHero;
    $HEAD = [
        'title' => $meta['title'],
        'description' => $meta['description'],
        'canonical' => site_url($slug),
        'og_type' => 'website',
        'og_image' => $ogHero ? site_url($ogHero['src']) : null,
        'ld' => ld_json($graph),
    ];
    $currentSlug = $slug;
    $show_map = !in_array($type, ['area', 'area-hub'], true);
    // The lead form lives on the homepage + service pages; the contact page
    // has its own message form. AZ P2-5: area, hub, about and resource
    // pages carry the lead form in their compact final CTA, so Button 2
    // stays in-page there too instead of bouncing to the homepage form.
    $withForm = in_array($type, ['area', 'area-hub', 'about', 'resource'], true);
    $formTarget = ($isService || $isContact || $withForm) ? '#request-service' : '/#request-service';
    $btn2 = $page['buttons']['b2'] ?? 'Request Emergency Help';
    // DEEP FIX 2026-11-14 (P3-1/P3-2), generalised FINAL-CTA FIX
    // 2026-11-16: the final CTA's WORDS (H2 + paragraph) come only from
    // the page's own tab, and only when the body has not already shown
    // them. render_blocks() below renders EVERY block, so any tab CTA
    // word (the H2 on the cost / first-24-hours tabs, the city-specific
    // closing paragraphs on Kennesaw / Dallas) is already on the page
    // and the card must not repeat it — and any word the tab does NOT
    // contain is not doc content here and must not be added. Both card
    // copies are therefore off on every render_page page: derived from
    // the page's own blocks and the render flow, never from a slug list.
    // (The homepage is the exception: render_home renders no blocks, so
    // its tab CTA words live in the card — see render_home.)
    $showCtaH2 = false;
    $showCtaPara = false;
    $eyebrow = $page['eyebrow'] ?? $HOME_META['eyebrow'];
    require $ROOT . '/includes/header.php';
    if ($isService):
    ?>
<section class="hero hero-short hero-service">
  <?php if ($pageHero): ?><div class="hero-media"><?= hero_img_tag($pageHero, 'fetchpriority="high"') ?></div><?php endif; ?>
  <div class="container hero-content hero-service-grid">
    <div class="hero-service-main">
      <p class="eyebrow on-navy"><?= esc($eyebrow) ?></p>
      <h1><?= esc($page['h1']) ?></h1>
      <div class="hero-service-summary"><?= !empty($page['intro']) ? render_para_links($page['intro'], $slug) : '' ?></div>
      <?= hero_buttons($formTarget, $btn2) ?>
    </div>
    <div class="hero-service-form">
      <?php $formCompact = true; require $ROOT . '/includes/lead-form.php'; $formCompact = false; ?>
    </div>
  </div>
</section>
<?php else: ?>
<section class="hero hero-short">
  <?php if ($pageHero): ?><div class="hero-media"><?= hero_img_tag($pageHero, 'fetchpriority="high"') ?></div><?php endif; ?>
  <div class="container hero-content">
    <p class="eyebrow on-navy"><?= esc($eyebrow) ?></p>
    <h1><?= esc($page['h1']) ?></h1>
    <?= hero_buttons($formTarget, $btn2) ?>
  </div>
</section>
<?php endif; ?>
<section class="section section-doc"><div class="container content-block">
  <?= crumbs_html($crumbs) ?>
  <?php if (!$isService && !empty($page['intro'])): ?>
    <p class="lead"><?= linkify_multi($page['intro']['text'], $page['intro']['links'] ?? [], $slug) ?></p>
  <?php endif; ?>
  <?php
    $contactFormHtml = '';
    if ($isContact) {
        ob_start();
        require $ROOT . '/includes/contact-form.php';
        $contactFormHtml = ob_get_clean();
    }
    echo render_blocks($page['blocks'] ?? [], $slug, $contactFormHtml);
  ?>
  <?php if ($type === 'area-hub'): ?>
    <div class="area-strip">
      <?php foreach ($AREAS as $a): $aimg = page_img($a['slug'], 'card'); ?>
      <div class="area-card-link">
        <div class="area-card">
          <?php if ($aimg): ?><?= img_tag($aimg, 1200, 675, 'lazy', '(max-width: 700px) 165px, 184px') ?><?php endif; ?>
          <span><?= esc($a['city']) ?>, GA</span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div></section>
<?= call_strip() ?>
<?php if (!$isContact): ?>
<?= final_cta_compact($formTarget, $withForm, $btn2, $showCtaH2, $slug, $showCtaPara) ?>
<?php endif; ?>
<?php
    require $ROOT . '/includes/footer.php';
}
