<?php
// Acworth Water Damage Restoration — contact-page message form (Tab 41).
// Fields are exactly the doc's "Form fields" line: Name | Phone | Email |
// Address or ZIP code | What happened? | Is water still coming in?
// (Yes/No) | Preferred contact time. Submit: "Send Message".
// Posts straight to the Google Sheets webhook (Apps Script, bound to the
// "Acworth Water Damage - Website Leads" sheet) from the browser. The
// script logs one row + emails the owner. No email address appears
// anywhere in this page — only the webhook URL (data/pages.php
// $SITE['leads_webhook']). The hidden "page" field tells the owner which
// page the lead came from; "return_url" is where the script sends a
// no-JS visitor back to; "website" is the honeypot; the hidden
// "service" field marks the row "Contact form" (this form has no service
// select). JS (assets/js/main.js) intercepts the submit and POSTs with
// mode 'no-cors' (San Bruno pattern, proven live).
global $SITE;
?>
<div class="form-card" id="request-service">
  <p class="form-title">Send a Message</p>
  <p>For anything that isn't an emergency, use the form below and we'll get back to you. For immediate help, call <?= phone_link() ?>.</p>
  <div class="form-note" id="form-status" role="status" hidden></div>
  <form id="contact-form" method="post" action="<?= esc($SITE['leads_webhook']) ?>" novalidate>
    <input type="hidden" name="return_url" value="<?= esc(site_url($currentSlug ?? '/')) ?>">
    <input type="hidden" name="service" value="Contact form">
    <label for="c-name">Name</label>
    <input id="c-name" name="name" type="text" autocomplete="name" required maxlength="120">
    <label for="c-phone">Phone</label>
    <input id="c-phone" name="phone" type="tel" autocomplete="tel" required maxlength="40">
    <label for="c-email">Email</label>
    <input id="c-email" name="email" type="email" autocomplete="email" maxlength="120">
    <label for="c-address">Address or ZIP code</label>
    <input id="c-address" name="address" type="text" autocomplete="postal-code" maxlength="160">
    <label for="c-message">What happened?</label>
    <textarea id="c-message" name="message" required maxlength="2000"></textarea>
    <fieldset class="form-radio">
      <legend>Is water still coming in?</legend>
      <label><input type="radio" name="still" value="Yes"> Yes</label>
      <label><input type="radio" name="still" value="No"> No</label>
    </fieldset>
    <label for="c-when">Preferred contact time</label>
    <input id="c-when" name="when" type="text" maxlength="120">
    <input type="hidden" name="page" value="<?= esc(site_url($currentSlug ?? '/')) ?>">
    <p class="hp-field" aria-hidden="true"><label>Leave this empty <input type="text" name="website" tabindex="-1" autocomplete="off" value=""></label></p>
    <button class="btn btn-navy" type="submit">Send Message</button>
  </form>
</div>
