<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$appointments = getAppointments();
?>

<!-- Javascript -->
<script src="assets/js_s2y/appointments.js"></script>
<script>document.getElementById('pagestring').innerHTML = "<strong>Scissors2 You </strong>Afspraken";</script>

<!-- Post -->
<section>
    <h2>Openstaande afspraken</h2>
    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th width='2%'></th>
                <th width='8%'>Datum</th>
                <th width='5%'>Tijdstip</th>
                <th width='15%'>Klant</th>
                <th>Behandelingen</th>
                <th width='16%'>Aangemaakt op</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $app_true = false;

            foreach ($appointments as &$app) {
                if ($app->getStatus() == 'OPEN') {
                    $client = $app->getClient();
                    $app_true = true;
                    echo "<tr>";
                    echo "<td><a href='appointment?id=" . $app->getId() . "' class='icon'><i class='fab fa-sistrix'/></a></td>";
                    echo "<td>" . date("d M y", strtotime($app->getDate_appointment())) . "</td>";
                    echo "<td>" . $app->getTime_appointment() . "</td>";
                    echo "<td>" . $client->getFullname() . "</td>";
                    echo "<td>" . $app->getActionsasstring() . "</td>";
                    echo "<td><i>" . $app->getReg_date() . "</i></td>";
                    echo "</tr>";
                }
            }

            if ($app_true == false) {
                echo "<tr><td colspan='6'><i>Geen openstaande afspraken</i></td>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <div class="table-wrapper">
        <h2>Ingeplande afspraken </h2>
        <table id="plannedAppointments">
            <thead>
            <tr>
                <th width='2%'></th>
                <th onclick="sortTable(1,'plannedAppointments')" width='8%'>Datum</th>
                <th width='5%'>Tijdstip</th>
                <th width='2%'>Mail</th>
                <th width='15%'>Klant</th>
                <th>Behandelingen</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $app_true = false;

            foreach ($appointments as &$app) {
                if ($app->getStatus() == 'BUSY') {
                    $client = $app->getClient();
                    $app_true = true;
                    echo "<tr>";
                    echo "<td><a href='appointment?id=" . $app->getId() . "' class='icon'><i class='fab fa-sistrix'/></a></td>";
                    echo "<td>" . date("d M y", strtotime($app->getDate_appointment())) . "</td>";
                    echo "<td>" . $app->getTime_appointment() . "</td>";

                    if ($app->getMail_send() == false) {
                        if ($client->getEmail() == '') {
                            echo "<td><span title='Deze klant heeft geen e-mail adres.' class='icon-information'><i class='fas fa-exclamation-circle fa-spin'/></span></td>";
                        } else {
                            echo "<td><a href='#!' title='Afspraak bevestigings mail versturen' class='icon' onclick='sendAppointmentMail(" . $app->getId() . ", true)' class='icon'><i class='far fa-envelope'/></a></td>";
                        }

                    } else {
                        echo "<td><a href='#!' title='Er is al een mail verstuurd naar deze klant.' class='icon' onclick='sendAppointmentMail(" . $app->getId() . ", false)'><i class='far fa-envelope-open'/></a></td>";
                    }

                    echo "<td>" . $client->getFullname() . "</td>";
                    echo "<td>" . $app->getActionsasstring() . "</td>";
                    echo "</tr>";
                }
            }

            if ($app_true == false) {
                echo "<tr><td colspan='6'><i>Geen ingeplande afspraken</i></td>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <h2>Afgewerkte afspraken</h2>
    <div class="table-wrapper">
        <table id="closedAppointments">
            <thead>
            <tr>
                <th width='2%'></th>
                <th onclick="sortTable(1,'closedAppointments')" width='7%'>Datum</th>
                <th width='5%'>Tijdstip</th>
                <th width='2%'>Fact</th>
                <th width='15%'>Klant</th>
                <th>Behandelingen</th>
                <th width='5%'>Bedrag</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $app_true = false;

            foreach ($appointments as &$app) {
                if ($app->getStatus() == 'CLOSED') {
                    $client = $app->getClient();
                    $bill = $app->getBill();
                    $app_true = true;
                    echo "<tr>";
                    echo "<td><a href='appointment?id=" . $app->getId() . "' class='icon'><i class='fab fa-sistrix'/></a></td>";
                    echo "<td>" . date("d M y", strtotime($app->getDate_appointment())) . "</td>";
                    echo "<td>" . $app->getTime_appointment() . "</td>";

                    if ($bill->getId() == '') {
                        echo "<td><span title='Er is nog geen factuur aangemaakt voor deze afspraak!' class='icon-warning' ><i class='fas fa-exclamation-circle fa-spin'/></span></td>";
                    } else {
                        echo "<td><a class='icon' href='bill?id=" . $app->getId() . "'><i class='far fa-check-circle'/></a></td>";
                    }

                    echo "<td>" . $client->getFullname() . "</td>";
                    echo "<td>" . $app->getActionsasstring() . "</td>";
                    echo "<td>€" . $bill->getPrice_incl_btw() . "</td>";
                    echo "</tr>";
                }
            }

            if ($app_true == false) {
                echo "<tr><td colspan='5'><i>Geen afgewerkte afspraken</i></td>";
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