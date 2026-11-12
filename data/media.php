<?php
// Acworth Water Damage — image map.
// 27 of 32 slots filled. 5 slots have no fitting Pexels photo and were
// removed from $MEDIA (flagged, see qa/IMAGE-REPORT.md): svc-water-mitigation,
// svc-ceiling-water-damage, svc-hardwood-floor, svc-crawl-space,
// process-5-drying. page_img() returns null for those slugs, so the site
// renders a navy panel instead of a broken img.
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
    'process-1-dispatch' => ['file' => 'process-1-dispatch.jpg', 'alt' => 'Dispatch'],
    'process-2-stop-source' => ['file' => 'process-2-stop-source.jpg', 'alt' => 'Stop the source'],
    'process-3-inspect' => ['file' => 'process-3-inspect.jpg', 'alt' => 'Inspect and map moisture'],
    'process-4-extraction' => ['file' => 'process-4-extraction.jpg', 'alt' => 'Water extraction'],
    'process-6-clean' => ['file' => 'process-6-clean.jpg', 'alt' => 'Clean and sanitize'],
    'process-7-repair' => ['file' => 'process-7-repair.jpg', 'alt' => 'Repair and rebuild'],
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
function card_img($card) {
    global $MEDIA;
    $slot = $MEDIA[$card['img']] ?? null;
    if (!$slot) return null;
    if (!is_file(__DIR__ . '/../assets/img/' . $slot['file'])) return null;
    return ['src' => '/assets/img/' . $slot['file'], 'alt' => $slot['alt'], 'file' => $slot['file']];
}

// Returns null when the slot is missing OR the file is not on disk yet.
// Callers must render a navy panel (no <img>) in that case.
function page_img($slug, $kind) {
    global $PAGE_IMG, $IMG;
    $entry = $PAGE_IMG[$slug][$kind] ?? null;
    if (!$entry) return null;
    $disk = __DIR__ . '/../assets/img/' . $entry['file'];
    if (!is_file($disk)) return null;
    return ['src' => $IMG . $entry['file'], 'alt' => $entry['alt'], 'file' => $entry['file']];
}

function img_tag($img, $w, $h, $loading = 'lazy') {
    if (!$img) return '';
    return '<img src="' . esc($img['src']) . '" alt="' . esc($img['alt']) . '" width="' . (int) $w .
        '" height="' . (int) $h . '" loading="' . $loading . '">';
}
