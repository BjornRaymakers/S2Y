<?php

class article
{
    public $id = "0";
    public $reg_date = "";
    public $name = "";
    public $price1 = "";
    public $price2 = "";
    public $price1_comment = "";
    public $price2_comment = "";
    public $gender = "";
    public $bold = "";
    public $position = "";
    public $reduction = "";


    function setId($id)
    {
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function setReg_date($reg_date)
    {
        $this->reg_date = $reg_date;
    }

    function getReg_date()
    {
        return $this->reg_date;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function getName()
    {
        return $this->name;
    }

    function setPrice1($price1)
    {
        $this->price1 = $price1;
    }

    function getPrice1()
    {
        return $this->price1;
    }

    function setPrice2($price2)
    {
        $this->price2 = $price2;
    }

    function getPrice2()
    {
        return $this->price2;
    }

    function setPrice1_comment($price1_comment)
    {
        $this->price1_comment = $price1_comment;
    }

    function getPrice1_comment()
    {
        return $this->price1_comment;
    }

    function setPrice2_comment($price2_comment)
    {
        $this->price2_comment = $price2_comment;
    }

    function getPrice2_comment()
    {
        return $this->price2_comment;
    }

    function setGender($gender)
    {
        $this->gender = $gender;
    }

    function getGender()
    {
        return $this->gender;
    }

    function setBold($bold)
    {
        $this->bold = $bold;
    }

    function getBold()
    {
        return $this->bold;
    }

    function setPosition($position)
    {
        $this->position = $position;
    }

    function getPosition()
    {
        return $this->position;
    }

    function setReduction($reduction)
    {
        $this->reduction = $reduction;
    }

    function getReduction()
    {
        return $this->reduction;
    }

    function __construct()
    {
        $this->id = null;
        $this->article = "";
        $this->gender = "";
    }

}

function createArticleOfRow($row)
{
    $art = new article;

    $art->setId($row["id"]);
    $art->setReg_date($row["reg_date"]);
    $art->setName($row["article"]);
    $art->setPrice1($row["price1"]);
    $art->setPrice2($row["price2"]);
    $art->setPrice1_comment($row["price1_comment"]);
    $art->setPrice2_comment($row["price2_comment"]);
    $art->setGender($row["gender"]);
    $art->setBold($row["bold"]);
    $art->setPosition($row["position"]);
    $art->setReduction($row["reduction"]);
    return $art;
}

function getArticleByID($artid)
{
    $article = new article;

    if ($artid != "") {
        $sql = "SELECT * FROM pricelist WHERE id=" . $artid;
        $resultart = select_db($sql);


        if ($resultart->num_rows == 1) {
            while ($row = $resultart->fetch_assoc()) {
                $article = createArticleOfRow($row);
            }

        }
    }
    return $article;
}

function getArticles()
{
    $sql = "SELECT * FROM pricelist ORDER BY gender,position asc";
    $result = select_db($sql);

    $article_array = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $article = createArticleOfRow($row);
            array_push($article_array, $article);
        }
    }
    return $article_array;
}

function getArticlesByGender($gender)
{
    $sql = "SELECT * FROM pricelist WHERE gender='" . $gender . "' order by position";
    $result = select_db($sql);

    $article_array = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $article = createArticleOfRow($row);
            array_push($article_array, $article);
        }
    }
    return $article_array;
}

function deleteArticle($id)
{
    $sql = "DELETE FROM pricelist WHERE id=" . $id;
    $result = delete_db($sql);

    if ($result === TRUE) {
        return json_encode(array('string' => "<font color='#3d4449'>Artikel verwijderd!</font>", 'id' => '', 'redirect' => true));
    } else {
        return json_encode(array('string' => "<font color='red'>Artikel niet verwijderd, DB fout!</font>", 'id' => '', 'redirect' => false));
    }
}

function saveArticle($POST)
{
    $article = new article_class();
    $article->setName(ucfirst($POST["article"]));
    $article->setId($POST["priceid"]);
    $article->setPrice1($POST["price1"]);
    $article->setPrice2($POST["price2"]);
    $article->setPrice1_comment(ucfirst($POST["price1_comment"]));
    $article->setPrice2_comment(ucfirst($POST["price2_comment"]));
    $article->setGender($POST["gender"]);
    $article->setBold($POST["boldy"]);
    $article->setPosition($POST["position"]);
    $article->setReduction($POST["reduction"]);

    if ($article->getId() == '') {
        $sql = "INSERT INTO pricelist (article,price1,price2,price1_comment,price2_comment,gender,bold,position,reduction) VALUES ('" . $article->getName() . "','" . $article->getPrice1() . "','" . $article->getPrice2() . "','" . $article->getPrice1_comment() . "','" . $article->getPrice2_comment() . "','" . $article->getGender() . "','" . $article->getBold() . "','" . $article->getPosition() . "','" . $article->getReduction() . "')";
        $result = insert_db($sql);

        if ($result != null) {
            return json_encode(array('string' => "<font color='#3d4449'>Artikel toegevoegd!</font>", 'id' => $result, 'redirect' => false));
        } else {
            return json_encode(array('string' => "<font color='red'>Artikel niet toegevoegd, DB fout!</font>", 'id' => $result, 'redirect' => false));
        }
    } else {
        $sql = "UPDATE pricelist SET article='" . $article->getName() . "', price1='" . $article->getPrice1() . "', price2='" . $article->getPrice2() . "', price1_comment='" . $article->getPrice1_comment() . "', price2_comment='" . $article->getPrice2_comment() . "', gender='" . $article->getGender() . "', bold='" . $article->getBold() . "', position='" . $article->getPosition() . "', reduction='" . $article->getReduction() . "' WHERE id=" . $article->getId();
        $result = update_db($sql);

        if ($result === TRUE) {
            return json_encode(array('string' => "<font color='#3d4449'>Artikel gewijzigd!</font>", 'id' => '', 'redirect' => false));
        } else {
            return json_encode(array('string' => "<font color='red'>Artikel niet gewijzigd, DB fout!</font>", 'id' => '', 'redirect' => false));
        }
    }
}

?>