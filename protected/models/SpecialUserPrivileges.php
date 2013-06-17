<?php

class SpecialUserPrivileges extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
            return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
            return 'SPECIAL_USER_PRIVILEGES';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array("STUDY, STUDY_ID, CLINICAL_STUDY_ID, USER_ID, USERNAME, FIRSTNAME, LASTNAME, EMAIL, CENTRE_ID, CENTRE, 
                ROLE_STUDY_ID, ROLE_SPONSOR_NAME","required")
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

    public static function insertNewPrivilege($POST)
    {
        $count=count($_POST["CENTRE_ID"]);
        $ok=true;
        for($i=0;$i<$count;$i++)
        {
            $specialUserPrivileges=new SpecialUserPrivileges;
            $specialUserPrivileges->USER_ID=(int)$_POST["USER_ID"];
            $specialUserPrivileges->USERNAME=$_POST["USERNAME"];
            $specialUserPrivileges->FIRSTNAME=$_POST["FIRSTNAME"];
            $specialUserPrivileges->LASTNAME=$_POST["LASTNAME"];
            $specialUserPrivileges->EMAIL=$_POST["EMAIL"];
            $specialUserPrivileges->ROLE_SPONSOR_NAME=$_POST["ROLE_SPONSOR_NAME"];
            $specialUserPrivileges->ROLE_STUDY_ID=(int)$_POST["ROLE_STUDY_ID"];
            $specialUserPrivileges->CLINICAL_STUDY_ID=(int)$_POST["CLINICAL_STUDY_ID"];
            $specialUserPrivileges->STUDY=$_POST["STUDY"][$i];
            $specialUserPrivileges->STUDY_ID=(int)$_POST["STUDY_ID"][$i];
            $specialUserPrivileges->CENTRE_ID=(int)$_POST["CENTRE_ID"][$i];
            $specialUserPrivileges->CENTRE=$_POST["CENTRE"][$i];
            if (!$specialUserPrivileges->save())
                    $ok=false;
        }
        return $ok;
    }

}

?>
