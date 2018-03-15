<?php

class gift
{
    public $id = '';
    public $uniqid = '';
    public $valid = false;
    public $validstring = "Ongeldig";
    public $expires = '';
    public $amount = '';
    public $amountleft = '';

    /**
     * gift_class constructor.
     * @param string $id
     * @param string $uniqid
     * @param bool $valid
     * @param string $validstring
     * @param string $expires
     * @param string $amount
     */

    function __construct()
    {
        $this->id = '';
        $this->uniqid = '';
        $this->valid = false;
        $this->validstring = 'Ongeldig';
        $this->expires = '';
        $this->amount = '';
        $this->amountleft = '';
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAmountleft()
    {
        return $this->amountleft;
    }

    /**
     * @param string $amountleft
     */
    public function setAmountleft($amountleft)
    {
        $this->amountleft = $amountleft;
    }


    /**
     * @return string
     */
    public function getUniqid()
    {
        return $this->uniqid;
    }

    /**
     * @param string $uniqid
     */
    public function setUniqid($uniqid)
    {
        $this->uniqid = $uniqid;
    }


    /**
     * @return bool
     */
    public function isValid()
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return string
     */
    public function getValidstring()
    {
        return $this->validstring;
    }

    /**
     * @param string $validstring
     */
    public function setValidstring($validstring)
    {
        $this->validstring = $validstring;
    }


    /**
     * @return string
     */
    public function getExpires()
    {
        return $this->expires;
    }

    /**
     * @param string $expires
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }


}

function createGiftOfRow($row)
{
    $gift = new gift;
    $gift->setId($row["id"]);
    $gift->setUniqid($row['uniqid']);
    $gift->setExpires($row["expires"]);
    $gift->setValid(checkValid($row["expires"], 'bool'));
    $gift->setValidstring(checkValid($row["expires"], 'string'));
    $gift->setAmount($row["amount"]);
    $gift->setAmountleft($row["amountleft"]);
    return $gift;
}

function checkValid($date, $type)
{
    if (strtotime($date) < time()) {
        switch ($type) {
            case 'bool':
                return false;
                break;
            case 'string':
                return 'Ongeldig';
                break;
        }
        return false;
    } else {
        switch ($type) {
            case 'bool':
                return true;
                break;
            case 'string':
                return 'Geldig';
                break;
        }
    }
}

function getGifts()
{
    $sql = "SELECT * FROM gifts";
    $result = select_db($sql);

    $gift_array = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $gift = createGiftOfRow($row);
            array_push($gift_array, $gift);
        }
    }
    return $gift_array;
}

function getGiftByID($id)
{
    $sql = "SELECT * FROM gifts WHERE id=" . $id;
    $result = select_db($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $gift = createGiftOfRow($row);
            return $gift;
        }
    }
    return new gift();
}

function deleteGift($id)
{
    $sql = "DELETE FROM gifts WHERE uniqid='" . $id . "'";
    $result = delete_db($sql);

    if ($result === TRUE) {
        return json_encode(array('string' => "<font color='#3d4449'>Cadeaubon verwijderd!</font>", 'id' => '', 'redirect' => true));
    } else {
        return json_encode(array('string' => "<font color='red'>Cadeaubon niet verwijderd, DB fout!</font>", 'id' => '', 'redirect' => false));
    }
}

function saveGift($POST)
{
    $gift = new gift();
    $gift->setUniqid($POST["giftuid"]);
    $gift->setExpires($POST["giftexpires"]);
    $gift->setAmount($POST['giftamount']);

    if ($gift->getUniqid() == '') {
        $gift->setUniqid(uniqid());
        $sql = "INSERT INTO gifts (uniqid, expires, amount, amountleft) VALUES ('" . $gift->getUniqid() . "','" . $gift->getExpires() . "','" . $gift->getAmount() . "','" . $gift->getAmount() . "')";
        $result = insert_db($sql);

        if ($result != null) {
            return json_encode(array('string' => "<font color='#3d4449'>Cadeaubon toegevoegd!</font>", 'id' => $result, 'redirect' => false));
        } else {
            return json_encode(array('string' => "<font color='red'>" . $result . "Cadeaubons niet toegevoegd, DB fout!</font>", 'id' => $result, 'redirect' => false));
        }
    } else {
        $sql = "UPDATE gifts SET expires='" . $gift->getExpires() . "', amount='" . $gift->getAmount() . "' WHERE uniqid='" . $gift->getUniqid() . "'";
        $result = update_db($sql);

        if ($result === TRUE) {
            return json_encode(array('string' => "<font color='#3d4449'>Cadeaubon gewijzigd!</font>", 'id' => '', 'redirect' => false));
        } else {
            return json_encode(array('string' => "<font color='red'>Cadeaubon niet gewijzigd, DB fout!</font>", 'id' => '', 'redirect' => false));
        }
    }
}

?>