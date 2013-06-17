<?php

class UserHttpInfo extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UserRegistration the static model class
     */
    public $CLEAR_PASSWORD;

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'USER_HTTP_INFO';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(

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
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {

    }

    public function createNewEntry($userID)
    {
        $this->IP=$_SERVER["REMOTE_ADDR"];
        $this->USER_AGENT=$_SERVER["HTTP_USER_AGENT"];
        $this->USER_ID=$userID;
        $this->DATE_CONNECTION= new CDbExpression("SYSDATE");
        // for oracle database use trigger to simulate autoincrement field
        // $this->ID=new CDbExpression("SEQ_USER_HTTP_INFO.nextval");
        $this->save();
    }

}

?>