<?php

class appointment
{
    public $id = "";
    public $client = null;
    public $date_appointment = "";
    public $time_appointment = "";
    public $exinfo = "";
    public $reg_date = "";
    public $status = "";
    public $status_nl = "";
    public $hairtype = "";
    public $prefday = "";
    public $owninfo = "";
    public $color = "";
    public $action1 = null;
    public $action2 = null;
    public $action3 = null;
    public $action4 = null;
    public $action5 = null;
    public $action6 = null;
    public $actionsasstring = "";
    public $bill = "";
    public $gift = "";
    public $reduction = "";
    public $mail_send = "";

    function setId($id)
    {
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function setClient($client)
    {
        $this->client = $client;
    }

    function getClient()
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getGift()
    {
        return $this->gift;
    }

    /**
     * @param string $gift
     */
    public function setGift($gift)
    {
        $this->gift = $gift;
    }


    function setDate_appointment($date_appointment)
    {
        $this->date_appointment = $date_appointment;
    }

    function getDate_appointment()
    {
        return $this->date_appointment;
    }

    function setTime_appointment($time_appointment)
    {
        $this->time_appointment = $time_appointment;
    }

    function getTime_appointment()
    {
        return $this->time_appointment;
    }

    function setExinfo($exinfo)
    {
        $this->exinfo = $exinfo;
    }

    function getExinfo()
    {
        return $this->exinfo;
    }

    function setReg_date($reg_date)
    {
        $this->reg_date = $reg_date;
    }

    function getReg_date()
    {
        return $this->reg_date;
    }

    function setStatus($status)
    {
        $this->status = $status;
    }

    function getStatus()
    {
        return $this->status;
    }

    function setStatus_nl($status_nl)
    {
        $this->status_nl = $status_nl;
    }

    function getStatus_nl()
    {
        return $this->status_nl;
    }

    function setHairtype($hairtype)
    {
        $this->hairtype = $hairtype;
    }

    function getHairtype()
    {
        return $this->hairtype;
    }

    function setPrefday($prefday)
    {
        $this->prefday = $prefday;
    }

    function getPrefday()
    {
        return $this->prefday;
    }

    function setOwninfo($owninfo)
    {
        $this->owninfo = $owninfo;
    }

    function getOwninfo()
    {
        return $this->owninfo;
    }

    function setColor($color)
    {
        $this->color = $color;
    }

    function getColor()
    {
        return $this->color;
    }

    function setAction1($action1)
    {
        $this->action1 = $action1;
    }

    function getAction1()
    {
        return $this->action1;
    }

    function setAction2($action2)
    {
        $this->action2 = $action2;
    }

    function getAction2()
    {
        return $this->action2;
    }

    function setAction3($action3)
    {
        $this->action3 = $action3;
    }

    function getAction3()
    {
        return $this->action3;
    }

    function setAction4($action4)
    {
        $this->action4 = $action4;
    }

    function getAction4()
    {
        return $this->action4;
    }

    function setAction5($action5)
    {
        $this->action5 = $action5;
    }

    function getAction5()
    {
        return $this->action5;
    }

    function setAction6($action6)
    {
        $this->action6 = $action6;
    }

    function getAction6()
    {
        return $this->action6;
    }

    function setBill($bill)
    {
        $this->bill = $bill;
    }

    function getBill()
    {
        return $this->bill;
    }

    function setReduction($reduction)
    {
        $this->reduction = $reduction;
    }

    function getReduction()
    {
        return $this->reduction;
    }

    function setMail_send($mail_send)
    {
        $this->mail_send = $mail_send;
    }

    function getMail_send()
    {
        return $this->mail_send;
    }

    /**
     * @return string
     */
    public function getActionsasstring()
    {
        return $this->actionsasstring;
    }

    /**
     * @param string $actionsasstring
     */
    public function setActionsasstring($actionsasstring)
    {
        $this->actionsasstring = $actionsasstring;
    }


    function __construct()
    {
        $this->action1 = new article();
        $this->action2 = new article();
        $this->action3 = new article();
        $this->action4 = new article();
        $this->action5 = new article();
        $this->action6 = new article();
        $this->bill_id = null;
        $this->gift = new gift();
    }

}

function CreateAppointmentOfRow($row)
{
    $appointment = new appointment;
    $appointment->setId($row["id"]);
    $appointment->setClient(getClientByID($row["cust_id"]));
    $appointment->setDate_appointment($row["date_appointment"]);
    $appointment->setTime_appointment($row["time_appointment"]);
    $appointment->setExinfo($row["exinfo"]);
    $appointment->setReg_date($row["reg_date"]);
    $appointment->setStatus($row["status"]);
    $appointment->setStatus_nl(transStatus($row["status"]));
    $appointment->setHairtype($row["hairtype"]);
    $appointment->setPrefday($row["prefday"]);
    $appointment->setOwninfo($row["owninfo"]);
    $appointment->setColor($row["color"]);
    $appointment->setAction1(getArticleByID($row["action1"]));
    $appointment->setAction2(getArticleByID($row["action2"]));
    $appointment->setAction3(getArticleByID($row["action3"]));
    $appointment->setAction4(getArticleByID($row["action4"]));
    $appointment->setAction5(getArticleByID($row["action5"]));
    $appointment->setAction6(getArticleByID($row["action6"]));
    $appointment->setActionsasstring(getArtString($appointment));
    $appointment->setBill(getBillByID($row["bill_id"]));
    $appointment->setGift(getGiftByID($row["gift_id"]));
    $appointment->setReduction($row["reduction"]);
    $appointment->setMail_send($row["mail_send"]);
    return $appointment;
}

function getArtString($art)
{
    $Str = "";
    $Str = $art->getAction1()->getName();
    $Str .= "  " . $art->getAction2()->getName();
    $Str .= "  " . $art->getAction3()->getName();
    $Str .= "  " . $art->getAction4()->getName();
    $Str .= "  " . $art->getAction5()->getName();
    $Str .= "  " . $art->getAction6()->getName();
    return $Str;
}

function transStatus($stat)
{
    switch ($stat) {
        case "BUSY":
            return "Ingepland";
            break;
        case "CLOSED":
            return "Afgewerkt";
            break;
        case "OPEN":
            return "Open";
            break;
        default:
            return "";
    }
}

function getActionPrice($action, $hairtype, $btw)
{
    $return_price = 0;
    $price1exclbtw = $action->getPrice1();
    $price1exclbtwinclreduction = round($price1exclbtw - (($price1exclbtw / 100) * $action->getReduction()), 2, PHP_ROUND_HALF_UP);

    if ($action->getPrice2() == null) {
        $return_price = $price1exclbtwinclreduction;
    } else {

        if (strtoupper(strtoupper($hairtype) == strtoupper($action->getPrice1_comment()))) {
            $return_price = $price1exclbtwinclreduction;
        } else {
            $price2exclbtw = $action->getPrice2();
            $price2exclbtwinclreduction = round($price2exclbtw - (($price2exclbtw / 100) * $action->getReduction()), 2, PHP_ROUND_HALF_UP);
            $return_price = $price2exclbtwinclreduction;
        }

    }
    return $return_price;
}

function createBill($appid)
{
    $totalExclBtw = 0;
    $price_km = 0.25;
    $btw = 0;
    $appointment = getAppointmentByID($appid);
    $client = $appointment->getClient();

    if ($client->getID() != '' or $appointment->getId() != '') {
        //BEHANDELINGEN
        $totalExclBtw += getActionPrice($appointment->getAction1(), $appointment->getHairtype(), $btw);
        $totalExclBtw += getActionPrice($appointment->getAction2(), $appointment->getHairtype(), $btw);
        $totalExclBtw += getActionPrice($appointment->getAction3(), $appointment->getHairtype(), $btw);
        $totalExclBtw += getActionPrice($appointment->getAction4(), $appointment->getHairtype(), $btw);
        $totalExclBtw += getActionPrice($appointment->getAction5(), $appointment->getHairtype(), $btw);
        $totalExclBtw += getActionPrice($appointment->getAction6(), $appointment->getHairtype(), $btw);

        //KM VERGOEDING <10 == Gratis
        $total_km = $client->getTotal_km();
        if ($total_km < 10) {
            $price_km_total = 0;
        } else {
            $price_km_total = round(($client->getTotal_km() * $price_km), 2, PHP_ROUND_HALF_UP);
        }
        $totalExclBtw += $price_km_total;

        //AFSPRAAK KORTING
        if ($appointment->getReduction() > 0) {
            $appointmentreduction = round((($totalExclBtw / 100) * $appointment->getReduction()), 2, PHP_ROUND_HALF_UP);
            $totalExclBtw = $totalExclBtw - $appointmentreduction;
        } else {
            $appointmentreduction = 0;
        }

        //BEREKENINGEN
        $price_excl_btw_with_reduction = round($totalExclBtw, 2, PHP_ROUND_HALF_UP);
        $price_incl_btw_with_reduction = round((($price_excl_btw_with_reduction / 100) * $btw) + $price_excl_btw_with_reduction, 2, PHP_ROUND_HALF_UP);

        //INBRENG DATABASE
        $sql = "INSERT INTO bills (price_km,price_excl_btw,price_incl_btw,price_btw,price_km_total,app_reduction) VALUES ('" . $price_km . "','" . $price_excl_btw_with_reduction . "','" . $price_incl_btw_with_reduction . "','" . $btw . "','" . $price_km_total . "','" . $appointmentreduction . "')";
        $insertresult = insert_db($sql);

        $sql = "UPDATE appointments SET status='CLOSED', bill_id='" . $insertresult . "' WHERE id='" . $appointment->getId() . "'";
        $updateresult = update_db($sql);

        if ($updateresult == TRUE) {
            return json_encode(array('string' => "<font color='#3d4449'>Factuur aangemaakt!</font>", 'id' => $appointment->getId(), 'redirect' => true));
        } else {
            return json_encode(array('string' => "<font color='red'>Factuur niet aangemaakt!</font>", 'id' => '', 'redirect' => false));
        }
    } else {
        echo "MAJOR ERROR";
    }
}

function getAppointmentsByParam($appointments, $param, $addition)
{
    $return = [];

    foreach ($appointments as &$appointment) {
        if (date($param, strtotime($appointment->getDate_appointment())) == (date($param) + $addition)) {
            if ($appointment->getStatus() == 'BUSY') {
                array_push($return, $appointment);
            }
        }
    }
    return $return;
}

function getAppointments()
{
    $sql = "SELECT * FROM appointments ORDER BY date_appointment DESC";
    $result = select_db($sql);

    $appointments = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointment = CreateAppointmentOfRow($row);
            array_push($appointments, $appointment);
        }
    }
    return $appointments;
}

function getAppointmentsByState($state)
{
    $sql = "SELECT * FROM appointments WHERE status='" . $state . "'";
    $result = select_db($sql);
    $appointments = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointment = CreateAppointmentOfRow($row);
            array_push($appointments, $appointment);
        }
    }
    return $appointments;
}

function getAppointmentByID($id)
{
    $sql = "SELECT * FROM appointments WHERE id=" . $id;
    $result = select_db($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointment = CreateAppointmentOfRow($row);
            return $appointment;
        }
    }
    return new appointment_class();
}

function getColorsByCustomerID($custid)
{
    $sql = "SELECT color FROM appointments WHERE cust_id='" . $custid . "' GROUP BY color ORDER BY date_appointment DESC";
    $result = select_db($sql);
    $colors = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $color = $row['color'];
            if ($color != '') {
                array_push($colors, $color);
            }
        }
    }
    return $colors;
}

function getColorsAllCustomers()
{
    $sql = "SELECT color FROM appointments GROUP BY color ORDER BY date_appointment DESC";
    $result = select_db($sql);
    $colors = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $color = $row['color'];
            if ($color != '') {
                array_push($colors, $color);
            }
        }
    }
    return $colors;
}

function getAppointmentsByCustomerID($custid)
{
    $sql = "SELECT * FROM appointments WHERE cust_id='" . $custid . "' ORDER BY date_appointment DESC";
    $result = select_db($sql);
    $appointments = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $appointment = CreateAppointmentOfRow($row);
            array_push($appointments, $appointment);
        }
    }
    return $appointments;
}

function getAppointmentByBillID($billid)
{
    $sql = "SELECT * FROM appointments WHERE bill_id='" . $billid . "'";
    $result = select_db($sql);

    if ($result->num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $appointment = CreateAppointmentOfRow($row);
            return $appointment;
        }
    }
    return new appointment();
}

function deleteAppointment($id)
{
    $sql = "DELETE FROM appointments WHERE id=" . $id;
    $result = delete_db($sql);

    if ($result === TRUE) {
        return json_encode(array('string' => "<font color='#3d4449'>Afspraak verwijderd!</font>", 'id' => '', 'redirect' => true));
    } else {
        return json_encode(array('string' => "<font color='red'>Afspraak niet verwijderd, DB fout!</font>", 'id' => '', 'redirect' => false));
    }
}

function saveAppointment($POST)
{
    $appointment = new appointment();

    $temp_client = getClientByID($POST["custid"]);

    if ($temp_client->getID() < 1000) {
        $sql = "INSERT INTO clients (firstname,lastname,telephone,email,street,housenumber,pcode_id) VALUES ('" . $temp_client->getFirstname() . "','" . $temp_client->getLastname() . "','" . $temp_client->getTelephone() . "','" . $temp_client->getEmail() . "','" . $temp_client->getStreet() . "','" . $temp_client->getHousenumber() . "','" . $temp_client->getPcode_id() . "')";
        $newclient_id = insert_db($sql);

        if ($newclient_id != '') {
            $client = getClientByID($newclient_id);
            delete_db("DELETE FROM appointments_clients WHERE id=" . $temp_client->getID());
        } else {
            return json_encode(array('string' => "<font color='red'>Afspraak niet toegevoegd, DB fout!</font>", 'id' => '', 'redirect' => false));
        }
    } else {
        $client = $temp_client;
    }

    $appointment->setId($POST['appid']);
    $appointment->setClient($client);
    $appointment->setDate_appointment($POST["date_appointment"]);
    $appointment->setTime_appointment($POST["time_appointment"]);
    $appointment->setExinfo($POST["exinfo"]);
    $appointment->setOwninfo($POST["owninfo"]);
    $appointment->setAction1($POST["action1"]);
    $appointment->setAction2($POST["action2"]);
    $appointment->setAction3($POST["action3"]);
    $appointment->setAction4($POST["action4"]);
    $appointment->setAction5($POST["action5"]);
    $appointment->setAction6($POST["action6"]);
    $appointment->setReduction($POST["reduction"]);
    $appointment->setColor($POST["haircolor"]);
    $appointment->setHairtype($POST["hairtype"]);
    $appointment->setStatus($POST["status"]);
    $appointment->setGift(getGiftByID($POST["gift"]));

    if ($appointment->getId() == '') {
        $sql = "INSERT INTO appointments (cust_id,date_appointment,time_appointment,exinfo,status,hairtype,owninfo,color,action1,action2,action3,action4,action5,action6,reduction, gift_id) VALUES ('" . $client->getID() . "','" . $appointment->getDate_appointment() . "','" . $appointment->getTime_appointment() . "','" . $appointment->getExinfo() . "','" . $appointment->getStatus() . "','" . $appointment->getHairtype() . "','" . $appointment->getOwninfo() . "','" . $appointment->getColor() . "','" . $appointment->getAction1() . "','"  . $appointment->getAction2() . "','" . $appointment->getAction3() . "','" . $appointment->getAction4() . "','" . $appointment->getAction5() . "','" . $appointment->getAction6() . "','" . $appointment->getReduction() . "','" . $appointment->getGift()->getId() . "')";
        $result = insert_db($sql);

        if ($result != null) {
            return json_encode(array('string' => "<font color='#3d4449'>Afspraak toegevoegd!</font>", 'id' => $result, 'redirect' => false));
        } else {
            return json_encode(array('string' => "<font color='red'>Afspraak niet toegevoegd, DB fout!</font>", 'id' => $result, 'redirect' => false));
        }
    } else {
        $sql = "UPDATE appointments SET cust_id='" . $client->getID() . "', date_appointment='" . $appointment->getDate_appointment() . "', time_appointment='" . $appointment->getTime_appointment() . "', exinfo='" . $appointment->getExinfo() . "', status='" . $appointment->getStatus() . "', action1='" . $appointment->getAction1() . "', action2='" . $appointment->getAction2() . "', action3='" . $appointment->getAction3() . "', action4='" . $appointment->getAction4() . "', action5='" . $appointment->getAction5() . "', action6='" . $appointment->getAction6() . "', hairtype='" . $appointment->getHairtype() . "', owninfo='" . $appointment->getOwninfo() . "', reduction='" . $appointment->getReduction() . "', color='" . $appointment->getColor() . "', gift_id='" . $appointment->getGift()->getId() . "' WHERE id=" . $appointment->getId();
        $result = update_db($sql);
        if ($result === TRUE) {
            return json_encode(array('string' => "<font color='#3d4449'>Afspraak gewijzigd!</font>", 'id' => '', 'redirect' => false));
        } else {
            return json_encode(array('string' => "<font color='red'>Afspraak niet gewijzigd, DB fout!</font>", 'id' => '', 'redirect' => false));
        }
    }

}

function saveNewAppointmentAndClient($POST)
{
    try {
        //Vars
        $appointment = new appointment();
        $client = new client();

        $client->setFirstname(ucfirst($POST["firstname"]));
        $client->setLastname(ucfirst($POST["lastname"]));
        $client->setEmail($POST["email"]);
        $client->setTelephone($POST["telephone"]);
        $client->setStreet(ucfirst($POST["street"]));
        $client->setHousenumber($POST["housenumber"]);
        $client->setPcode_id($POST["pcode_id"]);

        $appointment->setDate_appointment($POST["appdate"]);
        $appointment->setTime_appointment($POST["apptime"]);
        $appointment->setExinfo($POST["comments"]);
        $appointment->setAction1(getArticleByID($POST["treatment1"]));
        $appointment->setAction2(getArticleByID($POST["treatment2"]));
        $appointment->setAction3(getArticleByID($POST["treatment3"]));
        $appointment->setAction4(getArticleByID($POST["treatment4"]));
        $appointment->setAction5(getArticleByID($POST["treatment5"]));
        $appointment->setAction6(getArticleByID($POST["treatment6"]));

        setcookie("s2yFirstname", $client->getFirstname(), time() + 60 * 60 * 24 * 7);
        setcookie("s2yLastname", $client->getLastname(), time() + 60 * 60 * 24 * 7);
        setcookie("s2yEmail", $client->getEmail(), time() + 60 * 60 * 24 * 7);
        setcookie("s2yTelephone", $client->getTelephone(), time() + 60 * 60 * 24 * 7);
        setcookie("s2yStreet", $client->getStreet(), time() + 60 * 60 * 24 * 7);
        setcookie("s2yHousenumber", $client->getHousenumber(), time() + 60 * 60 * 24 * 7);
        setcookie("s2yPcodeID", $client->getPcode_id(), time() + 60 * 60 * 24 * 7);

        $sql = "INSERT INTO appointments_clients (firstname,lastname,email,telephone,street,housenumber,pcode_id) VALUES ('" . $client->getFirstname() . "','" . $client->getLastname() . "','" . $client->getEmail() . "','" . $client->getTelephone() . "','" . $client->getStreet() . "','" . $client->getHousenumber() . "','" . $client->getPcode_id() . "')";
        $lastid = insert_db($sql);

        if ($lastid != null) {
            $sql = "INSERT INTO appointments (cust_id,date_appointment,time_appointment,exinfo,status,action1,action2,action3,action4,action5,action6) VALUES ('" . $lastid . "','" . $appointment->getDate_appointment() . "','" . $appointment->getTime_appointment() . "','" . $appointment->getExinfo() . "','OPEN','" . $appointment->getAction1()->getId() . "','" . $appointment->getAction2()->getId() . "','" . $appointment->getAction3()->getId() . "','" . $appointment->getAction4()->getId() . "','" . $appointment->getAction5()->getId() . "','" . $appointment->getAction6()->getId() . "')";
            insert_db($sql);

            $mail_body = createNewAppointmentMailBody($client, $appointment);
            $mail_subject = 'Nieuwe afspraak: ' . $client->getFirstname() . " " . $client->getLastname();
            sendMail('info@scissors2you.be', $client->getFirstname(), $client->getLastname(), $mail_subject, $mail_body, $client->getEmail(), false);

            return json_encode(array('fname' => $client->getFirstname(), 'code' => '1'));
        } else {
            return json_encode(array('fname' => $client->getFirstname(), 'code' => '2'));
        }

    } catch (Exception $e) {
        return json_encode(array('fname' => '', 'code' => '2'));
    }
}

function createNewAppointmentMailBody($clnt, $app)
{
    $message = "#################### NIEUWE AFSPRAAK ####################" . "<br>";
    $message .= "Naam: " . $clnt->getFirstname() . " " . $clnt->getLastname() . "<br>";
    $message .= "Adres: " . $clnt->getStreet() . " " . $clnt->getHousenumber() . "<br>";
    $message .= "Email: <a href=mailto:" . $clnt->getEmail() . ">" . $clnt->getEmail() . "</a><br>";
    $message .= "Telefoon: " . $clnt->getTelephone() . "<br><br>";
    $message .= "Gewenste datum: " . $app->getDate_appointment() . " - " . $app->getTime_appointment() . "<br>";
    $message .= "Bericht: " . $app->getExinfo() . "<br><br>";
    $message .= "#################### NIEUWE AFSPRAAK ####################";

    return $message;
}

function createAppointmentDeal($appointment)
{
    $client = $appointment->getClient();

    $message = "Beste " . $client->getFullname() . "<br><br>";
    $message .= "Je afspraak bij Scissors 2 You staat ingepland op " . $appointment->getDate_appointment() . " om " . $appointment->getTime_appointment() . "." . "<br><br>";
    $message .= "Tot dan!" . "<br><br>";
    $message .= "Scissors 2 You" . "<br>";
    $message .= "www.scissors2you.be - 0471/49.82.88" . "<br>";

    $variables = array();

    $variables['mailbody'] = $message;

    $template = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/admin/assets/templates/mail_template.php");

    foreach($variables as $key => $value)
    {
        $template = str_replace('{{ '.$key.' }}', $value, $template);
    }

    return $template;
}

?>