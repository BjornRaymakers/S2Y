<?php

// Start the session
session_start();

// Defines username and password. Retrieve however you like,
$config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/admin/assets/config/config_admin.ini');
$username = $config['username'];
$password = $config['password'];

// Error message
$error = "";

// Checks to see if the user is already logged in. If so, refirect to correct page.
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    $error = "success";
    header('Location: index.php');
}

// Checks to see if the username and password have been entered.
// If so and are equal to the username and password defined above, log them in.
if (isset($_POST['username']) && isset($_POST['password'])) {
    if ($_POST['username'] == $username && $_POST['password'] == $password) {
        $_SESSION['loggedIn'] = true;
        header('Location: index.php');
    } else {
        $_SESSION['loggedIn'] = false;
        $error = "<strong>Invalid username and password!</strong>";
    }
}
?>
    <!-- Header -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/toplogin.php");
?>
    <!-- Main -->
    <div id="main">
        <!-- Post -->
        <section>
            <?php echo $error; ?>
            <!-- form for login -->
            <h2>Scissors 2 You Management</h2>
            <form name="loginform" method="post" action="login.php" class="alt">
                <div class="row uniform">
                    <div class="12u$">
                        <input type="text" name="username" id="username" value="" placeholder="Gebruiker"/>
                    </div>
                    <div class="12u$">
                        <input type="password" name="password" id="password" value="" placeholder="Wachtwoord"/>
                    </div>
                    <div class="12u$">
                        <input type="submit" value="Log In!">
                    </div>
                </div>
            </form>
        </section>
    </div>
    <!-- Header -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottomlogin.php");
?>