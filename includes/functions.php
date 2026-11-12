<?php
// Acworth Water Damage Restoration — shared helpers. Written fresh for
// this site.

function esc($s) {
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}

function site_url($slug = '/') {
    global $SITE;
    $base = rtrim($SITE['url'], '/');
    if ($slug === '/' || $slug === '') return $base . '/';
    return $base . '/' . ltrim($slug, '/');
}

function phone_link($text = null) {
    global $SITE;
    $label = $text === null ? $SITE['phone'] : $text;
    return '<a href="' . esc($SITE['phone_href']) . '">' . esc($label) . '</a>';
}

// Wrap the FIRST occurrence of $anchor inside $text in a link.
// The words stay verbatim; only the short span becomes the anchor.
// If the link points at the page being rendered, no link is emitted at all
// (body copy never links to itself).
function linkify($text, $anchor, $href, $currentSlug = null) {
    if ($href === $currentSlug || $anchor === '' || $anchor === null) {
        return esc($text);
    }
    $pos = mb_strpos($text, $anchor);
    if ($pos === false) {
        return esc($text);
    }
    $before = mb_substr($text, 0, $pos);
    $after  = mb_substr($text, $pos + mb_strlen($anchor));
    return esc($before) . '<a href="' . esc($href) . '">' . esc($anchor) . '</a>' . esc($after);
}

// A paragraph array: ['text' => ..., 'anchor' => ..., 'href' => ...]
// or a plain string paragraph.
function render_para($para, $currentSlug = null) {
    if (is_string($para)) {
        return '<p>' . esc($para) . '</p>';
    }
    $html = '<p>';
    if (!empty($para['anchor']) && !empty($para['href'])) {
        $html .= linkify($para['text'], $para['anchor'], $para['href'], $currentSlug);
    } else {
        $html .= esc($para['text']);
    }
    return $html . '</p>';
}

// Service page paragraph: body + closing sentence verbatim, with only the
// short anchor span linked. An empty sentence (insurance page) renders
// the body alone.
function card_para($card, $currentSlug = null) {
    if (empty($card['sentence'])) {
        return '<p>' . esc($card['body']) . '</p>';
    }
    $sentence = linkify($card['sentence'], $card['anchor'], $card['slug'], $currentSlug);
    return '<p>' . esc($card['body']) . ' ' . $sentence . '.</p>';
}

// Homepage service card paragraph: body + one, two or three closing
// sentences verbatim. Two sentences join with ' and '; three join with
// ', ' then ' and ' — exactly as in the doc.
function card_para_multi($card, $servicesBySlug, $currentSlug = null) {
    $parts = [];
    foreach ($card['links'] as $slug) {
        $svc = $servicesBySlug[$slug] ?? null;
        if (!$svc) continue;
        $parts[] = linkify($svc['sentence'], $svc['anchor'], $svc['slug'], $currentSlug);
    }
    $joined = '';
    $n = count($parts);
    if ($n === 1) {
        $joined = $parts[0];
    } elseif ($n === 2) {
        $joined = $parts[0] . ' and ' . $parts[1];
    } elseif ($n >= 3) {
        $joined = $parts[0] . ', ' . $parts[1] . ' and ' . $parts[2];
    }
    return '<p>' . esc($card['body']) . ' ' . $joined . '.</p>';
}

function bullets_html($items) {
    $out = '<ul>';
    foreach ($items as $it) {
        $out .= '<li>' . esc($it) . '</li>';
    }
    return $out . '</ul>';
}

// Bullets with a bold label before the colon: [['label'=>..., 'text'=>...]]
function bullets_labeled_html($items) {
    $out = '<ul>';
    foreach ($items as $it) {
        $out .= '<li><strong>' . esc($it['label']) . ':</strong> ' . esc($it['text']) . '</li>';
    }
    return $out . '</ul>';
}

function table_html($table) {
    $out = '<div class="table-wrap"><table class="data-table"><thead><tr>';
    foreach ($table['headers'] as $h) {
        $out .= '<th scope="col">' . esc($h) . '</th>';
    }
    $out .= '</tr></thead><tbody>';
    foreach ($table['rows'] as $row) {
        $out .= '<tr>';
        foreach ($row as $i => $cell) {
            $out .= $i === 0
                ? '<th scope="row">' . esc($cell) . '</th>'
                : '<td>' . esc($cell) . '</td>';
        }
        $out .= '</tr>';
    }
    return $out . '</tbody></table></div>';
}

// ---- Page map: every route the site serves -------------------------------
// Skeleton pages reuse ONLY their doc-verbatim homepage summary as content.
// No words are invented for them; their full guides await their own docs.
function build_pages() {
    global $SERVICES, $AREAS;
    $pages = [];

    foreach ($SERVICES as $c) {
        $pages[$c['slug']] = [
            'type' => 'service', 'h1' => $c['h3'], 'kind' => 'service',
            'summary' => $c, 'parent' => null,
        ];
    }
    foreach ($AREAS as $a) {
        $pages[$a['slug']] = [
            'type' => 'area',
            'h1' => 'Water Damage Restoration in ' . $a['city'] . ', GA',
            'kind' => 'area', 'area' => $a,
            'parent' => ['label' => 'Service Areas', 'href' => '/locations'],
        ];
    }
    $pages['/locations'] = [
        'type' => 'area-hub',
        'h1' => 'Service Areas near Acworth, GA',
        'kind' => 'area-hub', 'parent' => null,
    ];
    return $pages;
}

// Trim a description to <=160 chars without changing any word: cut at the
// last sentence boundary that fits, else the last word boundary.
function meta_desc($text) {
    $text = trim($text);
    if (mb_strlen($text) <= 160) return $text;
    $cut = mb_substr($text, 0, 160);
    $dot = mb_strrpos($cut, '. ');
    if ($dot !== false && $dot >= 40) return mb_substr($cut, 0, $dot + 1);
    $sp = mb_strrpos($cut, ' ');
    if ($sp !== false) return mb_substr($cut, 0, $sp);
    return $cut;
}

function page_meta($slug, $pages) {
    global $HOME_META, $SITE;
    if ($slug === '/') {
        return ['title' => $HOME_META['title'], 'description' => $HOME_META['description']];
    }
    $p = $pages[$slug];
    // Titles are the H1 alone: every H1 is <=51 chars, so all titles fit <=60.
    // (The old ' | Brand' suffix pushed all 25 inner titles to 62-86 chars.)
    if ($p['type'] === 'service') {
        return ['title' => $p['h1'],
                'description' => meta_desc($p['summary']['desc'] ?? $p['summary']['body'])];
    }
    if ($p['type'] === 'area') {
        return ['title' => $p['h1'],
                'description' => 'Water damage restoration in ' . $p['area']['city'] . ', GA. Call ' . $SITE['phone'] . ' now.'];
    }
    if ($p['type'] === 'area-hub') {
        return ['title' => $p['h1'],
                'description' => meta_desc('Water damage restoration across Acworth, GA 30101 and 30102 and nearby cities in Cobb, Cherokee, Bartow and Paulding counties. Call ' . $SITE['phone'] . ' now.')];
    }
    return ['title' => $p['h1'],
            'description' => 'Water damage restoration in Acworth, GA 30101 and 30102. Call ' . $SITE['phone'] . ' now.'];
}

// ---- JSON-LD -------------------------------------------------------------
function ld_local_business() {
    global $SITE;
    return [
        '@type' => 'LocalBusiness',
        '@id' => site_url('/') . '#business',
        'name' => $SITE['brand'],
        'description' => '24/7 emergency water damage restoration in Acworth, GA 30101 and 30102. Crew dispatched immediately.',
        'telephone' => $SITE['phone'],
        'url' => site_url('/'),
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Acworth',
            'addressRegion' => 'GA',
            'postalCode' => '30101',
            'addressCountry' => 'US',
        ],
        'areaServed' => [
            ['@type' => 'City', 'name' => 'Acworth'],
            ['@type' => 'City', 'name' => 'Kennesaw'],
            ['@type' => 'City', 'name' => 'Woodstock'],
            ['@type' => 'City', 'name' => 'Cartersville'],
            ['@type' => 'City', 'name' => 'Dallas'],
            ['@type' => 'City', 'name' => 'Hiram'],
            ['@type' => 'AdministrativeArea', 'name' => 'Cobb County'],
            ['@type' => 'AdministrativeArea', 'name' => 'Cherokee County'],
        ],
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'opens' => '00:00', 'closes' => '23:59',
        ],
    ];
}

function ld_website() {
    global $SITE;
    return [
        '@type' => 'WebSite',
        '@id' => site_url('/') . '#website',
        'url' => site_url('/'),
        'name' => $SITE['brand'],
    ];
}

function ld_breadcrumb($crumbs) {
    $items = [];
    $i = 1;
    foreach ($crumbs as $c) {
        $item = ['@type' => 'ListItem', 'position' => $i, 'name' => $c['label']];
        if (!empty($c['href'])) $item['item'] = site_url($c['href']);
        $items[] = $item;
        $i++;
    }
    return ['@type' => 'BreadcrumbList', 'itemListElement' => $items];
}

function ld_faq($faqs) {
    $items = [];
    foreach ($faqs as $f) {
        $items[] = [
            '@type' => 'Question',
            'name' => $f['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
        ];
    }
    return ['@type' => 'FAQPage', 'mainEntity' => $items];
}

function ld_howto($name, $description, $steps) {
    $items = [];
    foreach ($steps as $s) {
        $items[] = [
            '@type' => 'HowToStep',
            'name' => $s['label'],
            'text' => $s['text'],
        ];
    }
    return ['@type' => 'HowTo', 'name' => $name, 'description' => $description, 'step' => $items];
}

function ld_speakable() {
    return [
        '@type' => 'SpeakableSpecification',
        'cssSelector' => ['.hero-intro', '.faq-list h3'],
    ];
}

function ld_service($name, $areaName) {
    global $SITE;
    return [
        '@type' => 'Service',
        'name' => $name,
        'serviceType' => 'Water Damage Restoration',
        'provider' => [
            '@type' => 'LocalBusiness',
            'name' => $SITE['brand'],
            'telephone' => $SITE['phone'],
        ],
        'areaServed' => ['@type' => 'City', 'name' => $areaName],
    ];
}

function ld_json($graph) {
    $data = ['@context' => 'https://schema.org', '@graph' => $graph];
    return '<script type="application/ld+json">' .
        json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) .
        '</script>';
}

// Visible breadcrumb trail. Header/footer, exempt from the body-copy link rule.
function crumbs_html($crumbs) {
    $out = '<nav class="crumbs" aria-label="Breadcrumb">';
    $first = true;
    foreach ($crumbs as $c) {
        if (!$first) $out .= '<span aria-hidden="true">›</span> ';
        $first = false;
        if (!empty($c['href'])) {
            $out .= '<a href="' . esc($c['href']) . '">' . esc($c['label']) . '</a>';
        } else {
            $out .= '<span aria-current="page">' . esc($c['label']) . '</span>';
        }
    }
    return $out . '</nav>';
}
