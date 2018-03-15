<!-- Header -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/assets/templates/top.php");
?>

<!-- Javascript -->
<script src="assets/js_s2y/pricelist.js"></script>

<!-- Content -->
<section>
    <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");
    $articles = getArticles();

    function stringBuilder($part1, $part2, $addeuro) {
        if ($part2 == '') {
            if($addeuro) {
                return '€ ' . $part1;
            } else {
                return $part1;
            }
        } else{
            if($addeuro) {
                return '€ ' . $part1 . " / € " . $part2;
            } else {
                return $part1 . " / " . $part2;
            }
        }
    }
    ?>

    <h2>Dames</h2>
    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th width="40%"></th>
                <th width="30%"></th>
                <th width="30%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($articles as &$article) {
                if (strtolower($article->getGender()) == 'dames') {
                    echo "<tr>";

                    if ($article->getBold()) {
                        echo "<td><strong>" . $article->getName() . "</strong></td>";
                    }
                    else {
                        echo "<td>" . $article->getName() . "</td>";
                    }

                    echo "<td>" . stringBuilder($article->getPrice1_comment(), $article->getPrice2_comment(), false) . "</td>";
                    echo "<td>" . stringBuilder($article->getPrice1(), $article->getPrice2(), true) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </div>

    <h2>Heren</h2>
    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th width="40%"></th>
                <th width="30%"></th>
                <th width="30%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($articles as &$article) {
                if (strtolower($article->getGender()) == 'heren') {
                    echo "<tr>";

                    if ($article->getBold()) {
                        echo "<td><strong>" . $article->getName() . "</strong></td>";
                    }
                    else {
                        echo "<td>" . $article->getName() . "</td>";
                    }

                    echo "<td>" . stringBuilder($article->getPrice1_comment(), $article->getPrice2_comment(), false) . "</td>";
                    echo "<td>" . stringBuilder($article->getPrice1(), $article->getPrice2(), true) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>

    <h2>Kids (tot 12j)</h2>
    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th width="40%"></th>
                <th width="30%"></th>
                <th width="30%"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($articles as &$article) {
                if (strtolower($article->getGender()) == 'kinderen') {
                    echo "<tr>";

                    if ($article->getBold()) {
                        echo "<td><strong>" . $article->getName() . "</strong></td>";
                    }
                    else {
                        echo "<td>" . $article->getName() . "</td>";
                    }

                    echo "<td>" . stringBuilder($article->getPrice1_comment(), $article->getPrice2_comment(), false) . "</td>";
                    echo "<td>" . stringBuilder($article->getPrice1(), $article->getPrice2(), true) . "</td>";
                    echo "</tr>";
                }
            }
            ?>
            </tbody>
        </table>
    </div>

    <p>
        <i>Prijzen exclusief kilometervergoeding (€0,25 / km) <br>Minder dan 10 km is gratis.</i>
    </p>
    <hr class="major"/>

    <h2>Niet gevonden wat je zocht?</h2>
    <p>Wens je toch iets anders, of heb je vragen omtrent een behandeling? <br>Aarzel niet en neem contact met ons op telefonisch of per mail.</p>
    <a class='icon fa-comment-o' href="contact"> Contact formulier</a>

</section>

<!-- Bottom -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/assets/templates/bottom.php");
?>