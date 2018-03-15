<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$gifts = getGifts();

?>

    <!-- Javascript -->
    <script src="assets/js_s2y/gifts.js"></script>

    <!-- Post -->
    <section>
        <h2>Cadeaubonnen overzicht</h2>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th width='16px'></th>
                    <th width='5%'>ID</th>
                    <th>Uiterlijke datum</th>
                    <th width='25%'>Waarde</th>
                    <th width='2%'>Geldig</th>

                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($gifts as &$gift) {
                    echo "<tr>";
                    echo "<td><a href='gift?id=" . $gift->getId() . "' class='icon'><i class='fab fa-sistrix'/></a></td>";
                    echo "<td>" . $gift->getUniqid() . "</td>";
                    echo "<td>" . $gift->getExpires() . "</td>";
                    echo "<td>" . $gift->getAmount() . "</td>";
                    echo "<td>" . $gift->getValidstring() . "</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Footer -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottom.php");
?>