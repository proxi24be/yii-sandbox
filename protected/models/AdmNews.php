<?php

/**
 * Created by JetBrains PhpStorm.
 * User: bluenight
 * Date: 20/01/13
 * Time: 18:11
 */
class News extends MySqliteActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function getDbConnection()
    {
        return self::getSqliteDbConnection();
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'NEWS';
    }

    public function scopes()
    {
        return array(
            'desc'=>array(
                "order"=>"LAST_UPDATED DESC"
            ),

        );
    }

    public function recently($limit=3)
    {
        if (is_numeric($limit))
            $this->getDbCriteria()->mergeWith(
                array(
                    "limit"=>$limit
                )
            );

        return $this;
    }

}

