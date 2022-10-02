<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/functions.php';
require_once __DIR__.'/config.php';

session_start();

// Basic check to make sure the form was submitted.
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    redirectWithError("The form must be submitted with POST data.");
}

// Do some validation, check to make sure the name, email and message are valid.
if (empty($_POST['g-recaptcha-response'])) {
    redirectWithError("Please complete the CAPTCHA.");
}

$recaptcha = new \ReCaptcha\ReCaptcha(CONTACTFORM_RECAPTCHA_SECRET_KEY);
$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_REQUEST['REMOTE_ADDR']);

if (!$resp->isSuccess()) {
    $errors = $resp->getErrorCodes();
    $error = $errors[0];

    $recaptchaErrorMapping = [
        'missing-input-secret' => 'No reCAPTCHA secret key was submitted.',
        'invalid-input-secret' => 'The submitted reCAPTCHA secret key was invalid.',
        'missing-input-response' => 'No reCAPTCHA response was submitted.',
        'invalid-input-response' => 'The submitted reCAPTCHA response was invalid.',
        'bad-request' => 'An unknown error occurred while trying to validate your response.',
        'timeout-or-duplicate' => 'The request is no longer valid. Please try again.',
    ];

    $errorMessage = $recaptchaErrorMapping[$error];
    redirectWithError("Please retry the CAPTCHA: ".$errorMessage);
}

if (empty($_POST['name'])) {
    redirectWithError("Please enter your name in the form.");
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    redirectWithError("Please enter your email address in the form. It must be in a valid format.");
}

if (empty($_POST['refname'])) {
    redirectWithError("Please enter the name of the referee you are evaluating in the form.");
}

if (!filter_var($_POST['refemail'], FILTER_VALIDATE_EMAIL) && trim($_POST['refemail']) != "NA" ) {
    redirectWithError("Please enter the email of the referee you are evaluating in the form (or NA if you don't know it).");
}

if (empty($_POST['date'])) {
    redirectWithError("Please enter the date of the game that the referee was evaluated on.");
}

if (empty($_POST['location'])) {
    redirectWithError("Please enter the location of the game that the referee was evaluated on.");
}

if (empty($_POST['ques1'])) {
    redirectWithError("Please enter a response for question 1 in the form.");
}

if (empty($_POST['ques2'])) {
    redirectWithError("Please enter a response for question 2 in the form.");
}

if (empty($_POST['ques3'])) {
    redirectWithError("Please enter a response for question 3 in the form.");
}

if (empty($_POST['ques4'])) {
    redirectWithError("Please enter a response for question 4 in the form.");
}

if (empty($_POST['ques5'])) {
    redirectWithError("Please enter a response for question 5 in the form.");
}

if (empty($_POST['ques6'])) {
    redirectWithError("Please enter a response for question 6 in the form.");
}

if (empty($_POST['ques7'])) {
    redirectWithError("Please enter a response for question 7 in the form.");
}

if (empty($_POST['ques8'])) {
    redirectWithError("Please enter a response for question 8 in the form.");
}

// Everything seems OK, time to send the email.

$mail = new \PHPMailer\PHPMailer\PHPMailer(true);
/*$msgFor = "";
if(!empty($_POST["president"])){ $msgFor.= "President; ";}
if(!empty($_POST["vicepresident"])){ $msgFor.= "Vice-President; ";}
if(!empty($_POST["secretary"])){ $msgFor.= "Secretary; ";}
if(!empty($_POST["treasurer"])){ $msgFor.= "Treasurer; ";}
if(!empty($_POST["baseball"])){ $msgFor.= "Baseball; ";}
if(!empty($_POST["football"])){ $msgFor.= "Football; ";}
if(!empty($_POST["basketball"])){ $msgFor.= "Basketball; ";}
if(!empty($_POST["soccer"])){ $msgFor.= "Soccer; ";}
if(!empty($_POST["softball"])){ $msgFor.= "Softball; ";}
if(!empty($_POST["volleyball"])){ $msgFor.= "Volleyball; ";}
if(!empty($_POST["wrestling"])){ $msgFor.= "Wrestling; ";}*/

try {
    //Server settings
    $mail->SMTPDebug = EVAL_PHPMAILER_DEBUG_LEVEL;
    $mail->isSMTP();
    $mail->Host = EVAL_SMTP_HOSTNAME;
    $mail->SMTPAuth = true;
    $mail->Username = EVAL_SMTP_USERNAME;
    $mail->Password = EVAL_SMTP_PASSWORD;
    $mail->SMTPSecure = EVAL_SMTP_ENCRYPTION;
    $mail->Port = EVAL_SMTP_PORT;

    // Recipients
    $mail->setFrom(EVAL_FROM_ADDRESS, EVAL_FROM_NAME);
    $mail->addAddress(EVAL_TO_ADDRESS, EVAL_TO_NAME);
    if (filter_var($_POST['email]')){ $mail->addAddress($_POST['email'], $_POST['name'])}
    if (filter_var($_POST['refemail'], FILTER_VALIDATE_EMAIL)){ $mail->addAddress($_POST['refemail'], $_POST['refname'])}
    $mail->addReplyTo($_POST['email'], $_POST['name']);

    //Questions on form
    /*
    1. Is the Official energetic/in shape?
    2. Are they receptive to feedback?
    3. Are they communicative?
    4. Do they have basketball sense/Any prior experience?
    5. What are 2 things the official did well?
    6. What did you do as the trainer to help the official better understand the game?
    7. Positioning, Whistle Tempo, Did you do the books together, Meet the Players/Coaches Prior to tip-off?
    8. What is one thing the official could take away and improve on immediately?
    */

    // Content
    $mail->Subject = "Third District Basketball Evaluation for ".$_POST['refname'];
    $mail->Body    = <<<EOT
Evaluator: {$_POST['name']}
-- Email: {$_POST['email']}
Referee: {$_POST['refname']}
-- Email: {$_POST['refemail']}
Game Date: {$_POST['refname']}
Game Location: {$_POST['refemail']}

Evaluation Questions
    1. Is the Official energetic/in shape?
        {$_POST['ques1']}
    2. Are they receptive to feedback?
        {$_POST['ques2']}
    3. Are they communicative?
        {$_POST['ques3']}
    4. Do they have basketball sense/Any prior experience?
        {$_POST['ques4']}
    5. What are 2 things the official did well?
        {$_POST['ques5']}
    6. What did you do as the trainer to help the official better understand the game?
        {$_POST['ques6']}
    7. Positioning, Whistle Tempo, Did you do the books together, Meet the Players/Coaches Prior to tip-off?
        {$_POST['ques7']}
    8. What is one thing the official could take away and improve on immediately?
        {$_POST['ques8']}
EOT;

    $mail->send();
    redirectSuccess();
} catch (Exception $e) {
    redirectWithError("An error occurred while trying to send the evaluation: ".$mail->ErrorInfo);
}
