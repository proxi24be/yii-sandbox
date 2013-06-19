<?php
/**
 * User: TRANN
 * Date: 6/19/13
 * Time: 2:50 PM
 */

use \application\components\helper as helper;

Yii::import('application.modules.biotracking.models.*');

class RelationBehaviorTest extends CDbTestCase {

    public $instance ;

    public function setUp()
    {
        $this->instance = helper\AdmCRUDSimpleFactory::getInstance('AdmForm');
    }

    public function tearDown()
    {
        
    }

    public function testCreationRelationParameter()
    {
        $data = array('SHORT_DESCRIPTION' => 'new_form_' . time(), 'STUDY_ID' => 1);
        $this->instance->attributes = $data;
        $this->assertTrue($this->instance->save());
    }
}