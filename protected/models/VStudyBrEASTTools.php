<?php

class VStudyBrEASTTools extends CActiveRecord
{
        private $objsbt;
        private $toCompare;
    
        /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return VCentreAddressPI the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'V_STUDY_BREAST_TOOLS';
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
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function getGroupRole ($roleStudyID)
        {
            $this->objsbt= VStudyBrEASTTools::model()->findAllByAttributes(array("ROLE_STUDY_ID"=>(int)$roleStudyID));
            $this->toCompare=$roleStudyID;
            
            if ($this->isInArray($this->getScBreast()))
                            return "SC";
            else if ($this->isInArray($this->getInvBreast()))
                            return "INV";
            else if ($this->isInArray($this->getCraBreast()))
                            return "CRA";
            else if ($this->isInArray($this->getCsmBreast()))
                            return "CRC";
            else 
                            return "OTH";
        }
        
        private function getFollowingRoleBreast(array $array)
        {
            $rows = array();
            foreach ($this->objsbt as $row) 
                if (in_array($row["ROLE_BREAST_ID"],$array)) 
                    $rows[] = $row;
            return $rows;
        }
        
       /**
        return array [object]
        */
        private function getCraBreast()
        {
            $cra = array(8,9);
            return $this->getFollowingRoleBreast($cra);
        }

        /**
        return array [object]
        */
        private function getInvBreast()
        {
            $inv= array(1,2);
            return $this->getFollowingRoleBreast($inv);
        }

        /**
        return array [object]
        */
        private function getScBreast()
        {
            $sc=array(3,4,17);
            return $this->getFollowingRoleBreast($sc);
        }

        private function getCsmBreast()
        {
            $csm=array(12);
            return $this->getFollowingRoleBreast($csm);
        }

        private function isInArray(array $rows)
        {
            $found = false;	
            foreach ($rows as $row)
                foreach ($row as $key => $value)
                    if ($key=='ROLE_STUDY_ID' && $value == $this->toCompare)
                        $found=true;
                    
            return $found;
        }
}

?>