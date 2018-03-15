<?php

class guestbook
{
    private $id = "";
    private $name = "";
    private $message = "";
    private $date = "";
    private $approved = false;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return boolean
     */
    public function isApproved()
    {
        return $this->approved;
    }

    /**
     * @param boolean $approved
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
    }


}

function createMessageOfRow($row)
{
    $message = new guestbook();
    $message->setId($row['id']);
    $message->setName($row['name']);
    $message->setMessage($row['message']);
    $message->setDate($row['DATE(reg_date)']);
    $message->setApproved($row['approved']);
    return $message;
}

function getPublicMessages() {
    $sql = "SELECT id,name,message,DATE(reg_date),approved FROM guestbook ORDER BY reg_date DESC";

    $result = select_db($sql);
    $message_array = [];

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $mess = createMessageOfRow($row);
            if ($mess->isApproved()) {
                array_push($message_array, $mess);
            }
        }
    }
    return $message_array; 
}
function getMessages()
{
    $sql = "SELECT id,name,message,DATE(reg_date),approved FROM guestbook ORDER BY reg_date DESC";

    $result = select_db($sql);
    $message_array = [];

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $mess = createMessageOfRow($row);
            array_push($message_array, $mess);
        }
    }
    return $message_array;
}

function toggleMessage($id)
{
    $sql = "UPDATE guestbook SET approved = !approved WHERE id=" . $id;

    $result = update_db($sql);
    return $result;
}

function deleteMessage($id)
{
    $sql = "DELETE FROM guestbook WHERE id=" . $id;

    $result = delete_db($sql);
    return $result;
}

function saveMessage($POST) {
    $name = $POST["gb_fullname"];
    $email = $POST["gb_email"];
    $comments = $POST["gb_comments"];

    if ($name != "" || $email != "") {

        $sql = "INSERT INTO guestbook (name, email, message,approved) VALUES ('" . ucfirst($name) ."','" . $email . "','" . ucfirst($comments) . "',false)";
        $result = insert_db($sql);

        if ($result) {
            return json_encode(array('fname' => $name, 'code' => '3'));
        } else {
            return json_encode(array('fname' => $name, 'code' => '2'));
        }
    } else {
        return json_encode(array('fname' => $name, 'code' => '2'));
    }
}