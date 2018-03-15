<!-- Header -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/assets/templates/top.php");
?>

<!-- Main -->
<section id="banner">
    <div class="content">
        <header>
            <?php
            switch ($_GET["id"]) {
                case 1:
                    echo "<h1>Bedankt " . $_GET["fname"] . "!</h1>";
                    echo "<p>We nemen zo spoedig mogelijk contact met jou op!</p>";
                    break;
                case 2:
                    echo "<h1>Bedankt, maar ...</h1>";
                    echo "<p>Er is een probleem opgedoken bij het verzenden van het bericht!</p>";
                    echo "<p>Probeer het later nogmaals of mail ons op <a href='mailto:info@scissors2you.be'>info@scissors2you</a></p>";
                    break;
                case 3:
                    echo "<h1>Bedankt " . $_GET["fname"] . "!</h1>";
                    echo "<p>Bedankt voor je bericht!</p>";
                    break;
                default:
                    echo "<h1>Bedankt " . $_GET["fname"] . "!</h1>";
            }

            ?>
        </header>

    </div>
    <span class="image object">
        <img src="images/pic10.jpg" alt=""/>
    </span>
</section>

<!-- Bottom -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/assets/templates/bottom.php");
?>