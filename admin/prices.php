<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$articles = getArticles();
?>

<!-- Javascript -->
<script src="assets/js_s2y/prices.js"></script>
<script src="assets/js_s2y/dynasort.js"></script>

<!-- Post -->
<section>

    <h2>Prijslijst beheer</h2>

    <h3>Dames</h3>
    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th width='2%'></th>
                <th width='3%'>ID</th>
                <th>Benaming</th>
                <th width='10%'>Omsch 1</th>
                <th width='10%'>Prijs 1</th>
                <th width='10%'>Omsch 2</th>
                <th width='10%'>Prijs 2</th>
                <th width='10%'>Plaats</th>
                <th width='5%'>Positie</th>
                <th width='5%'>Korting</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($articles as &$article) {
                if (strtolower($article->getGender()) == 'dames') {
                    if ($article->getBold()) {
                        echo "<tr>";
                        echo "<td><a href='price?id=" . $article->getId() . "' class='icon'><i class='fab fa-sistrix'/></a></td>";
                        echo "<td>" . $article->getId() . "</td>";
                        echo "<td><strong>" . $article->getName() . "</strong></td>";
                        echo "<td>" . $article->getPrice1_comment() . "</td>";
                        echo "<td>€ " . $article->getPrice1() . "</td>";
                        echo "<td>" . $article->getPrice2_comment() . "</td>";
                        echo "<td>€ " . $article->getPrice2() . "</td>";
                        echo "<td>" . $article->getGender() . " </td>";
                        echo "<td>" . $article->getPosition() . "</td>";
                        echo "<td>" . $article->getReduction() . "%</td>";
                        echo "</tr>";
                    } else {
                        echo "<tr>";
                        echo "<td><a href='price?id=" . $article->getId() . "' class='icon'><i class='fab fa-sistrix'/></a></td>";
                        echo "<td>" . $article->getId() . "</td>";
                        echo "<td>" . $article->getName() . "</td>";
                        echo "<td>" . $article->getPrice1_comment() . "</td>";
                        echo "<td>€ " . $article->getPrice1() . "</td>";
                        echo "<td>" . $article->getPrice2_comment() . "</td>";
                        echo "<td>€ " . $article->getPrice2() . "</td>";
                        echo "<td>" . $article->getGender() . " </td>";
                        echo "<td>" . $article->getPosition() . "</td>";
                        echo "<td>" . $article->getReduction() . "%</td>";
                        echo "</tr>";
                    }
                }
            }
            ?>
            </tbody>
        </table>
    </div>

    <h3>Heren</h3>
    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th width='2%'></th>
                <th width='3%'>ID</th>
                <th>Benaming</th>
                <th width='10%'>Omsch 1</th>
                <th width='10%'>Prijs 1</th>
                <th width='10%'>Omsch 2</th>
                <th width='10%'>Prijs 2</th>
                <th width='10%'>Plaats</th>
                <th width='5%'>Positie</th>
                <th width='5%'>Korting</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($articles as &$article) {
                if (strtolower($article->getGender()) == 'heren') {
                    if ($article->getBold()) {
                        echo "<tr><td><a href='price?id=" . $article->getId() . "' class='icon alt fa-edit'</a></td><td>" . $article->getId() . "</td><td><strong>" . $article->getName() . "</strong></td><td>" . $article->getPrice1_comment() . "</td><td>€ " . $article->getPrice1() . "</td><td>" . $article->getPrice2_comment() . "</td><td>€ " . $article->getPrice2() . "</td><td>" . $article->getGender() . " </td><td>" . $article->getPosition() . "</td><td>" . $article->getReduction() . "%</td></tr>";
                    } else {
                        echo "<tr><td><a href='price?id=" . $article->getId() . "' class='icon alt fa-edit'</a></td><td>" . $article->getId() . "</td><td>" . $article->getName() . "</td><td>" . $article->getPrice1_comment() . "</td><td>€ " . $article->getPrice1() . "</td><td>" . $article->getPrice2_comment() . "</td><td>€ " . $article->getPrice2() . "</td><td>" . $article->getGender() . " </td><td>" . $article->getPosition() . "</td><td>" . $article->getReduction() . "%</td></tr>";
                    }
                }
            }
            ?>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>

    <h3>Kids (tot 12j)</h3>
    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th width='2%'></th>
                <th width='3%'>ID</th>
                <th>Benaming</th>
                <th width='10%'>Omsch 1</th>
                <th width='10%'>Prijs 1</th>
                <th width='10%'>Omsch 2</th>
                <th width='10%'>Prijs 2</th>
                <th width='10%'>Plaats</th>
                <th width='5%'>Positie</th>
                <th width='5%'>Korting</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($articles as &$article) {
                if (strtolower($article->getGender()) == 'kinderen') {
                    if ($article->getBold()) {
                        echo "<tr><td><a href='price?id=" . $article->getId() . "' class='icon alt fa-edit'</a></td><td>" . $article->getId() . "</td><td><strong>" . $article->getName() . "</strong></td><td>" . $article->getPrice1_comment() . "</td><td>€ " . $article->getPrice1() . "</td><td>" . $article->getPrice2_comment() . "</td><td>€ " . $article->getPrice2() . "</td><td>" . $article->getGender() . " </td><td>" . $article->getPosition() . "</td><td>" . $article->getReduction() . "%</td></tr>";
                    } else {
                        echo "<tr><td><a href='price?id=" . $article->getId() . "' class='icon alt fa-edit'</a></td><td>" . $article->getId() . "</td><td>" . $article->getName() . "</td><td>" . $article->getPrice1_comment() . "</td><td>€ " . $article->getPrice1() . "</td><td>" . $article->getPrice2_comment() . "</td><td>€ " . $article->getPrice2() . "</td><td>" . $article->getGender() . " </td><td>" . $article->getPosition() . "</td><td>" . $article->getReduction() . "%</td></tr>";
                    }
                }
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="row uniform">
        <div class="12u$">
            <ul class="actions">
                <li><a href="price" class="button">Nieuwe prijs aanmaken</a></li>
            </ul>
        </div>
    </div>
</section>

<!-- Footer -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottom.php");
?>					