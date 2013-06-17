<?php

class OracleReport extends ServerReport
{
    private $baseUrl ;
    private $asynchrone="BACKGROUND=YES";
    
    public function __construct($reportForm=null) 
    {
        parent::__construct($reportForm);
        $this->baseUrl = "\\\\vmbroraapp64\\c$\\oracle\\AS10gR2mt\\j2ee\\home\\reports\\";
    }
    
    public function generateReport(array $params) 
    {
        $today = date("dmY-His");
        $fileExt=$params["fileExt"];
        $fileformat = strtolower($fileExt) == "xls" ? "DelimitedData" : strtolower($fileExt);
        $desFolder=$params["desFolder"];
        $destination_path = "reports/aphinity/$desFolder" ;
//        curl n'aime pas les espaces dans les noms donc j'utilise le folder path
        $outFileName=$params["desFolder"];
        $outFileName = "$outFileName-$today" ;
        $config = Yii::app()->params["dbReport"];
        $queueID=$params["queueID"];
        $params1="&destype=file&desformat=$fileformat&desname=$destination_path/$outFileName.$fileExt&userid={$config['username']}/{$config['password']}@{$config['databaseURL']}/{$config['databaseName']}";        
        $params2="+QID=$queueID"; // the QID is generated after the insert
        $params3="+$this->asynchrone";
        $request = <<<REQ
http://vmbroraapp64.breast.chimio.bordet.be/reports/rwservlet?report={$params["exec_file"]}{$params1}{$params2}{$params3}  
REQ;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, '10');    

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $fileUrl = "\\\\vmbroraapp64\\aphinity\\$desFolder\\$outFileName.$fileExt";
        
        $this->updateQueue($fileUrl);
        return $fileUrl;
     }
}
?>
