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

// ---- Full-tab content (rebuild 2026-11-12): generic block renderer ------
// $FULL_PAGES (data/pages-full.php) carries per-route structured blocks
// parsed verbatim from the doc's 41 tabs. Homepage (Tab 1) stays in
// data/pages.php and is untouched.

// Apply several links to one paragraph's text. Each link carries its
// anchor's character offset ("pos") in the ORIGINAL text, so the right
// occurrence is linked when a phrase repeats. Self-links and overlapping
// anchors are skipped (the parser already dedupes; this is the
// render-time guard). Words stay verbatim; only the anchor spans link.
function linkify_multi($text, $links, $currentSlug = null) {
    if (empty($links)) return esc($text);
    $spans = [];
    foreach ($links as $l) {
        if (empty($l['anchor']) || empty($l['href'])) continue;
        if ($l['href'] === $currentSlug) continue;
        $pos = $l['pos'] ?? mb_strpos($text, $l['anchor']);
        if ($pos === false || $pos === null) continue;
        if (mb_substr($text, (int) $pos, mb_strlen($l['anchor'])) !== $l['anchor']) continue;
        $end = (int) $pos + mb_strlen($l['anchor']);
        $overlap = false;
        foreach ($spans as $s) {
            if ($pos < $s['end'] && $end > $s['pos']) { $overlap = true; break; }
        }
        if ($overlap) continue;
        $spans[] = ['pos' => (int) $pos, 'end' => $end, 'anchor' => $l['anchor'], 'href' => $l['href']];
    }
    if (!$spans) return esc($text);
    usort($spans, fn($a, $b) => $a['pos'] <=> $b['pos']);
    $out = '';
    $cursor = 0;
    foreach ($spans as $s) {
        $out .= esc(mb_substr($text, $cursor, $s['pos'] - $cursor));
        $out .= '<a href="' . esc($s['href']) . '">' . esc($s['anchor']) . '</a>';
        $cursor = $s['end'];
    }
    $out .= esc(mb_substr($text, $cursor));
    return $out;
}

function render_para_links($para, $currentSlug = null) {
    if (is_string($para)) return '<p>' . esc($para) . '</p>';
    $text = $para['text'] ?? '';
    $links = $para['links'] ?? [];
    return '<p>' . linkify_multi($text, $links, $currentSlug) . '</p>';
}

function render_faq_section($sec, $slug) {
    $out = '<h2>' . esc($sec['h2']) . '</h2><div class="faq-list">';
    foreach ($sec['items'] as $f) {
        $out .= '<details><summary><h3>' . esc($f['q']) . '</h3><span class="faq-toggle" aria-hidden="true">+</span></summary>';
        $out .= '<div class="faq-answer"><p>' . linkify_multi($f['a'], $f['links'] ?? [], $slug) . '</p></div></details>';
    }
    return $out . '</div>';
}

// AZ P2-3: split a "Label: rest" step bullet into [label, rest].
// A label is a short prefix (<=6 words, <=45 chars) before the first ": ".
// Items without one render as body-only steps (number badge only).
function split_step_label($text) {
    $pos = mb_strpos($text, ': ');
    if ($pos === false) return [null, $text];
    $label = mb_substr($text, 0, $pos);
    if (count(preg_split('/\s+/', trim($label))) > 6 || mb_strlen($label) > 45) {
        return [null, $text];
    }
    return [$label, mb_substr($text, $pos + 2)];
}

// AZ P2-3: the trailing item of a process group is a closing note, not a
// step, when it has no label and reads as commentary (it carries a link,
// or one of the closing phrases). Only ever applied to the LAST item.
function is_process_note($text, $links) {
    if (!empty($links)) return true;
    return (bool) preg_match('/\bis only\b|\bis what\b|\bis complete only when\b|\btakes longer than\b/i', $text);
}

// AZ P2-3: render a "How does ..." group as numbered step cards
// (no-photo variant: number badge + label + text). Step numbers come
// from a CSS counter, so no new visible words are added. A trailing
// closing note renders as a paragraph after the grid. Words and links
// are unchanged; only the presentation changes.
function render_process_steps($steps, $slug) {
    $note = null;
    $last = count($steps) - 1;
    if ($last >= 0) {
        $cand = $steps[$last];
        if ($cand['label'] === null && is_process_note($cand['text'], $cand['links'])) {
            $note = array_pop($steps);
        }
    }
    $out = '<div class="process-steps">';
    foreach ($steps as $s) {
        $out .= '<div class="process-step">';
        if ($s['label'] !== null) {
            $out .= '<p class="step-title">' . esc($s['label']) . '</p>';
        }
        // Links carry offsets into the original text; shift them past
        // the "Label: " prefix when a label was split off.
        $links = $s['links'];
        if ($s['label'] !== null && !empty($links)) {
            $shift = mb_strlen($s['label']) + 2;
            $links = array_map(function ($l) use ($shift) {
                $l['pos'] = ($l['pos'] ?? 0) - $shift;
                return $l;
            }, $links);
        }
        $out .= '<p>' . linkify_multi($s['text'], $links, $slug) . '</p>';
        $out .= '</div>';
    }
    $out .= '</div>';
    if ($note !== null) {
        $out .= '<p class="process-note">' . linkify_multi($note['text'], $note['links'], $slug) . '</p>';
    }
    return $out;
}

// Generic renderer for a tab's structured blocks. $formHtml is inserted
// where a "contact_form" block appears (contact page only).
function render_blocks($blocks, $slug, $formHtml = '') {
    $out = '';
    for ($i = 0; $i < count($blocks); $i++) {
        $b = $blocks[$i];
        switch ($b['kind']) {
            case 'h2':
                $out .= '<h2>' . esc($b['text']) . '</h2>';
                // AZ P2-3: a "How does ..." group followed by bullets/defs
                // is the service process — re-present it as step cards
                // (words unchanged). The following list blocks are consumed.
                if (str_starts_with($b['text'], 'How does')) {
                    $steps = [];
                    $j = $i + 1;
                    while ($j < count($blocks) && in_array($blocks[$j]['kind'], ['bullets', 'defs'], true)) {
                        $blk = $blocks[$j];
                        if ($blk['kind'] === 'defs') {
                            foreach ($blk['items'] as $it) {
                                $steps[] = ['label' => $it['label'], 'text' => $it['text'], 'links' => $it['links'] ?? []];
                            }
                        } else {
                            foreach ($blk['items'] as $it) {
                                [$label, $rest] = split_step_label($it['text']);
                                // Guard: a link anchored inside the label
                                // part must not be shifted into the body.
                                if ($label !== null && !empty($it['links'])) {
                                    $shift = mb_strlen($label) + 2;
                                    foreach ($it['links'] as $l) {
                                        if (($l['pos'] ?? 0) < $shift) { $label = null; $rest = $it['text']; break; }
                                    }
                                }
                                $steps[] = ['label' => $label, 'text' => $rest, 'links' => $it['links'] ?? []];
                            }
                        }
                        $j++;
                    }
                    if ($steps) {
                        $out .= render_process_steps($steps, $slug);
                        $i = $j - 1;
                    }
                }
                break;
            case 'h3':
                $out .= '<h3>' . esc($b['text']) . '</h3>';
                break;
            case 'para':
                // AZ P2-4: /contact "Call for emergencies" number is bare
                // doc text; render it as the same tel: link every other
                // phone number uses. Words unchanged; only this exact
                // paragraph is affected.
                if (trim($b['text'] ?? '') === '(470) 672-2095' && empty($b['links'])) {
                    $out .= '<p>' . phone_link('(470) 672-2095') . '</p>';
                } else {
                    $out .= render_para_links($b, $slug);
                }
                break;
            case 'defs':
                $out .= '<dl class="quick-list">';
                foreach ($b['items'] as $d) {
                    // AZ O-7: the doc's phone value renders as a tel: link,
                    // same as the P2-4 paragraph fix. Words unchanged.
                    $dd = (trim($d['text'] ?? '') === '(470) 672-2095' && empty($d['links']))
                        ? phone_link('(470) 672-2095')
                        : linkify_multi($d['text'], $d['links'] ?? [], $slug);
                    $out .= '<div><dt>' . esc($d['label']) . '</dt><dd>' . $dd . '</dd></div>';
                }
                $out .= '</dl>';
                break;
            case 'bullets':
                $out .= '<ul>';
                foreach ($b['items'] as $it) {
                    $out .= '<li>' . linkify_multi($it['text'], $it['links'] ?? [], $slug) . '</li>';
                }
                $out .= '</ul>';
                break;
            case 'table':
                $out .= table_html(['headers' => $b['headers'], 'rows' => $b['rows']]);
                break;
            case 'faq_section':
                $out .= render_faq_section($b, $slug);
                break;
            case 'contact_form':
                $out .= $formHtml;
                break;
        }
    }
    return $out;
}

// Header/footer nav: the 19 original services + the 6 new service routes
// from the full-tab rebuild, in doc order.
function nav_services() {
    global $SERVICES, $FULL_PAGES;
    $out = [];
    $seen = [];
    foreach ($SERVICES as $s) {
        $out[] = ['slug' => $s['slug'], 'nav' => $s['nav']];
        $seen[$s['slug']] = true;
    }
    foreach ($FULL_PAGES as $slug => $f) {
        if (($f['type'] ?? '') === 'service' && empty($seen[$slug])) {
            $out[] = ['slug' => $slug, 'nav' => $f['nav']];
            $seen[$slug] = true;
        }
    }
    return $out;
}

// Footer Resources column: the 7 resource guides, in tab order.
function nav_resources() {
    global $FULL_PAGES;
    $out = [];
    foreach ($FULL_PAGES as $slug => $f) {
        if (($f['type'] ?? '') === 'resource') {
            $out[] = ['slug' => $slug, 'nav' => $f['h1']];
        }
    }
    return $out;
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
// Full-tab rebuild 2026-11-12: the 26 original routes keep their shape
// (service summaries still feed the homepage cards + nav), but every route
// is overlaid with its verbatim tab data (meta, eyebrow, H1, intro,
// blocks, FAQs) from data/pages-full.php, and the 15 missing routes are
// added — 41 routes total. The homepage (Tab 1) is not in $FULL_PAGES.
function build_pages() {
    global $SERVICES, $AREAS, $FULL_PAGES;
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
    foreach ($FULL_PAGES as $slug => $full) {
        if ($slug === '/') continue;
        if (isset($pages[$slug])) {
            $pages[$slug] = array_merge($pages[$slug], $full);
        } else {
            $pages[$slug] = array_merge(['parent' => null], $full);
        }
    }
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
    // Full-tab rebuild: meta title + description are verbatim from the tab.
    // (Descriptions over 160 chars are trimmed at a sentence boundary by
    // meta_desc() — no word is changed.)
    if (!empty($p['meta_title'])) {
        return ['title' => $p['meta_title'],
                'description' => meta_desc($p['meta_description'] ?? '')];
    }
    // Fallback for any route without tab meta (none expected after rebuild).
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
