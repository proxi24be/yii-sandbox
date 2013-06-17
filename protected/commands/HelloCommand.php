<?php 

class HelloCommand extends CConsoleCommand

{

    public function actionBonjour($myName)
    {
        echo "hello the world $myName";
    }


}


