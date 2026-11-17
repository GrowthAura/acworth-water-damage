<?php
// Acworth Water Damage — image map.
// GENERATED-IMAGE ROUND 2026-11-15: the 6 slots below were filled with
// OUR OWN generated images (media pipeline, photorealistic, competitor-
// inspired subjects only — no competitor photo copied, no stock source:
// no Pexels/Openverse/Wikimedia/Unsplash). See
// qa/second-source-images-2026-11-15.md + qa/IMAGE-LOG. The old roof
// photo (Pexels 9431615) was replaced the same round; the original is
// backed up in qa/second-source-tmp/backup/.
// 26 of 32 original slots filled. 6 slots had no fitting Pexels photo and
// had been removed from $MEDIA (flagged, see qa/IMAGE-REPORT.md) until the
// 2026-11-15 generated-image round restored them (see note above):
// svc-water-mitigation,
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
        // DEEP FIX 2026-11-14 (P3-9): honest alt. The photo is a flooded
        // road with speed-limit signs standing in the water — no crew, no
        // home. No place is claimed (the road's town is not verifiable).
        'alt' => 'Floodwater covering a road, with speed limit signs standing in the water'],
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
        // GENERATED 2026-11-15: replaced Pexels 9431615 (flat grey slate/
        // tile roof, European cues). Generated US roofers installing
        // brown-gray architectural asphalt shingles on a pitched roof of
        // a US suburban house. See qa/second-source-images-2026-11-15.md.
        'alt' => 'Storm & Roof Leak Water Damage in Acworth'],
    // GENERATED 2026-11-15 (own generated images, see report): the 4
    // service slots that had no fitting stock photo. Each feeds its
    // homepage card AND its service-page hero (same slot, $PAGE_IMG).
    'svc-water-mitigation' => ['file' => 'svc-water-mitigation.jpg',
        'alt' => 'Water Mitigation & Structural Drying in Acworth'],
    'svc-crawl-space' => ['file' => 'svc-crawl-space.jpg',
        'alt' => 'Crawl Space Water Removal in Acworth'],
    'svc-ceiling-water-damage' => ['file' => 'svc-ceiling-water-damage.jpg',
        'alt' => 'Ceiling Water Damage Repair in Acworth'],
    'svc-hardwood-floor' => ['file' => 'svc-hardwood-floor.jpg',
        'alt' => 'Hardwood Floor Water Damage in Acworth'],
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
        // PENDING-CALLS 2026-11-15 (item 2): replaced — Pexels 31006674,
        // a Georgia lake with a boathouse and docks (no mountains, no
        // palms). Alt describes the photo; it does not claim the photo
        // is Lake Allatoona itself.
        'alt' => 'A lake in Georgia with a boathouse and docks along the shore'],
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
    // GENERATED 2026-11-15: process-4-extraction + process-5-drying filled
    // with own generated images (see qa/second-source-images-2026-11-15.md).
    // process-4 was removed 2026-11-14 (Pexels 6195273 = Lancaster's photo);
    // the generated replacement is a different scene, not that photo.
    'process-4-extraction' => ['file' => 'process-4-extraction.jpg', 'alt' => 'Water extraction'],
    'process-5-drying' => ['file' => 'process-5-drying.jpg', 'alt' => 'Structural drying'],
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
        'alt' => 'Lake Allatoona High Water: A Basement Checklist for Acworth Homes',
        // DEEP FIX 2026-11-14 (P3-8): the flooded pier/dock (the subject)
        // sits at the bottom of the frame; the 422px cover crop kept only
        // a sliver of it. 85% keeps the cabins and most of the pier.
        'pos' => '50% 85%'],
    'res-musty-basement' => ['file' => 'res-musty-basement.jpg',
        'alt' => 'Musty Basement Smell? 7 Hidden Water Damage Signs to Check',
        // DEEP FIX 2026-11-14 (P3-8): the damp stains at the wall base and
        // the wet floor (the subject) sit at the bottom of the frame; the
        // center crop cut them. Bottom-anchored crop keeps them in frame.
        'pos' => '50% 100%'],
    'res-frozen-pipe' => ['file' => 'res-frozen-pipe.jpg',
        'alt' => 'Freezing Nights in Acworth: How to Stop Attic, Crawl Space & Lake-Home Pipe Bursts'],
    'res-restoration-cost' => ['file' => 'res-restoration-cost.jpg',
        'alt' => 'How Much Does Water Damage Restoration Cost in Acworth?'],
    'res-first-24-hours' => ['file' => 'res-first-24-hours.jpg',
        'alt' => 'Water Damage in Your Acworth Home: The First 24 Hours Checklist'],
    'about-team' => ['file' => 'about-team.jpg',
        // DEEP FIX 2026-11-14 (P3-9 audit): honest alt. The photo shows a
        // construction crew pouring concrete on a roof slab — not a water
        // damage crew and not this business's team. (The photo itself is
        // the carried P2-3 wrong-service item.)
        'alt' => 'Construction workers in hard hats and high-visibility vests working on a concrete roof slab'],
    'contact-crew' => ['file' => 'contact-crew.jpg',
        // DEEP FIX 2026-11-14 (P3-9 audit): honest alt. The photo is a
        // generic call-centre stock photo (headset agents at desks), not
        // this business's crew.
        'alt' => 'Customer service representatives with headsets answering calls at their desks'],
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
        'w' => $dims[0], 'h' => $dims[1], 'pos' => $entry['pos'] ?? null];
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

// Variant-only srcset (no original appended) — for <picture> sources,
// where the largest entry must be an exact variant width, not the 1600w
// original. A variant is skipped silently when its file is absent.
function img_srcset_variants($img, $widths) {
    if (!$img || empty($img['file'])) return '';
    $stem = preg_replace('/\.jpg$/i', '', $img['file']);
    $parts = [];
    foreach ((array) $widths as $tw) {
        $vfile = $stem . '-' . (int) $tw . 'w.jpg';
        if (!is_file(__DIR__ . '/../assets/img/variants/' . $vfile)) continue;
        $parts[] = '/assets/img/variants/' . $vfile . ' ' . (int) $tw . 'w';
    }
    return implode(', ', $parts);
}

// Hero <picture> srcsets — SINGLE SOURCE OF TRUTH for hero_img_tag() +
// hero_preload_tag(). The preload MUST serve the same srcset the picture
// uses, or the browser downloads twice. Returns null when the progressive
// variants are not all on disk (callers fall back to plain JPG img +
// JPG preload, the pre-WebP behaviour).
// PROGRESSIVE-JPEG FIX 2026-11-17 (diagnosis #2): the hero <picture>
// serves progressive JPEG — mobile via a media-qualified source
// (360/560w; with only 360/560 offered, the browser picks 560w on mobile
// instead of the 800w it picked from the old [360,560,800] srcset at
// DPR 1.75 x 412 CSS px = 721), desktop via its own source (800/1280w).
// WebP is all-or-nothing (zero hero pixels until fully decoded — the
// 6/8 blank filmstrip); a progressive JPEG paints its first scan early.
function hero_picture_srcsets($img) {
    if (!$img || empty($img['file'])) return null;
    $mob = img_srcset_variants($img, [360, 560]);
    $desk = img_srcset_variants($img, [800, 1280]);
    if ($mob === '' || $desk === '') return null;
    return ['mobile' => $mob, 'desktop' => $desk];
}

// WebP srcset — RETAINED 2026-11-17 (progressive-JPEG round): no longer
// used by heroes (hero_img_tag()/hero_preload_tag() now serve progressive
// JPEG only). Kept so the WebP variants stay addressable; the .webp files
// remain on disk and in git and are never fetched by the hero.
function img_srcset_webp($img, $widths) {
    if (!$img || empty($img['file'])) return '';
    $stem = preg_replace('/\.jpg$/i', '', $img['file']);
    $parts = [];
    foreach ((array) $widths as $tw) {
        $vfile = $stem . '-' . (int) $tw . 'w.webp';
        if (!is_file(__DIR__ . '/../assets/img/variants/' . $vfile)) continue;
        $parts[] = '/assets/img/variants/' . $vfile . ' ' . (int) $tw . 'w';
    }
    $v1280 = $stem . '-1280w.webp';
    if (is_file(__DIR__ . '/../assets/img/variants/' . $v1280)) {
        $parts[] = '/assets/img/variants/' . $v1280 . ' 1280w';
    }
    return implode(', ', $parts);
}

// Hero <img>: real dimensions + srcset. $extra carries fetchpriority etc.
// sizes: hero renders full viewport width on mobile, 1280px on desktop.
// DEEP FIX 2026-11-14 (P3-7): srcset is now [360, 560, 800, original] —
// the 360/560 variants already existed on disk for every hero file (same
// pipeline as the card variants); the hero tag just never offered them.
// DEEP FIX 2026-11-14 (P3-8): 'pos' (per-image object-position) is
// emitted as an inline style when the slot defines one.
// PROGRESSIVE-JPEG FIX 2026-11-17 (diagnosis #2): wrapped in <picture>
// with TWO progressive-JPEG <source>s (mobile 360/560w, desktop 800/1280w)
// + the JPG <img> as fallback. The old WebP <source> is gone: WebP is
// all-or-nothing, so the hero showed zero pixels until fully decoded.
// Cards stay JPG.
function hero_img_tag($img, $extra = '') {
    if (!$img) return '';
    $style = !empty($img['pos']) ? ' style="object-position: ' . esc($img['pos']) . '"' : '';
    $imgTag = '<img src="' . esc($img['src']) . '" alt="' . esc($img['alt']) . '"' .
        ' width="' . (int) $img['w'] . '" height="' . (int) $img['h'] . '"' .
        ' srcset="' . img_srcset($img, [360, 560, 800]) . '"' .
        ' sizes="(max-width: 700px) 100vw, 1280px"' . $style .
        ($extra !== '' ? ' ' . $extra : '') . '>';
    $sets = hero_picture_srcsets($img);
    if ($sets === null) return $imgTag; // no progressive variants: plain JPG img
    return '<picture><source media="(max-width: 700px)" srcset="' . $sets['mobile'] .
        '" sizes="100vw"><source srcset="' . $sets['desktop'] .
        '" sizes="1280px">' . $imgTag . '</picture>';
}

// SPEED INDEX / LCP FIX 2026-11-17 (his order; PSI mobile Speed Index 4.0s,
// the hero <img> is the LCP element and the browser only discovers it after
// parsing the body): preload the page's hero image so the browser discovers
// it in the <head>. The preload MUST serve the same progressive-JPEG srcset
// the <picture> source will use — hero_picture_srcsets() is the single
// source of truth for both, so they cannot drift. TWO media-matched links:
// exactly ONE fetches per viewport (media on <link> gates the fetch), so
// there is still no double download. When no progressive variants exist
// for a hero it falls back to the single JPG srcset (the pre-WebP
// behaviour). Returns '' when the page has no hero (honestly empty by
// design). PROGRESSIVE-JPEG FIX 2026-11-17 (diagnosis #2): the old single
// WebP preload is gone with the WebP <source>.
function hero_preload_tag($img) {
    if (!$img) return '';
    $sets = hero_picture_srcsets($img);
    if ($sets !== null) {
        return '<link rel="preload" as="image" media="(max-width: 700px)" imagesrcset="' . esc($sets['mobile']) .
            '" imagesizes="100vw" fetchpriority="high">' .
            '<link rel="preload" as="image" media="(min-width: 701px)" imagesrcset="' . esc($sets['desktop']) .
            '" imagesizes="1280px" fetchpriority="high">';
    }
    $ss = img_srcset($img, [360, 560, 800]);
    if ($ss === '') return '';
    return '<link rel="preload" as="image" imagesrcset="' . esc($ss) .
        '" imagesizes="(max-width: 700px) 100vw, 1280px" fetchpriority="high">';
}

function img_tag($img, $w, $h, $loading = 'lazy', $sizes = '') {
    if (!$img) return '';
    // SEO FIX 2026-11-13 (P3-19/P3-5): $w/$h are kept for signature
    // compatibility but the REAL file dimensions are emitted instead —
    // the old hardcoded 1200x675 did not match the 1600x900 files.
    // $sizes is the slot's rendered width, e.g. "(max-width: 700px) 348px, 313px".
    $rw = (int) ($img['w'] ?? $w);
    $rh = (int) ($img['h'] ?? $h);
    $out = '<img src="' . esc($img['src']) . '" alt="' . esc($img['alt']) . '" width="' . $rw .
        '" height="' . $rh . '" srcset="' . img_srcset($img, [360, 560, 800]) . '"';
    if ($sizes !== '') $out .= ' sizes="' . esc($sizes) . '"';
    return $out . ' loading="' . $loading . '">';
}
