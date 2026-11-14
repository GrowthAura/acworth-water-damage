<?php
// Acworth Water Damage — image map.
// 26 of 32 original slots filled. 6 slots have no fitting Pexels photo and
// were removed from $MEDIA (flagged, see qa/IMAGE-REPORT.md): svc-water-mitigation,
// svc-ceiling-water-damage, svc-hardwood-floor, svc-crawl-space,
// process-5-drying, and process-4-extraction (removed 2026-11-14: Pexels
// 6195273 is Lancaster's photo, live on the Lancaster homepage — see
// qa/IMAGE-FIX-PROCESS4-2026-11-14.md; 11 fresh Pexels queries found no
// clean replacement). page_img() returns null for those slugs, so the site
// renders a navy panel instead of a broken img.
// Rebuild 2026-11-12 added 15 more slots (6 new services, 7 resources,
// about, contact) — files land from the image agent; unfilled slots render
// a navy panel until then (see qa/IMAGE-REPORT-rebuild.md).
// All images are fresh for this site (a separate worker downloaded the
// actual files into /assets/img/). Alt text is place + topic; no "AI" word
// anywhere, and no on-site claim that any image is a real job photo.
// page_img() returns null when the file is not on disk yet, so a slot
// that has not been filled renders a navy panel instead of a broken img.

$IMG = '/assets/img/';

// Slot definitions: file (without path) + alt text.
$MEDIA = [
    'hero' => ['file' => 'hero-acworth-water-damage.jpg',
        'alt' => 'Water damage restoration crew at work in an Acworth, GA home'],
    'svc-emergency-water-extraction' => ['file' => 'svc-emergency-water-extraction.jpg',
        'alt' => 'Emergency Water Extraction in Acworth'],
    'svc-flood-damage-restoration' => ['file' => 'svc-flood-damage-restoration.jpg',
        'alt' => 'Flood Damage Restoration in Acworth'],
    'svc-burst-pipe' => ['file' => 'svc-burst-pipe.jpg',
        'alt' => 'Burst Pipe Cleanup in Acworth'],
    'svc-flooded-basement' => ['file' => 'svc-flooded-basement.jpg',
        'alt' => 'Flooded Basement Cleanup in Acworth'],
    'svc-sewage-backup' => ['file' => 'svc-sewage-backup.jpg',
        'alt' => 'Sewage Backup Cleanup in Acworth'],
    'svc-mold-remediation' => ['file' => 'svc-mold-remediation.jpg',
        'alt' => 'Mold Remediation in Acworth'],
    'svc-storm-roof-leak' => ['file' => 'svc-storm-roof-leak.jpg',
        'alt' => 'Storm & Roof Leak Water Damage in Acworth'],
    'svc-water-heater-leak' => ['file' => 'svc-water-heater-leak.jpg',
        'alt' => 'Water Heater Leak Cleanup in Acworth'],
    'svc-appliance-leak' => ['file' => 'svc-appliance-leak.jpg',
        'alt' => 'Appliance Leak Cleanup in Acworth'],
    'svc-ac-leak' => ['file' => 'svc-ac-leak.jpg',
        'alt' => 'AC Leak Water Damage in Acworth'],
    'svc-carpet-water-damage' => ['file' => 'svc-carpet-water-damage.jpg',
        'alt' => 'Carpet Water Damage in Acworth'],
    'svc-water-damage-repair' => ['file' => 'svc-water-damage-repair.jpg',
        'alt' => 'Water Damage Repair in Acworth'],
    'svc-commercial-water-damage' => ['file' => 'svc-commercial-water-damage.jpg',
        'alt' => 'Commercial Water Damage in Acworth'],
    'svc-lake-allatoona' => ['file' => 'svc-lake-allatoona.jpg',
        'alt' => 'Lake Allatoona Lake Home Water Damage'],
    'svc-insurance-claim' => ['file' => 'svc-insurance-claim.jpg',
        'alt' => 'Water Damage Insurance Claim Help in Acworth'],
    'area-kennesaw' => ['file' => 'area-kennesaw.jpg',
        'alt' => 'Water damage restoration in Kennesaw, GA'],
    'area-woodstock' => ['file' => 'area-woodstock.jpg',
        'alt' => 'Water damage restoration in Woodstock, GA'],
    'area-cartersville' => ['file' => 'area-cartersville.jpg',
        'alt' => 'Water damage restoration in Cartersville, GA'],
    'area-dallas' => ['file' => 'area-dallas.jpg',
        'alt' => 'Water damage restoration in Dallas, GA'],
    'area-hiram' => ['file' => 'area-hiram.jpg',
        'alt' => 'Water damage restoration in Hiram, GA'],
    'locations-hub' => ['file' => 'locations-hub-hero.jpg',
        'alt' => 'Downtown Buford, Georgia main street — water damage restoration service areas across northwest metro Atlanta'],
    'process-1-dispatch' => ['file' => 'process-1-dispatch.jpg', 'alt' => 'Dispatch'],
    'process-2-stop-source' => ['file' => 'process-2-stop-source.jpg', 'alt' => 'Stop the source'],
    'process-3-inspect' => ['file' => 'process-3-inspect.jpg', 'alt' => 'Inspect and map moisture'],
    // process-4-extraction REMOVED 2026-11-14 (Pexels 6195273 = Lancaster's
    // photo). No $MEDIA entry: the step renders the empty band, like process-5.
    'process-6-clean' => ['file' => 'process-6-clean.jpg', 'alt' => 'Clean and sanitize'],
    'process-7-repair' => ['file' => 'process-7-repair.jpg', 'alt' => 'Repair and rebuild'],
    // Rebuild 2026-11-12 — 15 new routes. Slots are added here up front;
    // page_img() returns null until the image agent's file is on disk, so
    // an unfilled slot renders a navy panel, never a broken img.
    'svc-mold-inspection' => ['file' => 'svc-mold-inspection.jpg',
        'alt' => 'Mold Inspection in Acworth'],
    'svc-slab-leak' => ['file' => 'svc-slab-leak.jpg',
        'alt' => 'Slab Leak Water Damage in Acworth'],
    'svc-townhome' => ['file' => 'svc-townhome.jpg',
        'alt' => 'Townhome Water Damage in Acworth'],
    'svc-mobile-home' => ['file' => 'svc-mobile-home.jpg',
        'alt' => 'Mobile Home Water Damage in Acworth'],
    'svc-rental-property' => ['file' => 'svc-rental-property.jpg',
        'alt' => 'Rental Property Water Damage in Acworth'],
    'svc-fire-water-damage' => ['file' => 'svc-fire-water-damage.jpg',
        'alt' => 'Fire Damage Restoration in Acworth'],
    'res-sewage-who-pays' => ['file' => 'res-sewage-who-pays.jpg',
        'alt' => 'Cobb County Sewage Backup: Who Pays, You or the County?'],
    'res-leak-credit' => ['file' => 'res-leak-credit.jpg',
        'alt' => 'Cobb County Water Leak Credit After a Burst Pipe: What to Save'],
    'res-lake-high-water' => ['file' => 'res-lake-high-water.jpg',
        'alt' => 'Lake Allatoona High Water: A Basement Checklist for Acworth Homes'],
    'res-musty-basement' => ['file' => 'res-musty-basement.jpg',
        'alt' => 'Musty Basement Smell? 7 Hidden Water Damage Signs to Check'],
    'res-frozen-pipe' => ['file' => 'res-frozen-pipe.jpg',
        'alt' => 'Freezing Nights in Acworth: How to Stop Attic, Crawl Space & Lake-Home Pipe Bursts'],
    'res-restoration-cost' => ['file' => 'res-restoration-cost.jpg',
        'alt' => 'How Much Does Water Damage Restoration Cost in Acworth?'],
    'res-first-24-hours' => ['file' => 'res-first-24-hours.jpg',
        'alt' => 'Water Damage in Your Acworth Home: The First 24 Hours Checklist'],
    'about-team' => ['file' => 'about-team.jpg',
        'alt' => 'About Our Acworth Water Damage Restoration Team'],
    'contact-crew' => ['file' => 'contact-crew.jpg',
        'alt' => 'Contact Our 24/7 Acworth Water Damage Crew'],
];

// Page -> slot map. Built from the data arrays so a slug can never point
// at a slot that does not exist in $MEDIA.
$PAGE_IMG = [];
$PAGE_IMG['/'] = ['hero' => $MEDIA['hero']];
foreach ($SERVICES as $s) {
    if (!isset($MEDIA[$s['img']])) continue; // flagged slot: no image, navy panel
    $slot = $MEDIA[$s['img']];
    $PAGE_IMG[$s['slug']] = ['card' => $slot, 'hero' => $slot];
}
foreach ($AREAS as $a) {
    $key = 'area-' . strtolower($a['city']);
    $PAGE_IMG[$a['slug']] = ['card' => $MEDIA[$key], 'hero' => $MEDIA[$key]];
}
// Rebuild 2026-11-12 — hero slots for the 15 new routes (slug => slot key).
// page_img() returns null until the file is on disk, so an unfilled slot
// renders a navy panel, never a broken img.
$NEW_PAGE_IMG = [
    '/mold-inspection-acworth-ga' => 'svc-mold-inspection',
    '/slab-leak-water-damage-acworth-ga' => 'svc-slab-leak',
    '/townhome-water-damage-acworth-ga' => 'svc-townhome',
    '/mobile-home-water-damage-acworth-ga' => 'svc-mobile-home',
    '/rental-property-water-damage-acworth-ga' => 'svc-rental-property',
    '/fire-water-damage-acworth-ga' => 'svc-fire-water-damage',
    '/resources/cobb-county-sewage-backup-who-pays' => 'res-sewage-who-pays',
    '/resources/cobb-county-water-leak-credit' => 'res-leak-credit',
    '/resources/lake-allatoona-high-water-basement' => 'res-lake-high-water',
    '/resources/musty-basement-water-damage-signs' => 'res-musty-basement',
    '/resources/acworth-frozen-pipe-prevention' => 'res-frozen-pipe',
    '/resources/water-damage-restoration-cost-acworth' => 'res-restoration-cost',
    '/resources/water-damage-first-24-hours' => 'res-first-24-hours',
    '/about' => 'about-team',
    '/contact' => 'contact-crew',
];
foreach ($NEW_PAGE_IMG as $slug => $key) {
    if (!isset($MEDIA[$key])) continue;
    $PAGE_IMG[$slug] = ['hero' => $MEDIA[$key]];
}
// Chain 1 AZ fix — locations hub hero (Pexels 9471562, downtown Buford GA).
$PAGE_IMG['/locations'] = ['hero' => $MEDIA['locations-hub']];
$PROCESS_IMG_KEYS = [
    'process-1' => 'process-1-dispatch',
    'process-2' => 'process-2-stop-source',
    'process-3' => 'process-3-inspect',
    'process-4' => 'process-4-extraction',
    'process-5' => 'process-5-drying',
    'process-6' => 'process-6-clean',
    'process-7' => 'process-7-repair',
];
foreach ($PROCESS_IMG_KEYS as $slug => $key) {
    if (!isset($MEDIA[$key])) continue; // flagged slot: no image, navy panel
    $PAGE_IMG[$slug] = ['img' => $MEDIA[$key]];
}

// Card image for a homepage card: the card's own 'img' slot.
// Returns null when the file is not on disk yet.
// SEO FIX 2026-11-13 (P3-19/P3-5): the returned array also carries the
// REAL file dimensions ('w'/'h' from getimagesize), so the template emits
// width/height attributes that match the file instead of hardcoded values.
function card_img($card) {
    global $MEDIA;
    $slot = $MEDIA[$card['img']] ?? null;
    if (!$slot) return null;
    if (!is_file(__DIR__ . '/../assets/img/' . $slot['file'])) return null;
    $dims = img_real_dims($slot['file']);
    return ['src' => '/assets/img/' . $slot['file'], 'alt' => $slot['alt'], 'file' => $slot['file'],
        'w' => $dims[0], 'h' => $dims[1]];
}

// Returns null when the slot is missing OR the file is not on disk yet.
// Callers must render a navy panel (no <img>) in that case.
// SEO FIX 2026-11-13 (P3-19/P3-5): also carries real 'w'/'h'.
function page_img($slug, $kind) {
    global $PAGE_IMG, $IMG;
    $entry = $PAGE_IMG[$slug][$kind] ?? null;
    if (!$entry) return null;
    $disk = __DIR__ . '/../assets/img/' . $entry['file'];
    if (!is_file($disk)) return null;
    $dims = img_real_dims($entry['file']);
    return ['src' => $IMG . $entry['file'], 'alt' => $entry['alt'], 'file' => $entry['file'],
        'w' => $dims[0], 'h' => $dims[1]];
}

// ---- SEO FIX 2026-11-13 (P2-1 slot-fit variants + P3-19 real dims) ------
// Slot-fit variants live in assets/img/variants/<stem>-<w>w.jpg
// (360/560/800, quality 80, EXIF stripped; originals untouched — see
// qa/seofix/variants-manifest.json). The original file is always the
// largest srcset entry, so high-DPR screens still get full pixels.

// Real pixel dimensions of an original file (cached per request).
function img_real_dims($file) {
    static $cache = [];
    if (!isset($cache[$file])) {
        $size = @getimagesize(__DIR__ . '/../assets/img/' . $file);
        $cache[$file] = $size ? [(int) $size[0], (int) $size[1]] : [1600, 900];
    }
    return $cache[$file];
}

// srcset string for an image array: variant files that exist on disk at
// the requested widths, plus the original file at its real width.
// $widths: variant widths to offer (e.g. [800] for heroes, [360,560,800]
// for cards). A variant is skipped silently when its file is absent.
function img_srcset($img, $widths) {
    if (!$img || empty($img['file'])) return '';
    $stem = preg_replace('/\.jpg$/i', '', $img['file']);
    $parts = [];
    foreach ((array) $widths as $tw) {
        $vfile = $stem . '-' . (int) $tw . 'w.jpg';
        if (!is_file(__DIR__ . '/../assets/img/variants/' . $vfile)) continue;
        $parts[] = '/assets/img/variants/' . $vfile . ' ' . (int) $tw . 'w';
    }
    $parts[] = esc($img['src']) . ' ' . (int) ($img['w'] ?? 1600) . 'w';
    return implode(', ', $parts);
}

// Hero <img>: real dimensions + srcset. $extra carries fetchpriority etc.
// sizes: hero renders full viewport width on mobile, 1280px on desktop.
function hero_img_tag($img, $extra = '') {
    if (!$img) return '';
    return '<img src="' . esc($img['src']) . '" alt="' . esc($img['alt']) . '"' .
        ' width="' . (int) $img['w'] . '" height="' . (int) $img['h'] . '"' .
        ' srcset="' . img_srcset($img, [800]) . '"' .
        ' sizes="(max-width: 700px) 100vw, 1280px"' .
        ($extra !== '' ? ' ' . $extra : '') . '>';
}

function img_tag($img, $w, $h, $loading = 'lazy', $sizes = '') {
    if (!$img) return '';
    // SEO FIX 2026-11-13 (P3-19/P3-5): $w/$h are kept for signature
    // compatibility but the REAL file dimensions are emitted instead —
    // the old hardcoded 1200x675 did not match the 1600x900 files.
    // $sizes is the slot's rendered width, e.g. "(max-width: 700px) 348px, 263px".
    $rw = (int) ($img['w'] ?? $w);
    $rh = (int) ($img['h'] ?? $h);
    $out = '<img src="' . esc($img['src']) . '" alt="' . esc($img['alt']) . '" width="' . $rw .
        '" height="' . $rh . '" srcset="' . img_srcset($img, [360, 560, 800]) . '"';
    if ($sizes !== '') $out .= ' sizes="' . esc($sizes) . '"';
    return $out . ' loading="' . $loading . '">';
}
