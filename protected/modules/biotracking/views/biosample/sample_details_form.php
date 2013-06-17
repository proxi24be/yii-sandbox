<style>

    form#sampleDetailsForm .myinfo
    {
        margin-top : 0px;
        width : 450px;
        margin-bottom : 10px;
    }

</style>


<form class="form-horizontal" id='sampleDetailsForm'>
    <fieldset>

        <legend class="title">SAMPLE DETAILS FORM</legend>

        <div class="marginLeft50">

            <h4 class="title">Sample general information</h4>

            <div class="notEditableContent">

                <div class="control-group">
                    <label class="control-label">Patient number</label>

                    <div class="controls">
                        <span class="spanInfo">{{dataToCollect.patient.SCREENING_NUMBER}}</span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Patient birthdate</label>

                    <div class="controls">
                        <span class="spanInfo">{{dataToCollect.birthdate.ddmmmyyyy}}</span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Center</label>

                    <div class="controls">
                        <span class="spanInfo">{{dataToCollect.patient.SCREENING_NUMBER.substring(0,6)}}</span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Visit</label>

                    <div class="controls">
                        <span class="spanInfo">{{dataToCollect.visit.VISIT_NAME}}</span>
                    </div>
                </div>

                <div class="control-group">
                    <label class="control-label">Sample type</label>

                    <div class="controls">
                        <span class="spanInfo">{{dataToCollect.sampleType.DESCRIPTION}}</span>
                    </div>
                </div>

                <span ng-show="'TISSUE' == dataToCollect.sampleType.DESCRIPTION">
                    <div class="control-group">
                        <label class="control-label">Conditioning</label>

                        <div class="controls">
                            <span class="spanInfo">{{dataToCollect.conditioning.CONDITIONING}}</span>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Laterality</label>

                        <div class="controls">
                            <span class="spanInfo">{{dataToCollect.laterality.LATERALITY}}</span>
                        </div>
                    </div>
                </span>

            </div>

            <h4 style="margin-top:20px" class="title">Sample specifications</h4>

            <span class="tissue-tumour-block" ng-show="'tissue' == dataToCollect.sampleType.DESCRIPTION.toLowerCase()">
                <?php
                $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["pathological"]));
                $this->widget("FactoryFormElement", array("properties" => $model["pathological"]));
                $this->endWidget();
                ?>
            </span>

            <span class='serum-plasma' ng-show="'serum' == dataToCollect.sampleType.DESCRIPTION.toLowerCase() || 'plasma' == dataToCollect.sampleType.DESCRIPTION.toLowerCase()">
                <?php
                $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["cryovials"]));
                $this->widget("FactoryFormElement", array("properties" => $model["cryovials"]));
                $this->endWidget();

                $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["temperature"]));
                $this->widget("FactoryFormElement", array("properties" => $model["temperature"]));
                $this->endWidget();
                ?>
            </span>


            <?php
            $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["collectionDate"]));
            $this->widget("FactoryFormElement", array("properties" => $model["collectionDate"]));
            $this->endWidget();
            ?>

            <span class='tissue-tumour-block' ng-show="'tissue' == dataToCollect.sampleType.DESCRIPTION.toLowerCase()">
                <?php
                $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["fixative"]));
                $this->widget("FactoryFormElement", array("properties" => $model["fixative"]));
                $this->endWidget();
                ?>
                <span ng-show="'other' == dataToCollect.fixative.FIXATIVES.toLowerCase()">
                <?php
                $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["otherFixative"]));
                $this->widget("FactoryFormElement", array("properties" => $model["otherFixative"]));
                $this->endWidget();
                ?>
                </span>
            </span>

            <?php
            $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["comment"]));
            $this->widget("FactoryFormElement", array("properties" => $model["comment"]));
            $this->endWidget();
            ?>

            <div class="tissue-tumour-block" style="margin-top:20px;"
                 ng-show="'tissue'==dataToCollect.sampleType.DESCRIPTION.toLowerCase()">
                <h4 class="title">Return address for FFPE tumor block</h4>
                <p class='myinfo alert alert-info'><b>Site address is used by default</b>, please correct it if it is required.</p>
                <?php
                $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["street"]));
                $this->widget("FactoryFormElement", array("properties" => $model["street"]));
                $this->endWidget();

                $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["city"]));
                $this->widget("FactoryFormElement", array("properties" => $model["city"]));
                $this->endWidget();

                $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["state"]));
                $this->widget("FactoryFormElement", array("properties" => $model["state"]));
                $this->endWidget();

                $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["postcode"]));
                $this->widget("FactoryFormElement", array("properties" => $model["postcode"]));
                $this->endWidget();

                $this->beginWidget("Bs_ControlGroupForm", array("properties" => $model["country"]));
                $this->widget("FactoryFormElement", array("properties" => $model["country"]));
                $this->endWidget();
                ?>
            </div>

            <div class="control-group" style="margin-left:150px">
                <div class="controls">
                    <input type="submit" class="btn btn-primary" value="Save" ng-click="saveForm()">
                </div>
            </div>

        </div>

    </fieldset>

</form>