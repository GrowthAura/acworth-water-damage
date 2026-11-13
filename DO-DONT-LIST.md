# ACWORTH WATER DAMAGE — DO / DON'T LIST (top authority for the builder)
Doc: Google Doc 1inwjmOHwwQLP9kaNX9-5rE1-iWBCpO4PRFn-0sMGYmU, 'Water Damage Restoration in Acworth'
Phone ONLY: (470) 672-2095 — ZIPs 30101 + 30102, Acworth, GA (Cobb & Cherokee County)
Build dir: ~/workspace/acworth-water-damage/ — Stack: plain PHP 8 (San Bruno pattern: index.php front controller + includes/ + data/pages.php + .htaccess). LIVE on GitHub Pages since 2026-11-12 ~19:35 PKT.

## ⚠️ CORRECTION 2026-11-12 ~19:48 PKT — THE STANDARD (his order, applies to ALL future work on this site)
- **Content 1001% exactly as in his docs, exactly as instructed — na ek lafz kam, na ek lafz zyada, na kuch invent karna hai.** Har site ek se badh kar ek ho — is site ko pichli sites se BEHTAR banao.
- **The doc was NEVER homepage-only.** The 2026-11-11 read used plain `documents.get`, which silently returns Tab 1 ONLY. Re-read with `includeTabsContent=true`: **41 tabs, 50,057 words** (Tab 1 = 3,026 words, byte-identical to the old read). Full per-tab counts: qa/DOC-TABS-2026-11-12.md. Raw: doc-tabs-raw.json.
- **Rule: fetch Google Docs ONLY with includeTabsContent=true; verify the `tabs` array and count tabs + words per tab BEFORE claiming anything about a doc's coverage.**
- **Content-fullness gate in EVERY QA round from now on:** per-page visible-word count (total + main-body excl. header/footer/sticky bar + UNIQUE prose). EMPTY = main <100 words, THIN = 100–300. A page returning 200 with H1=1 can still be effectively empty. Rendered-state checks (real clicks / Chromium mirror) are mandatory, never curl alone.
- **Live site as deployed is THIN:** its 25 inner pages carry only their verbatim homepage summary; 15 doc routes are missing entirely (6 services, 7 resources, /about/, /contact/). Full doc route count is **41, not 26**. Rebuild scope: 41 routes with full verbatim tab content.
- Headings in the tabs are literal "H1:/H2:/H3:" text labels; links are plain-text parenthetical paths; **0 hyperlink objects** in the doc. Parse labels + URL lines; never infer links.

## DO
- Content 100% verbatim from the doc. Do NOT cut, shorten, paraphrase or invent a single line. Strip em/en dashes at build time without changing words (en dash in a range becomes a hyphen: 24-48 hours, 3-5 days).
- Lynnwood theme = DESIGN LANGUAGE ONLY: Fraunces (display serif) + Inter (body), warm paper #FBF8F2, deep ink #0F1D2E, ocean accent #0B7AB5. Write the PHP/CSS/JS FRESH for Acworth. Design inspiration only.
- Button 1 = ONLY the call number "(470) 672-2095", nothing else written in it. Button 2 ("Request Emergency Help") = EQUAL to Button 1 — same size, same prominence, same visibility.
- Body text 18px sitewide (his standing rule). Only headings keep their own sizes.
- Wide-text rule: body/content max-width 88ch, hero intro 72ch, hero H1 24ch, H2 36ch, container 1280px.
- URL form: homepage / only, every other route NO trailing slash. Slash form of a no-slash route answers 308 to the no-slash form. Self-canonical on every page (1/page).
- Google end-level: JSON-LD (LocalBusiness + BreadcrumbList + FAQPage + WebSite + Service), sitemap date-only lastmod (YYYY-MM-DD, no time), robots Allow:/ with NO Host: line, LCP <1.8s mobile, CLS 0, 0 broken links, 0 orphans, H1 = 1 visible per page, FAQ schema 6/6 = visible Q&A exactly matching, anchors max 3-5 words, 1 link per target per page in body copy, NO page links to itself from its own body (header/footer/breadcrumb exempt).
- Homepage FULL verbatim: H1 x1, H2 x18, H3 x29, FAQ 6, trust badges 4, 15 service cards, 7 process steps, 3 real tables, 5 area links.
- EVERY route gets its FULL verbatim tab content (1,042–1,586 words per service/area tab; resources 917–1,020; hub 766; about 831; contact 570). No summary-only pages, no skeleton pages — the doc HAS the content. Parse each tab's H1:/H2:/H3: labels + URL line + meta title/description verbatim.
- Fresh images ONLY (see DON'T). Every image: real photographic, topic-fit + place-fit by VIEWED pixels, correct aspect, height measured (never width alone), file weight sane, EXIF/XMP stripped + verified, no "AI" word in filename/path/alt/metadata, never claimed as a real job photo. If a slot has no file on disk, page_img() returns null and the slot renders a navy panel — never a broken img.
- Forms: lead form on homepage + service pages (lead-band with name/phone/message). No backend mail until he gives an address — form must not pretend to send.
- Mobile: sticky call bar (hidden while hero on screen), hamburger (46x46, Escape closes), no horizontal overflow at 320/390/768/1280, Button 2 visible at scroll-0, phone CTA never hidden.
- Footer map on every page EXCEPT area pages (and the /locations hub). Footer NAP = phone + city/ZIP only.
- Verify VISUALLY with real screenshots (desktop + mobile) before any claim. Code checks alone never prove a design.

## DON'T
- ZERO images from any past site — not renamed, cropped or resized. Lynnwood's 16 images are BANNED, and so is every image from San Bruno, Pleasant Grove and Tulsa. Every Acworth image must be fresh for Acworth.
- NEVER copy/clone any file from San Bruno, Pleasant Grove, Lynnwood or Tulsa (CSS, JS, pages, favicon) — write CSS/PHP/JS fresh. Google differentiation ABSOLUTE: zero traces of any other site anywhere (name, phone (425) 845-0289 / (650) 822-6798 / (385) 346-0377, domains, other cities, comments, filenames, alt text, schema, sitemap, robots, manifest, llms.txt, image metadata).
- Do NOT invent: no street address (none in doc), no domain (none in doc — SITE url is now the Pages URL https://growthaura.github.io/acworth-water-damage/, swap when a real domain lands), no certifications, reviews, rates, licences, equipment, dates or geography beyond the doc. Cost range $1,400-$3,800 typical / past $15,000 large is verbatim doc — keep exactly. Quick Answers "about 3,800 for an average job" is verbatim doc — keep exactly, no $ added. /about/ and /contact/ ARE in the doc (Tabs 40–41) — build them from their tabs, verbatim. NO Privacy tab exists — do NOT build a Privacy page.
- The Cobb County Water System Emergency Dispatch number 770-419-6201 in the doc is PLAIN TEXT, not our business phone. Never put it in a call button, the header, the footer NAP, or schema.
- Do NOT add a link not in the doc. Doc link annotations (URLs in parentheses) are the ONLY authority for links. A link anchored on only part of his phrase counts as missing.
- Do NOT change any URL. The 41 routes below are final unless he orders a change.
- NO push / deploy / domain / DNS / Vercel / GitHub Pages without his explicit word + token. Re-push of the rebuilt site needs his word too.
- NO ranking / leads / customer-outcome guarantee ever. YES full own-effort guarantee: end-level work, verbatim content, no fake claims, measured speed, checks, no blunder gates skipped.
- Do NOT call a page done on curl 200 alone — prove it with a real-browser render + screenshot.

## ROUTES (41 total — from the full 41-tab doc read, verified 2026-11-12)
1. / — homepage (Tab 1, full doc)
2. /emergency-water-extraction-acworth-ga (Tab 2)
3. /flood-damage-restoration-acworth-ga (Tab 3)
4. /burst-pipe-water-damage-acworth-ga (Tab 4)
5. /flooded-basement-cleanup-acworth-ga (Tab 5)
6. /sewage-backup-cleanup-acworth-ga (Tab 6)
7. /water-mitigation-acworth-ga (Tab 7)
8. /mold-remediation-acworth-ga (Tab 8)
9. /ceiling-water-damage-repair-acworth-ga (Tab 9)
10. /storm-roof-leak-water-damage-acworth-ga (Tab 10)
11. /lake-allatoona-water-damage (Tab 11)
12. /water-damage-repair-acworth-ga (Tab 12)
13. /crawl-space-water-removal-acworth-ga (Tab 13)
14. /water-heater-leak-cleanup-acworth-ga (Tab 14)
15. /hardwood-floor-water-damage-acworth-ga (Tab 15)
16. /commercial-water-damage-acworth-ga (Tab 16)
17. /mold-inspection-acworth-ga (Tab 17 — NEW route, was missing)
18. /appliance-leak-water-damage-acworth-ga (Tab 18)
19. /ac-leak-water-damage-acworth-ga (Tab 19)
20. /slab-leak-water-damage-acworth-ga (Tab 20 — NEW route, was missing)
21. /carpet-water-damage-acworth-ga (Tab 21)
22. /townhome-water-damage-acworth-ga (Tab 22 — NEW route, was missing)
23. /mobile-home-water-damage-acworth-ga (Tab 23 — NEW route, was missing)
24. /water-damage-insurance-claim-acworth-ga (Tab 24)
25. /rental-property-water-damage-acworth-ga (Tab 25 — NEW route, was missing)
26. /fire-water-damage-acworth-ga (Tab 26 — NEW route, was missing)
27. /locations/kennesaw-ga (Tab 27)
28. /locations/woodstock-ga (Tab 28)
29. /locations/cartersville-ga (Tab 29)
30. /locations/dallas-ga (Tab 30)
31. /locations/hiram-ga (Tab 31)
32. /resources/cobb-county-sewage-backup-who-pays/ (Tab 32 — NEW route, was missing)
33. /resources/cobb-county-water-leak-credit/ (Tab 33 — NEW route, was missing)
34. /resources/lake-allatoona-high-water-basement/ (Tab 34 — NEW route, was missing)
35. /resources/musty-basement-water-damage-signs/ (Tab 35 — NEW route, was missing)
36. /resources/acworth-frozen-pipe-prevention/ (Tab 36 — NEW route, was missing)
37. /resources/water-damage-restoration-cost-acworth/ (Tab 37 — NEW route, was missing)
38. /resources/water-damage-first-24-hours/ (Tab 38 — NEW route, was missing)
39. /locations (Tab 39, hub)
40. /about/ (Tab 40 — NEW route, was missing)
41. /contact/ (Tab 41 — NEW route, was missing)

## OPEN (his call, do not guess)
- Domain: none in doc — SITE url is now the Pages URL; confirm the real domain before any apex move.
- No street address in doc — footer NAP is phone + city/ZIP only until he gives an address.
- About/Contact ARE in the doc (Tabs 40–41) — built from their tabs in the rebuild. NO Privacy tab — do not build Privacy.
- Real job photos vs fresh stock photos — fresh photographic images are the plan; swap in real job photos later if he sends them.
- Meta title verbatim ("Water Damage Restoration Acworth GA | 24/7 Emergency Crew" = 57ch) — keep verbatim unless he orders a trim.
