<?php
/**
 * User: TRANN
 * Date: 4/1/13
 * Time: 11:22 AM
 */

Yii::import('application.modules.biotracking.models.*');

class PrelevementTest extends CDbTestCase {

    public $fixtures = array(
        'prelevement' => 'Prelevement',
    );

    public function testInstance()
    {
        $prelevement = $this->prelevement('screening_1');
        $prelevement->USER_ENTERED = 90;
        $this->assertTrue($prelevement->save());

        $prelevement = Prelevement::model()->findByPk(1);

        $unix_timestamp = strtotime($prelevement->COLLECTION_DATE);
        $this->assertTrue (is_numeric($unix_timestamp));
        $this->assertEquals($unix_timestamp, strtotime(date('d-m-Y')));
    }
}