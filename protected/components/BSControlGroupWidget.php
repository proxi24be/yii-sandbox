<?php
/**
 * User: TRANN
 * Date: 3/31/13
 * Time: 6:51 PM
 */

/**
 * Class BSControlGroupWidget
 *
 * The BS prefix is for bootstrap(twitter)
 *
 * @internal The below is an example of html that will be rendered :
 *  <div class="control-group">
 *  <label class="control-label" for="inputEmail">Email</label>
 *  <div class="controls">
 *   <input type="text" id="inputEmail" placeholder="Email">
 *  </div>
 *  </div>
 */
class BSControlGroupWidget extends CWidget {

    public $htmlOptions;

    public function init()
    {

    }

    public function run()
    {
        echo "</div></div>";
    }

}