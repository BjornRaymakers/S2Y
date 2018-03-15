<?php

class bill
{
    private $id = "";
    private $price_km = 0;
    private $price_excl_btw = 0;
    private $price_incl_btw = 0;
    private $price_btw = 0;
    private $price_km_total = 0;
    private $app_reduction = 0;
    private $reg_date;

    public function __construct()
    {
        $this->id = "";
        $this->price_km = 0;
        $this->price_excl_btw = 0;
        $this->price_incl_btw = 0;
        $this->price_btw = 0;
        $this->price_km_total = 0;
        $this->reg_date = "";
        $this->app_reduction = 0;
    }

    public function getAppReduction()
    {
        return $this->app_reduction;
    }

    public function setAppReduction($app_reduction)
    {
        $this->app_reduction = $app_reduction;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function setPrice_km($price_km)
    {
        $this->price_km = $price_km;
    }

    function getPrice_km()
    {
        return $this->price_km;
    }

    function setPrice_excl_btw($price_excl_btw)
    {
        $this->price_excl_btw = $price_excl_btw;
    }

    function getPrice_excl_btw()
    {
        return $this->price_excl_btw;
    }

    function setPrice_incl_btw($price_incl_btw)
    {
        $this->price_incl_btw = $price_incl_btw;
    }

    function getPrice_incl_btw()
    {
        return $this->price_incl_btw;
    }

    function setPrice_btw($price_btw)
    {
        $this->price_btw = $price_btw;
    }

    function getPrice_btw()
    {
        return $this->price_btw;
    }

    function setPrice_km_total($price_km_total)
    {
        $this->price_km_total = $price_km_total;
    }

    function getPrice_km_total()
    {
        return $this->price_km_total;
    }

    function setReg_date($reg_date)
    {
        $this->reg_date = $reg_date;
    }

    function getReg_date()
    {
        return $this->reg_date;
    }

}

function CreateBillOfRow($row)
{
    $bill = new bill;
    $bill->setId($row["id"]);
    $bill->setPrice_km($row["price_km"]);
    $bill->setPrice_excl_btw($row["price_excl_btw"]);
    $bill->setPrice_incl_btw($row["price_incl_btw"]);
    $bill->setPrice_btw($row["price_btw"]);
    $bill->setPrice_km_total($row["price_km_total"]);
    $bill->setAppReduction($row['app_reduction']);
    $bill->setReg_date($row["date(reg_date)"]);
    return $bill;
}

function getBillByID($billid)
{
    require_once $_SERVER['DOCUMENT_ROOT'] . '/admin/assets/functions/database.php';

    if ($billid === '') {
        return new bill();
    }

    $sql = "SELECT *, date(reg_date) FROM bills WHERE id='" . $billid . "'";
    $resultbills = select_db($sql);
    if ($resultbills->num_rows > 0) {
        //Should be only one
        while ($row = $resultbills->fetch_assoc()) {
            $bill = CreateBillOfRow($row);
        }
    } else {
        $bill = new bill();
    }
    return $bill;
}

function getBills()
{
    $sql = "SELECT *, date(reg_date) FROM bills ORDER BY id DESC";
    $result = select_db($sql);

    $bill_array = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bill = CreateBillOfRow($row);
            array_push($bill_array, $bill);
        }
    }
    return $bill_array;
}

function deleteBill($id, $appid) {
    $sql = "DELETE FROM bills WHERE id=" . $id;
    $result = delete_db($sql);

    if ($result === TRUE) {
        $sql = "UPDATE appointments SET bill_id='' WHERE id='" . $appid . "'";
        $resultappointment = update_db();

        if ($resultappointment == TRUE) {
            return json_encode(array('string' => "<font color='#3d4449'>Factuur verwijderd!</font>", 'id' => '', 'redirect' => true));
        } else {
            return json_encode(array('string' => "<font color='orange>Factuur verwijderd, afspraak niet geüpdatet!</font>", 'id' => '', 'redirect' => true));
        }
    } else {
        return json_encode(array('string' => "<font color='red'>Factuur niet verwijderd, DB fout!</font>", 'id' => '', 'redirect' => false));
    }
}

?>