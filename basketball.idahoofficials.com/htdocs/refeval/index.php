<?php

require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/config.php';

session_start();

if (!empty($_SESSION['_contact_form_error'])) {
    $error = $_SESSION['_contact_form_error'];
    unset($_SESSION['_contact_form_error']);
}

if (!empty($_SESSION['_contact_form_success'])) {
    $success = true;
    unset($_SESSION['_contact_form_success']);
}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="../dist/css/metro-bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../styles/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="../styles/style.css">
      <link rel="stylesheet" type="text/css" href="../styles/animate.css">
      <link rel="stylesheet" type="text/css" href="../styles/docs.css">

      <link rel="icon" href="favicon.png" type="image/png">
    <title>Contact Us</title>

    <!-- reCAPTCHA Javascript -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
      <script type="text/javascript" src="scripts/bootstrap.min.js"></script>
      <script type="text/javascript" src="scripts/metro-docs.js"></script>
</head>
<body data-spy="scroll" data-target=".subnav" data-offset="50" screen_capture_injected="true">
<div id="top" class="navbar navbar-default navbar-fixed-top" style="align-content: left; background-color: dodgerblue;">
        <div class="col-md-1"></div>
        <div class="col-md-9">
        <div class="navbar-header">
            <a href="../index.html"><img class="bannerad-img" src="../images/ID3rdDistrict.png" title="ThirdDistrict" alt="ThirdDistrict" height="90" width="120"></a>
            <div class="mobileHide">
                <a class="navbar-brand" href="index.html">
                    <h1><b>Third District Officials Association</b></h1>
                </a>
            </div>
        </div>
        </div>
        <div class="col-md-2"></div>
</div>
<div class="contentTop" class="row padTop" style="padding-top: 150px;">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-5">
                <div class="card-body">
                    <h1 class="card-title">
                        Contact Us
                    </h1>

                    <?php
                    if (!empty($success)) {
                        ?>
                        <div class="alert alert-success">Your message was sent successfully!</div>
                        <?php
                    }
                    ?>

                    <?php
                    if (!empty($error)) {
                        ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                        <?php
                    }
                    ?>

                    <form method="post" action="submit.php">
                        <div class="form-group">
                            <label for="name">Your Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Your Email Address</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                            <br/>
                            <label for="submitterType">I am a</label><br/>
                            &nbsp;&nbsp;<input type="radio" id="fan" name="submitterType" value="fan" 
                                <?php if (isset($type) && $type=="fan") echo "checked";?>>Fan<br/>
                            &nbsp;&nbsp;<input type="radio" id="coach" name="submitterType" value="coach" 
                                <?php if (isset($type) && $type=="coach") echo "checked";?>>Coach
                            </div>
                            <div class="col-sm-6">
                            <br/><br/>
                            &nbsp;&nbsp;<input type="radio" id="athlete" name="submitterType" value="athlete" 
                                <?php if (isset($type) && $type=="athlete") echo "checked";?>>Athlete<br/>
                            &nbsp;&nbsp;<input type="radio" id="official" name="submitterType" value="official" 
                                <?php if (isset($type) && $type=="official") echo "checked";?>>Official
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                            <br/>
                            <label for="president">Send my feedback to:</label><br/>
                            &nbsp;&nbsp;<input type="checkbox" id="president" name="president" value="President"
                                <?php if (isset($pres) && $pres != "") echo "checked";?>>President<br/>
                            &nbsp;&nbsp;<input type="checkbox" id="vicepresident" name="vicepresident" value="Vice-President"
                                <?php if (isset($vice) && $vice != "") echo "checked";?>>Vice-President<br/>
                            &nbsp;&nbsp;<input type="checkbox" id="secretary" name="secretary" value="Secretary"
                                <?php if (isset($secr) && $secr != "") echo "checked";?> >Secretary<br/>
                            &nbsp;&nbsp;<input type="checkbox" id="treasurer" name="treasurer" value="Treasurer"
                                <?php if (isset($trea) && $trea != "") echo "checked";?> >Treasurer<br/>
                            &nbsp;&nbsp;<input type="checkbox" id="baseball" name="baseball" value="Baseball"
                                <?php if (isset($base) && $base != "") echo "checked";?> >Baseball<br/>
                            &nbsp;&nbsp;<input type="checkbox" id="basketball" name="basketball" value="Basketball"
                                <?php if (isset($bask) && $bask != "") echo "checked";?> >Basketball<br/>
                            </div>
                            <div class="col-sm-6">
                            <br/><br/>
                            &nbsp;&nbsp;<input type="checkbox" id="football" name="football" value="Football"
                                <?php if (isset($foot) && $foot != "") echo "checked";?> >Football<br/>
                            &nbsp;&nbsp;<input type="checkbox" id="soccer" name="soccer" value="Soccer"
                                <?php if (isset($socc) && $socc != "") echo "checked";?> >Soccer<br/>
                            &nbsp;&nbsp;<input type="checkbox" id="softball" name="softball" value="Softball"
                                <?php if (isset($soft) && $soft != "") echo "checked";?> >Softball<br/>
                            &nbsp;&nbsp;<input type="checkbox" id="volleyball" name="volleyball" value="Volleyball"
                                <?php if (isset($voll) && $voll != "") echo "checked";?> >Volleyball<br/>
                            &nbsp;&nbsp;<input type="checkbox" id="wrestling" name="wrestling" value="Wrestling"
                                <?php if (isset($wres) && $wres != "") echo "checked";?> >Wrestling<br/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject">Your Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea name="message" id="message" class="form-control" rows="12"></textarea>
                        </div>

                        <div class="form-group text-center">
                            <div class="g-recaptcha" data-sitekey="<?= CONTACTFORM_RECAPTCHA_SITE_KEY ?>"></div>
                        </div>

                        <button class="btn btn-primary btn-block">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>-->
<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>-->
<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>-->
</body>
</html>
