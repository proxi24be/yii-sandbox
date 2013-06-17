<?php 

class MySampleNumber extends Biotracking

{
    public function __construct ()
    {
            parent::__construct ();
    }

    public function getAllSampleNumber ()
    {
        $sql = 'SELECT SAMPLE_NUMBER, SN.VISIT_ID, VISIT_NAME , SN.MATERIAL_TYPE MATERIAL_TYPE_ID, DESCRIPTION MATERIAL_TYPE
                        FROM SAMPLE_NUMBERS SN JOIN VISITS V ON SN.VISIT_ID=V.VISIT_ID
                        JOIN MATERIAL_TYPES MT ON MT.MATERIAL_TYPE= SN.MATERIAL_TYPE
                        GROUP BY SAMPLE_NUMBER, SN.VISIT_ID, VISIT_NAME , SN.MATERIAL_TYPE , DESCRIPTION
                        ORDER BY SN.VISIT_ID ';

        $command=$this->conn->createCommand($sql);
        return $command->queryAll();
    }
}

