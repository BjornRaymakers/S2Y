<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$client = getClientByID($_GET["id"]);
$pcodes = getPostalcodes();

if ($client->getID() != '') {
    $appointments = getAppointmentsByCustomerID($client->getID());
}

?>

<!-- Javascript -->
<script src="assets/js_s2y/client.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAs4j6sN7fUYo2mEZgRpOJ502YR8pRHXL0&callback=calcDistance"></script>

<!-- Post -->
<section>
    <div class="row uniform">
        <div class="6u 12u">
            <h2><?php echo $client->getFullname() ?> </h2>
        </div>
        <div class="6u 12u$">
            <h3 align="right" id="responseH"></h3>
        </div>
    </div>

    <form id="clientform" class='alt'>
        <div class="row uniform">

            <!-- CONTACT GEGEVENS -->
            <div class="2u 12u(small)">
                <label for="custid">ID</label>
                <input type="text" name="custid" id="custid" value="<?php echo $client->getID(); ?>" readonly/>
            </div>
            <div class="4u 12u(small)">
                <label for="firstname">Voornaam</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $client->getFirstname(); ?>"/>
            </div>
            <div class="6u 12u$(small)">
                <label for="lastname">Achternaam</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $client->getLastname(); ?>"/>
            </div>

            <div class="4u 12u(small)">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $client->getEmail(); ?>"/>
            </div>

            <div class="4u 12u(small)">
                <label for="telephone">Telefoon</label>
                <input type="text" name="telephone" id="telephone" value="<?php echo $client->getTelephone(); ?>"/>
            </div>

            <div class="4u 12u$(small)">
                <label for="birthday">Verjaardag</label>
                <input type="date" name="birthday" id="birthday" value="<?php echo $client->getBirthday(); ?>"
                       placeholder="YYYY-MM-DD"/>
            </div>

            <div class="5u 12u$(small)">
                <label for="street">Straat</label>
                <input type="text" name="street" id="street" value="<?php echo $client->getStreet(); ?>"/>
            </div>
            <div class="1u 12u$(small)">
                <label for="housenumber">Nr</label>
                <input type="text" name="housenumber" id="housenumber"
                       value="<?php echo $client->getHousenumber(); ?>"/>
            </div>
            <div class="4u 12u(small)">
                <label for="city">Stad</label>
                <div class="select-wrapper">
                    <select name="citys" id="citys" onchange="calcDistance()">
                        <?php
                        foreach ($pcodes as $key => $value):
                            if ($key == $client->getPcode_id()) {
                                echo '<option value="' . $key . '" selected="selected">' . $value . '</option>';
                            } else {
                                echo '<option value="' . $key . '">' . $value . '</option>';
                            }

                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="2u 12u$(small)">
                <label for="total_km">Aantal KMs</label>
                <input type="text" name="total_km" id="total_km" value="<?php echo $client->getTotal_km(); ?>"
                       readonly/>
            </div>

            <div class="4u 12u">
                <label for="regdate">Klant sinds</label>
                <input type="text" name="regdate" id="regdate" value="<?php echo $client->getReg_date(); ?>"
                       readonly/>
            </div>
            <div class="8u 12u$">
                <label for="exinfo">Extra info</label>
                <input type="text" name="exinfo" id="exinfo" value="<?php echo $client->getEx_info(); ?>"/>
            </div>
            <ul class="actions">
                <li><input type='button' onclick='saveClient()' name='update' value='Bewaren'/></li>
                <li><input type='button' onclick='deleteClient()' name='delete' value='Verwijderen'/></li>
            </ul>
        </div>
    </form>
</section>

<section>
    <div class="row uniform">
        <div class="6u 12u">
            <h2>Afspraken historiek</h2>
        </div>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
            <tr>
                <th width='2%'></th>
                <th width='5%'>ID</th>
                <th width='10%'>Datum</th>
                <th width='10%'>Tijd</th>
                <th width='10%'>Status</th>
                <th width='40%'>Behandeling</th>
                <th width='20%'>Prijs</th>
                <th width='5%'></th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($appointments as &$appointment) {
                $bill = $appointment->getBill();
                echo "<tr>";
                echo "<td><a href='appointment?id=" . $appointment->getId() . "' class='icon'><i class='fab fa-sistrix'/></a></td>";
                echo "<td>" . $appointment->getId() . "</td>";
                echo "<td>" . date("d M Y", strtotime($appointment->getDate_appointment())) . "</td>";
                echo "<td>" . $appointment->getTime_appointment() . "</td>";
                echo "<td>" . $appointment->getStatus_nl() . "</td>";
                echo "<td>" . $appointment->getActionsasstring() . "</td>";
                echo "<td>€ " . $bill->getPrice_incl_btw() . "</td>";
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