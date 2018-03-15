<?php
// Start the session
ob_start();
session_start();

// Check to see if actually logged in. If not, redirect to login page
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
    header("Location: login.php");
}

$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
    header("Location: login.php");
}
?>
<!DOCTYPE HTML>
<html>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/ajax-v241.core.js"></script>
<script defer src="assets/js/fontawesome-all.js"></script>

<!--[if lte IE 8]>
<script src="assets/js/ie/respond.min.js"></script>
<![endif]-->

<!-- S2Y Scripts -->
<script src="assets/js_s2y/main.js"></script>
<script src="assets/js_s2y/clock.js"></script>
<script src="assets/js_s2y/sweetalert2.all.min.js"></script>

<!-- Set SWAL Defaults -->
<script>
    swal.setDefaults({
        buttonsStyling: false,
        confirmButtonClass: 'swal-button-confirm',
        cancelButtonClass: 'swal-button-cancel',
        width: '40%',
    });
</script>

<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <title>Scissors 2 YOU - Kapster aan huis</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <!--[if lte IE 8]><script src="../assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="icon" href="../../images/favicon.ico">
    <!--[if lte IE 9]><link rel="stylesheet" href="../assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="../assets/css/ie8.css" /><![endif]-->
</head>
<body>

<!-- Modal -->
<div id="mainModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="bodyHeader"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p id="bodyModal"></p>
                    <input type="text" id="inputModal"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="bodyFooter" data-dismiss="modal">Sluit</button>
            </div>
        </div>

    </div>
</div>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Main -->
    <div id="main">
        <div class="inner">

            <!-- Header -->
            <header id="header">
                <a id='pagestring' href="./" class="logo"></a>
                <ul class="icons">
                    <li><div id="datetimestr"></div></li>
<!--                    <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>-->
<!--                    <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>-->
                </ul>
            </header>
