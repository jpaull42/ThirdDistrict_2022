<?php

function redirectWithError($error)
{
    $_SESSION['_eval_form_error'] = $error;

    header('Location: '.$_SERVER['HTTP_REFERER']);
    echo "Error: ".$error;
    die();
}

function redirectSuccess()
{
    $_SESSION['_eval_form_success'] = true;

    header('Location: '.$_SERVER['HTTP_REFERER']);
    echo "Your evaluation was sent successfully!";
    die();
}
