<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$appointments = getAppointments();
?>

<!-- Javascript -->
<script src="assets/js_s2y/bills.js"></script>

<!-- Main -->
<section>
    <h2>Facturen</h2>


    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th width='2%'></th>
                <th width='5%'>ID</th>
                <th width='10%'>Datum</th>
                <th width='25%'>Klant</th>
                <th width='10%'>Prijs / KM</th>
                <th width='10%'>Totaal KM</th>
                <th width='10%'>KM verg.</th>
                <th width='10%'>Prijs (excl)</th>
                <th width='10%'>BTW %</th>
                <th width='10%'>Prijs (incl)</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($appointments as &$appointment) {
                $bill = $appointment->getBill();
                if ($bill->getID() != '') {
                    $client = $appointment->getClient();
                    echo "<tr>";
                    echo "<td><a href='bill?id=" . $appointment->getId() . "' class='icon'><i class='fab fa-sistrix'/></a></td>";
                    echo "<td>" . $bill->getId() . "</td>";
                    echo "<td>" . date("d M y", strtotime($appointment->getDate_appointment())) . "</td>";
                    echo "<td>" . $client->getFullname() . "</td>";
                    echo "<td>€" . $bill->getPrice_km() . "</td>";
                    echo "<td>" . $client->getTotal_km() . " km</td>";
                    echo "<td>€" . $bill->getPrice_km_total() . "</td>";
                    echo "<td>€" . $bill->getPrice_excl_btw() . "</td>";
                    echo "<td>" . $bill->getPrice_btw() . "%</td>";
                    echo "<td><strong>€" . $bill->getPrice_incl_btw() . "</strong></td>";
                    echo "</tr>";

                }
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