# ACWORTH — BUILD NOTES
Build: 2026-11-11, local only. Builder: subagent (parent orchestrator).

## What was built
- Plain PHP 8 site, San Bruno architecture, ALL code written fresh for Acworth (no file copied from San Bruno / Pleasant Grove / Lynnwood / Tulsa).
- 26 routes: homepage + 19 services + /locations hub + 5 area pages.
- Homepage: full doc verbatim, H1 x1, H2 x18, H3 x29, FAQ 6, trust badges 4, 15 service cards, 7 process steps, 3 real HTML tables, 5 area cards, lead form.
- Skeleton pages: verbatim homepage summary only. Split cards handled explicitly:
  - Water-heater card (3 links) -> 3 pages (water-heater / appliance / AC), each sharing the card body with only its own closing sentence.
  - Hardwood/carpet card (2 links) -> 2 pages, same pattern.
  - Insurance page: the 3 verbatim sentences of the homepage insurance paragraph; no closing link sentence (it would self-link).
- media.php: 32-slot manifest (hero + 19 svc + 5 area + 7 process). page_img() and card_img() return null when the file is not on disk, so unfilled slots render a navy panel, never a broken img. A separate image worker is downloading the actual files into /assets/img/ in parallel and will prune entries it cannot fill.
- Favicons: fresh PIL draw (qa/make-favicons.py), navy rounded tile + ocean drop.

## Judgment calls
- Area-page anchors on the homepage are the verbatim 6-word doc lines ("Water damage restoration in Kennesaw, GA") per the task brief, even though the standing anchor rule is 3-5 words — doc authority wins.
- /locations hub adds one verbatim ZIP line from the doc's Quick Answers ("ZIP codes covered: 30101 and 30102, including unincorporated Cherokee County.") as its ZIP coverage line.
- Footer map is suppressed on area pages AND the /locations hub (San Bruno pattern).
- Insurance service-page meta description uses the first verbatim sentence only (the full 3-sentence body is ~400 chars).
- og:image / twitter:image tags are emitted only when the hero image file exists on disk (no broken og image while the image worker is still running).
- Quick Answers "about 3,800 for an average job" kept exactly as in the doc (no $ added). En dashes in ranges converted to hyphens (24-48 hours, 3-5 days, 1-3 days, 2-4 days, 3-7+ days, 5-10+ days). No em dashes appear in the doc.
- Cobb dispatch 770-419-6201 appears only as plain text in the three doc-verbatim places (Quick Answers, Water and sewer lines, FAQ 1). Never a tel: link, never in header/footer/schema.

## Favicon md5s (fresh, generated 2026-11-11)
- apple-touch-icon.png da41fbe60dc1a8b4e8c644958da5d050
- favicon-16x16.png 08e305a38a4b2cfa5534e4ce6f278a75
- favicon-192x192.png 4d04de868a078d808c77bc38f3749429
- favicon-32x32.png 12e3473651b1f8b7430733467f2ffc95
- favicon-48x48.png 0f8354f053fefb1ed18058a2bbff579e
- favicon-512x512.png e27fd8e39448aae004d8f23496687536
- favicon.ico fd90a92c8849f2fc248d7002f00810d6
- favicon.svg ee55ddf6acdf4971bda2ee6f0fad4df1

## Verification (build audit round 1, 2026-11-11 — qa/VERIFY-ROUND1.md)
- 26/26 routes 200, H1 1/page, canonical 1/page, sitemap 26/26, 308 slash, 404, 0 other-site traces, 0 en/em dashes, FAQ schema 6/6 = visible, JSON-LD valid 26/26.
- Playwright overflow round: 6 pages x 320/390/768/1280, overflow 0, H1 visible, body 18px/32.4px, Button 2 bottom 842 @320x844 and 746 @390x844, call bar hidden at scroll-0. Two real defects found + fixed in-round: process-step h3 count (36->29) and 320px Button 2 below fold (950->842).
- Screenshots: NOT taken by this build (a separate verification pass does that).
- LCP/CLS: NOT measured (meaningful only after images land).
- Images: 0/32 on disk at build time (worker in parallel); heroes/cards render as navy panels until files land — by design, not a defect.

## OPEN
- Domain (none in doc; SITE url is the http://localhost:8000 placeholder).
- No street address; no About/Contact/Privacy content.
- Image worker pending (32 slots).
- Visual screenshot round pending (separate verification pass).
