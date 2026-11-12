# ACWORTH — MASTER CHECKLIST (tick only on verified evidence, never on claim)

## 0. SOURCE (done 2026-11-11 ~17:43 PKT)
- [x] Doc read: 'Water Damage Restoration in Acworth', 3,026 words, H1 x1, H2 x18, H3 x29, FAQ 6
- [x] Phone (470) 672-2095 only; Cobb dispatch 770-419-6201 is plain text, not our phone; ZIPs 30101 + 30102
- [x] 26 routes extracted from doc parentheses (19 services + locations hub + 5 areas + homepage)
- [x] San Bruno pattern inspected (index.php, pages.php, functions.php, header/footer, lead-form/handler, media.php, main.js, .htaccess, robots, llms, manifest)

## 1. PHP SCAFFOLD (fresh code, Acworth only)
- [x] index.php front controller (router, 308 slash->no-slash, sitemap.xml dynamic, static-file serving)
- [x] .htaccess (RewriteEngine, slash->308, front-controller fallback)
- [x] $SITE in data/pages.php (placeholder url http://localhost:8000, comment PLACEHOLDER)
- [x] includes/header.php + footer.php (shared, sticky header, mobile nav, sticky call bar, footer map except area pages)
- [x] includes/functions.php (esc, canonical, linkify, card_para, card_para_multi, tables, schema builders)
- [x] data/pages.php (all 26 routes, meta, H1, verbatim summaries; 15 homepage cards incl. 3-link and 2-link cards)
- [x] data/media.php (32-slot manifest; page_img/card_img return null when the file is not on disk)
- [x] assets/css/styles.css FRESH (design language, 18px body, 88ch/72ch/24ch/36ch wide-text, responsive overrides AFTER base rules)
- [x] assets/js/main.js FRESH (nav, FAQ accordion, lead form, reveal, header shadow, call bar)
- [x] robots.txt (Allow:/, sitemap line, NO Host:), llms.txt, site.webmanifest, 404 handling
- [x] Favicon set FRESH (PIL-drawn navy tile + ocean drop; md5s in BUILD-NOTES.md, 0 matches to other sites)

## 2. IMAGES — FRESH ONLY (zero from any past site)
- [x] Fresh photographic set — 27/32 slots filled (Pexels, fresh for Acworth); 5 flagged, no photo forced; media.php manifest + page_img() null-guards; 4 wrong-fit images replaced in fix round (see qa/FINDINGS.md)
- [x] Hash check vs banned images from Lynnwood / San Bruno / Pleasant Grove / Tulsa: 0 md5 matches (124 banned files hashed, independently re-verified); perceptual-hash checked, lake aHash 21 investigated = different photo, not a duplicate
- [x] EXIF/XMP stripped + byte-scan verified per image (0 hits); no "AI" in filename/path/alt/metadata
- [x] Every slot verified by VIEWED pixels (coordinator contact sheets + full-size views); all 1600x900, height measured, aspect correct
- [x] Slots with no fitting photo flagged honestly (5: water-mitigation, ceiling, hardwood, crawl-space, process-5-drying) — navy fallback, no img tag

## 3. HOMEPAGE (full verbatim)
- [x] Meta title verbatim (57ch), meta description verbatim
- [x] H1 x1 visible, H2 x18, H3 x29, FAQ 6 visible = schema 6/6
- [x] Trust badges 4, Button 1 phone-only, Button 2 equal, lead form, quick-answers 7 defs
- [x] All doc links present, anchors 3-5 words, 1 link per target, 0 self-links in body
- [x] 15 service cards (own 16:9 photo slot each), 7 process steps (own photo slot each), 3 real tables, 5 area cards

## 4. LINKED PAGES (25 skeletons, verbatim summary only)
- [x] Each: H1 x1, verbatim homepage summary, hero slot, theme, schema, internal links
- [x] 19 services (incl. split water-heater/appliance/AC and hardwood/carpet pages; insurance page = 3 verbatim sentences, no self-link), locations hub, 5 area cities
- [x] No invented words on any skeleton page

## 5. GOOGLE / SEO A-to-Z (per page, 26/26)
- [x] Self-canonical 1/page, og:url = canonical, sitemap = canonical (26/26 match)
- [x] JSON-LD valid: LocalBusiness + BreadcrumbList + FAQPage (homepage) + WebSite + Service
- [x] Sitemap date-only lastmod, robots no Host:, 0 broken links, 0 orphans
- [x] CLS 0 everywhere; LCP mobile home 1808ms (marginal, at target — re-measure on real hosting), service pages 324-1056ms; overflow 0 @320/390/768/1280, 18px body verified by computed size, H1 visible — verified on ALL 26 pages (Playwright probes, qa/screenshot-probes.json)
- [x] H1 visible on every page (verified by Playwright probes + viewed screenshots, 26/26)

## 6. 10X TESTING + SCREENSHOTS
- [x] Round 1: build check (200s, H1s, links, schema, images)
- [x] Round 2: visual check (desktop + mobile screenshots, every page) — independent verification pass, 52 screenshots in qa/screenshots/
- [x] Findings log with per-point status; fixes re-verified fresh (qa/FINDINGS.md — 4 wrong images replaced + hub cards added, re-audit PROBLEMS 0)
- [x] PDF review pack (desktop top + mobile top per page, labelled) — ~/workspace/your_files/acworth-review-pack.pdf, 27 pp, 4.38MB
- [x] SERVICE-HERO REDESIGN 2026-11-12 (his order): 19 service pages — two-column hero (wide H1 32ch + verbatim summary under H1 + compact form beside it), summary/form moved out of content section, mobile stacks in DOM order. Independent Playwright verify: overflow 0, buttons equal, Button 2 visible at scroll-0 on all 19 @320/@390 (tightest insurance-claim 775px). D1 P1 found (form intro white-on-white in hero) + fixed (.form-card color + tel nowrap) + re-verified 13.44:1 on 19/19. HTTP audit re-run PROBLEMS 0. Findings: qa/FINDINGS-hero-redesign.md + qa/FINDINGS-hero-redesign-verify.md.
- [x] Review pack REGENERATED post-redesign 2026-11-12 — ~/workspace/your_files/acworth-review-pack.pdf, 27 pp, 4.6MB, 52/52 images (replaces stale 18:29 pack)

## 7. DELIVERY GATES (his word only)
- [ ] His review of screenshots + points sheet
- [ ] Push/deploy/domain/DNS ONLY on his explicit word + token (token rule: reuse in-window 3-4 days, transient use, delete temp files)
- [ ] Live links file (26 URLs) delivered as downloadable .txt
