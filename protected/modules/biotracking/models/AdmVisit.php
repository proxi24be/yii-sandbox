<?php
/**
 * User: TRANN
 * Date: 6/6/13
 * Time: 2:53 PM
 */

class AdmVisit extends MyBiotrackingActiveRecord {

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
        return 'ADM_VISIT';
    }

    public function relations()
    {
        return array(
          'study' => array(self::MANY_MANY, 'AdmStudy', 'ADM_STUDY_VISIT(VISIT_ID, STUDY_ID)'),
          'samples' => array(self::MANY_MANY, 'AdmSample', 'ADM_VISIT_SAMPLE(VISIT_ID, SAMPLE_ID)'),
        );
    }

    public static function showFreeVisit($studyID)
    {
        if ( !isset ($studyID))
            throw new Exception('missing parameter studyID');

        $conn = Yii::app()->dbBiotracking;
        $sql = 'SELECT AV.ID, AV.VISIT_NAME, AV.VISIT_INTERVAL
                FROM ADM_VISIT AV LEFT JOIN
                (SELECT VISIT_ID FROM ADM_STUDY_VISIT WHERE STUDY_ID = :studyID) ASV
                ON AV.ID = ASV.VISIT_ID
                  WHERE ASV.VISIT_ID IS NULL
                  GROUP BY AV.ID, AV.VISIT_NAME, AV.VISIT_INTERVAL';
        $command = $conn->createCommand($sql);
        $command->bindParam(":studyID", $studyID, PDO::PARAM_INT);
        return $command->queryAll();
    }

}