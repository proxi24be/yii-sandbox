<?php

class RegistrationProcedure {

private $dsn = 'oci:dbname=clin';
private $user ;
private $password ;

	public function __construct($userClin='breast_registration', $pwdClin='md5_breast@clin'){
		$this->user= $userClin;
		$this->password = $pwdClin;
	}
	
	public function __destruct(){
		unset($this);
	}
	
	public function execute ($procedureName){
		$resultat ='';
		try 
		{
			$dbh = new PDO($this->dsn, $this->user, $this->password);
			$stmt = $dbh->prepare("CALL $procedureName");
			$stmt->execute();
			$resultat ='OK';
			unset($dbh);
		} 

		catch (PDOException $e) 
		{
			$resultat = 'Connection failed: ' . $e->getMessage();
		}
		
		return $resultat ;
	}
}

	
?>


