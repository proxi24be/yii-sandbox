<?php

class MyPatient extends Biotracking
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPatient($studyID,$userID)
    {
        if (!isset($studyID) || !isset($userID))
                throw new Exception("getAllPatient: missing parameter");
        
        $sql="select PATIENT_ID, SCREENING_NUMBER , BIRTHDATE from patients  
                join (select centre_id from v_privileges_users where user_id = :USERID AND study_id=:STUDYID) vp 
                    on vp.centre_id = patients.centre_id  
                group by PATIENT_ID, SCREENING_NUMBER, BIRTHDATE order by SCREENING_NUMBER";

        $command=$this->conn->createCommand($sql);
        $command->bindParam(":STUDYID",$studyID,PDO::PARAM_INT);
        $command->bindParam(":USERID",$userID,PDO::PARAM_INT);
        return $command->queryAll();
    }
    
    public function getVisit($patientID)
    {
        $sql="SELECT  MV.VISIT_ID, VISIT_NAME, VISIT_INTERVAL FROM MATERIAL_VISIT MV, PATIENTS 
        JOIN VISITS ON MV.VISIT_ID=VISITS.VISIT_ID  
        WHERE MV.ARM_ID=PATIENTS.ARM_ID AND MV.STUDY_ID=PATIENTS.STUDY_ID AND PATIENT_ID= :PATIENTID
        GROUP BY MV.VISIT_ID, VISIT_NAME, VISIT_INTERVAL  ORDER BY VISIT_INTERVAL";

        $command=$this->conn->createCommand($sql);
        $command->bindParam(":PATIENTID",$patientID,PDO::PARAM_INT);
        $rows= $command->queryAll();
        
        if (count($rows)>0)
            return $rows;
//        affiche seulement la visit screening
        else
        {
            $sql="SELECT  MATERIAL_VISIT.VISIT_ID, VISIT_NAME, VISIT_INTERVAL 
            FROM MATERIAL_VISIT JOIN PATIENTS ON  MATERIAL_VISIT.STUDY_ID=PATIENTS.STUDY_ID 
            JOIN VISITS ON MATERIAL_VISIT.VISIT_ID=VISITS.VISIT_ID  
            WHERE VISIT_NAME='SCREENING' AND PATIENT_ID=:PATIENTID GROUP BY MATERIAL_VISIT.VISIT_ID, VISIT_NAME, VISIT_INTERVAL ORDER BY VISIT_INTERVAL";
            $command=$this->conn->createCommand($sql);
            $command->bindParam(":PATIENTID",$patientID,PDO::PARAM_INT);
            return $command->queryAll();
        }
    }
    
    public function getSampleByVisit($patientID,$visitID)
    {
        $sql="SELECT  MATERIAL_TYPES.MATERIAL_TYPE, MATERIAL_TYPES.DESCRIPTION 
            FROM MATERIAL_VISIT
            JOIN PATIENTS ON MATERIAL_VISIT.ARM_ID=PATIENTS.ARM_ID OR PATIENTS.ARM_ID IS NULL
            AND MATERIAL_VISIT.STUDY_ID=PATIENTS.STUDY_ID
            JOIN VISITS ON MATERIAL_VISIT.VISIT_ID=VISITS.VISIT_ID
            JOIN MATERIAL_TYPES ON MATERIAL_VISIT.MATERIAL_TYPE=MATERIAL_TYPES.MATERIAL_TYPE
            WHERE PATIENT_ID=:PATIENTID AND MATERIAL_VISIT.VISIT_ID=:VISITID GROUP BY MATERIAL_TYPES.MATERIAL_TYPE, MATERIAL_TYPES.DESCRIPTION";
        $command=$this->conn->createCommand($sql);
        $command->bindParam(":PATIENTID",$patientID,PDO::PARAM_INT);
        $command->bindParam(":VISITID",$visitID,PDO::PARAM_INT);
        return $command->queryAll();
    }

}