<?php
// Acworth Water Damage Restoration — lead form. Posts straight to the
// Google Sheets webhook (Apps Script, bound to the "Acworth Water
// Damage - Website Leads" sheet) from the browser. The script logs one
// row + emails the owner. No email address appears anywhere in this
// page — only the webhook URL (data/pages.php $SITE['leads_webhook']) —
// so Google Search cannot connect this site to the mailbox. The hidden
// "page" field tells the owner which page the lead came from;
// "return_url" is where the script sends a no-JS visitor back to;
// "website" is the honeypot. JS (assets/js/main.js) intercepts the
// submit and POSTs with mode 'no-cors' (San Bruno pattern, proven live).
global $SITE, $SERVICES;
?>
<div class="form-card<?= !empty($formCompact) ? ' form-card-compact' : '' ?>" id="request-service">
  <p class="form-title">Request Emergency Help</p>
  <p>Fill this in and we will call you back. For immediate help, call <?= phone_link() ?>.</p>
  <div class="form-note" id="form-status" role="status" hidden></div>
  <form id="lead-form" method="post" action="<?= esc($SITE['leads_webhook']) ?>" novalidate>
    <input type="hidden" name="return_url" value="<?= esc(site_url($currentSlug ?? '/')) ?>">
    <label for="f-name">Your name</label>
    <input id="f-name" name="name" type="text" autocomplete="name" required maxlength="120">
    <label for="f-phone">Phone number</label>
    <input id="f-phone" name="phone" type="tel" autocomplete="tel" required maxlength="40">
    <label for="f-service">What is happening?</label>
    <select id="f-service" name="service">
      <option value="">Select a service</option>
      <?php foreach (nav_services() as $s): ?>
      <option value="<?= esc($s['nav']) ?>"><?= esc($s['nav']) ?></option>
      <?php endforeach; ?>
      <option value="Other">Other</option>
    </select>
    <label for="f-message">Tell us what happened</label>
    <textarea id="f-message" name="message" required maxlength="2000"></textarea>
    <input type="hidden" name="page" value="<?= esc(site_url($currentSlug ?? '/')) ?>">
    <p class="hp-field" aria-hidden="true"><label>Leave this empty <input type="text" name="website" tabindex="-1" autocomplete="off" value=""></label></p>
    <button class="btn btn-navy" type="submit">Request Emergency Help</button>
  </form>
</div>
