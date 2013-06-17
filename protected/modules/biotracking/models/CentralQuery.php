<?php


class CentralQuery
{
    
    public function __construct() 
    {
        
    }
    
    public function __destruct() 
    {
    
        
    }
    
    public static function getALLHer2Form()
    {
        $biotrackingConn = Yii::app()->dbBiotracking; 
        // Here you will use your complex sql query using a string or other yii ways to create your query
        $sql="SELECT       RESPONSE.MATERIAL_ID, CENTRE_DESCRIPTION, SCREENING_NUMBER, BIRTHDATE,MATERIAL_TYPE,DATE_PICKUP, 
                    decode(RESPONSE.CL_RECEPTION_DATE,null,'NOT YET RECEIVED',RESPONSE.CL_RECEPTION_DATE) CL_RECEPTION_DATE, 
                    decode(
                            upper(part1.SAMPLE_EVALUABLE), null, 'NOT YET AVAILABLE',
                            'YES', upper(PART1.HER2_ELIGIBLE),
                             'NO', 'NOT EVALUABLE'
                                                
                        ) HER2_ELIGIBLE,
                    
                    part1.sample_evaluable,
                    RESPONSE.MATERIAL_ID LOCAL_RESULT,
                    decode(upper(PART1.MATERIAL_ID),null,'NOT YET AVAILABLE',upper(PART1.MATERIAL_ID)) PART1_MATERIAL_ID, 
                    decode(upper(PART2.MATERIAL_ID),null,'NOT YET AVAILABLE',upper(PART2.MATERIAL_ID)) PART2_MATERIAL_ID 
                    FROM LAB2.V_MATERIAL_WITH_RESPONSES RESPONSE 
                    join (select CENTRE_ID, CENTRE FROM LAB2.V_PRIVILEGES_USERS WHERE USER_ID=:USERID) up 
                    on up.centre=centre_description
                                                                   
                    LEFT JOIN (SELECT MATERIAL_ID,HER2_ELIGIBLE, SAMPLE_EVALUABLE FROM LAB2.V_CENTRAL_RESULT_PART1 ) PART1 ON PART1.MATERIAL_ID = RESPONSE.MATERIAL_ID 
                    LEFT JOIN (SELECT MATERIAL_ID FROM LAB2.V_CENTRAL_RESULT_PART2 ) PART2 ON PART2.MATERIAL_ID = RESPONSE.MATERIAL_ID
                    JOIN (SELECT CENTRE FROM LAB2.V_PRIVILEGES_USERS WHERE USER_ID = :USERID) VPU ON VPU.CENTRE = CENTRE_DESCRIPTION                                                         
                    GROUP BY RESPONSE.MATERIAL_ID, CENTRE_DESCRIPTION, SCREENING_NUMBER, 
                    BIRTHDATE,MATERIAL_TYPE,DATE_PICKUP,CL_RECEPTION_DATE, PART1.HER2_ELIGIBLE, PART1.SAMPLE_EVALUABLE,
                    RESPONSE.MATERIAL_ID, PART1.MATERIAL_ID,PART2.MATERIAL_ID ORDER BY MATERIAL_ID, CENTRE_DESCRIPTION ";
        $oCommand = $biotrackingConn->createCommand($sql);
        // Bind the parameter
        $userID=5;
        $oCommand->bindParam(':USERID',$userID, PDO::PARAM_INT);
        return $oCommand->queryAll(); // Run query and get all results in a CDbDataReader
    }
}

?>
