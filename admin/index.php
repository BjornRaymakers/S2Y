<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include $_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/matomo.php";
include $_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php";

$articles = getArticles();

$total_clients = count(getClients());

$birthday_clients_this_week = getBirthdayClients(0);
$birthday_clients_next_week = getBirthdayClients(1);

//Appointments
$appointments = getAppointments();
$appointments_total = count($appointments);
$appointments_next_week = getAppointmentsByParam($appointments, 'W', 1);
$appointments_week = getAppointmentsByParam($appointments, 'W', 0);

$appointsments_open = getAppointmentsByState('OPEN');
$appointsments_busy = getAppointmentsByState('BUSY');
$appointsments_closed = getAppointmentsByState('CLOSED');

//Visits
$visits_matomo = getMatomoJSON('Live.getLastVisitsDetails');
?>
    <!-- Javascript -->
    <script src="assets/js_s2y/index.js"></script>

    <section>
        <div class="row">
            <div class="4u 12u$(medium)">
                <h3><i id="clientAlert" class='icon-information fas fa-exclamation-circle fa-spin' style="display: none;"></i> Klanten</h3>
                <ul>
                    <?php if (count($birthday_clients_this_week)) {
                        echo "<script>document.getElementById('clientAlert').style.display = 'inline';</script>";
                        echo "<li><a href='#!' onclick=showPanel('popupPanelBirthdaysThisWeek')>" . count($birthday_clients_this_week) . " verjaardag(en) deze week.</a></li>";
                    } else {
                        echo "<li>Niemand verjaard er deze week</li>";
                    }
                    ?>
                    <?php if (count($birthday_clients_next_week)) {
                        echo "<li><a href='#!' onclick=showPanel('popupPanelBirthdaysNextWeek')>" . count($birthday_clients_next_week) . " verjaardag(en) deze week.</a></li>";
                    } else {
                        echo "<li>Niemand verjaard er volgende week</li>";
                    }
                    ?>
                    <li><i><?php echo $total_clients; ?> klanten in het klantenbestand.</i></li>
                </ul>
            </div>
            <div class="4u 12u$(medium)">
                <h3><i id="appointmentAlert" class='icon-information fas fa-exclamation-circle fa-spin' style="display: none;"></i> Afspraken</h3>

                <ul>

                    <?php
                    if (count($appointsments_open)) {

                        echo "<script>document.getElementById('appointmentAlert').style.display = 'inline';</script>";

                        if (count($appointsments_open) == 1) {
                            $word = 'afspraak';
                        } else {
                            $word = 'afspraken';
                        }
                        echo "<li><a href='#!' onclick=showPanel('popupPanelAppointmentsOpen')> " . count($appointsments_open) . " " . $word . " open.</a></li>";
                    } else {
                        echo "<li>Geen open afspraken</li>";
                    }
                    if (count($appointments_week)) {
                        echo "<li><a href='#!' onclick=showPanel('popupPanelAppointmentsThisWeek')>" . count($appointments_week) . " afspraken deze week.</a></li>";
                    } else {
                        echo "<li>Geen afspraken deze week</li>";
                    }

                    if (count($appointments_next_week)) {
                        echo "<li><a href='#!' onclick=showPanel('popupPanelAppointmentsNextWeek')>" . count($appointments_next_week) . " afspraken volgende week.</a></li>";
                    } else {
                        echo "<li>Geen afspraken volgende week</li>";
                    }
                    ?>
                    <li><i><?php echo $appointments_total; ?> afspraken geregistreerd.</i></li>
                </ul>
            </div>

            <div class="4u$ 12u$(medium)">
                <h3>Site bezoeken</h3>
                <ul>
                    <!--                    <li>--><?php //echo $visits_today; ?><!-- bezoeken vandaag.</li>-->
                    <!--                    <li>--><?php //echo $visits_month; ?><!-- bezoeken deze maand.</li>-->
                    <li><a href="#!" onclick="showPanel('popupPanelVisits')">Bekijk bezoeken</a></li>
                    <li><a href="../piwik">Ga naar Matomo</a></li>
                </ul>
            </div>

            <div class="12u$" id="hiddenPanels">
                <div class="12u$" id="popupPanelVisits" style="display: none">
                    <div class="box">
                        <div class="table-wrapper">
                            <h4>Bezoeken</h4>
                            <table>
                                <thead>
                                <tr>
                                    <th width='20%'>IP</th>
                                    <th width='20%'>Client info</th>
                                    <th>Datum</th>
                                    <th width='10%'>Duurtijd</th>
                                    <th width='10%'>Acties</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($visits_matomo as &$visit) {
                                    $obj_vars = get_object_vars($visit);

                                    $visitIp = $obj_vars['visitIp'];
                                    $serverDatePrettyFirstAction = $obj_vars['serverDatePrettyFirstAction'];
                                    $serverTimePrettyFirstAction = $obj_vars['serverTimePrettyFirstAction'];
                                    $visitorTypeIcon = "../piwik/" . $obj_vars['visitorTypeIcon']; //Returning or new customer field
                                    $operatingSystemIcon = "../piwik/" . $obj_vars['operatingSystemIcon'];
                                    $browserIcon = "../piwik/" . $obj_vars['browserIcon'];
                                    $deviceTypeIcon = "../piwik/" . $obj_vars['deviceTypeIcon'];
                                    $countryFlag = "../piwik/" . $obj_vars['countryFlag'];
                                    $visitDurationPretty = $obj_vars['visitDurationPretty'];
                                    $actionDetails = $obj_vars['actionDetails'];

                                    $test = "";
                                    $actionLogs = [];
                                    if (count($actionDetails) > 0) {
                                        foreach ($actionDetails as $actionDetail) {
                                            $actionDetailFormatted = get_object_vars($actionDetail);
                                            $actionLog = [];
                                            $actionLog['URL'] = $actionDetailFormatted['url'];
                                            $actionLog['Duurtijd'] = $actionDetailFormatted['timeSpentPretty'];
                                            $actionLog['Datum'] = $actionDetailFormatted['serverTimePretty'];
                                            array_push($actionLogs, $actionLog);
                                        }
                                    }

                                    $actionLogsJSON = htmlspecialchars(json_encode($actionLogs));

                                    echo "<tr>";
                                    echo "<td>" . $visitIp . "</td>";

                                    echo "<td>";
                                    echo "<img src='" . $deviceTypeIcon . "' alt='' border=9 height=18 width=18 style='margin-left:10px'>";
                                    echo "<img src='" . $operatingSystemIcon . "' alt='' border=9 height=18 width=18 style='margin-left:10px'>";
                                    echo "<img src='" . $browserIcon . "' alt='' border=9 height=18 width=18 style='margin-left:10px'>";
                                    echo "<img src='" . $countryFlag . "' alt='' border=9 height=18 width=25 style='margin-left:10px'>";
                                    echo "<img src='" . $visitorTypeIcon . "' alt='' border=9 height=18 width=18 style='margin-left:10px'>";
                                    echo "</td>";

                                    echo "<td>" . $serverDatePrettyFirstAction . " " . $serverTimePrettyFirstAction . "</td>";
                                    echo "<td>" . $visitDurationPretty . "</td>";
                                    echo '<td><a href="#!" onclick="showModal(' . $actionLogsJSON . ')">' . count($actionDetails) . '</a></td>';
                                    echo "</tr>";

                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="12u$" id="popupPanelBirthdaysThisWeek" style="display: none">
                    <div class="box">
                        <div class="table-wrapper">
                            <h4>Verjaardagen deze week</h4>
                            <table>
                                <thead>
                                <tr>
                                    <th width='10%'>ID</th>
                                    <th width='40%'>Naam</th>
                                    <th width='25%'>Datum</th>
                                    <th width='25%'>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($birthday_clients_this_week as &$client) {
                                    echo "<tr><td>" . $client->getID() . "</td><td><a href='client?id=" . $client->getID() . "'>" . $client->getFullname() . "</a></td><td>" . $client->getBirthday() . "</td><td>" . $client->getEmail() . "</td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="12u$" id="popupPanelBirthdaysNextWeek" style="display: none">
                    <div class="box">
                        <div class="table-wrapper">
                            <h4>Verjaardagen volgende week</h4>
                            <table>
                                <thead>
                                <tr>
                                    <th width='10%'>ID</th>
                                    <th width='40%'>Naam</th>
                                    <th width='25%'>Datum</th>
                                    <th width='25%'>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($birthday_clients_next_week as &$client) {
                                    echo "<tr><td>" . $client->getID() . "</td><td><a href='client?id=" . $client->getID() . "'>" . $client->getFullname() . "</a></td><td>" . $client->getBirthday() . "</td><td>" . $client->getEmail() . "</td></tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="12u$" id="popupPanelAppointmentsOpen" style="display: none">
                    <div class="box">
                        <div class="table-wrapper">
                            <h4>Open afspraken</h4>
                            <table>
                                <thead>
                                <tr>
                                    <th width='2%'></th>
                                    <th width='8%'>Datum</th>
                                    <th width='5%'>Tijdstip</th>
                                    <th width='15%'>Klant</th>
                                    <th>Behandelingen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($appointsments_open as &$app) {
                                    $client = $app->getClient();
                                    echo "<tr>";
                                    echo "<td><a href='appointment?id=" . $app->getId() . "' class='icon'><i class='fab fa-sistrix'/></a></td>";
                                    echo "<td>" . date("d M y", strtotime($app->getDate_appointment())) . "</td>";
                                    echo "<td>" . $app->getTime_appointment() . "</td>";
                                    echo "<td>" . $client->getFullname() . "</td>";
                                    echo "<td>" . $app->getActionsasstring() . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="12u$" id="popupPanelAppointmentsNextWeek" style="display: none">
                    <div class="box">
                        <div class="table-wrapper">
                            <h4>Afspraken volgende week</h4>
                            <table id="plannedAppointments">
                                <thead>
                                <tr>
                                    <th width='2%'></th>
                                    <th width='8%'>Datum</th>
                                    <th width='5%'>Tijdstip</th>
                                    <th width='2%'>Mail</th>
                                    <th width='15%'>Klant</th>
                                    <th>Behandelingen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($appointments_next_week as &$app) {
                                    $client = $app->getClient();
                                    echo "<tr>";
                                    echo "<td><a href='appointment?id=" . $app->getId() . "' class='icon'><i class='fab fa-sistrix'/></a></td>";
                                    echo "<td>" . date("d M y", strtotime($app->getDate_appointment())) . "</td>";
                                    echo "<td>" . $app->getTime_appointment() . "</td>";

                                    if ($app->getMail_send() == false) {
                                        if ($client->getEmail() == '') {
                                            echo "<td><span title='Deze klant heeft geen e-mail adres.' class='icon-information'><i class='fas fa-exclamation-circle fa-spin'/></span></td>";
                                        } else {
                                            echo "<td><a href='#!' title='Afspraak bevestigings mail versturen' class='icon' onclick='sendMail(" . $app->getId() . ")' class='icon'><i class='far fa-envelope'/></a></td>";
                                        }

                                    } else {
                                        echo "<td><a href='#!' title='Er is al een mail verstuurd naar deze klant.' class='icon' onclick='sendMail(" . $app->getId() . ")'><i class='far fa-envelope-open'/></a></td>";
                                    }

                                    echo "<td>" . $client->getFullname() . "</td>";
                                    echo "<td>" . $app->getActionsasstring() . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="12u$" id="popupPanelAppointmentsThisWeek" style="display: none">
                    <div class="box">
                        <div class="table-wrapper">
                            <h4>Afspraken deze week</h4>
                            <table>
                                <thead>
                                <tr>
                                    <th width='2%'></th>
                                    <th width='8%'>Datum</th>
                                    <th width='5%'>Tijdstip</th>
                                    <th width='2%'>Mail</th>
                                    <th width='15%'>Klant</th>
                                    <th>Behandelingen</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($appointments_week as &$app) {
                                    $client = $app->getClient();
                                    echo "<tr>";
                                    echo "<td><a href='appointment?id=" . $app->getId() . "' class='icon'><i class='fab fa-sistrix'/></a></td>";
                                    echo "<td>" . date("d M y", strtotime($app->getDate_appointment())) . "</td>";
                                    echo "<td>" . $app->getTime_appointment() . "</td>";

                                    if ($app->getMail_send() == false) {
                                        if ($client->getEmail() == '') {
                                            echo "<td><span title='Deze klant heeft geen e-mail adres.' class='icon-information'><i class='fas fa-exclamation-circle fa-spin'/></span></td>";
                                        } else {
                                            echo "<td><a href='#!' title='Afspraak bevestigings mail versturen' class='icon' onclick='sendMail(" . $app->getId() . ")' class='icon'><i class='far fa-envelope'/></a></td>";
                                        }

                                    } else {
                                        echo "<td><a href='#!' title='Er is al een mail verstuurd naar deze klant.' class='icon' onclick='sendMail(" . $app->getId() . ")'><i class='far fa-envelope-open'/></a></td>";
                                    }

                                    echo "<td>" . $client->getFullname() . "</td>";
                                    echo "<td>" . $app->getActionsasstring() . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottom.php");
?>