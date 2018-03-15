<?php

class client
{
    public $id = "";
    public $firstname = "";
    public $lastname = "";
    public $fullname = "";
    public $email = "";
    public $telephone = "";
    public $street = "";
    public $housenumber = "";
    public $pcode_id = "";
    public $ex_info = "";
    public $birthday = "";
    public $total_km = "";
    public $pcode;
    public $city;
    private $appointments = [];

    function getAppointments()
    {
        return $this->appointments;
    }

    function setAppointments($appointments)
    {
        $this->appointments = $appointments;
    }

    function getFullname()
    {
        return $this->fullname;
    }

    function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    function setPcode($pcode)
    {
        $this->pcode = $pcode;
    }

    function getPcode()
    {
        return $this->pcode;
    }

    function setCity($city)
    {
        $this->city = $city;
    }

    function getCity()
    {
        return $this->city;
    }

    function setID($id)
    {
        $this->id = $id;
    }

    function getID()
    {
        return $this->id;
    }

    function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    function getFirstname()
    {
        return $this->firstname;
    }

    function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    function getLastname()
    {
        return $this->lastname;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function getEmail()
    {
        return $this->email;
    }

    function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    function getTelephone()
    {
        return $this->telephone;
    }

    function setStreet($street)
    {
        $this->street = $street;
    }

    function getStreet()
    {
        return $this->street;
    }

    function setHousenumber($housenumber)
    {
        $this->housenumber = $housenumber;
    }

    function getHousenumber()
    {
        return $this->housenumber;
    }

    function setPcode_id($pcode_id)
    {
        $this->pcode_id = $pcode_id;
    }

    function getPcode_id()
    {
        return $this->pcode_id;
    }

    function getFull_Address()
    {
        return $this->street . " " . $this->housenumber . ", " . $this->pcode . " " . $this->city;
    }

    function setEx_info($ex_info)
    {
        $this->ex_info = $ex_info;
    }

    function getEx_info()
    {
        return $this->ex_info;
    }

    function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    function getBirthday()
    {
        return $this->birthday;
    }

    function setTotal_km($total_km)
    {
        $this->total_km = $total_km;
    }

    function getTotal_km()
    {
        return $this->total_km;
    }

    function setReg_date($reg_date)
    {
        $this->reg_date = $reg_date;
    }

    function getReg_date()
    {
        return $this->reg_date;
    }


    function __construct()
    {
        $this->id = null;
        $this->fullname = "Klant";
    }

}

function createClientOfRow($row)
{
    $client = new client;
    $client->setID($row["id"]);
    $client->setFirstname($row["firstname"]);
    $client->setLastname($row["lastname"]);
    $client->setFullname($row["firstname"] . " " . $row["lastname"]);
    $client->setEmail($row["email"]);
    $client->setTelephone($row["telephone"]);
    $client->setReg_date($row["date(reg_date)"]);
    $client->setStreet($row["street"]);
    $client->setHousenumber($row["housenumber"]);
    $client->setPcode_id($row["pcode_id"]);
    $client->setEx_info($row["exinfo"]);
    $client->setBirthday($row["birthday"]);
    $client->setTotal_km($row["total_km"]);
    $client->setCity($row["city"]);
    $client->setPcode($row["pcode"]);
    //$client->setAppointments(getAppointmentsByCustomerID($client->getId()));
    return $client;
}

function flushTemporaryClients()
{
    $sql = "TRUNCATE appointments_clients";
    $result = delete_db($sql);

    if ($result == true) {
        return json_encode(array('string' => "Database geledigd!", 'errorcode' => 'success', 'id' => '', 'redirect' => false));
    } else {
        return json_encode(array('string' => "Database niet geledigd!", 'errorcode' => 'error', 'id' => '', 'redirect' => false));
    }
}

function getClients()
{
    $sql = "SELECT *, c.id as id, date(reg_date), p.pcode as pcode, p.city as city FROM clients c INNER JOIN pcodes p on p.id = c.pcode_id ORDER BY firstname";
    $result = select_db($sql);

    $client_array = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $client = createClientOfRow($row);
            array_push($client_array, $client);
        }
    }
    return $client_array;
}

function getBirthdayClients($weekplus)
{
    if ($weekplus == 0) {
        $sql = "SELECT *, c.id as id, date(reg_date), p.pcode as pcode, p.city as city FROM clients c INNER JOIN pcodes p on p.id = c.pcode_id WHERE WEEK(c.birthday) = WEEK(curdate()) ORDER BY firstname";
    } else {
        $sql = "SELECT *, c.id as id, date(reg_date), p.pcode as pcode, p.city as city FROM clients c INNER JOIN pcodes p on p.id = c.pcode_id WHERE WEEK(c.birthday) = WEEK(curdate()) + " . $weekplus . " ORDER BY firstname";
    }
    $result = select_db($sql);

    $client_array = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $client = createClientOfRow($row);
            array_push($client_array, $client);
        }
    }
    return $client_array;
}

function getClientsCompare($client)
{
    $sql = "SELECT *, c.id as id, date(reg_date), p.pcode as pcode, p.city as city FROM clients c JOIN pcodes p on p.id = c.pcode_id WHERE c.street LIKE '" . trim($client->getStreet()) . "' AND c.housenumber LIKE '" . trim($client->getHousenumber()) . "'";
    $result = select_db($sql);

    $client_array = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $client = createClientOfRow($row);
            array_push($client_array, $client);
        }
    }
    return $client_array;
}

function getClientByID($clientid)
{
    $sql = "SELECT *, c.id as id, date(reg_date), p.pcode as pcode, p.city as city FROM clients c JOIN pcodes p on p.id = c.pcode_id WHERE c.id=" . $clientid;
    $resultclient = select_db($sql);

    if ($resultclient->num_rows == 1) {
        //Existing customer in 'clients' table.
        while ($row = $resultclient->fetch_assoc()) {
            $client = createClientOfRow($row);
        }
        return $client;
    } else {
        //It maybe is a new customer
        $sql_other = "SELECT *, c.id as id, date(reg_date), p.pcode as pcode, p.city as city FROM appointments_clients c JOIN pcodes p on p.id = c.pcode_id WHERE c.id=" . $clientid;
        $resultclient_other = select_db($sql_other);

        if ($resultclient_other->num_rows == 1) {
            //Existing customer in 'clients' table.
            while ($row = $resultclient_other->fetch_assoc()) {
                $client = createClientOfRow($row);
            }
            return $client;
        }

    }
    return new client_class();
}

function deleteClient($id)
{
    $sql = "DELETE FROM clients WHERE id=" . $id;
    $result = delete_db($sql);

    if ($result === TRUE) {
        return json_encode(array('string' => "<font color='#3d4449'>Klant verwijderd!</font>", 'id' => '', 'redirect' => true));
    } else {
        return json_encode(array('string' => "<font color='red'>Klant niet verwijderd, DB fout!</font>", 'id' => '', 'redirect' => false));
    }
}

function saveClient($POST)
{
    $client = new client();
    $client->setID($POST["custid"]);
    $client->setFirstname(ucwords(strtolower($POST["firstname"])));
    $client->setLastname(ucwords(strtolower($POST["lastname"])));
    $client->setTelephone($POST["telephone"]);
    $client->setEmail($POST["email"]);
    $client->setStreet(ucfirst($POST["street"]));
    $client->setHousenumber($POST["housenumber"]);
    $client->setPcode_id($POST["citys"]);
    $client->setEx_info($POST["exinfo"]);
    $client->setBirthday($POST["birthday"]);
    $client->setTotal_km($POST["total_km"]);

    if ($client->getID() == '') {
        $sql = "INSERT INTO clients (firstname,lastname,telephone,email,street,housenumber,pcode_id,exinfo,birthday,total_km) VALUES ('" . $client->getFirstname() . "','" . $client->getLastname() . "','" . $client->getTelephone() . "','" . $client->getEmail() . "','" . $client->getStreet() . "','" . $client->getHousenumber() . "','" . $client->getPcode_id() . "','" . $client->getEx_info() . "','" . $client->getBirthday() . "','" . $client->getTotal_km() . "')";
        $result = insert_db($sql);

        if ($result != null) {
            return json_encode(array('string' => "<font color='#3d4449'>Klant toegevoegd!</font>", 'id' => $result, 'redirect' => false));
        } else {
            return json_encode(array('string' => "<font color='red'>Klant niet toegevoegd, DB fout!</font>", 'id' => $result, 'redirect' => false));
        }
    } else {
        $sql = "UPDATE clients SET firstname='" . $client->getFirstname() . "', lastname='" . $client->getLastname() . "', telephone='" . $client->getTelephone() . "', email='" . $client->getEmail() . "', street='" . $client->getStreet() . "', housenumber='" . $client->getHousenumber() . "', pcode_id='" . $client->getPcode_id() . "', exinfo='" . $client->getEx_info() . "', birthday='" . $client->getBirthday() . "', total_km='" . $client->getTotal_km() . "' WHERE id=" . $client->getID();
        $result = update_db($sql);

        if ($result === TRUE) {
            return json_encode(array('string' => "<font color='#3d4449'>Klant gewijzigd!</font>", 'id' => '', 'redirect' => false));
        } else {
            return json_encode(array('string' => "<font color='red'>Klant niet gewijzigd, DB fout!</font>", 'id' => '', 'redirect' => false));
        }
    }


}

?>