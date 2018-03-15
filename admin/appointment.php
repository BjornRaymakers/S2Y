<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/top.php");
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/functions/classes.php");

global $app, $client, $clients, $bill, $actions;

$app_id = $_GET["id"];
$sendmail = $_GET["mail"];

if ($app_id == '') {
    $app = new appointment_class();
    $client = new client_class();
    $bill = new bill_class();
} else {
    $app = getAppointmentByID($_GET["id"]);

    $client = $app->getClient();
    $clientlookalike = getClientsCompare($client);

    $clientColors = getColorsByCustomerID($client->getID());

    echo "<script>var custlookalike = " . json_encode($clientlookalike) . "</script>";
    $bill = $app->getBill();
}

$allColors = getColorsAllCustomers();
$actions = getArticles();
$clients = getClients();
$gifts = getGifts();

?>

    <!-- Javascript -->
    <script>
        var appointment = <?php echo json_encode($app);?>;
        var clients = <?php echo json_encode($clients);?>;
        var actions = <?php echo json_encode($actions);?>;
        var gifts = <?php echo json_encode($gifts);?>;
    </script>

    <script src="assets/js_s2y/appointment.js"></script>

    <!-- Post -->
    <section>
        <div class="row uniform">
            <div class="8u 12u">
                <?php
                if ($client->getID() == '') {
                    echo "<h2>Nieuwe afspraak</h2>";
                } else {
                    echo "<h2>Afspraak van " . $client->getFullname() . "</h2>";
                }
                ?>
            </div>
            <div class="4u 12u$">
                <h3 align="right" id="responseH"></h3>
            </div>
        </div>

        <form id="appointmentform" class='alt'>
            <div class="row uniform">

                <!-- CONTACT GEGEVENS -->
                <div class="12u$">
                    <label for="custid">Klant</label>
                    <div class="select-wrapper">
                        <select name="custid" id="custid" onchange="calculateTreatments()">
                            <?php
                            if ($client->getID() != '') {
                                echo "<optgroup label='Huidige klant'>";
                                echo "<option value='" . $client->getID() . "' selected>" . $client->getID() . " - " . $client->getFullname() . " - " . $client->getStreet() . " " . $client->getHousenumber() . ", " . $client->getPcode() . " " . $client->getCity() . "</option>";
                                echo "</optgroup>";
                            }
                            ?>

                            <?php
                            if (count($clientlookalike) > 0) {
                                echo "<optgroup label=\"Aanbevolen\">";
                                foreach ($clientlookalike as &$clnt) {
                                    echo "<option value='" . $clnt->getID() . "'>" . $clnt->getID() . " - " . $clnt->getFullname() . " - " . $clnt->getStreet() . " " . $clnt->getHousenumber() . ", " . $clnt->getPcode() . " " . $clnt->getCity() . "</option>";
                                }
                                echo "</optgroup>";
                            }

                            ?>
                            </optgroup>
                            <optgroup label="Alle klanten">
                                <?php
                                foreach ($clients as &$clnt) {
                                    echo "<option value='" . $clnt->getID() . "'>" . $clnt->getID() . " - " . $clnt->getFullname() . " - " . $clnt->getStreet() . " " . $clnt->getHousenumber() . ", " . $clnt->getPcode() . " " . $clnt->getCity() . "</option>";
                                }
                                ?>
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="3u 12u(small)">
                    <label for="appid">ID</label>
                    <input type="text" name="appid" id="appid" value="<?php echo $app->getId(); ?>" readonly/>
                </div>

                <div class="3u 12u(small)">
                    <label for="status">Status</label>
                    <div class="select-wrapper">
                        <select name="status" id="status" onchange="changeButton2();">
                            <option value="OPEN"<?php if (strtoupper($app->getStatus()) == 'OPEN') echo ' selected="selected"'; ?>>Open</option>
                            <option value="BUSY"<?php if (strtoupper($app->getStatus()) == 'BUSY') echo ' selected="selected"'; ?>>Ingepland</option>
                            <option value="CLOSED"<?php if (strtoupper($app->getStatus()) == 'CLOSED') echo ' selected="selected"'; ?>>Afgewerkt</option>
                        </select>
                    </div>
                </div>
                <div class="3u 12u(small)">
                    <label for="date_appointment">Datum</label>
                    <input type="date" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"
                           title="YYYY-MM-DD" name="date_appointment" id="date_appointment"
                           value="<?php echo $app->getDate_appointment(); ?>" placeholder="YYYY-MM-DD">
                </div>
                <div class="3u 12u$(small)">
                    <label for="time_appointment">Tijdstip</label>
                    <input type="time" pattern="(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9])" title="HH:MM"
                           name="time_appointment" id="time_appointment"
                           value="<?php echo $app->getTime_appointment(); ?>" placeholder="HH:MM">
                </div>

                <div class="12u$">
                    <h2>Behandelingen</h2>
                </div>

                <div class="6u 12u" id="divaction1">
                    <label for="action1">Behandeling 1</label>
                    <div class="select-wrapper">
                        <select name="action1" id="action1" onchange="calculateTreatments()">
                            <option selected value=""></option>
                            <optgroup label="Dames">
                                <?php
                                $womanart = getArticlesByGender('Dames');
                                foreach ($womanart as &$article):
                                    if ($app->getAction1()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                            <optgroup label="Heren">
                                <?php
                                $manart = getArticlesByGender('Heren');
                                foreach ($manart as &$article):
                                    if ($app->getAction1()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                            <optgroup label="Kinderen">
                                <?php
                                $kidsart = getArticlesByGender('Kinderen');
                                foreach ($kidsart as &$article):
                                    if ($app->getAction1()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="6u 12u$" id="divaction2">
                    <label for="action2">Behandeling 2</label>
                    <div class="select-wrapper">
                        <select name="action2" id="action2" onchange="calculateTreatments()">
                            <option selected value=""></option>
                            <optgroup label="Dames">
                                <?php
                                $womanart = getArticlesByGender('Dames');
                                foreach ($womanart as &$article):
                                    if ($app->getAction2()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                            <optgroup label="Heren">
                                <?php
                                $manart = getArticlesByGender('Heren');
                                foreach ($manart as &$article):
                                    if ($app->getAction2()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                            <optgroup label="Kinderen">
                                <?php
                                $kidsart = getArticlesByGender('Kinderen');
                                foreach ($kidsart as &$article):
                                    if ($app->getAction2()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="6u 12u" id="divaction3">
                    <label for="action3">Behandeling 3</label>
                    <div class="select-wrapper">
                        <select name="action3" id="action3" onchange="calculateTreatments()">
                            <option selected value=""></option>
                            <optgroup label="Dames">
                                <?php
                                $womanart = getArticlesByGender('Dames');
                                foreach ($womanart as &$article):
                                    if ($app->getAction3()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                            <optgroup label="Heren">
                                <?php
                                $manart = getArticlesByGender('Heren');
                                foreach ($manart as &$article):
                                    if ($app->getAction3()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                            <optgroup label="Kinderen">
                                <?php
                                $kidsart = getArticlesByGender('Kinderen');
                                foreach ($kidsart as &$article):
                                    if ($app->getAction3()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="6u 12u$" id="divaction4">
                    <label for="action4">Behandeling 4</label>
                    <div class="select-wrapper">
                        <select name="action4" id="action4" onchange="calculateTreatments()">
                            <option selected value=""></option>
                            <optgroup label="Dames">
                                <?php
                                $womanart = getArticlesByGender('Dames');
                                foreach ($womanart as &$article):
                                    if ($app->getAction4()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                            <optgroup label="Heren">
                                <?php
                                $manart = getArticlesByGender('Heren');
                                foreach ($manart as &$article):
                                    if ($app->getAction4()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                            <optgroup label="Kinderen">
                                <?php
                                $kidsart = getArticlesByGender('Kinderen');
                                foreach ($kidsart as &$article):
                                    if ($app->getAction4()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="6u 12u" id="divaction5">
                    <label for="action5">Behandeling 5</label>
                    <div class="select-wrapper">
                        <select name="action5" id="action5" onchange="calculateTreatments()">
                            <option selected value=""></option>
                            <optgroup label="Dames">
                                <?php
                                $womanart = getArticlesByGender('Dames');
                                foreach ($womanart as &$article):
                                    if ($app->getAction5()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                            <optgroup label="Heren">
                                <?php
                                $manart = getArticlesByGender('Heren');
                                foreach ($manart as &$article):
                                    if ($app->getAction5()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                            <optgroup label="Kinderen">
                                <?php
                                $kidsart = getArticlesByGender('Kinderen');
                                foreach ($kidsart as &$article):
                                    if ($app->getAction5()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="6u 12u$" id="divaction6">
                    <label for="action6">Behandeling 6</label>
                    <div class="select-wrapper">
                        <select name="action6" id="action6" onchange="calculateTreatments()">
                            <option selected value=""></option>
                            <optgroup label="Dames">
                                <?php
                                $womanart = getArticlesByGender('Dames');
                                foreach ($womanart as &$article):
                                    if ($app->getAction6()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                            <optgroup label="Heren">
                                <?php
                                $manart = getArticlesByGender('Heren');
                                foreach ($manart as &$article):
                                    if ($app->getAction6()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . '</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . '</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                            <optgroup label="Kinderen">
                                <?php
                                $kidsart = getArticlesByGender('Kinderen');
                                foreach ($kidsart as &$article):
                                    if ($app->getAction6()->getId() == $article->getId()) {
                                        echo '<option value="' . $article->getId() . '" selected>' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                                    } else {
                                        echo '<option value="' . $article->getId() . '">' . $article->getName() . ' (' . $article->getPrice1_comment() . ')</option>';
                                    }
                                endforeach;
                                ?>
                            </optgroup>
                        </select>
                    </div>
                </div>
                <div class="12u$" id="buttonaddtreatment">
                    <a href="#!" onclick="addTreatmentDiv()" class="icon fa-plus"><i> Voeg nog een behandeling toe</i></a>
                </div>

                <div class="12u$">
                    <h2>Kleuring & haarlengte</h2>
                </div>
                <div class="6u 12u">
                    <label for="haircolor">Kleur</label>
                    <div class="select-wrapper">
                        <select name="haircolor" id="haircolor">
                            <option value=""/>
                            <optgroup label="Klant gebonden kleuren">
                                <?php
                                if (count($clientColors) > 0) {
                                    foreach ($clientColors as &$clr) {
                                        if ($app->getColor() == $clr) {
                                            echo "<option value='' selected>" . $clr . "</option>";
                                        } else {
                                            echo "<option value=''>" . $clr . "</option>";
                                        }

                                    }
                                }
                                ?>
                            </optgroup>
                            <optgroup label="Alle kleuringen">
                                <?php
                                if (count($allColors) > 0) {
                                    foreach ($allColors as &$clr) {
                                        echo "<option value=''>" . $clr . "</option>";
                                    }
                                }
                                ?>
                            </optgroup>
                            <optgroup id="optNewColor" label="Nieuw toegevoegd">
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="6u 12u$">
                    <label for="hairtype">Haarlengte</label>
                    <div class="select-wrapper">
                        <select name="hairtype" id="hairtype" onchange="calculateTreatments()">
                            <option
                                    value="Kort" <?= strtoupper($app->getHairtype()) == 'KORT' ? ' selected="selected"' : ''; ?>>
                                Kort
                            </option>
                            <option
                                    value="Lang" <?= strtoupper($app->getHairtype()) == 'LANG' ? ' selected="selected"' : ''; ?>>
                                Lang
                            </option>
                        </select>
                    </div>
                </div>
                <div class="12u$" id="buttonaddtreatment">
                    <a href="#!" onclick="inputModal()" class="icon fa-plus"><i> Voeg een nieuwe kleuring toe</i></a>
                </div>

                <div class="12u$">
                    <h2>Kortingen & cadeaubonnen</h2>
                </div>

                <div class="3u 12u(small)">
                    <label for="reduction">Afspraak korting (%)</label>
                    <input type="text" name="reduction" id="reduction" placeholder='0' value="<?php echo $app->getReduction(); ?>" onchange="calculateTreatments()">
                </div>
                <div class="5u 12u(small)">
                    <label for="giftuid">Cadeaubon code</label>
                    <input type="text" onkeyup='checkGift()' name="giftuid" id="giftuid" value="<?php echo $app->getGift()->getUniqid(); ?>" onchange="calculateTreatments()">
                </div>
                <div class="4u 12u$">
                    <label for="giftdetails">Cadeaubon geldig</label>
                    <i id='gifticon' style='margin-right: 5px;' class='fas fa-exclamation-circle fa-spin'></i><i name="giftdetails" id="giftdetails">Geen geldige code</i>
                </div>

                <div class="12u$">
                    <h2>Extra informatie</h2>
                </div>
                <div class="6u 12u">
                    <label for="exinfo">Extra info van de klant</label>
                    <textarea name="exinfo" id="exinfo" rows="2"><?php echo $app->getExinfo(); ?></textarea>
                </div>
                <div class="6u 12u$">
                    <label for="owninfo">Extra info van de kapster</label>
                    <textarea name="owninfo" id="owninfo" rows="2"><?php echo $app->getOwninfo(); ?></textarea>
                </div>

                <div class="12u$">
                    <hr/>
                </div>

                <div class="12u$">
                    <ul class="actions">
                        <li>
                            <a href=#!" onclick="checkAppointment(false)" id='saveappointmentli' class="button fit">Bewaren</a>
                        </li>
                        <li>
                            <a href=#!" onclick="checkAppointment(true)" id='createbillli' class="button fit">Afrekenen</a>
                        </li>
                        <li>
                            <a href=#!" onclick="viewBill()" id='viewbillli' class="button fit">Factuur bekijken</a>
                        </li>
                        <li>
                            <a href=#!" onclick="deleteAppointment()" id='deleteappointmentli' class="button fit special">Verwijderen</a>
                        </li>
                    </ul>
                </div>
            </div>
        </form>
    </section>

    <script>
        showTreatmentDivs();
    </script>

<?php
// No bill = disable/enable buttons
if ($bill->getId() == '') {
    echo "<script>document.getElementById('viewbillli').classList.add('disabled')</script>";
} else {
    echo "<script>document.getElementById('createbillli').classList.add('disabled')</script>";
    echo "<script>document.getElementById('deleteappointmentli').classList.add('disabled')</script>";
    echo "<script>document.getElementById('saveappointmentli').classList.add('disabled')</script>";
}
?>

    <!-- Footer -->
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/bottom.php");
?>