<?php
/**
 * User: TRANN
 * Date: 5/15/13
 * Time: 11:38 AM
 */

Yii::import('application.commands.*');


class BenchmarkController extends Controller{

    public function actionIndex()
    {
        require_once('SetupTable/lab2_v_patients.php');
        $start = time();
        $datas = $lab2_v_patients;
        for($i=0; $i<10; $i++)
        {
            foreach($datas as $data)
            {
                $benchmark = new Benchmark();
                $benchmark->FRAMEWORK = 'YII';
                $benchmark->TIMESTAMP = time();
                $benchmark->DATA = implode(', ', $data);
                $benchmark->save();
            }
        }
        $end = time();
        $this->render('index', array('benchmark1' => $end - $start ));
    }
}