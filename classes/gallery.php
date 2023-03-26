<?php

require_once('config.php');


class Gallery extends Config
{
    private $id;
    private $altText;
    private $imagepath;

    //insert users into database

    public function __construct($id = 0,  $altText = '', $imagepath = '')
    {
        $this->id = $id;
        $this->altText = $altText;
        $this->imagepath = $imagepath;
    }


    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setAltText($altText)
    {
        $this->altText = $altText;
    }
    public function getAltText()
    {
        return $this->altText;
    }
    public function setImagePath($imagepath)
    {
        $this->imagepath = $imagepath;
    }
    public function getImagePath()
    {
        return $this->imagepath;
    }
    public function insertData()
    {
        try {
            $sql = "INSERT INTO gallery(alt_text, image_path) VALUES(?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$this->altText, $this->imagepath]);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function fetchAll()
    {
        try {
            $sql = "SELECT * FROM gallery ORDER BY id DESC ";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function fetchOne()
    {
        $sql = "SELECT * FROM gallery WHERE id = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$this->id]);
        return $stmt->fetchAll();
    }

    public function update()
    {
        try {
            $sql = "UPDATE gallery SET image_path = ?, alt_text = ? WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$this->imagepath, $this->altText, $this->id]);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete()
    {
        try {
            $sql = "DELETE FROM gallery WHERE id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$this->id]);
            $stmt->fetchAll();
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
