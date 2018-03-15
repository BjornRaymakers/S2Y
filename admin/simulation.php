<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$pcodes = getPostalcodes();
$articles = getArticles();

echo "<script>var articles = " . json_encode($articles) . "</script>";
?>

<script src="assets/js_s2y/simulation.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAs4j6sN7fUYo2mEZgRpOJ502YR8pRHXL0&callback=calcPrice"></script>

<section>
    <h2>Prijs simulatie</h2>
    <div class="row uniform">
        <div class="5u 12u$(small)">
            <label for="street">Straat</label>
            <input type="text" name="street" id="street" onchange="calcPrice()" placeholder="Straat" value=""/>
        </div>
        <div class="1u 12u$(small)">
            <label for="housenumber">Nr</label>
            <input type="text" name="housenumber" onchange="calcPrice()" placeholder="Nr" id="housenumber"
                   value=""/>
        </div>
        <div class="6u 12u(small)">
            <label for="city">Stad</label>
            <div class="select-wrapper">
                <select name="citys" id="citys" onchange="calcPrice()">
                    <?php
                    foreach ($pcodes as $key => $value):
                        echo '<option value="' . $key . '">' . $value . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>
        </div>
        <div class="12u$">
            <label for="simulate_action">Behandeling</label>
            <div class="select-wrapper">
                <select name="action1" id="simulate_action" onchange="calcPrice()">
                    <option selected value=""></option>
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
        <div class="2u 12u">
            <label for="total_km">Aantal kilometers</label>
            <input type="text" name="total_km" id="total_km" value=""/>
        </div>
        <div class="2u 12u">
            <label for="total_km_price">Kilometervergoeding</label>
            <input type="text" name="total_km_price" id="total_km_price" value=""/>
        </div>
        <div class="4u 12u">
            <label for="total_price1">Totale prijs inclusief behandeling</label>
            <input type="text" name="total_price1" id="total_price1" value=""/>
        </div>
        <div class="4u 12u$">
            <label for="total_price2">Totale prijs inclusief behandeling</label>
            <input type="text" name="total_price2" id="total_price2" value=""/>
        </div>
    </div>
</section>
<!-- Footer -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottom.php");
?>
