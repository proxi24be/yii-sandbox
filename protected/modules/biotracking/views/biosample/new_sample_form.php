<?php
/**
 * Created by JetBrains PhpStorm.
 * User: TRANN
 * Date: 3/14/13
 * Time: 11:24 AM
 *
 */
?>

<form class="form-horizontal" id="newSample">
    <fieldset>
        <legend class="title">NEW SAMPLE REGISTRATION</legend>
        <div class="marginLeft50">
            <h4 class="title">Sample basic information</h4>

            <?php
            $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["patient"]));
            $this->widget("FactoryFormElement", array("properties" => $model["patient"]));
            $this->endWidget();

            $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["birthdate"]));
            $this->widget("FactoryFormElement", array("properties" => $model["birthdate"]));
            $this->endWidget();

            $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["visit"]));
            $this->widget("FactoryFormElement", array("properties" => $model["visit"]));
            $this->endWidget();

            $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["kitNumber"]));
            $this->widget("FactoryFormElement", array("properties" => $model["kitNumber"]));
            $this->endWidget();

            $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["sampleType"]));
            $this->widget("FactoryFormElement", array("properties" => $model["sampleType"]));
            $this->endWidget();
            ?>
            <div class="tissueScreening" ng-show="'TISSUE'== dataToCollect.sampleType.DESCRIPTION">
                <p>

                <div>
                    <!--ce div additionel garantie que l'effet bounce sous jquery ne modifie pas la position de l'élément-->
                    <label class="control-label"><?php echo $model['conditioning']["label"];?></label>

                    <div class="controls">
                        <?php $this->widget("FactoryFormElement", array("properties" => $model["conditioning"])); ?>
                    </div>
                </div>
                </p>
                <p>

                <div>
                    <label class="control-label "><?php echo $model['laterality']["label"];?></label>

                    <div class="controls">
                        <?php $this->widget("FactoryFormElement", array("properties" => $model["laterality"])); ?>
                    </div>
                </div>
                </p>
            </div>
            <!--tissue-->

            <div class="blood" ng-show="'BLOOD'== dataToCollect.sampleType.DESCRIPTION">
                <p>

                <div>
                    <label class="control-label"><?php echo $model['bloodTechnical']["label"];?></label>

                    <div class="controls">
                        <?php $this->widget("FactoryFormElement", array("properties" => $model["bloodTechnical"])); ?>
                    </div>
                </div>
                </p>
            </div>
            <!--blood-->
            <?php

            $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["endTaxanes"]));
            $this->widget("FactoryFormElement", array("properties" => $model["endTaxanes"]));
            $this->endWidget();

            $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["sampleNumber"]));
            $this->widget("FactoryFormElement", array("properties" => $model["sampleNumber"]));
            $this->endWidget();

            ?>
            <div class="control-group" style="margin-left:150px">
                <div class="controls">
                    <input type="submit" class="btn btn-primary" value="Next" ng-click="submitInfo()">
                </div>
            </div>

            <div id="birthdate-confirm" title="Confirm patient birthdate" class="myDialog">
                <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;">
                  </span>You have entered the following patient birthdate: <span id="SPANCONFIRMBIRTHDATE"
                                                                                 style="font-weight: bold"></span>

                <p>Do you want to continue ? (This action cannot be undone)</p></p>
            </div>


            <div id="german-birthdate-confirm" title="Confirm patient birthdate" class="myDialog">
                <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
                    <b>Warning:</b> due to the German regulation on data protection, <b>only the year of birth</b> can
                    be reported.</p>

                <p>Therefore, please report 30-June (data entry convention) for the day and month.</p>

                <p>Thank you.</p>
            </div>


            <div id="sampleKitNumberConfirm" title="Confirm sample kit ID" class="myDialog">
                <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
                    <b>Warning:</b> The kit number that you have entered is not as the kit number assigned at
                    randomisation.</p>

                <p>Do you still want to confirm ?</p>
            </div>

        </div>
    </fieldset>
</form>
