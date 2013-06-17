<?php
/**
 * User: TRANN
 * Date: 3/31/13
 * Time: 4:35 PM
 */

use application\modules\biotracking\business as myHtml;

class HtmlElementFormTest extends CTestCase {

    private $_htmlAttribute;
    public function setup()
    {
        $this->_htmlAttribute = new myHtml\HtmlAttribute();
    }

    public function testInstance()
    {
        $this->assertTrue($this->_htmlAttribute != null);
    }

    public function testConvertObjectToArray()
    {
        $htmlElementForm = new myHtml\HtmlElementForm('select', $this->_htmlAttribute);
        $array = get_object_vars($htmlElementForm);

        $this->assertTrue(array_key_exists('tag', $array));
        $this->assertTrue('select' == $array['tag']);
    }

    public function testGetAttributes()
    {
        $attributes = array('id', 'name', 'class', 'ngModel');
        $this->assertEquals($this->_htmlAttribute->getAttributes(), $attributes);
    }

    public function testInstanceOfHtmlAttribute()
    {
        $htmlElementForm = new myHtml\HtmlElementForm('select', $this->_htmlAttribute);
        $this->assertTrue($htmlElementForm->getHtmlAttribute() instanceof myHtml\HtmlAttribute);
    }

}