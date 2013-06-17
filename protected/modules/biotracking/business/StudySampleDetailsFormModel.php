<?php
/**
 * User: TRANN
 * Date: 3/27/13
 * Time: 3:07 PM
 */

namespace application\modules\biotracking\business;

use application\modules\biotracking\business\BrEASTSampleDetailsFormAbstract;
use CMap;

class StudySampleDetailsFormModel extends BrEASTSampleDetailsFormAbstract {

    // blood|serum|plasma.
    public $CRYOVIALS_NUMBER;
    public $TEMPERATURE;
    // aphinity.
    public $SAMPLE_NUMBER;
    public $KIT_NUMBER_ID;

    public $FREEZING_PROCEDURE, $OTHER_FREEZING_PROCEDURE;
    public $COMMENT;
    // blood.
    public $blood_technical;
    // serum.
    public $endTaxanes;

    public $userID;

    public $patientNumber;
    public $birthdate_dd_mmm_yyyy;
    public $birthdate_dd_mm_yyyy;
    public $center;

    public function rules()
    {
        $rules= array(
            array('SAMPLE_NUMBER, COMMENT', 'safe'),
        );

         return CMap::mergeArray(parent::rules(), $rules);
    }

}