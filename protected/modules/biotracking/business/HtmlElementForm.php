<?php
/**
 * User: TRANN
 * Date: 3/31/13
 * Time: 4:44 PM
 */

namespace application\modules\biotracking\business;


class HtmlElementForm {

    public $tag;
    public $htmlAttribute;

    /**
     * @param $tag
     * @param HtmlAttribute $htmlAttribute
     */
    public function __construct($tag, HtmlAttribute $htmlAttribute)
    {
        $this->tag = $tag;
        $this->htmlAttribute = $htmlAttribute;
    }

    public function getHtmlAttribute()
    {
        return $this->htmlAttribute;
    }

    public function getTag()
    {
        return $this->tag;
    }

}