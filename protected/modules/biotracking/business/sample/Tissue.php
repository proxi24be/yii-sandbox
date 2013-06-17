<?php
/**
 * Created by JetBrains PhpStorm.
 * User: trann
 * Date: 14/01/13
 * Time: 12:03
 * To change this template use File | Settings | File Templates.
 */


namespace application\modules\biotracking\business\sample;

use Addresses, ReturnAddresses;

class Tissue extends SampleAbstract
{

    public function __construct($values, array $materialTypeProperties)
    {
        parent::__construct($values, $materialTypeProperties);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function createSampleInformation()
    {
        $this->createSampleInformationFollowingBasicBusiness();
        $this->saveAddressAndReturnAddress();
    }

    public function updateSampleInformation($userID)
    {
        $this->updateMaterialDetails($userID);
        $this->updateReturnAddress();
    }

    private function updateReturnAddress()
    {
        $values = parent::getValues();
        $materialID = $values["MATERIAL_ID"];
        $returnAddresses = ReturnAddresses::model()->find("MATERIAL_ID=:MATERIALID", array(":MATERIALID" => $materialID));
        if (null == $returnAddresses)
            throw new Exception ("no record found for the MATERIAl_ID : $materialID >>> update aborted");

        $addressID = $returnAddresses->ADDRESS_ID;

        $addresses = new Addresses();
        $addresses->attributes = $values;
        $addresses->updateInformation($addressID);
        return true;
    }

    private function saveAddressAndReturnAddress()
    {
        $address = new Addresses();
        $address->ADDRESS_STREET = trim($this->jsonObject->address->ADDRESS_STREET);
        $address->ADDRESS_CITY = trim($this->jsonObject->address->ADDRESS_CITY);
        if (isset($this->jsonObject->address->ADDRESS_STATE))
            $address->ADDRESS_STATE = trim($this->jsonObject->address->ADDRESS_STATE);
        $address->ADDRESS_POSTCODE = trim($this->jsonObject->address->ADDRESS_POSTCODE);
        $address->COUNTRY_ID = $this->jsonObject->address->COUNTRY_ID;
        if (!$address->save())
            throw new CModelValidationException($address->getErrors(), $address);

        $returnAddresses = new ReturnAddresses();
        $returnAddresses->MATERIAL_ID = $this->materialID;
        $returnAddresses->ADDRESS_ID = $address->ADDRESS_ID;
        if (!$returnAddresses->save())
            throw new CModelValidationException($returnAddresses->getErrors(), $returnAddresses);
    }

}