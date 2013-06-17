<?php
/**
 * User: TRANN
 * Date: 6/3/13
 * Time: 12:03 PM
 */

$url = Yii::app()->createAbsoluteUrl('administration/biotracking/study');
?>
<div class='container'>
    <div class='row'>
        <div class='span6 offset3'>
            <form class='form-horizontal' id='form_choice' action="<?php echo $url;?>">
                <div class='control-group'>
                    <label class="control-label" for="inputEmail">Please select an action</label>
                    <div class='controls'>
                        <select name='action'>
                            <option></option>
                            <option value='new_study'>Setup new study</option>
                            <option value='edit_study'>Edit current study</option>
                        </select>
                    </div>
                </div>
                <div class='form-actions'>
                    <input type='submit' value='go' class='btn btn-primary' />
                </div>
            </form>
        </div>
    </div>
</div>


