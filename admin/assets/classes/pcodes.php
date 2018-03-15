<?php

class pcodes
{
    private $id = 0;
    private $pcode = 0;
    private $city = "";

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getPcode()
    {
        return $this->pcode;
    }

    public function setPcode($pcode)
    {
        $this->pcode = $pcode;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

}

function createPostalcodeOfRow($row)
{
    $pcode = new pcodes();
    $pcode->setId($row["id"]);
    $pcode->setPcode($row["pcode"]);
    $pcode->setCity($row["city"]);
    return $pcode;
}

function getPostalcodes()
{
    $pcodes = array();
    
    $sql = "SELECT * FROM pcodes ORDER BY pcode";
    $resultpcodes = select_db($sql);

    if ($resultpcodes->num_rows > 0) {
        while ($row = $resultpcodes->fetch_assoc()) {
            $pcodes[$row["id"]] = $row["pcode"] . " - " . $row["city"];
        }
    }
    return $pcodes;
}

function getPostalcodeByID($pcodeid)
{
    $pcode = new pcode_class();

    if ($pcodeid != "") {
        $sql = "SELECT * FROM pcodes ORDER BY pcode WHERE id=" . $pcodeid;
        $resultpcode = select_db($sql);


        if ($resultpcode->num_rows == 1) {
            while ($row = $resultpcode->fetch_assoc()) {
                $pcode = createPostalcodeOfRow($row);
            }

        }
    }
    return $pcode;
}