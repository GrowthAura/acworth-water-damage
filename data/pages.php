<?php
// Acworth Water Damage Restoration — site and page data.
// Written fresh for this site. All visible copy is verbatim from the
// Google Doc "Water Damage Restoration in Acworth" (doc
// 1inwjmOHwwQLP9kaNX9-5rE1-iWBCpO4PRFn-0sMGYmU, homepage only, 3,026
// words). Nothing here is invented: no street address, no domain, no
// About / Contact / Privacy content, no reviews, no rates beyond the
// doc's own cost range. En dashes in doc ranges are rendered as hyphens
// at build time (24-48 hours, 3-5 days); no word is changed. Button 1
// shows ONLY the phone number; Button 2 ("Request Emergency Help") is
// its equal. The Cobb County Water System Emergency Dispatch number
// 770-419-6201 appears in the doc as plain text; it is NOT our business
// phone and is never linked as a call button.

$SITE = [
    'brand'       => 'Acworth Water Damage Restoration',
    'brand_small' => 'WATER DAMAGE RESTORATION',
    'city'        => 'Acworth',
    'state'       => 'GA',
    'zip'         => '30101',
    'zip2'        => '30102',
    'county'      => 'Cobb & Cherokee County',
    'phone'       => '(470) 672-2095',
    'phone_href'  => 'tel:+14706722095',
    'phone_plain' => '4706722095',
    'hours'       => '24/7',
    'map_query'   => 'Acworth, GA 30101',
    // GitHub Pages project URL (live). Swap when a real domain lands.
    'url'         => 'https://www.acworthwaterdamagerestoration.us',
];

$HOME_META = [
    'title'       => 'Water Damage Restoration Acworth GA | 24/7 Emergency Crew',
    'description' => 'Water damage restoration in Acworth, GA 30101 & 30102. Crew dispatched immediately, 24/7. Call (470) 672-2095 now.',
    'eyebrow'     => 'WATER DAMAGE RESTORATION • ACWORTH, GEORGIA',
    'h1'          => '24/7 Water Damage Restoration in Acworth, GA',
    'intro'       => 'Burst pipe, flooded basement, sewage backup or a ceiling dripping after a storm? Our water damage restoration crew in Acworth, GA handles emergency water extraction, structural drying, mold prevention and repairs for homes and businesses across ZIP codes 30101 and 30102. The moment you call, a crew is dispatched immediately, day or night, to stop the water and protect your floors, walls and belongings.',
];

$TRUST = [
    'Crew Dispatched Immediately',
    'Open 24/7, 365 Days',
    'IICRC S500 Drying Standards',
    'Cobb & Cherokee County Coverage',
];

$QUICK = [
    'h2' => 'How fast can a water damage crew reach a home in Acworth, GA?',
    'paras' => [
        'A crew is dispatched immediately after your call, 24/7, to homes across Acworth 30101 and 30102, including the Lake Allatoona shoreline, Bells Ferry Road and the Cobb Parkway corridor.',
        'Speed is the single biggest factor in how much of your home can be saved. The EPA advises drying wet materials within 24 to 48 hours to prevent mold growth, and Acworth\'s humid summers shorten that window. When emergency water damage in Acworth starts with a burst supply line or a failed sump pump, every hour of standing water means more swollen baseboards, more wet drywall and a higher chance of mold behind the walls. Calling right away keeps the job smaller, faster and less disruptive.',
    ],
    'h3' => 'Acworth Water Damage Quick Answers',
    'defs' => [
        ['label' => 'Response', 'text' => 'crew dispatched immediately, 24 hours a day, 7 days a week'],
        ['label' => 'ZIP codes covered', 'text' => '30101 and 30102, including unincorporated Cherokee County'],
        ['label' => 'Mold window', 'text' => 'mold can start on wet materials within 24-48 hours (EPA)'],
        ['label' => 'Typical drying time', 'text' => 'about 3-5 days for most homes'],
        ['label' => 'Typical cost range', 'text' => 'about 3,800 for an average job'],
        ['label' => 'Street water main break', 'text' => 'Cobb County Water System Emergency Dispatch, 770-419-6201'],
        ['label' => 'Fastest help', 'text' => 'call (470) 672-2095'],
    ],
];

// 19 service pages. 'body' is the paragraph before its closing link
// sentence; 'sentence' is that closing sentence verbatim; 'anchor' is the
// short span inside it that carries the link. The water-heater card on
// the homepage covers three service pages, and the hardwood/carpet card
// covers two; those pages share the card body and each keep only their
// own closing sentence. The insurance page has no closing link sentence
// (its link points to itself from the homepage); its body is the three
// verbatim sentences of the homepage insurance paragraph.
$SERVICES = [
    [
        'slug' => '/emergency-water-extraction-acworth-ga',
        'nav'  => 'Emergency Water Extraction',
        'h3'   => 'Emergency Water Extraction in Acworth',
        'img'  => 'svc-emergency-water-extraction',
        'body' => 'Truck-mounted and portable extractors pull standing water out of carpet, hardwood, tile and subfloors before it soaks deeper into the structure.',
        'sentence' => 'Learn more about emergency water extraction in Acworth',
        'anchor'   => 'emergency water extraction in Acworth',
    ],
    [
        'slug' => '/water-mitigation-acworth-ga',
        'nav'  => 'Water Mitigation & Structural Drying',
        'h3'   => 'Water Mitigation & Structural Drying in Acworth',
        'img'  => 'svc-water-mitigation',
        'body' => 'Commercial dehumidifiers, air movers and daily moisture readings dry walls, framing and floors to safe levels instead of leaving hidden moisture behind.',
        'sentence' => 'See water mitigation in Acworth',
        'anchor'   => 'water mitigation in Acworth',
    ],
    [
        'slug' => '/flood-damage-restoration-acworth-ga',
        'nav'  => 'Flood Damage Restoration',
        'h3'   => 'Flood Damage Restoration in Acworth',
        'img'  => 'svc-flood-damage-restoration',
        'body' => 'When creeks or heavy rain push water inside, the crew handles flood cleanup, extraction, sanitizing and drying for Category 2 and Category 3 water.',
        'sentence' => 'See flood damage restoration in Acworth',
        'anchor'   => 'flood damage restoration in Acworth',
    ],
    [
        'slug' => '/burst-pipe-water-damage-acworth-ga',
        'nav'  => 'Burst Pipe Cleanup',
        'h3'   => 'Burst Pipe Cleanup in Acworth',
        'img'  => 'svc-burst-pipe',
        'body' => 'Frozen attic lines, cracked supply hoses and failed fittings can release gallons every minute. Water is removed, wet materials are opened up and drying starts the same visit.',
        'sentence' => 'See burst pipe water damage cleanup in Acworth',
        'anchor'   => 'burst pipe water damage',
    ],
    [
        'slug' => '/flooded-basement-cleanup-acworth-ga',
        'nav'  => 'Flooded Basement Cleanup',
        'h3'   => 'Flooded Basement Cleanup in Acworth',
        'img'  => 'svc-flooded-basement',
        'body' => 'Finished, partial and walkout basements are common in Acworth, and they are where water collects first. Carpet, drywall and storage are triaged and dried fast.',
        'sentence' => 'See flooded basement cleanup in Acworth',
        'anchor'   => 'flooded basement cleanup in Acworth',
    ],
    [
        'slug' => '/crawl-space-water-removal-acworth-ga',
        'nav'  => 'Crawl Space Water Removal',
        'h3'   => 'Crawl Space Water Removal in Acworth',
        'img'  => 'svc-crawl-space',
        'body' => 'Standing water under the house is pumped out, and the crawl space is dried so moisture doesn\'t rise into floors and living areas.',
        'sentence' => 'See crawl space water removal in Acworth',
        'anchor'   => 'crawl space water removal',
    ],
    [
        'slug' => '/sewage-backup-cleanup-acworth-ga',
        'nav'  => 'Sewage Backup Cleanup',
        'h3'   => 'Sewage Backup Cleanup in Acworth',
        'img'  => 'svc-sewage-backup',
        'body' => 'Sewage is Category 3 water. Contaminated materials are removed, surfaces are disinfected and the area is dried using protective procedures.',
        'sentence' => 'See sewage backup cleanup in Acworth',
        'anchor'   => 'sewage backup cleanup in Acworth',
    ],
    [
        'slug' => '/mold-remediation-acworth-ga',
        'nav'  => 'Mold Remediation',
        'h3'   => 'Mold Remediation in Acworth',
        'img'  => 'svc-mold-remediation',
        'body' => 'If water sat too long, mold is contained, removed and the source moisture corrected so it doesn\'t return.',
        'sentence' => 'See mold remediation in Acworth',
        'anchor'   => 'mold remediation in Acworth',
    ],
    [
        'slug' => '/ceiling-water-damage-repair-acworth-ga',
        'nav'  => 'Ceiling Water Damage Repair',
        'h3'   => 'Ceiling Water Damage Repair in Acworth',
        'img'  => 'svc-ceiling-water-damage',
        'body' => 'Sagging or stained ceilings from upstairs bathrooms, attic air handlers or roof leaks are drained, dried and rebuilt.',
        'sentence' => 'See ceiling water damage repair in Acworth',
        'anchor'   => 'ceiling water damage repair',
    ],
    [
        'slug' => '/storm-roof-leak-water-damage-acworth-ga',
        'nav'  => 'Storm & Roof Leak Water Damage',
        'h3'   => 'Storm & Roof Leak Water Damage in Acworth',
        'img'  => 'svc-storm-roof-leak',
        'body' => 'Emergency tarping, attic drying and interior water removal after wind-driven rain or a fallen tree.',
        'sentence' => 'See storm water damage cleanup in Acworth',
        'anchor'   => 'storm water damage cleanup',
    ],
    [
        'slug' => '/water-heater-leak-cleanup-acworth-ga',
        'nav'  => 'Water Heater Leak Cleanup',
        'h3'   => 'Water Heater Leak Cleanup in Acworth',
        'img'  => 'svc-water-heater-leak',
        'body' => 'Failed water heater tanks, washing machine hoses, dishwasher lines and clogged AC condensate drains are some of the most common indoor leaks.',
        'sentence' => 'See water heater leak cleanup in Acworth',
        'anchor'   => 'water heater leak cleanup',
    ],
    [
        'slug' => '/appliance-leak-water-damage-acworth-ga',
        'nav'  => 'Appliance Leak Cleanup',
        'h3'   => 'Appliance Leak Cleanup in Acworth',
        'img'  => 'svc-appliance-leak',
        'body' => 'Failed water heater tanks, washing machine hoses, dishwasher lines and clogged AC condensate drains are some of the most common indoor leaks.',
        'sentence' => 'appliance leak cleanup in Acworth',
        'anchor'   => 'appliance leak cleanup in Acworth',
    ],
    [
        'slug' => '/ac-leak-water-damage-acworth-ga',
        'nav'  => 'AC Leak Water Damage',
        'h3'   => 'AC Leak Water Damage in Acworth',
        'img'  => 'svc-ac-leak',
        'body' => 'Failed water heater tanks, washing machine hoses, dishwasher lines and clogged AC condensate drains are some of the most common indoor leaks.',
        'sentence' => 'AC leak water damage in Acworth',
        'anchor'   => 'AC leak water damage',
    ],
    [
        'slug' => '/hardwood-floor-water-damage-acworth-ga',
        'nav'  => 'Hardwood Floor Water Damage',
        'h3'   => 'Hardwood Floor Water Damage in Acworth',
        'img'  => 'svc-hardwood-floor',
        'body' => 'Floor drying mats help save cupped hardwood, and wet carpet is extracted and dried with the pad replaced when needed.',
        'sentence' => 'See hardwood floor water damage in Acworth',
        'anchor'   => 'hardwood floor water damage',
    ],
    [
        'slug' => '/carpet-water-damage-acworth-ga',
        'nav'  => 'Carpet Water Damage',
        'h3'   => 'Carpet Water Damage in Acworth',
        'img'  => 'svc-carpet-water-damage',
        'body' => 'Floor drying mats help save cupped hardwood, and wet carpet is extracted and dried with the pad replaced when needed.',
        'sentence' => 'carpet water damage in Acworth',
        'anchor'   => 'carpet water damage in Acworth',
    ],
    [
        'slug' => '/water-damage-repair-acworth-ga',
        'nav'  => 'Water Damage Repair',
        'h3'   => 'Water Damage Repair in Acworth',
        'img'  => 'svc-water-damage-repair',
        'body' => 'Once everything is dry, damaged drywall, insulation, baseboards and flooring are replaced so the home is finished, not just dried.',
        'sentence' => 'See water damage repair in Acworth',
        'anchor'   => 'water damage repair in Acworth',
    ],
    [
        'slug' => '/commercial-water-damage-acworth-ga',
        'nav'  => 'Commercial Water Damage',
        'h3'   => 'Commercial Water Damage in Acworth',
        'img'  => 'svc-commercial-water-damage',
        'body' => 'Offices, shops, restaurants and marinas get after-hours extraction and phased drying to keep doors open.',
        'sentence' => 'See commercial water damage restoration in Acworth',
        'anchor'   => 'commercial water damage restoration',
    ],
    [
        'slug' => '/lake-allatoona-water-damage',
        'nav'  => 'Lake Allatoona Water Damage',
        'h3'   => 'Lake Allatoona Lake Home Water Damage',
        'img'  => 'svc-lake-allatoona',
        'body' => 'Walkout basements, lower levels and vacant second homes along Lake Allatoona get dedicated attention when lake water or a hidden leak gets inside.',
        'sentence' => 'See Lake Allatoona water damage restoration',
        'anchor'   => 'Lake Allatoona water damage restoration',
    ],
    [
        'slug' => '/water-damage-insurance-claim-acworth-ga',
        'nav'  => 'Water Damage Insurance Claim',
        'h3'   => 'Water Damage Insurance Claim Help in Acworth',
        'img'  => 'svc-insurance-claim',
        'body' => 'Most Georgia homeowners policies cover sudden and accidental water damage, such as a burst pipe or a failed water heater, but they exclude outside floodwater and long-term seepage. Flooding from creeks or rising lake water usually needs a separate flood policy through the NFIP. Photos, moisture readings and drying logs help support any claim.',
        'desc' => 'Most Georgia homeowners policies cover sudden and accidental water damage, such as a burst pipe or a failed water heater, but they exclude outside floodwater and long-term seepage.',
        'sentence' => '',
        'anchor'   => '',
    ],
];

// 15 homepage service cards. 'links' lists the service slugs whose
// closing sentences belong to the card, in doc order; multi-link cards
// join their sentences with ', ' and ' and ' exactly as in the doc.
$CARDS = [
    ['h3' => 'Emergency Water Extraction in Acworth',
     'body' => 'Truck-mounted and portable extractors pull standing water out of carpet, hardwood, tile and subfloors before it soaks deeper into the structure.',
     'links' => ['/emergency-water-extraction-acworth-ga'], 'img' => 'svc-emergency-water-extraction'],
    ['h3' => 'Water Mitigation & Structural Drying in Acworth',
     'body' => 'Commercial dehumidifiers, air movers and daily moisture readings dry walls, framing and floors to safe levels instead of leaving hidden moisture behind.',
     'links' => ['/water-mitigation-acworth-ga'], 'img' => 'svc-water-mitigation'],
    ['h3' => 'Flood Damage Restoration in Acworth',
     'body' => 'When creeks or heavy rain push water inside, the crew handles flood cleanup, extraction, sanitizing and drying for Category 2 and Category 3 water.',
     'links' => ['/flood-damage-restoration-acworth-ga'], 'img' => 'svc-flood-damage-restoration'],
    ['h3' => 'Burst Pipe Cleanup in Acworth',
     'body' => 'Frozen attic lines, cracked supply hoses and failed fittings can release gallons every minute. Water is removed, wet materials are opened up and drying starts the same visit.',
     'links' => ['/burst-pipe-water-damage-acworth-ga'], 'img' => 'svc-burst-pipe'],
    ['h3' => 'Flooded Basement Cleanup in Acworth',
     'body' => 'Finished, partial and walkout basements are common in Acworth, and they are where water collects first. Carpet, drywall and storage are triaged and dried fast.',
     'links' => ['/flooded-basement-cleanup-acworth-ga'], 'img' => 'svc-flooded-basement'],
    ['h3' => 'Crawl Space Water Removal in Acworth',
     'body' => 'Standing water under the house is pumped out, and the crawl space is dried so moisture doesn\'t rise into floors and living areas.',
     'links' => ['/crawl-space-water-removal-acworth-ga'], 'img' => 'svc-crawl-space'],
    ['h3' => 'Sewage Backup Cleanup in Acworth',
     'body' => 'Sewage is Category 3 water. Contaminated materials are removed, surfaces are disinfected and the area is dried using protective procedures.',
     'links' => ['/sewage-backup-cleanup-acworth-ga'], 'img' => 'svc-sewage-backup'],
    ['h3' => 'Mold Remediation in Acworth',
     'body' => 'If water sat too long, mold is contained, removed and the source moisture corrected so it doesn\'t return.',
     'links' => ['/mold-remediation-acworth-ga'], 'img' => 'svc-mold-remediation'],
    ['h3' => 'Ceiling Water Damage Repair in Acworth',
     'body' => 'Sagging or stained ceilings from upstairs bathrooms, attic air handlers or roof leaks are drained, dried and rebuilt.',
     'links' => ['/ceiling-water-damage-repair-acworth-ga'], 'img' => 'svc-ceiling-water-damage'],
    ['h3' => 'Storm & Roof Leak Water Damage in Acworth',
     'body' => 'Emergency tarping, attic drying and interior water removal after wind-driven rain or a fallen tree.',
     'links' => ['/storm-roof-leak-water-damage-acworth-ga'], 'img' => 'svc-storm-roof-leak'],
    ['h3' => 'Water Heater, Appliance & AC Leak Cleanup in Acworth',
     'body' => 'Failed water heater tanks, washing machine hoses, dishwasher lines and clogged AC condensate drains are some of the most common indoor leaks.',
     'links' => ['/water-heater-leak-cleanup-acworth-ga', '/appliance-leak-water-damage-acworth-ga', '/ac-leak-water-damage-acworth-ga'],
     'img' => 'svc-water-heater-leak'],
    ['h3' => 'Hardwood Floor & Carpet Drying in Acworth',
     'body' => 'Floor drying mats help save cupped hardwood, and wet carpet is extracted and dried with the pad replaced when needed.',
     'links' => ['/hardwood-floor-water-damage-acworth-ga', '/carpet-water-damage-acworth-ga'],
     'img' => 'svc-hardwood-floor'],
    ['h3' => 'Water Damage Repair in Acworth',
     'body' => 'Once everything is dry, damaged drywall, insulation, baseboards and flooring are replaced so the home is finished, not just dried.',
     'links' => ['/water-damage-repair-acworth-ga'], 'img' => 'svc-water-damage-repair'],
    ['h3' => 'Commercial Water Damage in Acworth',
     'body' => 'Offices, shops, restaurants and marinas get after-hours extraction and phased drying to keep doors open.',
     'links' => ['/commercial-water-damage-acworth-ga'], 'img' => 'svc-commercial-water-damage'],
    ['h3' => 'Lake Allatoona Lake Home Water Damage',
     'body' => 'Walkout basements, lower levels and vacant second homes along Lake Allatoona get dedicated attention when lake water or a hidden leak gets inside.',
     'links' => ['/lake-allatoona-water-damage'], 'img' => 'svc-lake-allatoona'],
];

$SERVICES_H2    = 'Water Damage Services in Acworth, GA';
$SERVICES_INTRO = 'From a single leaking water heater to a basement full of storm runoff, every service below is handled by the same 24/7 crew. Whatever the source, the goal is the same: fast water removal in Acworth homes, complete drying and a clean, safe space again.';
$SERVICES_CLOSE = 'Water coming in right now? Call (470) 672-2095. A crew is dispatched immediately to any address in Acworth 30101 or 30102, day or night.';

$CAUSES_H2    = 'What causes water damage in Acworth homes?';
$CAUSES_INTRO = 'Acworth sits between Lake Acworth and Lake Allatoona, with creeks, sloped lots and a large number of homes built in the 1980s and 1990s. That mix creates a few patterns that show up again and again:';
$CAUSES = [
    ['label' => 'Lake and creek water', 'text' => 'Allatoona Creek, Proctor Creek, Clark Creek and Pitner Creek rise fast during multi-day rain, and saturated ground pushes water against lower levels.'],
    ['label' => 'Finished and walkout basements', 'text' => 'Basements set into hillsides take in water where the wall meets the slab, through cinder-block seams or when a sump pump fails.'],
    ['label' => 'Attic and crawl space plumbing', 'text' => 'Supply lines in unheated attics and vented crawl spaces are the first to freeze and split on cold nights.'],
    ['label' => 'Attic air handlers', 'text' => 'Long Georgia cooling seasons fill condensate pans daily, and one clogged drain line can soak a ceiling.'],
    ['label' => 'Aging water heaters', 'text' => 'Tanks in basements and garages often fail after about 8 to 12 years of use.'],
    ['label' => 'Sewer line blockages', 'text' => 'Grease, roots and debris in a private sewer line can push wastewater back up through floor drains and toilets.'],
    ['label' => 'Storms and trees', 'text' => 'Wind-driven rain and falling limbs open roofs and let water into attics and upper floors.'],
];

$SIGNS_H2    = 'What are the hidden signs of water damage in an Acworth home?';
$SIGNS_INTRO = 'Not every leak announces itself with a puddle. Watch for:';
$SIGNS = [
    'A musty smell in a finished basement that doesn\'t fade with the AC running',
    'Paint bubbling or peeling on walls near bathrooms, laundry rooms or exterior walls',
    'Baseboards swelling, separating or turning soft at the bottom',
    'Hardwood boards cupping, or laminate and LVP lifting at the seams',
    'White, chalky residue (efflorescence) on cinder-block basement walls',
    'Brown rings or soft spots on ceilings below bathrooms or under the attic air handler',
    'A water meter that keeps moving with every fixture turned off',
    'Higher indoor humidity, condensation on windows or doors that suddenly stick',
];
$SIGNS_CLOSE = 'Any of these is worth a moisture check before it turns into a larger repair.';

$PROCESS_H2    = 'How does water damage restoration in Acworth, GA work?';
$PROCESS_INTRO = 'Every job follows a clear process so nothing is missed and drying is measured, not guessed.';
$PROCESS_STEPS = [
    ['label' => 'Dispatch', 'text' => 'A crew is dispatched immediately with extraction and drying equipment on board.'],
    ['label' => 'Stop the source', 'text' => 'The water supply is shut off or the leak is isolated, and electrical hazards are checked.'],
    ['label' => 'Inspect and map moisture', 'text' => 'Moisture meters and thermal imaging show how far water traveled into walls, floors and cabinets.'],
    ['label' => 'Water extraction', 'text' => 'Standing water is removed from floors, carpet and subfloors.'],
    ['label' => 'Structural drying', 'text' => 'Dehumidifiers and air movers run while moisture readings are logged daily until materials reach dry standards.'],
    ['label' => 'Clean and sanitize', 'text' => 'Affected areas are cleaned, and antimicrobial treatment is applied where needed to help prevent mold after water damage.'],
    ['label' => 'Repair and rebuild', 'text' => 'Drywall, insulation, trim and flooring are replaced so the space is ready to use again.'],
];
$PROCESS_CLOSE = 'Ready to start drying? Call (470) 672-2095 and a crew is dispatched immediately.';

$MITIGATION_H2 = 'Water mitigation vs. water damage restoration: what\'s the difference?';
$MITIGATION_TABLE = [
    'headers' => ['Stage', 'What happens', 'When it happens'],
    'rows' => [
        ['Mitigation', 'Water extraction, drying, dehumidification, moisture monitoring', 'First hours to about 5 days'],
        ['Restoration', 'Drywall, insulation, flooring, cabinets and paint replaced or repaired', 'After materials are fully dry'],
    ],
];
$MITIGATION_CLOSE = 'Mitigation stops the damage from growing. Restoration puts the home back together. Most Acworth jobs need both, and insurers usually look at them as separate stages.';

$DRYING_H2 = 'How long do different materials take to dry?';
$DRYING_TABLE = [
    'headers' => ['Material', 'Typical drying time', 'Notes'],
    'rows' => [
        ['Carpet', '1-3 days', 'Pad is often replaced; sewage-soaked carpet is removed'],
        ['Drywall', '2-4 days', 'Removed if soaked high or wet with gray or black water'],
        ['Wood framing and subfloor', '3-5 days', 'Checked with moisture meters until it reaches a dry reading'],
        ['Hardwood flooring', '3-7+ days', 'Floor drying mats help limit cupping'],
        ['Concrete slab and cinder block', '5-10+ days', 'Dense materials hold water the longest'],
    ],
];
$DRYING_CLOSE = 'These are typical ranges. Humidity, how long the water sat and how quickly extraction started all change the real number. Daily moisture readings decide when drying is finished, not the calendar.';

$CATEGORY_H2 = 'What category of water is in your home?';
$CATEGORY_TABLE = [
    'headers' => ['Category', 'Source examples', 'How it\'s handled'],
    'rows' => [
        ['Category 1 (clean)', 'Supply line, water heater, faucet overflow', 'Extract and dry; most materials can be saved'],
        ['Category 2 (gray)', 'Washing machine, dishwasher, sump overflow', 'Extract, clean, sanitize, then dry'],
        ['Category 3 (black)', 'Sewage, outside floodwater, creek water', 'Remove porous materials, disinfect, then dry'],
    ],
];
$CATEGORY_CLOSE = 'Clean water can turn into Category 2 or 3 if it sits for a day or two, which is another reason fast extraction matters.';

$EQUIPMENT_H2 = 'What equipment is used on an Acworth water damage job?';
$EQUIPMENT = [
    'Truck-mounted and portable extractors pull standing water out of carpet, pad and hard floors',
    'LGR (low-grain refrigerant) dehumidifiers pull moisture out of the air so materials can release it',
    'High-velocity air movers push air across wet surfaces to speed evaporation',
    'Thermal imaging cameras reveal wet areas behind walls and under floors without demolition',
    'Pin and pinless moisture meters confirm when each material reaches a dry reading',
    'Hardwood floor drying mats draw water up out of boards and subfloor',
    'HEPA air scrubbers capture airborne particles during mold or sewage cleanup',
    'Antimicrobial treatments go on cleaned surfaces to help prevent mold growth',
];

$ZIPS_H2    = 'Water damage across Acworth 30101 and 30102';
$ZIPS_INTRO = 'Acworth\'s two ZIP codes cover very different kinds of homes, and each brings its own water problems.';
$ZIPS_PARAS = [
    'Acworth 30101 includes downtown Acworth, Lake Acworth, the McEver Road area and neighborhoods like Brookstone, Cedarcrest, Becketts Walk and Ford Landing. Many of these homes have finished or partial basements and two-story layouts with upstairs laundry rooms, so basement seepage and ceiling leaks are common calls.',
    'Acworth 30102 stretches along Bells Ferry Road and Highway 92 into unincorporated Cherokee County, with neighborhoods such as Bennett Farms, Bells Ferry Place, Allatoona Pass, Buice Lake and Worthington, plus manufactured-home communities and lake homes near the Allatoona shoreline. Older plumbing, crawl spaces and some homes on septic systems make water removal in Acworth\'s 30102 area a different job than in a newer slab home.',
];
$ZIPS_CLOSE = 'Wherever your home sits, water damage in Acworth, GA is handled with the same 24/7 response and the same measured drying process.';

$SCENARIOS_H2 = 'Common water damage situations around Acworth';
$SCENARIOS = [
    ['h3' => 'The vacant lake house',
     'text' => 'A second home near Lake Allatoona sits empty during a hard freeze. An attic or crawl space line splits, and water runs for days before anyone notices. These jobs usually need extraction on more than one floor, flood cuts in drywall and a mold check.'],
    ['h3' => 'The upstairs laundry leak',
     'text' => 'A washer supply hose bursts on the second floor of a newer home. Water travels through the subfloor into the ceiling and walls below. Drying focuses on the ceiling cavity, the framing and the flooring on both levels.'],
    ['h3' => 'The basement after days of rain',
     'text' => 'Ground around a hillside home stays saturated after several days of rain, the sump pump can\'t keep up, and water spreads across a finished basement. Carpet, pad and lower drywall are triaged, and the block walls are dried with dehumidification.'],
    ['h3' => 'The summer ceiling drip',
     'text' => 'In the middle of summer the attic air handler\'s condensate line clogs and the overflow pan fills. Water soaks the insulation and stains the ceiling below. The fix is drying the attic, replacing wet insulation and repairing the drywall.'],
];

$PAYS_H2 = 'Who pays for water damage in Acworth: you, Cobb County or insurance?';
$PAYS = [
    ['h3' => 'Water and sewer lines',
     'para' => 'Cobb County Water System maintains the public water and sewer mains. Pipes on your property, including your private sewer line, are the homeowner\'s responsibility. If you see a break in the street or suspect a county sewer main is backing up, Cobb Water\'s Emergency Dispatch line is 770-419-6201.'],
    ['h3' => 'Cobb County leak credit',
     'para' => 'Cobb County Water System offers a partial leak credit once in a rolling 12-month period for documented private plumbing leaks, covering no more than two billing months. Keep your plumbing repair receipt, because it is required to apply.'],
    ['h3' => 'Homeowners insurance vs. flood insurance',
     'para' => ['text' => 'Most Georgia homeowners policies cover sudden and accidental water damage, such as a burst pipe or a failed water heater, but they exclude outside floodwater and long-term seepage. Flooding from creeks or rising lake water usually needs a separate flood policy through the NFIP. Photos, moisture readings and drying logs help support any claim. See water damage insurance claim help in Acworth',
        'anchor' => 'water damage insurance claim', 'href' => '/water-damage-insurance-claim-acworth-ga']],
];

$COST_H2    = 'How much does water damage restoration cost in Acworth?';
$COST_PARA  = 'Costs depend on how much area got wet, the category of water and how long it sat. As a general range, smaller cleanups can run a few hundred dollars, a typical Acworth water damage job lands around $1,400 to $3,800, and large floods or sewage losses that need rebuilding can go well past $15,000.';
$COST_INTRO = 'The biggest cost drivers are:';
$COST_BULLETS = [
    'Square footage and number of rooms affected',
    'Clean water vs. gray water vs. sewage',
    'Whether drywall, insulation, cabinets or flooring must be removed',
    'How many days of drying equipment are needed',
    'Whether mold has already started',
];

$FIRST_HOUR_H2 = 'What should you do in the first hour after water damage?';
$FIRST_HOUR = [
    'Shut off the water at the main valve or the appliance supply.',
    'Turn off power to wet rooms if it\'s safe to reach the breaker.',
    'Take photos and video of every wet area before moving anything.',
    'Move valuables, electronics and rugs to a dry room.',
    'Stay out of sewage or floodwater, which can carry bacteria.',
    'Don\'t use a household vacuum on standing water.',
    'Call for water extraction so drying can start right away.',
];

$CHOOSING_H2    = 'How to choose a water damage company in Acworth';
$CHOOSING_INTRO = 'When you\'re comparing any water damage company in Acworth, a few questions separate a fast, thorough job from a slow one:';
$CHOOSING = [
    'Do they answer and dispatch 24/7, including nights and holidays?',
    'Do they follow IICRC S500 drying standards?',
    'Do they measure and log moisture daily, or just set fans and leave?',
    'Can they handle Category 3 water like sewage and floodwater?',
    'Do they document the job with photos and drying records for insurance?',
    'Can they handle repairs after drying, so you aren\'t hiring a second crew?',
];

$NEARBY_H2    = 'Areas served near Acworth';
$NEARBY_INTRO = 'The same 24/7 crew also covers nearby cities in Cobb, Cherokee, Bartow and Paulding counties:';
$AREAS = [
    ['slug' => '/locations/kennesaw-ga', 'city' => 'Kennesaw',
     'line' => 'Water damage restoration in Kennesaw, GA', 'anchor' => 'Water damage restoration in Kennesaw, GA'],
    ['slug' => '/locations/woodstock-ga', 'city' => 'Woodstock',
     'line' => 'Water damage restoration in Woodstock, GA', 'anchor' => 'Water damage restoration in Woodstock, GA'],
    ['slug' => '/locations/cartersville-ga', 'city' => 'Cartersville',
     'line' => 'Water damage restoration in Cartersville, GA', 'anchor' => 'Water damage restoration in Cartersville, GA'],
    ['slug' => '/locations/dallas-ga', 'city' => 'Dallas',
     'line' => 'Water damage restoration in Dallas, GA', 'anchor' => 'Water damage restoration in Dallas, GA'],
    ['slug' => '/locations/hiram-ga', 'city' => 'Hiram',
     'line' => 'Water damage restoration in Hiram, GA', 'anchor' => 'Water damage restoration in Hiram, GA'],
];
$AREAS_HUB_LINE = ['text' => 'See all service areas', 'anchor' => 'all service areas', 'href' => '/locations'];
$AREAS_ZIP_LINE = 'ZIP codes covered: 30101 and 30102, including unincorporated Cherokee County.';

$FAQ_H2 = 'Water Damage FAQs';
$FAQS = [
    ['q' => 'Who do I call for water damage in Acworth?',
     'a' => 'Call a 24/7 water damage company in Acworth that can dispatch a crew immediately for extraction and drying. Our crew is reached at (470) 672-2095. For a broken public water main in the street, contact Cobb County Water System\'s Emergency Dispatch at 770-419-6201.'],
    ['q' => 'How long does it take to dry a water-damaged home?',
     'a' => 'Most structural drying takes about 3 to 5 days. Dense materials like hardwood, plaster and cinder block, or high humidity, can extend that. Daily moisture readings show when each area is truly dry.'],
    ['q' => 'Can I stay in my home during drying?',
     'a' => 'In most clean-water cases, yes. Drying equipment is noisy but safe. With sewage or significant mold, it\'s better to stay out of the affected area until it\'s cleaned and sanitized.'],
    ['q' => 'Will mold grow after a leak?',
     'a' => 'Mold can start within 24 to 48 hours on wet drywall, carpet or wood. Fast extraction and measured drying are the best way to prevent it.'],
    ['q' => 'Does homeowners insurance cover water damage in Georgia?',
     'a' => 'Usually for sudden, accidental leaks like burst pipes or appliance failures. Outside flooding from creeks or the lake is typically excluded and needs separate flood coverage. Check your policy and document everything.'],
    ['q' => 'Do you cover unincorporated Acworth in Cherokee County?',
     'a' => 'Yes. Water damage in Acworth, GA is handled across both ZIP codes, including the 30102 areas along Bells Ferry Road and Highway 92 that sit in unincorporated Cherokee County.'],
];

$FINAL_CTA_H2 = 'Water in your Acworth home right now?';
$FINAL_CTA_PARAS = [
    'Don\'t wait for it to spread. Our 24/7 water damage restoration crew in Acworth, GA is ready for burst pipes, flooded basements, sewage backups and storm leaks across 30101 and 30102. Call (470) 672-2095 now and a crew is dispatched immediately for emergency water damage in Acworth, from first extraction to final repair.',
];
