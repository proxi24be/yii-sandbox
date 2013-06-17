<?php


/* The followings are the available columns in table 'ADDRESSES':
 * @property integer $ADDRESS_ID
 * @property string $ADDRESS_STREET
 * @property string $ADDRESS_POSTCODE
 * @property string $ADDRESS_STATE
 * @property integer $COUNTRY_ID
 * @property string $ADDRESS_CITY
 * @property string $CENTRE
 * @property string $STUDY
 * @property string $CENTRE_NAME
 * @property string $COUNTRY
 * @property integer $CENTRE_ID
 */

class VTransportCentres extends MyShipmentActiveRecord {
    
        
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Addresses the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getDbConnection()
    {
        return self::getShipmentDbConnection();
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'V_TRANSPORT_CENTRES';
    }

    // public function relations()
    // {
    //     return array(
    //         'shipCentre'=>array(self::HAS_MANY, 'VMaterialsToShip', 'CENTRE_ID'),
    //     );
    // }

}


?>