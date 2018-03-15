<?php

class actions
{
    private $id = 0;
    private $title = "";
    private $body = "";
    private $duration = "";
    private $valid = "";

    /**
     * actions_class constructor.
     * @param int $id
     * @param string $title
     * @param string $body
     * @param string $duration
     */
    public function __construct($id, $title, $body, $duration)
    {
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->duration = $duration;
    }


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param string $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * @param string $valid
     */
    public function setValid($valid)
    {
        $this->valid = $valid;
    }




}


function createActionOfRow($row)
{
    $act = new actions(0,"","","");
    $act->setId($row["id"]);
    $act->setBody($row["body"]);
    $act->setDuration($row["duration"]);
    $act->setTitle($row["title"]);
    $act->setValid($row["valid"]);
    return $act;
}

function getActions() {

    $sql = "SELECT * FROM actions";
    $result = select_db($sql);

    $action_array = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $action = createActionOfRow($row);
            array_push($action_array, $action);
        }
    }
    return $action_array;
}

function getActionByID($actid)
{
    $action = new actions_class();

    if ($actid != "") {
        $sql = "SELECT * FROM actions WHERE id=" . $actid;
        $resultact = select_db($sql);


        if ($resultact->num_rows == 1) {
            while ($row = $resultact->fetch_assoc()) {
                $action = createActionOfRow($row);
            }

        }
    }
    return $action;
}

function saveAction($POST)
{

    $action = new actions_class();
    $action->setId($POST["actid"]);
    $action->setTitle(ucfirst($POST["acttitle"]));
    $action->setBody($POST["actbody"]);
    $action->setDuration($POST["actduration"]);
    $action->setValid(isset($_POST['actvalid']) ? 1 : 0);


    if ($action->getId() == '') {
        $sql = "INSERT INTO actions (title, body, duration, valid) VALUES ('" . $action->getTitle() . "','" . $action->getBody() . "','" . $action->getDuration() . "'," . $action->getValid() . ")";
        $result = insert_db($sql);

        if ($result != null) {
            return json_encode(array('string' => "<font color='#3d4449'>Actie toegevoegd!</font>", 'id' => $result, 'redirect' => false));
        } else {
            return json_encode(array('string' => "<font color='red'>Actie niet toegevoegd, DB fout!</font>", 'id' => $result, 'redirect' => false));
        }
    } else {
        $sql = "UPDATE actions SET title='" . $action->getTitle() . "', body='" . $action->getBody() . "', duration='" . $action->getDuration() . "', valid=" . $action->getValid() . " WHERE id=" . $action->getId();
        $result = update_db($sql);

        if ($result === TRUE) {
            return json_encode(array('string' => "<font color='#3d4449'>Actie gewijzigd!</font>", 'id' => '', 'redirect' => false));
        } else {
            return json_encode(array('string' => "<font color='red'>Actie niet gewijzigd, DB fout!</font>", 'id' => '', 'redirect' => false));
        }
    }
}

function deleteAction($id)
{
    $sql = "DELETE FROM actions WHERE id=" . $id;
    $result = delete_db($sql);

    if ($result === TRUE) {
        return json_encode(array('string' => "<font color='#3d4449'>Actie verwijderd!</font>", 'id' => '', 'redirect' => true));
    } else {
        return json_encode(array('string' => "<font color='red'>Actie niet verwijderd, DB fout!</font>", 'id' => '', 'redirect' => false));
    }
}

?>