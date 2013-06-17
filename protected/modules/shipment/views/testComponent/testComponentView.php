<?php

$criteria=new CDbCriteria;
$criteria->select=array("MATERIAL_ID","SAMPLE_NUMBER","TEMPERATURE");
$activeRecords = VMaterialstoShip::model()->findAll($criteria);

$this->widget("application.components.HtmlTable", array (
    'th'=> array ("sample_id" ,"sample_number","temperature","To request"),
    'data'=> $activeRecords,
    'td'=> array("MATERIAL_ID","SAMPLE_NUMBER","TEMPERATURE"),
    'extraTD' => array("<input type='checkbox'/>")
));


?>