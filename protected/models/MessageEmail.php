<?php

class MessageEmail 
{
    public static function getMessage($firstname,$lastname,$email,$code)
    {
        return  "Dear $firstname $lastname,\n".
		"\n".
		"Welcome to the BrEAST Website !!!\n".
		"\n".
		"Your user account has been successfully created\n".
		"\n".
		"Please click on the below link in order to activate your user account and to receive your username \n".
		"http://localhost/breast_yii/site/completeregistration?code=$code \n".
		"\n".
		"Best regards,\n".
		"The BrEAST Technical Team.\n";
    }
    
    public static function getResetMessage($firstname,$lastname,$email,$user,$temp)
    {
        return  "Dear $firstname $lastname,\n".
		"\n".
		"You have request a reset of password\n".
		"\n".
		"Please click on the below link in order to reset your password \n".
		"http://localhost/breast_yii/site/updatepassword?user=$user&temp=$temp \n".
		"\n".
		"Best regards,\n".
		"The BrEAST Technical Team.\n";
    }
		
}

?>
