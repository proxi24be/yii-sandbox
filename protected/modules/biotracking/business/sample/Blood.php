<?php
/**
 * Created by JetBrains PhpStorm.
 * User: trann
 * Date: 14/01/13
 * Time: 12:05
 * To change this template use File | Settings | File Templates.
 */

   class Blood extends Sample {
       public function __construct($values, array $materialTypeProperties){
           parent::__construct($values, $materialTypeProperties);
       }

       public function __destruct (){
           parent::__destruct();
       }

       public function updateSampleInformation($userID)
       {
           $this->updateMaterialDetails($userID);
       }

       public function saveSampleInformation($prelevementID,$userID){
           parent::insertParent($prelevementID, $userID);
       }

       public function createSampleInformation()
       {
           // TODO: Implement createSampleInformation() method.
       }
   }
