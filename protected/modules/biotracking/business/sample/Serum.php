<?php
/**
 * Created by JetBrains PhpStorm.
 * User: trann
 * Date: 14/01/13
 * Time: 12:05
 * To change this template use File | Settings | File Templates.
 */

class Serum extends Sample
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
        parent::insertParent($prelevementID, $userID);
        $values = parent::getValues();
        $this->insertChildren($prelevementID, $userID);
    }

    public function updateSampleInformation($userID)
    {
        $this->updateMaterialDetails($userID);
    }


    private function insertChildren($prelevementID, $userID)
    {
        $materials = $this->getMaterials();
        $currentParent = $materials->getMaterialID(); // !! très important de sauver le parent actuel
        $arrayProperties = $this->getArrayProperties();
        $values = $this->getValues();
        $numberOfCryoVials = $values["CRYOVIALS_NUMBER"];
        if ($numberOfCryoVials > 1) {
            for ($i = 0; $i < $numberOfCryoVials; $i++) {
                $materials->getNextMaterialID(); //créer un nv materialID
                $materials->insertParent($currentParent, $prelevementID, $values["MATERIAL_TYPE_ID"]);
                foreach ($arrayProperties as $materialTypeProperty)
                    if ($materialTypeProperty->PROPERTY === 'CRYOVIALS_NUMBER')
                        $this->insertIntoMaterialDetails($materials->getMaterialID(), '1', $materialTypeProperty->PROPERTY_ID);
                    else {
                        if (!empty($values[$materialTypeProperty->PROPERTY]))
                            $this->insertIntoMaterialDetails($materials->getMaterialID(), $values[$materialTypeProperty->PROPERTY], $materialTypeProperty->PROPERTY_ID);
                    }

                parent::insertIfNoteDoesNotExist($userID, $materials->getMaterialID(), $values["comment"]);
                $this->saveCurrentLocation($values["PATIENT_ID"], $materials->getMaterialID(), '2');
            }
        }
    }

    public function createSampleInformation()
    {
        // TODO: Implement createSampleInformation() method.
    }
}
