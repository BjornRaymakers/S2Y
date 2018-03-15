<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$appointment = getAppointmentByID($_GET['id']);
$bill = $appointment->getBill();
$client = $appointment->getClient();

?>
<script src="assets/js_s2y/bill.js"></script>

<section>
    <div class="row uniform">
        <div class="8u 12u">
            <h2>Factuur van <?php echo $appointment->getDate_appointment();?></h2>
        </div>
        <div class="4u 12u$">
            <h3 align="right" id="responseH"></h3>
        </div>
    </div>
    <div class="row uniform">
        <div class="12u$">
            <table>
                <h3>Details</h3>
                <thead>
                <tr>
                    <th width='16px'></th>
                    <th width='125px'></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><a href='../appointment?id=<?php echo $appointment->getId();?>' class='icon'><i class='fab fa-sistrix'/></a></td>
                    <td><strong>Afspraak:</strong></td>
                    <td><span id="appid"><?php echo $appointment->getId(); ?></span></td>
                </tr>
                <tr>
                    <td><a href='?id=<?php echo $bill->getId();?>' class='icon'><i class='fab fa-sistrix'/></a></td>
                    <td><strong>Factuur:</strong></td>
                    <td><span id="billid"><?php echo $bill->getId(); ?></span></td>
                </tr>
                <tr>
                    <td><a href='client?id=<?php echo $client->getID();?>' class='icon'><i class='fab fa-sistrix'/></a></td>
                    <td><strong>Klant:</strong></td>
                    <td><?php echo $client->getID() . " - " . $client->getFullname(); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><?php echo $client->getFull_Address() ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="12u$">
            <div class="table-wrapper">
                <h3>Overzicht</h3>
                <table>
                    <thead>
                    <tr>
                        <th width='5%'>ID</th>
                        <th width='40%'>Benaming</th>
                        <th width='10%'>Type</th>
                        <th width='15%'>Prijs</th>
                        <th width='10%'>Aantal</th>
                        <th width='10%'>Korting</th>
                        <th width='15%'>Totaal</th>
                        <th width='5%'>BTW</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $totalExclBtw = 0;

                    $actionprice = getActionPrice($appointment->getAction1(), $appointment->getHairtype(), $bill->getPrice_btw());
                    if ($actionprice != 0) {
                        echo "<tr><td>" . $appointment->getAction1()->getId() . "</td><td>" . $appointment->getAction1()->getName() . "</td><td></td><td></td><td>1</td><td>" . $appointment->getAction1()->getReduction() . "%</td><td>€ " . $actionprice . "</td><td>" . $bill->getPrice_btw() . "%</td>";
                    }

                    $actionprice = getActionPrice($appointment->getAction2(), $appointment->getHairtype(), $bill->getPrice_btw());
                    if ($actionprice != 0) {
                        echo "<tr><td>" . $appointment->getAction2()->getId() . "</td><td>" . $appointment->getAction2()->getName() . "</td><td></td><td></td><td>1</td><td>" . $appointment->getAction2()->getReduction() . "%</td><td>€ " . $actionprice . "</td><td>" . $bill->getPrice_btw() . "%</td>";
                    }

                    $actionprice = getActionPrice($appointment->getAction3(), $appointment->getHairtype(), $bill->getPrice_btw());
                    if ($actionprice != 0) {
                        echo "<tr><td>" . $appointment->getAction3()->getId() . "</td><td>" . $appointment->getAction3()->getName() . "</td><td></td><td></td><td>1</td><td>" . $appointment->getAction3()->getReduction() . "%</td><td>€ " . $actionprice . "</td><td>" . $bill->getPrice_btw() . "%</td>";
                    }

                    $actionprice = getActionPrice($appointment->getAction4(), $appointment->getHairtype(), $bill->getPrice_btw());
                    if ($actionprice != 0) {
                        echo "<tr><td>" . $appointment->getAction4()->getId() . "</td><td>" . $appointment->getAction4()->getName() . "</td><td></td><td></td><td>1</td><td>" . $appointment->getAction4()->getReduction() . "%</td><td>€ " . $actionprice . "</td><td>" . $bill->getPrice_btw() . "%</td>";
                    }

                    //KM VERGOEDING
                    echo "<tr><td></td><td>Kilometervergoeding <i>(Gratis onder de 10km)</i></td><td></td><td>€ 0.25</td><td>" . $client->getTotal_km() . "</td><td></td><td>€ " . $bill->getPrice_km_total() . "</td><td>" . $bill->getPrice_btw() . "%</td></tr>";

                    //AFSPRAAK KORTING
                    if ($bill->getAppReduction() > 0) {
                        echo "<tr><td></td><td>Afspraak korting</td><td></td><td></td><td></td><td>" . $appointment->getReduction() . "%</td><td>- € " . $bill->getAppReduction() . "</td><td></td></tr>";
                    }


                    //BTW
                    $totalBTW = $bill->getPrice_incl_btw() - $bill->getPrice_excl_btw();

                    echo "<tr><td>B</td><td>BTW</td><td></td><td></td><td></td><td></td><td>€ " . $totalBTW . "</td><td></td></tr>";
                    echo "<tr><td><strong>T</strong></td><td><strong>Totaal (inclusief btw)</strong></td><td></td><td></td><td></td><td></td><td><strong>€ " . $bill->getPrice_incl_btw() . "</strong></td><td></td></tr>";
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="12u$">
            <ul class="actions">
                <li>
                    <a href=#!" onclick="deleteBill()" id='deletebill' class="button fit">Factuur verwijderen</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Footer -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottom.php");
?>	