<?php

class MyKitNumber extends Biotracking
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {

    }

    public function findKitNumber($patientID)
    {
        if (isset($patientID))
        {
            $patientID = (int)$patientID;
            $sql = "SELECT pat.patient_id, pat.centre_id, pat.screening_number,sample_kit_id , kitEntered.kit_number_value kit_entered
                    FROM patients pat JOIN received_files rf ON pat.screening_number=rf.patient_number
                    LEFT JOIN kit_number  kitEntered ON pat.patient_id = kitEntered.property_value
                    WHERE pat.patient_id=:PATIENTID AND sample_kit_id IS NOT null
                    GROUP BY pat.patient_id, pat.centre_id, pat.screening_number,sample_kit_id, kitEntered.kit_number_value ";

            $command = $this->conn->createCommand($sql);
            $command->bindParam(":PATIENTID", $patientID, PDO::PARAM_INT);

            return $command->queryAll();
        }
        else
            throw new Exception("findKitNumber : error parameter in");
    }

    public function findAllKitNumberOfSite(array $arrCentreID)
    {
        if (is_array($arrCentreID) && count($arrCentreID) > 0)
        {
            $filter = implode(",", $arrCentreID);
            $sql = "SELECT pat.patient_id, pat.centre_id, pat.screening_number,sample_kit_id, kitEntered.kit_number_value kit_entered
                    FROM patients pat JOIN received_files  rf ON pat.screening_number=rf.patient_number
                    LEFT JOIN kit_number  kitEntered ON pat.patient_id = kitEntered.property_value
                    WHERE pat.centre_id IN ($filter)
                    GROUP BY pat.patient_id, pat.centre_id, pat.screening_number,sample_kit_id, kitEntered.kit_number_value";

            $command = $this->conn->createCommand($sql);

            return $command->queryAll();
        }
        else
            throw new Exception ("findAllKitNumberOfSite : error parameter in");
    }

    public function findAllKitNumberOfUser($userID)
    {
        if (!isset($userID))
            throw new Exception ("findAllKitNumberOfUser : invalid userID");

        $sql = "SELECT pat.patient_id PATIENT_ID, pat.centre_id CENTRE_ID, pat.screening_number SCREENING_NUMBER, sample_kit_id SAMPLE_KIT_ID,
                kitEntered.kit_number_value KIT_NUMBER_VALUE
                FROM patients pat
                JOIN received_files  rf ON pat.screening_number=rf.patient_number
                JOIN (SELECT centre_id FROM v_privileges_users WHERE user_id = :USERID) vp ON vp.centre_id = pat.centre_id
                LEFT JOIN kit_number  kitEntered ON pat.patient_id = kitEntered.property_value
                GROUP BY pat.patient_id, pat.centre_id, pat.screening_number,sample_kit_id, kitEntered.kit_number_value";

        $command = $this->conn->createCommand($sql);
        $command->bindParam(":USERID", $userID, PDO::PARAM_INT);

        return $command->queryAll();
    }
}
