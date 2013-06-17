<?php

class RdcAccount
{
   public function __construct()
    {
       
    }
    
    public function createUser($username, $password, $firstname, $lastname, $clinical_study_id, $site, $role,$csm=false)
    {
        
      $username=strtoupper($username);
      // recherche du nom exact de l'étude
      $conn = ociplogon("SYS", "letrozole12", "CLIN", '', OCI_SYSDBA);
      $sql = "select * from clinical_studies WHERE clinical_study_id = $clinical_study_id ";
            
      $stmt = ociparse($conn,$sql);
      ociexecute($stmt);
      oci_fetch_all($stmt, $res);
      ocifreestatement($stmt);
      $study = $res['STUDY'][0];
 
        if ($this->userExist($username,$conn)=== false  && $role != 'RXC_DMGR')
        {
                    // Création du user purement "Oracle"
              $sql="create user \"$username\" identified by \"$password\" temporary tablespace temp default tablespace users"; 
              Yii::log($sql);
              $stmt = ociparse($conn,$sql);
              ociexecute($stmt);
              ocifreestatement($stmt);     


              // Le user doit pouvoir se connecter etc.
              $sql ="GRANT CREATE SESSION, CONNECT,RESOURCE,RXCLIN_READ,RXCLIN_MOD,OCL_ACCESS TO \"$username\" ";
              Yii::log($sql);
              $stmt = ociparse($conn,$sql);
              ociexecute($stmt);
              ocifreestatement($stmt);     

              // Access to RDC
              $sql ="GRANT RXC_RDC, RDC_ACCESS TO \"$username\" "; // RXC_RDCT,  RXC_SITE sinon on a une erreur en ouvrant une page de CRF
              Yii::log($sql);
              $stmt = ociparse($conn,$sql);
              ociexecute($stmt);
              ocifreestatement($stmt);     

              // Job de l'utilisateur
              $sql = "GRANT $role TO \"$username\" ";
              Yii::log($sql);
              $stmt = ociparse($conn,$sql);
              ociexecute($stmt);
              ocifreestatement($stmt);

              $sql = "ALTER USER \"$username\" DEFAULT ROLE ALL EXCEPT RXCLIN_MOD";
              Yii::log($sql);
              $stmt = ociparse($conn,$sql);
              ociexecute($stmt);
              ocifreestatement($stmt);

              // Rend son profil password expirable
              $sql ="ALTER USER \"$username\" PROFILE PASSWORDEXPIRE";
              Yii::log($sql);
              $stmt = ociparse($conn,$sql);
              ociexecute($stmt);
              ocifreestatement($stmt);

              // Oracle accounts  
              $superuser='';
              $userlogdir='';
              $rslogdir='c:\opapps46\html\repout_clin';
              $psubp='';
              $psubq='';
              $rs='';
              $jobsetrs='';
              $psubrs='';
              $rsp='';
              $customdir='';

              $sql="insert into ORACLE_ACCOUNTS 
              (ORACLE_ACCOUNT_NAME, CREATION_TS, CREATED_BY, ALL_STUDY_ACCESS_FLAG, 
              FIRST_NAME, LAST_NAME, OA_SUB_TYPE_CODE, USER_LOG_DIR, 
              RS_RXC_LOG,                     
              DEFAULT_PRINTER_QUEUE,          
              DEFAULT_PSUB_QUEUE,             
              DEFAULT_REPORT_RS,              
              DEFAULT_JOB_SET_RS,             
              DEFAULT_PSUB_SCHEDULE_RS,       
              DEFAULT_RS_PRINTER,             
              OC_CUSTOM_DOC_DIR,
              DATE_DISPLAY_FORMAT,
              DATE_INPUT_FORMAT)
              values
               (UPPER('$username'), SYSDATE, 'SYSTEM', 
               decode('$superuser', 'Y', 'Y', 'y', 'Y', 'N') , UPPER('$firstname'), 
                    UPPER('$lastname'),
                    'ORACLE', '$userlogdir', '$rslogdir',
              '$psubp',
              '$psubq',
              '$rs',
              '$jobsetrs',
              '$psubrs',
              '$rsp',
              '$customdir',
              'STANDARD',
              'EUROPEAN'
              )";
              Yii::log($sql);
              $stmt = ociparse($conn,$sql);
              ociexecute($stmt);
              ocifreestatement($stmt);

              // cette ligne donne accès à tous les centres d'aphinity !!! 
              // il faut l'enlever pour eviter des failles de sécurité
              
              $sql = "INSERT INTO account_study_accesses (ACCOUNT_STUDY_ACCESS_OA_NAME, ACCOUNT_STUDY_ACCESS_CS_ID, CREATION_TS, CREATED_BY)
              VALUES ('$username', $clinical_study_id, SYSDATE, USER)" ;
              Yii::log($sql);
              $stmt = ociparse($conn,$sql);
              ociexecute($stmt);
              ocifreestatement($stmt);

        }
      
	if ($role=="RXC_INV")
		$profilPrivileges ="APPROVE, BROWSE, BRW_BATCH, UPDATE, UPD_DISCREP";
	else if ($role=="RXC_CRA")
		{
			$profilPrivileges ="BROWSE, BRW_BATCH, UPD_DISCREP, VERIFY";
			if ($csm)
				$profilPrivileges ="BROWSE, BRW_BATCH, VERIFY";
		}
	else if ($role=="RXC_SITE")
		$profilPrivileges ="BROWSE, BRW_BATCH, UPDATE, UPD_DISCREP";
	else 
		exit();
	
	$this->createProfilPrivileges($profilPrivileges,$username,$site,$study,$conn);
  
}    

	public function getRoleRdc ($roleBrEAST){
            
          $roleRDC=VRoleRdcBrEAST::model()->findByAttributes(array("ROLE_BREAST"=>  strtoupper($roleBrEAST)));  
          if ($roleRDC == null)
                  return false ;
          else 
              return $roleRDC;
      }

	private function createProfilPrivileges($profilPrivileges,$username,$site,$study,$conn){
	// privileges pour le centre
		  $sql = "INSERT INTO OPA_LEVEL_PRIVS
		  (LEVEL_PRIV_ID,
		  CREATION_TS,
		  CREATED_BY,
		  USER_NAME,
		  LEVEL_TYPE,
		  LEVEL_PRIVILEGE,
		  LEVEL_VALUE,
		  PARENT_LEVEL_TYPE,
		  PARENT_LEVEL_VALUE,
		  ADMIN,
		  MODIFICATION_TS,
		  MODIFIED_BY)
		  VALUES (OPA.OPA_LEVEL_PRIVS_SEQ.nextval,
		  sysdate,
		  'SYSTEM',
		  '$username',
		  'SITE',
		  '$profilPrivileges',
		  '$site',
		  'STUDY',
		  '$study',
		  'NO',
		  NULL,
		  NULL)";
		  
		  Yii::log($sql);
		  $stmt = ociparse($conn,$sql);
		  ociexecute($stmt);
		  ocifreestatement($stmt);
}


	private function userExist($userName,$conn){
	$sql =  "SELECT COUNT (ORACLE_ACCOUNT_NAME) TOTAL FROM ORACLE_ACCOUNTS WHERE ORACLE_ACCOUNT_NAME LIKE '$userName' " ;
	$stmt = ociparse($conn,$sql);
	ociexecute($stmt);
	$result = oci_fetch_object($stmt);
	ocifreestatement($stmt);

	if ($result->TOTAL == 0) 
		return false;
	else	
		return true;
	}
	
	public function updatePassword ($username,$password) {
            $conn = ociplogon("SYS", "letrozole12", "CLIN", '', OCI_SYSDBA);
            $sql =" ALTER USER \"$username\" IDENTIFIED BY \"$password\" ";
            Yii::log($sql);
            $stmt = ociparse($conn,$sql);
            ociexecute($stmt);
            ocifreestatement($stmt);
            $conn=null;
	}
        
        
    public function createNewRdcUser ($studyName,$userRegistration){
    if ($studyName=="APHINITY")
    {
        $clinical_study_id = "401";
        $roleStudyID= (int)$userRegistration->attributes["ROLE_STUDY_ID"];
        if ($roleStudyID==59 || $roleStudyID==66 )
            $csm=true;
        else
            $csm=false;
        
        $role_breast = VRoleBrEASTStudy::model()->findByAttributes(array("ROLE_STUDY_ID"=>$roleStudyID));
        
        if ($role_breast !== null)
        {
            $roleRdc = $this->getRoleRdc($role_breast["ROLE_BREAST"]);
            if ($roleRdc !== false)
            {
                switch ($roleRdc["ROLE_RDC_ID"]){
                case 1: $role ="RXC_INV";
                        break ;
                case 2: $role="RXC_DMGR";
                        break;
                case 3: $role="RXC_CRA";
                        break;
                case 4: $role ="RXC_SITE";
                        break;
                }
                $email = $userRegistration->attributes['EMAIL_ADDRESS'];
                $rows = $this->getCentreUser(array("ROLE_STUDY_ID"=>$roleStudyID,"STUDY"=>"APHINITY","EMAIL"=>$email));
                if (count($rows)>0)
                {
                    foreach ($rows as $row)
                        $this->createUser(strtoupper ($userRegistration->attributes["USERNAME"]), $userRegistration->CLEAR_PASSWORD, 
                                strtoupper($userRegistration->attributes["FIRSTNAME"]), strtoupper($userRegistration->attributes["LASTNAME"]),$clinical_study_id, $row["CENTRE"], $role,$csm);
                }
                
            }
            
        }
                
    }
}


    public function getCentreUser(array $params)
    {
        $roleStudyID=$params["ROLE_STUDY_ID"];
        $studyName=$params["STUDY"];
        $email=$params["EMAIL"];
        $breastProfile=VRoleBrEASTStudy::model()->findByAttributes(array("ROLE_STUDY_ID"=>$roleStudyID));
        $listOfRoles=VRoleBrEASTStudy::model()->findAllByAttributes(array("BREAST_PROFILE_ID"=>$breastProfile["BREAST_PROFILE_ID"]));
        $temp=array();
        foreach ($listOfRoles as $role)
                $temp[]=$role["ROLE_STUDY"];
        $cdbCriteria = new CDbCriteria();
        $cdbCriteria->select="CENTRE";
        $cdbCriteria->condition="STUDY LIKE :studyName AND EMAIL LIKE :email";
        $cdbCriteria->params=array(":studyName"=>$studyName, ":email" =>$email);
        $cdbCriteria->addInCondition("ROLE_NAME", $temp);
        $cdbCriteria->group="CENTRE";
        $rows = VContactAllExceptHera::model()->findAll($cdbCriteria);
        return $rows;
    }


}


?>
