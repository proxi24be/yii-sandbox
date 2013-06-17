<?php
/**
 * User: TRANN
 * Date: 5/15/13
 * Time: 12:45 PM
 */

class AdmStudy extends AdminActiveRecord {

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'ADM_STUDY';
    }

    public function rules()
    {
        return array(
          array('DESCRIPTION', 'required'),
        );
    }

    public function relations()
    {
        return array(
            'visits' => array(self::MANY_MANY, 'AdmVisit', 'ADM_STUDY_VISIT(STUDY_ID, VISIT_ID)'),
            'samples' => array(self::MANY_MANY, 'AdmSample', 'ADM_VISIT_SAMPLE(STUDY_ID, SAMPLE_ID)'),
        );
    }

}