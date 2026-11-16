<?php
// Acworth Water Damage Restoration — footer + mobile call bar. Written
// fresh for this site. $show_map (bool) is set by the page renderer before
// include; area pages skip the map.
global $SITE, $SERVICES, $AREAS, $PAGES;
$show_map = $show_map ?? true;
// The lead form lives on the homepage + service pages; the contact page
// has its own message form. AZ P2-5: area, hub, about and resource pages
// carry the lead form in their compact final CTA. Elsewhere the
// "Request Emergency Help" button goes to the homepage form. On the
// contact page the button reads "Send a Message" and targets that page's
// own form.
$__slug = $currentSlug ?? '/';
$__type = isset($PAGES[$__slug]) ? ($PAGES[$__slug]['type'] ?? '') : '';
$__hasForm = ($__slug === '/') || in_array($__type, ['service', 'contact', 'area', 'area-hub', 'about', 'resource'], true);
$__formTarget = $__hasForm ? '#request-service' : '/#request-service';
// DEEP FIX 2026-11-14 (P3-10): the footer Get Help button uses the
// page's own Button 2 text ($btn2, set by render_page from the page's
// doc data) so every Button 2 on the page matches. Homepage/contact
// fall back to the defaults ($btn2 is unset on the homepage; the
// contact page keeps 'Send a Message').
$__formLabel = ($__slug === '/contact') ? 'Send a Message' : ($btn2 ?? 'Request Emergency Help');
$map_src = 'https://www.google.com/maps?q=' . rawurlencode($SITE['map_query']) . '&output=embed';
?>
</main>
<?php if ($show_map): ?>
<div class="footer-map-wrap" aria-label="Map of Acworth, Georgia">
  <iframe class="footer-map" title="Map: Acworth, GA 30101" src="<?= esc($map_src) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
<?php endif; ?>
<footer class="site-footer">
  <div class="container footer-cols">
    <div class="footer-col">
      <p class="footer-h"><?= esc($SITE['brand']) ?></p>
      <p>24/7 emergency water damage restoration in Acworth, GA 30101 and 30102. Crew dispatched immediately.</p>
      <p><a href="<?= esc($SITE['phone_href']) ?>"><?= esc($SITE['phone']) ?></a><br>
      Acworth, GA 30101 &amp; 30102<br>
      <span class="footer-hours">Open 24 hours, 7 days a week</span></p>
      <a class="btn btn-ocean" href="<?= esc($SITE['phone_href']) ?>"><?= esc($SITE['phone']) ?></a>
    </div>
    <div class="footer-col">
      <p class="footer-h">Services</p>
      <ul>
        <?php foreach (nav_services_footer() as $s): ?>
        <li><a href="<?= esc($s['slug']) ?>"><?= esc($s['nav']) ?></a></li>
        <?php endforeach; ?>
        <li><a class="footer-more" href="/#services">View all services</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <p class="footer-h">Service Areas</p>
      <ul>
        <?php foreach ($AREAS as $a): ?>
        <li><a href="<?= esc($a['slug']) ?>"><?= esc($a['city']) ?>, GA</a></li>
        <?php endforeach; ?>
        <li><a class="footer-more" href="/locations">View all service areas</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <p class="footer-h">Get Help Now</p>
      <p><a href="<?= esc($SITE['phone_href']) ?>"><?= esc($SITE['phone']) ?></a><br>
      Acworth, GA 30101 &amp; 30102<br>
      <span class="footer-hours">Open 24 hours, 7 days a week</span></p>
      <a class="btn btn-cream" href="<?= esc($__formTarget) ?>"><?= esc($__formLabel) ?></a>
      <p class="footer-about"><a href="/about">About our team</a> &middot; <a href="/contact">Contact us</a></p>
    </div>
  </div>
  <div class="container footer-bottom">
    <span>&copy; 2026 <?= esc($SITE['brand']) ?> &middot; Acworth, GA 30101 &amp; 30102</span>
    <span>24/7 Emergency Service &middot; <?= esc($SITE['phone']) ?></span>
  </div>
</footer>
<a class="mobile-call-bar" href="<?= esc($SITE['phone_href']) ?>" aria-label="<?= esc($SITE['phone']) ?>">
  <span aria-hidden="true">&#9742;</span><span><?= esc($SITE['phone']) ?></span>
</a>
<div class="mobile-call-spacer" aria-hidden="true"></div>
<script src="/assets/js/main.js?v=6" defer></script>
</body>
</html>
