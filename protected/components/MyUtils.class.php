<?php
class MyUtils 
{
	
    public function addEmpty ($array)
    {
            $myArray= array();
            $myArray[""]="";
            foreach ($array as $key => $value)
                    $myArray[$key] = $value;

            return $myArray;
    }

    public function generateTagElems ($tag,$data,$closeTag=true)
    {
        $valueToReturn = array();
        foreach($data as $value=>$name)
                    $valueToReturn[] = CHtml::tag($tag,array('value'=>$value),CHtml::encode($name),$closeTag);    

        return $valueToReturn;
    }

    public function displayTags ( $tags)
    {
        foreach ($tags as $tag)         
            echo $tag;
    }

    public function filterTrueCriteria ($array)
    {
        $valueToReturn = array();
        foreach ($array as $key =>$value)
            if (! ($value=='empty'))
                $valueToReturn[$key] = $value;

        return $valueToReturn;
    }

    public function addConditions (CDbCriteria &$criteria, $post)
    {
        $filtered = MyUtils::filterTrueCriteria($post);
        $condition_params = MyUtils::getConditionAndParams($filtered);
        ob_start();
        print_r($condition_params);
        Yii::log(ob_get_contents());
        ob_end_clean();
        
        $criteria->condition=$condition_params["condition"];
        $criteria->params=$condition_params["params"];
    }


    public function getDataForSelectFromModel(CActiveRecord $model, $condition,$params,$data)
    {
        $values = $model->findAll($condition,$params);
        $data = CHtml::listData($values,$data[0],$data[1]);
        return $data;
    }

    public function countError (array $matriceErrors)
    {
        $count=0;
        foreach ($matriceErrors as $error)
                $count+= count($error);
        
        return $count;
    }

    private function getConditionAndParams($conditions)
    {
        $valueToReturn["condition"]="";
        $valueToReturn["params"]=array();
        foreach ($conditions as $key => $value )
            {
                $valueToReturn["condition"] = "$key=:$key and ".$valueToReturn["condition"];
                $valueToReturn["params"][":$key"] = is_numeric($value) ? (int)$value :$value;
            }    
        
        $valueToReturn["condition"]= substr($valueToReturn["condition"], 0,-4);
        return $valueToReturn;
    }
    
    
    public static function transformToQuery (array $arrays)
    {
        $valueToReturn ="" ;
                foreach ($arrays as $val)
                        $valueToReturn = $valueToReturn . "'$val',";

        $valueToReturn = substr($valueToReturn,0,-1);

        return "($valueToReturn)";

    }
    
    public static function groupArrayByKey($key, array $data)
    {
        $valueToReturn=array();
        if (count($data)>0)
        {
            foreach ($data as $row)
                $valueToReturn[$row[$key]][]=$row;
        }
        return $valueToReturn;
    }

}



?>