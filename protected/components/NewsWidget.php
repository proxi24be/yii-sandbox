<?php
/**
 * Created by JetBrains PhpStorm.
 * User: bluenight
 * Date: 20/01/13
 * Time: 19:07
 */
class NewsWidget extends CWidget
{

    private $_news;

    public function init()
    {
        $this->_news= AdmNews::model()->desc()->recently(2)->findAll();
    }

    public function getData()
    {
        return $this->_news;
    }

    public function run()
    {
        $this->render("newswidget", array("news"=>$this->_news));
    }

}