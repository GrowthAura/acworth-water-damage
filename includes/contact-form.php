<?php
// Acworth Water Damage Restoration — contact-page message form (Tab 41).
// Fields are exactly the doc's "Form fields" line: Name | Phone | Email |
// Address or ZIP code | What happened? | Is water still coming in?
// (Yes/No) | Preferred contact time. Submit: "Send Message".
// No mail is sent: no destination address has been given yet, and none is
// invented here. Submitting shows an honest notice and points to the phone.
global $SITE;
$form = $form ?? [];
$errors = $form['errors'] ?? [];
$values = $form['values'] ?? [];
$notice = $form['notice'] ?? false;
?>
<div class="form-card" id="request-service">
  <p class="form-title">Send a Message</p>
  <p>For anything that isn't an emergency, use the form below and we'll get back to you. For immediate help, call <?= phone_link() ?>.</p>
  <?php if ($notice): ?>
  <div class="form-note" role="status">
    <p><strong>Thank you. This form does not send email yet.</strong> No email address has been set up for requests, so your message was not sent anywhere. For immediate help, call <?= phone_link() ?>. A crew is dispatched immediately.</p>
  </div>
  <?php else: ?>
  <?php if ($errors): ?>
  <div class="form-note" role="alert">
    <p><strong>Please fix the following:</strong> <?= esc(implode(' ', $errors)) ?></p>
  </div>
  <?php endif; ?>
  <form method="post" action="" novalidate>
    <label for="c-name">Name</label>
    <input id="c-name" name="name" type="text" autocomplete="name" required maxlength="120" value="<?= esc($values['name'] ?? '') ?>">
    <label for="c-phone">Phone</label>
    <input id="c-phone" name="phone" type="tel" autocomplete="tel" required maxlength="40" value="<?= esc($values['phone'] ?? '') ?>">
    <label for="c-email">Email</label>
    <input id="c-email" name="email" type="email" autocomplete="email" maxlength="120" value="<?= esc($values['email'] ?? '') ?>">
    <label for="c-address">Address or ZIP code</label>
    <input id="c-address" name="address" type="text" autocomplete="postal-code" maxlength="160" value="<?= esc($values['address'] ?? '') ?>">
    <label for="c-message">What happened?</label>
    <textarea id="c-message" name="message" required maxlength="2000"><?= esc($values['message'] ?? '') ?></textarea>
    <fieldset class="form-radio">
      <legend>Is water still coming in?</legend>
      <label><input type="radio" name="still" value="Yes"<?= (($values['still'] ?? '') === 'Yes') ? ' checked' : '' ?>> Yes</label>
      <label><input type="radio" name="still" value="No"<?= (($values['still'] ?? '') === 'No') ? ' checked' : '' ?>> No</label>
    </fieldset>
    <label for="c-when">Preferred contact time</label>
    <input id="c-when" name="when" type="text" maxlength="120" value="<?= esc($values['when'] ?? '') ?>">
    <p class="hp-field" aria-hidden="true"><label>Leave this empty <input type="text" name="website" tabindex="-1" autocomplete="off" value=""></label></p>
    <button class="btn btn-navy" type="submit">Send Message</button>
  </form>
  <?php endif; ?>
</div>
