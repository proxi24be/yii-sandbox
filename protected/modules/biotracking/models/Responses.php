<?php

class Responses extends MyBiotrackingActiveRecord
{
	private $compatibilityMode;
	// public $USER_ENTERED;
	// public $RESPONSE_ID;
	// public $SEQ_NUM;
	// public $FORM_ID;
	// public $MATERIAL_ID;
	// public $VALUE;
	// public $QUESTION_ID;
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
		return 'RESPONSES';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('USER_ENTERED, RESPONSE_ID, SEQ_NUM, FORM_ID, MATERIAL_ID, QUESTION_ID','required')
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
        
        public function insertResults($userID, array $fields, array $attributes)
        {
            foreach($fields as $value => $questionID)
            {
                $responses=new Responses ();
                $responses->USER_ENTERED= $userID;
                $responses->ENTERED_DATE= new CDbExpression("SYSDATE");
                $responses->RESPONSE_ID=new CDbExpression("RESPONSES_SEQ.nextval");
                $responses->SEQ_NUM=0;
                $responses->FORM_ID=$attributes['formID'];
                $responses->MATERIAL_ID=$attributes['sampleID'];
                $newValue=trim($attributes["$value"]);
                $responses->VALUE= $this->convertToNumeric($newValue);
                $responses->QUESTION_ID=(int)$questionID;
                if (!$responses->save())
                {
                    ob_start();
                    print_r($responses->getErrors());
                    $errors = ob_get_contents();
                    ob_end_clean();
                    Yii::log($errors);
                    throw new Exception("AphinityLocalForm::save(): missing parameters");
                }
                    
            }
        }
        
        public function updateResults($userID, array $fields, array $attributes,$compatibilityMode=array())
        {
            $this->compatibilityMode=$compatibilityMode;
            foreach($fields as $value => $questionID)
            {
                $response=Responses::model()->findByAttributes(array("MATERIAL_ID"=>(int)$attributes["sampleID"],"FORM_ID"=>(int)$attributes["formID"],"QUESTION_ID"=>(int)$questionID));
                if ($response != null)
                {
                    $newResponse= $this->transformNewValueToOldValue($questionID, $attributes["$value"]);
                    $newReponse=trim($newResponse);
                    if ($newResponse != $response->VALUE)
                    {
                        $response->VALUE= $this->convertToNumeric($newResponse);
                        $response->MODIFICATION_USER=$userID;
                        $response->MODIFICATION_DATE= new CDbExpression("SYSDATE");
                        if (!$response->save())
                            throw new Exception("AphinityLocalForm::save(): missing parameters");
                    }
                }
                else
                    throw new Exception ("AphinityLocalForm::update row to update not found");
            }
        }
        
        private function transformNewValueToOldValue ($questionID,$response)
        {
            if (count($this->compatibilityMode)>0)
            if (key_exists($questionID,$this->compatibilityMode ))
            {
                $values = $this->compatibilityMode[$questionID];
                if (key_exists($response,$values))
                {
                    $oldToNew = $values[$response];
                    return $oldToNew;
                }
            }
            return $response;
        }
        
        
        private function convertToNumeric($value)
        {
            if ((int) intval($value) !== 0 )
                return intval($value);
            else if ((int)floatval($value)!==0)
                return floatval($value);
            else 
                return $value;
        }
}