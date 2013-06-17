<?php
/**
 * User: trann
 * Date: 14/01/13
 * Time: 12:00
 */

namespace application\modules\biotracking\business\sample;

use Prelevement, stdClass, CModelValidationException, Materials;
use MyJson, MyMap, MaterialDetails, MaterialNotes, VPatients, MaterialLocation;

/**
 * @internal une amélioration possible de cette classe pourrait être d'étendre la classe CFormModel de Yii
 */
abstract class SampleAbstract
{
    // ces variables sont publiques pour faciliter leur utilisation.
    public $prelevementID;
    public $materialID;
    public $noteID;
    public $jsonObject;

    private $_materialTypeProperties;
    private $_sampleDetailsProperties;
    // Contains property to save.
    private $_values;
    private $_materialTypeID;
    private $_userID;
    private $_studyID;

    /**
     * @param \stdClass $jsonObject
     * @param array $materialTypeProperties : array of active records
     */
    public function __construct(stdClass $jsonObject, array $materialTypeProperties)
    {
        $this->_materialTypeProperties = $materialTypeProperties;
        $this->jsonObject = $jsonObject;
        $this->_sampleDetailsProperties = $this->getSampleDetailsProperties($this->_materialTypeProperties);
        $this->_values =  MyMap::fetchAttributes($this->_sampleDetailsProperties, MyJson::convertToMap($jsonObject));
        $this->_materialTypeID = $this->jsonObject->sampleType->MATERIAL_TYPE;
        $this->_userID = $this->jsonObject->USER_ID;
        $this->_studyID = $this->jsonObject->STUDY_ID;
    }

    public function __destruct()
    {

    }

    public function getMaterialTypeProperties()
    {
        return $this->_materialTypeProperties;
    }

    public function getValues()
    {
        return $this->_values;
    }

    /**
     * @throws CModelValidationException
     * @return mixed ID du nouveau record créer
     */
    protected function createPrelevement()
    {
        $prelevement = new Prelevement();
        $prelevement->VISIT_ID = $this->jsonObject->visit->VISIT_ID;
        $prelevement->PATIENT_ID = $this->jsonObject->patient->PATIENT_ID;
        $collectionDate = $this->jsonObject->patient->ddmmmyyyy;
        $prelevement->COLLECTION_DATE = $collectionDate;
        $prelevement->STUDY_ID = $this->_studyID;
        $prelevement->USER_ENTERED = $this->_userID;
        if (!$prelevement->save())
            throw new CModelValidationException($prelevement->getErrors(), $prelevement);

        $prelevementID = $prelevement->getPrimaryKey();
        unset($prelevement);
        return $prelevementID;
    }

    /**
     * @param $prelevementID
     * @throws CModelValidationException
     * @return mixed ID du nouveau record créer
     */
    protected function createMaterials($prelevementID)
    {
        $materials = new Materials();
        $materials->PRELEVEMENT_ID = (int)$prelevementID;
        $materials->MATERIAL_TYPE = (int)$this->_materialTypeID;
        if (!$materials->save())
            throw new CModelValidationException($materials->getErrors(), $materials);

        $materialID = $materials->MATERIAL_ID;
        unset($materials);
        return $materialID;
    }

    protected function createMaterialDetails($materialID, $values)
    {
        // array of AR
        foreach ($this->_materialTypeProperties as $materialTypeProperty)
        {
            if (isset($values[$materialTypeProperty->PROPERTY]))
            {
                $materialDetails = new MaterialDetails();
                $materialDetails->MATERIAL_ID = $materialID;
                $materialDetails->PROPERTY_ID = $materialTypeProperty->PROPERTY_ID;
                $materialDetails->VALUE = $values[$materialTypeProperty->PROPERTY];
                if (!$materialDetails->save())
                    throw new CModelValidationException($materialDetails->getErrors(), $materialDetails);

                unset($materialDetails);
            }
        }
    }

    protected function createMaterialLocation($materialID, $locationID, $locTypeID)
    {
        $materialLocation = new MaterialLocation();
        $materialLocation->MATERIAL_ID = $materialID;
        $materialLocation->LOC_TYPE_ID = $locTypeID;
        $materialLocation->LOCATION_ID = $locationID;
        if (!$materialLocation->save())
            throw new CModelValidationException($materialLocation->getErrors(), $materialLocation);
    }

    /**
     * @param $materialID
     * @param $note
     * @param $userID
     * @throws CModelValidationException
     * @return mixed ID du nouveaux records creer
     */
    protected function createMaterialNote($materialID, $note, $userID)
    {
        if (!empty($note)) {
            $materialNote = new MaterialNotes();
            $materialNote->MATERIAL_ID = $materialID;
            $materialNote->MATERIAL_NOTE = $note;
            $materialNote->USER_ID = $userID;
            if (!$materialNote->save())
                throw new CModelValidationException($materialNote->getErrors(), $materialNote);

            $noteID = $materialNote->getPrimaryKey();
            unset($materialNote);
            return $noteID;
        }
    }

    protected function updateMaterialDetails($userID)
    {
        $this->setUserID($userID);
        $this->materialDetails->update($this->values, $this->_materialTypeProperties);
    }

    protected function createSampleInformationFollowingBasicBusiness()
    {
        $this->prelevementID = $this->createPrelevement();

        $this->materialID = $this->createMaterials($this->prelevementID);

        $this->createMaterialDetails($this->materialID, $this->_values);

        $locationID = $this->getCurrentLocationID($this->jsonObject->patient->PATIENT_ID);

        $this->createMaterialLocation($this->materialID, $locationID, 1);

        $this->createMaterialNote($this->materialID, $this->jsonObject->COMMENT, $this->jsonObject->USER_ID);
    }

    private function getCurrentLocationID($patientID)
    {
        $vpatients = VPatients::model()->findByAttributes(array('PATIENT_ID' => $patientID));
        if (null == $vpatients)
            throw new Exception("Unknown patientID : $patientID");
        else
            return $vpatients->CENTRE_ID;
    }

    private function getSampleDetailsProperties(array $materialTypeProperties)
    {
        $properties = array();
        foreach ($materialTypeProperties as $materialProperty)
            $properties[] = $materialProperty->PROPERTY;
        return $properties;
    }

    public abstract function createSampleInformation();
    public abstract function updateSampleInformation($userID);

}
