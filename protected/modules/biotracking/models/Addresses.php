<?php
/**
 * User: trann
 * Date: 16/01/13
 * Time: 11:53
 */

class Addresses extends MyBiotrackingActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ParcelDetails the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getDbConnection()
    {
        return self::getBiotrackingDbConnection();
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ADDRESSES';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
             array ("ADDRESS_STREET, ADDRESS_CITY, ADDRESS_POSTCODE, ADDRESS_STATE, COUNTRY_ID","safe")
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     *  Pour utiliser cette méthode correctement il faut que les paramètres càd les nouvelles valeurs qu'on désire insérer
     *  soit 'bindé' avec l'objet courant.
     *  Pour ce faire on peut simplement utiliser la propriété public attributes du model (binding data)
     *
     * @param $addressID
     * @return mixed le nombre de row affecté par la query (dans ce cas ci il ne devrait retourner qu'un 1 ou 0)
     */
    public function updateInformation($addressID)
    {
        $connection=$this->getDbConnection();
        $sql="UPDATE ADDRESSES SET ADDRESS_STREET='$this->ADDRESS_STREET', ADDRESS_CITY='$this->ADDRESS_CITY',
                ADDRESS_STATE='$this->ADDRESS_STATE', ADDRESS_POSTCODE='$this->ADDRESS_POSTCODE', COUNTRY_ID=$this->COUNTRY_ID
                WHERE ADDRESS_ID=:ADDRESS_ID
                AND ( nvl(ADDRESS_STREET,'null') <> :ADDRESS_STREET OR nvl(ADDRESS_CITY,'null')<> :ADDRESS_CITY OR
                nvl(ADDRESS_STATE,'null')<> :ADDRESS_STATE OR nvl(ADDRESS_POSTCODE,'null')<> :ADDRESS_POSTCODE OR
                nvl(COUNTRY_ID,0)<> :COUNTRY_ID)";

        $command=$connection->createCommand($sql);
        $command->bindParam(":ADDRESS_STREET",$this->ADDRESS_STREET,PDO::PARAM_STR);
        $command->bindParam(":ADDRESS_CITY",$this->ADDRESS_CITY,PDO::PARAM_STR);
        $command->bindParam(":ADDRESS_POSTCODE",$this->ADDRESS_POSTCODE,PDO::PARAM_STR);
        $command->bindParam(":ADDRESS_STATE",$this->ADDRESS_STATE,PDO::PARAM_STR);
        $command->bindParam(":COUNTRY_ID",$this->COUNTRY_ID,PDO::PARAM_INT);
        $command->bindParam(":ADDRESS_ID",$addressID,PDO::PARAM_INT);
        return $command->execute();
    }
}