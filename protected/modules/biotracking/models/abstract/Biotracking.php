<?php

abstract class Biotracking

{
    public $schemaLab;
    public $conn;

    public function __construct()
    {
        if ("prod" == strtolower(Yii::app()->params['environment']))
            $this->schemLab = "lab2";
        else
            $this->schemaLab = "lab_dev2";

        $this->conn = Yii::app()->dbBiotracking;
    }

    public function __destruct()
    {

    }

    public function getSchemaLab()
    {
        return $this->schemaLab;
    }

}



