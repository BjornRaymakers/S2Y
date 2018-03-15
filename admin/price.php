<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$article = getArticleByID($_GET["id"]);
?>

<!-- Javascript -->
<script src="assets/js_s2y/price.js"></script>
<script src="assets/js_s2y/dynasort.js"></script>

<!-- Post -->
<section>
    <div class="row uniform">
        <div class="6u 12u">
            <h2><?php echo $article->getName() ?> </h2>
        </div>
        <div class="6u 12u$">
            <h4 align="right" id="responseH"></h4>
        </div>
    </div>

    <form id="artform" class='alt'>
        <div class="row uniform">

            <!-- CONTACT GEGEVENS -->
            <div class="2u 12u(small)">
                <label for="priceid">ID</label>
                <input type="text" name="priceid" id="priceid" value="<?php echo $article->getId(); ?>" readonly/>
            </div>
            <div class="6u 12u(small)">
                <label for="article">Benaming</label>
                <input type="text" name="article" id="article" value="<?php echo $article->getName(); ?>"/>
            </div>
            <div class="2u 12u(small)">
                <label for="boldy">Vetgedrukt?</label>
                <div class="select-wrapper">
                    <select name="boldy" id="boldy">
                        <option value="1"<?php if ($article->getBold()) echo ' selected="selected"'; ?>>Ja</option>
                        <option value="0"<?php if (!$article->getBold()) echo ' selected="selected"'; ?>>Nee
                        </option>
                    </select>
                </div>
            </div>
            <div class="2u 12u(small)">
                <label for="position">Positie</label>
                <div class="select-wrapper">
                    <select name="position" id="position">
                        <?php
                        for ($i = 1; $i <= 30; $i++) {
                            if ($i == $article->getPosition()) {
                                echo "<option value=" . $i . " selected='selected'?>" . $i . "</option>";
                            } else {
                                echo "<option value=" . $i . " ?>" . $i . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="6u 12u(small)">
                <label for="price1_comment">Prijs 1 benaming</label>
                <input type="text" name="price1_comment" id="price1_comment"
                       value="<?php echo $article->getPrice1_comment(); ?>"/>
            </div>
            <div class="6u 12u$(small)">
                <label for="price1">Prijs 1 (excl btw)</label>
                <input type="text" name="price1" id="price1" value="<?php echo $article->getPrice1(); ?>"/>
            </div>

            <div class="6u 12u$(small)">
                <label for="price2_comment">Prijs 2 benaming</label>
                <input type="text" name="price2_comment" id="price2_comment"
                       value="<?php echo $article->getPrice2_comment(); ?>"/>
            </div>
            <div class="6u 12u(small)">
                <label for="price2">Prijs 2 (excl btw)</label>
                <input type="text" name="price2" id="price2" value="<?php echo $article->getPrice2(); ?>"/>
            </div>

            <div class="12u$">
                <label for="gender">Dames / Heren / Kinderen</label>
                <div class="select-wrapper">
                    <select name="gender" id="gender">
                        <option
                            value="Dames"<?php if (strtoupper($article->getGender()) == 'DAMES') echo ' selected="selected"'; ?>>
                            Dames
                        </option>
                        <option
                            value="Heren"<?php if (strtoupper($article->getGender()) == 'HEREN') echo ' selected="selected"'; ?>>
                            Heren
                        </option>
                        <option
                            value="Kinderen"<?php if (strtoupper($article->getGender()) == 'KINDEREN') echo ' selected="selected"'; ?>>
                            Kinderen
                        </option>
                    </select>
                </div>
            </div>
            <div class="12u$">
                <label for="reduction"><font color="red">Korting (%)</font></label>
                <input type="text" name="reduction" id="reduction" value="<?php echo $article->getReduction(); ?>"/>
            </div>
            <div class="12u$">
                <hr/>
            </div>
            <ul class="actions">
                <li><input type='button' onclick='saveArticle()' name='update' value='Bewaren'/></li>
                <li><input type='button' onclick='deleteArticle()' name='delete' value='Verwijderen'/></li>
            </ul>
        </div>
    </form>
</section>

<!-- Footer -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottom.php");
?>		