<?php

class MySample 
{
    public function getMySamples($studyID,$userID, $additionalCondition='')
    {
        if (!empty($additionalCondition))
            $additionalCondition= "AND $additionalCondition";
        
        $conn = Yii::app()->dbBiotracking;
        $sql="SELECT MAT.MATERIAL_ID , LOCAL_ID, PRE.PATIENT_ID,SCREENING_NUMBER,BIRTHDATE,PRE.COLLECTION_DATE,MT.DESCRIPTION MATERIAL_TYPE,
            VISIT_NAME, VISIT_INTERVAL,LOCATION,SAMPLE_NUMBER  FROM MATERIALS MAT JOIN PRELEVEMENT PRE ON MAT.PRELEVEMENT_ID=PRE.PRELEVEMENT_ID 
           JOIN PATIENTS P ON PRE.PATIENT_ID = P.PATIENT_ID 
           JOIN  VISITS V  ON V.VISIT_ID = PRE.VISIT_ID
           JOIN (SELECT material_id,                          
                  MAX (DECODE (property_id, 11, VALUE, NULL)) sample_number,
                  MAX (DECODE (property_id, 7, VALUE, NULL)) local_id,
                  MAX (DECODE (property_id, 8, VALUE, NULL)) material_state           
                  FROM material_details   GROUP BY material_id

           ) ATTR  ON ATTR.MATERIAL_ID= MAT.MATERIAL_ID

           JOIN MATERIAL_TYPES MT ON MT.MATERIAL_TYPE= MAT.MATERIAL_TYPE
           LEFT JOIN V_MATERIAL_LOCATION_MAX MLM ON MAT.MATERIAL_ID= MLM.MATERIAL_ID  
           JOIN (SELECT DISTINCT CENTRE_ID FROM V_PRIVILEGES_USERS WHERE USER_ID =:USERID) CENTRE ON P.CENTRE_ID= CENTRE.CENTRE_ID
           LEFT JOIN (SELECT MATERIAL_ID FROM V_MATERIAL_PARENT) PARENT ON MAT.MATERIAL_ID = PARENT.MATERIAL_ID
           WHERE PRE.STUDY_ID = :STUDYID  AND MAT.MATERIAL_TYPE NOT IN (58,59,60) AND (PARENT.MATERIAL_ID IS NULL OR MAT.MATERIAL_TYPE=54) 
             $additionalCondition
           GROUP BY MAT.MATERIAL_ID, LOCAL_ID, PRE.PATIENT_ID,SCREENING_NUMBER,BIRTHDATE,PRE.COLLECTION_DATE,MT.DESCRIPTION,VISIT_NAME, 
                    VISIT_INTERVAL,LOCATION,SAMPLE_NUMBER";
        $command=$conn->createCommand($sql);
        $command->bindParam(":USERID",$userID,PDO::PARAM_INT);
        $command->bindParam(":STUDYID",$studyID,PDO::PARAM_INT);
        return $command->queryAll();
    }
    
    public function getMyVisits($studyID,$userID)
    {
        $sql= "select visit_name, visit_interval from prelevement pre 
            join v_patients vp on vp.patient_id = pre.patient_id 
            join (SELECT DISTINCT CENTRE_ID FROM V_PRIVILEGES_USERS WHERE USER_ID = :USERID AND STUDY_ID=:STUDYID) priv on priv.centre_id=vp.centre_id 
            JOIN  VISITS V  ON V.VISIT_ID = PRE.VISIT_ID 
            GROUP BY visit_name, visit_interval ORDER BY VISIT_INTERVAL";
        $conn = Yii::app()->dbBiotracking;
        $command=$conn->createCommand($sql);
        // replace the placeholder ":username" with the actual username value
        $command->bindParam(":USERID",$userID,PDO::PARAM_INT);
        // replace the placeholder ":email" with the actual email value
        $command->bindParam(":STUDYID",$studyID,PDO::PARAM_INT);
        return $command->queryAll();
    }
    
    public function getSampleCompletedFormTissue($studyID,$userID)
    {
        $sql =" SELECT RESPONSE.MATERIAL_ID, CENTRE_DESCRIPTION, SCREENING_NUMBER, BIRTHDATE,MATERIAL_TYPE,DATE_PICKUP, 
                decode(RESPONSE.CL_RECEPTION_DATE,null,'NOT YET RECEIVED',RESPONSE.CL_RECEPTION_DATE) CL_RECEPTION_DATE, 
                decode(upper(part1.SAMPLE_EVALUABLE), null, 'NOT YET AVAILABLE','YES', upper(PART1.HER2_ELIGIBLE),'NO', 'NOT EVALUABLE') HER2_ELIGIBLE,
                part1.sample_evaluable, RESPONSE.MATERIAL_ID LOCAL_RESULT,
                decode(upper(PART1.MATERIAL_ID),null,'NOT YET AVAILABLE',upper(PART1.MATERIAL_ID)) PART1_MATERIAL_ID, 
                decode(upper(PART2.MATERIAL_ID),null,'NOT YET AVAILABLE',upper(PART2.MATERIAL_ID)) PART2_MATERIAL_ID 
                FROM V_MATERIAL_WITH_RESPONSES RESPONSE 
                JOIN (SELECT CENTRE FROM V_PRIVILEGES_USERS WHERE USER_ID = :USERID AND STUDY_ID=:STUDYID) up ON UP.CENTRE=CENTRE_DESCRIPTION
                LEFT JOIN (SELECT MATERIAL_ID,HER2_ELIGIBLE, SAMPLE_EVALUABLE FROM V_CENTRAL_RESULT_PART1 ) PART1 ON PART1.MATERIAL_ID = RESPONSE.MATERIAL_ID 
                LEFT JOIN (SELECT MATERIAL_ID FROM V_CENTRAL_RESULT_PART2 ) PART2 ON PART2.MATERIAL_ID = RESPONSE.MATERIAL_ID
                GROUP BY RESPONSE.MATERIAL_ID, CENTRE_DESCRIPTION, SCREENING_NUMBER, 
                BIRTHDATE,MATERIAL_TYPE,DATE_PICKUP,CL_RECEPTION_DATE, PART1.HER2_ELIGIBLE, PART1.SAMPLE_EVALUABLE,
                RESPONSE.MATERIAL_ID, PART1.MATERIAL_ID,PART2.MATERIAL_ID ORDER BY MATERIAL_ID, CENTRE_DESCRIPTION ";
        
        $conn = Yii::app()->dbBiotracking;
        $command=$conn->createCommand($sql);
        // replace the placeholder ":username" with the actual username value
        $command->bindParam(":USERID",$userID,PDO::PARAM_INT);
        // replace the placeholder ":email" with the actual email value
        $command->bindParam(":STUDYID",$studyID,PDO::PARAM_INT);
        return $command->queryAll();
    }
    
    public function getSampleCompletedFormOther($studyID,$userID,$profile)
    {
        if (strpos($profile, "CENTRAL LAB")===false)
            $sql = " SELECT VMPF.MATERIAL_ID, VMPF.MATERIAL_TYPE, CENTRE_DESCRIPTION, SCREENING_NUMBER, VISIT_NAME, '' PDF_FORM 
                     FROM V_MATERIAL_PDF_FORMS VMPF JOIN  V_MATERIAL_DETAILS_ALL VMDA ON VMPF.MATERIAL_ID = VMDA.MATERIAL_ID 
                    JOIN VISITS ON VISITS.VISIT_ID = VMDA.VISIT_ID  
                    JOIN (SELECT CENTRE FROM V_PRIVILEGES_USERS WHERE USER_ID = :USERID AND STUDY_ID=:STUDYID) VPU ON VPU.CENTRE =CENTRE_DESCRIPTION 
                    LEFT JOIN (SELECT MATERIAL_ID FROM V_MATERIAL_PARENT) PARENT ON VMPF.MATERIAL_ID = PARENT.MATERIAL_ID 
                    WHERE VISIT_NAME<>'SCREENING' AND PARENT.MATERIAL_ID IS NULL  
                    AND VMPF.MATERIAL_TYPE NOT IN ('RNA','DNA','TMA')  
                    GROUP BY VMPF.MATERIAL_ID, VMPF.MATERIAL_TYPE, CENTRE_DESCRIPTION, SCREENING_NUMBER, VISIT_NAME , ''
                    ORDER BY VMPF.MATERIAL_ID, CENTRE_DESCRIPTION, SCREENING_NUMBER";
        else
            $sql="SELECT VMPF.MATERIAL_ID, VMPF.MATERIAL_TYPE, CENTRE_DESCRIPTION, SCREENING_NUMBER, VISIT_NAME 
             FROM V_MATERIAL_PDF_FORMS VMPF JOIN  V_MATERIAL_DETAILS_ALL VMDA ON VMPF.MATERIAL_ID = VMDA.MATERIAL_ID 
             JOIN VISITS ON VISITS.VISIT_ID = VMDA.VISIT_ID  
             JOIN (SELECT CENTRE FROM V_PRIVILEGES_USERS WHERE USER_ID = :USERID AND STUDY_ID=:STUDYID) VPU ON VPU.CENTRE =CENTRE_DESCRIPTION 
             WHERE VMPF.MATERIAL_TYPE IN ('RNA','DNA','TMA') GROUP BY VMPF.MATERIAL_ID, VMPF.MATERIAL_TYPE, CENTRE_DESCRIPTION, SCREENING_NUMBER, VISIT_NAME  
             ORDER BY VMPF.MATERIAL_ID, CENTRE_DESCRIPTION, SCREENING_NUMBER";
        
        $conn = Yii::app()->dbBiotracking;
        $command=$conn->createCommand($sql);
        // replace the placeholder ":username" with the actual username value
        $command->bindParam(":USERID",$userID,PDO::PARAM_INT);
        // replace the placeholder ":email" with the actual email value
        $command->bindParam(":STUDYID",$studyID,PDO::PARAM_INT);
        return $command->queryAll();
    }
    
}

