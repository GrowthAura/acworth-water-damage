<?php
// Acworth Water Damage Restoration — lead form validation.
// No mail is sent and nothing is stored: no destination address has been
// given yet. A valid submission returns a notice flag only; the renderer
// shows an honest "not sent, please call" message.

function handle_lead_post($post) {
    $values = [
        'name'    => trim((string) ($post['name'] ?? '')),
        'phone'   => trim((string) ($post['phone'] ?? '')),
        'service' => trim((string) ($post['service'] ?? '')),
        'message' => trim((string) ($post['message'] ?? '')),
    ];
    $errors = [];
    if ($values['name'] === '') $errors[] = 'Please enter your name.';
    if ($values['phone'] === '') $errors[] = 'Please enter your phone number.';
    if ($values['message'] === '') $errors[] = 'Please tell us what happened.';
    if (!empty($post['website'])) $errors[] = 'Please leave the extra field empty.';
    if ($errors) return ['errors' => $errors, 'values' => $values];
    return ['notice' => true, 'values' => $values];
}

// Contact-page form (Tab 41 fields). Same honest rule as the lead form:
// no mail is sent and nothing is stored — no destination address has
// been given yet. A valid submission returns a notice flag only.
function handle_contact_post($post) {
    $values = [
        'name'     => trim((string) ($post['name'] ?? '')),
        'phone'    => trim((string) ($post['phone'] ?? '')),
        'email'    => trim((string) ($post['email'] ?? '')),
        'address'  => trim((string) ($post['address'] ?? '')),
        'message'  => trim((string) ($post['message'] ?? '')),
        'still'    => trim((string) ($post['still'] ?? '')),
        'when'     => trim((string) ($post['when'] ?? '')),
    ];
    $errors = [];
    if ($values['name'] === '') $errors[] = 'Please enter your name.';
    if ($values['phone'] === '') $errors[] = 'Please enter your phone number.';
    if ($values['message'] === '') $errors[] = 'Please tell us what happened.';
    if ($values['email'] !== '' && !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if ($values['still'] !== '' && !in_array($values['still'], ['Yes', 'No'], true)) {
        $errors[] = 'Please answer whether water is still coming in.';
    }
    if (!empty($post['website'])) $errors[] = 'Please leave the extra field empty.';
    if ($errors) return ['errors' => $errors, 'values' => $values];
    return ['notice' => true, 'values' => $values];
}
