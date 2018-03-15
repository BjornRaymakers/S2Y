<!-- Header -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$pcodes = getPostalcodes();
$articles = getArticles();

?>

<!-- Javascript -->
<script src="assets/js_s2y/appointment.js"></script>

<!-- Content -->
<section>

    <form id="newappointmentform" class="alt" onsubmit="return validateAppointmentForm()">
        <div class="row uniform">

            <!-- CONTACT GEGEVENS -->
            <div class="12u$">
                <h2>Contact gegevens</h2>
            </div>

            <div class="6u 12u$(small)">
                <input type="text" name="firstname" id="firstname"
                       value="<?php if (isset($_COOKIE["s2yFirstname"])) echo $_COOKIE["s2yFirstname"]; ?>"
                       placeholder="Voornaam" onkeydown='setBorderBackToOriginal("firstname")' required>
            </div>
            <div class="6u 12u$(small)">
                <input type="text" name="lastname" id="lastname"
                       value="<?php if (isset($_COOKIE["s2yLastname"])) echo $_COOKIE["s2yLastname"]; ?>"
                       placeholder="Achternaam" onkeydown='setBorderBackToOriginal("lastname")' required>
            </div>

            <div class="6u 12u$(small)">
                <input type="email" name="email" id="email"
                       value="<?php if (isset($_COOKIE["s2yEmail"])) echo $_COOKIE["s2yEmail"]; ?>"
                       placeholder="Email" onkeydown='setBorderBackToOriginal("email")' required>
            </div>

            <div class="6u 12u$(small)">
                <input type="text" name="telephone" id="telephone"
                       value="<?php if (isset($_COOKIE["s2yTelephone"])) echo $_COOKIE["s2yTelephone"]; ?>"
                       placeholder="Telefoon" onkeydown='setBorderBackToOriginal("telephone")' required>
            </div>

            <div class="5u 12u$(small)">
                <input type="text" name="street" id="street"
                       value="<?php if (isset($_COOKIE["s2yStreet"])) echo $_COOKIE["s2yStreet"]; ?>"
                       placeholder="Straat" onkeydown='setBorderBackToOriginal("street")' required>
            </div>
            <div class="1u 12u$(small)">
                <input type="text" name="housenumber" id="housenumber"
                       value="<?php if (isset($_COOKIE["s2yHousenumber"])) echo $_COOKIE["s2yHousenumber"]; ?>"
                       placeholder="Nr" onkeydown='setBorderBackToOriginal("housenumber")' required>
            </div>
            <div class="6u 12u$(small)">
                <div class="select-wrapper">
                    <select name="pcode_id" id="pcode_id" placeholder="Stad" onmousedown='setBorderBackToOriginal("pcode_id")' required>
                        <option value="<?php if (isset($_COOKIE["s2yPcodeID"])) echo $_COOKIE["s2yPcodeID"]; ?>">
                            Stad
                        </option>
                        <?php
                        foreach ($pcodes as $key => $value):
                            echo '<option value="' . $key . '">' . $value . '</option>';
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>

            <!-- BEHANDELINGEN -->
            <div class="12u$">
                <h2>Behandelingen</h2>
            </div>
            <div class="12u$" name="duplicater1" id="duplicater1">
                <div class="select-wrapper">
                    <select name="treatment1" id="treatment1">
                        <option selected value="Selecteer een behandeling">Selecteer een behandeling</option>
                        <optgroup label="Dames">
                            <?php
                            $womanart = getArticlesByGender('Dames');
                            foreach ($womanart as &$article):
                                echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                            endforeach;
                            ?>
                        </optgroup>
                        <optgroup label="Heren">
                            <?php
                            $manart = getArticlesByGender('Heren');
                            foreach ($manart as &$article):
                                echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                            endforeach;
                            ?>
                        </optgroup>
                        <optgroup label="Kinderen">
                            <?php
                            $kidsart = getArticlesByGender('Kinderen');
                            foreach ($kidsart as &$article):
                                echo '<option value="' . $article->getId() . '">' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                            endforeach;
                            ?>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="12u$" id="buttonaddtreatment">
                <a href="#!" onclick="duplicate()" class="icon fa-plus"><i> Voeg nog een behandeling toe</i></a>
            </div>

            <div class="12u$">
                <h2>Wanneer?</h2>
            </div>
            <div class="8u 12u(small)">
                <input type="date" name="appdate" id="appdate" onmousedown='setBorderBackToOriginal("appdate")' required>
            </div>
            <div class="4u 12u$(small)">
                <input type="time" name="apptime" id="apptime" onmousedown='setBorderBackToOriginal("apptime")' required>
            </div>

            <div class="12u$">
                <h2>Nog een specifieke wens?</h2>
            </div>
            <!-- BERICHT -->
            <div class="12u$">
                <textarea name="comments" id="comments" rows="5" placeholder="Bericht"></textarea>
            </div>

            <ul class="actions">
                <li><input type='button' onclick="saveNewAppointment()" value="Afspraak versturen"/></li>
            </ul>
        </div>
    </form>

</section>

<!-- Bottom -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/assets/templates/bottom.php");
?>