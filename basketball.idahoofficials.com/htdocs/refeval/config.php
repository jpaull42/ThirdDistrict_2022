<?php

/**
 * REQUIRED SETTINGS
 *
 * You will probably need to change all of these settings for your own site.
 */

// The name and address which should be used for the sender details.
// The name can be anything you want, the address should be something in your own domain. It does not need to exist as a mailbox.
define('EVAL_FROM_ADDRESS', 'bbeval@idahoofficials.com');
define('EVAL_FROM_NAME', 'Referee Evaluation Form');

// The name and address to which the contact message should be sent.
// These details should NOT be the same as the sender details.
define('EVAL_TO_ADDRESS', 'jpaull42@hotmail.com');
define('EVAL_TO_NAME', 'Webmaster');

// The details of your SMTP service, e.g. Gmail.
define('EVAL_SMTP_HOSTNAME', 'smtp.gmail.com');
define('EVAL_SMTP_USERNAME', 'jpaull110970@gmail.com');
define('EVAL_SMTP_PASSWORD', 'ojokyylmdkyfwroe');

// The reCAPTCHA credentials for your site. You can get these at https://www.google.com/recaptcha/admin
define('EVAL_RECAPTCHA_SITE_KEY', '6Ldhb_QUAAAAAOl1mwpDjMf2NACTpt5kFhEDPLCG');
define('EVAL_RECAPTCHA_SECRET_KEY', '6Ldhb_QUAAAAAPTuRd7peVYbAbRECYjBDCgYK7wz');

/**
 * Optional Settings
 */

// The debug level for PHPMailer. Default is 0 (off), but can be increased from 1-4 for more verbose logging.
define('EVAL_PHPMAILER_DEBUG_LEVEL', 0);

// Which SMTP port and encryption type to use. The default is probably fine for most use cases.
define('EVAL_SMTP_PORT', 587);
define('EVAL_SMTP_ENCRYPTION', 'tls');
