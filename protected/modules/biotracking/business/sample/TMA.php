<?php
/**
 * Created by JetBrains PhpStorm.
 * User: trann
 * Date: 14/01/13
 * Time: 12:06
 * To change this template use File | Settings | File Templates.
 */

class TMA extends Sample
{

    public function __construct($values, array $materialTypeProperties)
    {
        parent::__construct($values, $materialTypeProperties);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function saveSampleInformation($prelevementID, $userID)
    {
        ;
    }

    public function create($prelevementID, $parentID, $materialTypeID)
    {
        $materialID = $this->getMaterials()->getMaterialID();
        $sql = "INSERT INTO materials (material_id,parent_id,material_type,prelevement_id)
            VALUES ($materialID,$parentID,$materialTypeID,$prelevementID)";
        $this->getEZSQL()->query($sql);
        $arrayProperties = $this->getArrayProperties();
        $values = $this->getValues();

        $materialID = $this->getMaterials()->getMaterialID();
        foreach ($arrayProperties as $materialTypeProperty) {
            $value = empty($values[$materialTypeProperty->PROPERTY]) ? "NA" : $values[$materialTypeProperty->PROPERTY];
            $this->insertIntoMaterialDetails($materialID, $value, $materialTypeProperty->PROPERTY_ID);
        }


        $sql = " INSERT INTO MATERIAL_LOCATION (MATERIAL_ID, LOCATION_ID,LOC_TYPE_ID) VALUES ($materialID,108,2) ";
        $this->getEZSQL()->query($sql);
    }

    public function updateSampleInformation($userID)
    {
        // TODO: Implement updateSampleInformation() method.
    }

    public function createSampleInformation()
    {
        // TODO: Implement createSampleInformation() method.
    }
}