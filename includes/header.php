<?php
// Acworth Water Damage Restoration — page head + header. Written fresh
// for this site. Expects before include: $HEAD (title, description,
// canonical, ld json, og_type), $currentSlug, and the data arrays from
// data/pages.php.
global $SITE, $SERVICES, $AREAS;
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<script>document.documentElement.classList.add('js');</script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= esc($HEAD['title']) ?></title>
<meta name="description" content="<?= esc($HEAD['description']) ?>">
<meta name="robots" content="<?= esc($HEAD['robots'] ?? 'index, follow') ?>">
<?php if (!empty($HEAD['canonical'])): ?>
<link rel="canonical" href="<?= esc($HEAD['canonical']) ?>">
<?php endif; ?>
<meta property="og:type" content="<?= esc($HEAD['og_type'] ?? 'website') ?>">
<meta property="og:title" content="<?= esc($HEAD['title']) ?>">
<meta property="og:description" content="<?= esc($HEAD['description']) ?>">
<?php if (!empty($HEAD['canonical'])): ?>
<meta property="og:url" content="<?= esc($HEAD['canonical']) ?>">
<?php endif; ?>
<meta property="og:site_name" content="<?= esc($SITE['brand']) ?>">
<?php if (!empty($HEAD['og_image'])): ?>
<meta property="og:image" content="<?= esc($HEAD['og_image']) ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="<?= esc($HEAD['og_image']) ?>">
<?php else: ?>
<meta name="twitter:card" content="summary">
<?php endif; ?>
<meta name="twitter:title" content="<?= esc($HEAD['title']) ?>">
<meta name="twitter:description" content="<?= esc($HEAD['description']) ?>">
<meta name="theme-color" content="#071527">
<link rel="manifest" href="/site.webmanifest">
<link rel="icon" href="/favicon.ico">
<link rel="icon" type="image/svg+xml" href="/favicon.svg">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">
<!-- SEO FIX 2026-11-13 (P3-7): fonts self-hosted — Fraunces + Inter latin
     variable woff2 in /assets/fonts/ (see @font-face in styles.css). The
     Google Fonts stylesheet + preconnects were render-blocking and external;
     they are removed. Only the two faces the CSS actually uses are shipped
     (Fraunces normal 400-700, Inter 400-800); the italic axis Google served
     is unused anywhere on the site, so no italic file is installed. -->
<link rel="preload" href="/assets/fonts/fraunces-latin.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/assets/fonts/inter-latin.woff2" as="font" type="font/woff2" crossorigin>
<link rel="stylesheet" href="/assets/css/styles.css?v=15">
<?= $HEAD['ld'] ?? '' ?>
<noscript><style>.reveal{opacity:1 !important;transform:none !important;}</style></noscript>
</head>
<body>
<header class="site-header">
  <div class="topbar">
    <div class="topbar-inner">
      <span>24/7 Emergency Service &middot; Acworth, GA 30101 &amp; 30102</span>
      <a href="<?= esc($SITE['phone_href']) ?>">Call <?= esc($SITE['phone']) ?></a>
    </div>
  </div>
  <div class="container header-row">
    <a class="brand" href="/" aria-label="Acworth Water Damage Restoration, home">
      <span class="brand-mark" aria-hidden="true"><svg viewBox="0 0 24 24" width="24" height="24"><path d="M12 2.5C12 2.5 5.5 10.2 5.5 14.8a6.5 6.5 0 0 0 13 0C18.5 10.2 12 2.5 12 2.5Z" fill="#08699C"/><path d="M9.2 15.2a2.8 2.8 0 0 0 2.3 2.7" fill="none" stroke="#FFFFFF" stroke-width="1.4" stroke-linecap="round"/></svg></span>
      <span class="brand-word">Acworth<br>Water Damage<small><?= esc($SITE['brand_small']) ?></small></span>
    </a>
    <nav class="main-nav" aria-label="Main">
      <a href="/">Home</a>
      <details>
        <summary>Services</summary>
        <div class="nav-drop">
          <p class="drop-group">Water Damage Services</p>
          <?php foreach (nav_services_footer() as $s): ?>
          <a href="<?= esc($s['slug']) ?>"><?= esc($s['nav']) ?></a>
          <?php endforeach; ?>
        </div>
      </details>
      <!-- MENU 2026-11-17 (his order): Areas = direct link to /locations;
           guides group removed from the menu. Footer + body links untouched. -->
      <a href="/locations">Service Areas</a>
      <a href="/about">About</a>
      <a href="/contact">Contact</a>
    </nav>
    <a class="btn btn-ocean header-cta" href="<?= esc($SITE['phone_href']) ?>"><?= esc($SITE['phone']) ?></a>
    <div class="mobile-head">
      <a class="btn btn-ocean" href="<?= esc($SITE['phone_href']) ?>"><?= esc($SITE['phone']) ?></a>
      <details class="mobile-menu-wrap">
        <summary class="btn btn-outline" aria-label="Open menu"><svg viewBox="0 0 20 20" width="20" height="20" aria-hidden="true"><path d="M3 5h14M3 10h14M3 15h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></summary>
        <div class="mobile-menu">
          <a href="/">Home</a>
          <p class="drop-group">Water Damage Services</p>
          <?php foreach (nav_services_footer() as $s): ?>
          <a href="<?= esc($s['slug']) ?>"><?= esc($s['nav']) ?></a>
          <?php endforeach; ?>
          <!-- MENU 2026-11-17 (his order): Areas = direct link to /locations;
               guides group removed from the menu. Footer + body links untouched. -->
          <a href="/locations">Service Areas</a>
          <a href="/about">About</a>
          <a href="/contact">Contact</a>
          <a class="btn btn-ocean" href="<?= esc($SITE['phone_href']) ?>"><?= esc($SITE['phone']) ?></a>
        </div>
      </details>
    </div>
  </div>
</header>
<!-- MOBILE AUDIT 2026-11-16 (item F): backdrop for the open mobile menu.
     Sibling of <header>, not inside it (the header's backdrop-filter
     would size a fixed child to the header, not the viewport). Shown only
     while the menu is open (html.menu-open, main.js); a tap on it closes
     the menu. No content, no link. -->
<div class="menu-backdrop" aria-hidden="true"></div>
<main>
