<?php

class InternalUsers 
{
    private $conn;
    private $errorMessage;
    
    public function __construct() 
    {
        
    }
    
    public function __destruct()
    {
        
    }
    
    public function openConnection(array $connection)
    {
        $valueToReturn = false;
        try 
        {
            $this->conn=$this->createConnection($connection);
            if (false==$this->conn)
                throw new Exception ("connection issue");
            
            $valueToReturn=true;
        }
        catch (Exception $e)
        {
            $this->errorMessage= $e->getMessage();
        }
        return $valueToReturn ;
    }
    
    public function closeConnection()
    {
        oci_close($this->conn);
    }
    
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
    
    public function getInternalClinUser($username='')
    {
        if (!empty ($username))
        {
            $sql="select first_name,last_name,oracle_Account_name,study,decode(qs.creation_ts,NULL,oa.Creation_ts,qs.creation_ts) creation_date
            from  rxc.oracle_accounts oa left join (select account_study_Access_oa_name,study,qs.creation_ts from account_study_accesses qs,rxa_Des.clinical_studies cs where cs.clinical_Study_id=account_study_Access_cs_id) qs 
            on account_study_Access_oa_name=oracle_Account_name  where upper(oracle_account_name) like upper('%$username%') and oracle_account_name like 'OPS$%' order by oracle_Account_name";
        }
        else 
        {
            $sql="select first_name,last_name,oracle_Account_name,study,decode(qs.creation_ts,NULL,oa.Creation_ts,qs.creation_ts) creation_date
            from  rxc.oracle_accounts oa left join (select account_study_Access_oa_name,study,qs.creation_ts from account_study_accesses qs,rxa_Des.clinical_studies cs where cs.clinical_Study_id=account_study_Access_cs_id) qs 
            on account_study_Access_oa_name=oracle_Account_name where oracle_account_name like 'OPS$%' order by oracle_Account_name";
        }
        return $this->getResults($sql);
    }
    
    
    public function getInternalLabUser($username='')
    {
        return $this->getInternalUserGeneric($username);
    }
    
    public function getInternalSnapUser($username='')
    {
        return $this->getInternalUserGeneric($username);
    }
    
    public function getInternalSnap2User($username='')
    {
        return $this->getInternalUserGeneric($username);
    }
    
    private function getInternalUserGeneric($username)
    {
        if (!empty ($username))
            $sql="select username , created from sys.dba_users where upper(username) like upper('%$username%') group by username, created order by username";
        
        else 
            $sql="select username , created from sys.dba_users group by username, created order by username ";
        
        return $this->getResults($sql);
    }
    
    private function getResults ($sql)
    {
        $stmt = ociparse($this->conn,$sql);
        ociexecute($stmt);
        oci_fetch_all($stmt, $res);
        ocifreestatement($stmt);
        return $res;
    }
    
    private function createConnection(array $connection)
    {
        $conn=false;
        if (function_exists('oci_pconnect')) 
            $conn = oci_pconnect($connection['username'], $connection['password'], $connection['databaseName'], '', OCI_SYSDBA);
        else if (function_exists('oci_connect')) 
            $conn = oci_connect($connection['username'], $connection['password'], $connection['databaseName'], '', OCI_SYSDBA);
        else
            ;
        return $conn;
    }
    
}

?>
