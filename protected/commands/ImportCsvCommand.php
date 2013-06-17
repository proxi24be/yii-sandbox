<?php

    class MyCsv
    {
        private $_csvFile, $_table;
        public function __construct($csv,$table)
        {
            $this->_csvFile=$csv;
            $this->_table=$table;
        }

        public function import()
        {
            if (($handle = fopen($this->_csvFile, "r")) !== FALSE) 
            {
                $connection=Yii::app()->db;
                $cpt=0;
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
                {
                    try
                    {
                        if ($cpt>0)
                        {
                            $num = count($data);
                            if ($num==14)
                            {

                                $sql="INSERT INTO $this->_table VALUES ('".implode("', '", $data)."') ";
                                $connection->createCommand($sql)->execute();    
                            }    
                        }
                        $cpt++;
                    }
                    catch (Exception $e)
                    {
                        
                    }
                    
                }    
                fclose($handle);
            }
            else
                throw new Exception ("cannot read the csv file");
        }

    }

    class ImportCsvCommand extends CConsoleCommand
    {

        public function actionExecute ()
        {
            try
            {
                $csv="D:/wamp/www/mcd_breast_reborn/biotracking_table/does_not_exist.txt";
                $table="V_CENTRES_ADDRESS";
                if (!file_exists($csv))    
                    throw new Exception("the file does not exist!");

                $myCsv=new MyCsv($csv,$table);
                $myCsv->import();
            }

            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }
    }


?>