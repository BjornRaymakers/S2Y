<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$action = getActionByID($_GET["id"]);

?>
    <!-- Javascript -->
    <script src="assets/js_s2y/action.js"></script>

    <!-- Post -->
    <section>
        <div class="row uniform">
            <div class="6u 12u">
                <h2><?php echo $action->getTitle() ?> </h2>
            </div>
            <div class="6u 12u$">
                <h4 align="right" id="responseH"></h4>
            </div>
        </div>

        <form id="artform" class='alt'>
            <div class="row uniform">

                <!-- CONTACT GEGEVENS -->
                <div class="2u 12u(small)">
                    <label for="actid">ID</label>
                    <input type="text" name="actid" id="actid" value="<?php echo $action->getId(); ?>" readonly/>
                </div>
                <div class="10u 12u(small)">
                    <label for="acttitle">Titel</label>
                    <input type="text" name="acttitle" id="acttitle" value="<?php echo $action->getTitle(); ?>"/>
                </div>
                <div class="12u$">
                    <label for="acttitle">Actie</label>
                    <textarea name="actbody" id="actbody" rows="5" placeholder="Actie"><?php echo $action->getBody(); ?></textarea>
                </div>

                <div class="12u$">
                    <label for="actduration">Periode</label>
                    <input type="text" name="actduration" id="actduration" value="<?php echo $action->getDuration(); ?>"/>
                </div>

                <div class="12u$">
                    <hr/>
                </div>
                <ul class="actions">
                    <li><input type='button' onclick='saveAction()' name='update' value='Bewaren'/></li>
                    <li><input type='button' onclick='deleteAction()' name='delete' value='Verwijderen'/></li>
                    <li>
                        <?php
                        if ($action->getValid()) {
                            echo "<input type='checkbox' name='actvalid' id='actvalid' checked >";
                        } else {
                            echo "<input type='checkbox' name='actvalid' id='actvalid'>";
                        }
                        ?>
                        <label for="actvalid">Actief</label>
                    </li>
                </ul>
            </div>
        </form>
    </section>

    <!-- Footer -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottom.php");
?>