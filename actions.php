<!-- Header -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/assets/templates/top.php");
?>

<!-- Javascript -->
<script src="assets/js_s2y/actions.js"></script>

<!-- Content -->
<section>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

    $actions = getActions();
    $actionavailable = false;

    if (count($actions) > 0) {
        foreach ($actions as &$action) {
            if ((bool)$action->getValid() == true) {
                echo "<section>";
                echo "<header class='major''>";
                echo "<h2>" . $action->getTitle() . "</h2>";
                echo "</header>";
                echo "<div>";

                echo "<article>";
                echo "<h3>" . $action->getBody() . "</h3>";
                echo "<p><i>Deze actie is geldig: " . $action->getDuration() . "</i></p>";
                echo "</article>";
                echo "</div>";
                echo "</section>";
                $actionavailable = true;
            }
        }
    }

    if ($actionavailable == false) {
        echo "<h2>Geen lopende acties!</h2>";
    }
    ?>
</section>

<!-- Bottom -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/assets/templates/bottom.php");
?>