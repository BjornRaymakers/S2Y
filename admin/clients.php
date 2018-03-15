<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

$clients = getClients();
echo "<script>var clients=" . json_encode($clients) . "</script>";

?>

<!-- Javascript -->
<script src="assets/js_s2y/clients.js"></script>
<script src="assets/js_s2y/main.js"></script>

<!-- Post -->
<section>
    <h2>Klanten beheer</h2>

    <div class="row uniform">
        <div class="12u$">
            <input type="text" id='clientCriteriaField' oninput='updateClientTable()' placeholder="Zoek op naam, adres, telefoon, ..."/>
        </div>

        <div class="12u$">
            <div class="table-wrapper">
                <table id="clientMainTable">
                    <thead>
                    <tr>
                        <th width='2%'></th>
                        <th onclick="sortTable(1,'clientMainTable')" width='4%'>ID</th>
                        <th onclick="sortTable(2,'clientMainTable')" width='25%'>Naam</th>
                        <th onclick="sortTable(3,'clientMainTable')" width='35%'>Adres</th>
                        <th onclick="sortTable(4,'clientMainTable')" width='10%'>Telefoon</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="12u$">
            <ul class="actions">
                <li><a href="client.php" class="button icon alt fa-plus">Nieuwe klant aanmaken</a></li>
            </ul>
        </div>
    </div>
</section>

<!-- Footer -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottom.php");
?>
