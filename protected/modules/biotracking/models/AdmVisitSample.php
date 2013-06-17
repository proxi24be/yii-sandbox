<?php
/**
 * User: TRANN
 * Date: 6/10/13
 * Time: 1:14 PM
 */

Yii::import('application.models.*');
require_once('AdminActiveRecord.php');

class AdmVisitSample extends AdminActiveRecord {

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
        return 'ADM_VISIT_SAMPLE';
    }

    public function rules ()
    {
        return array(
            array('STUDY_ID, VISIT_ID, SAMPLE_ID', 'required'),
        );
    }

    public static function read($studyID, $visitID = null)
    {
        $visitCondition = ' 1 = 1 ';

        if ( !isset ($studyID))
            throw new Exception('missing parameter studyID');

        if (isset ($visitID))
            $visitCondition = ' VISIT_ID = :visitID ';

        $conn = Yii::app()->dbBiotracking;
        $sql = "select STUDY_ID,  study.DESCRIPTION as STUDY_NAME, VISIT_ID, av.VISIT_NAME,
                SAMPLE_ID, sample.DESCRIPTION AS SAMPLE_TYPE
                from ADM_VISIT_SAMPLE  ads
                join ADM_VISIT av on ads.VISIT_ID = av.ID
                JOIN ADM_SAMPLE sample on  ads.SAMPLE_ID = sample.ID
                JOIN ADM_STUDY study on study.ID = ads.STUDY_ID
                where STUDY_ID = :studyID and $visitCondition
                group by STUDY_ID,  study.DESCRIPTION, VISIT_ID, av.VISIT_NAME, SAMPLE_ID, sample.DESCRIPTION
                ORDER BY STUDY.DESCRIPTION , VISIT_NAME , sample.DESCRIPTION";

        $command = $conn->createCommand($sql);
        $command->bindParam(":studyID", $studyID, PDO::PARAM_INT);
        if (isset($visitID))
            $command->bindParam(":visitID", $visitID, PDO::PARAM_INT);

        return $command->queryAll();
    }

}