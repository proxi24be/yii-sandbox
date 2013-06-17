function AphinityScope(scope) {
    // keep the reference of the object $scope
    var $scope = scope;
    this.computeSampleNumber = function () {
        try
        {
            $scope.dataToCollect.SAMPLE_NUMBER = "";
            if ('blood' != $scope.dataToCollect.sampleType.DESCRIPTION.toLowerCase() && 'taxanes treatment completion' != $scope.dataToCollect.visit.VISIT_NAME.toLowerCase()) {
                var length = $scope.sampleNumbers.length;
                var i = 0;
                var found = false;
                while (!found && i < length) {
                    if ($scope.sampleNumbers[i]["MATERIAL_TYPE_ID"] == $scope.dataToCollect.sampleType.MATERIAL_TYPE
                        && $scope.sampleNumbers[i]["VISIT_ID"] == $scope.dataToCollect.visit.VISIT_ID) {
                        found = true;
                        $scope.dataToCollect.SAMPLE_NUMBER = $scope.sampleNumbers[i]["SAMPLE_NUMBER"];
                    }
                    else
                        i++;
                }
            }
            else {
                $scope.bloodTechnical = undefined;
                $scope.endTaxane = undefined;
            }
        }
        catch (err) {

        }
    }

    this.computeSampleNumber = function () {
        try
        {
            $scope.dataToCollect.SAMPLE_NUMBER = "";
            if ('blood' != $scope.dataToCollect.sampleType.DESCRIPTION.toLowerCase() && 'taxanes treatment completion' != $scope.dataToCollect.visit.VISIT_NAME.toLowerCase()) {
                var length = $scope.sampleNumbers.length;
                var i = 0;
                var found = false;
                while (!found && i < length) {
                    if ($scope.sampleNumbers[i]["MATERIAL_TYPE_ID"] == $scope.dataToCollect.sampleType.MATERIAL_TYPE
                        && $scope.sampleNumbers[i]["VISIT_ID"] == $scope.dataToCollect.visit.VISIT_ID) {
                        found = true;
                        $scope.dataToCollect.SAMPLE_NUMBER = $scope.sampleNumbers[i]["SAMPLE_NUMBER"];
                    }
                    else
                        i++;
                }
            }
            else {
                $scope.bloodTechnical = undefined;
                $scope.endTaxane = undefined;
            }
        }
        catch (err) {

        }
    }

    this.computeSampleNumberEndTaxanes = function () {
        var length = $scope.endTaxanes.length;
        var i = 0;
        var found = false;
        while (!found && i < length) {
            if ($scope.endTaxanes[i]["TEXT"] == $scope.dataToCollect.endTaxane.VALUE) {
                found = true;
                $scope.dataToCollect.SAMPLE_NUMBER = $scope.endTaxanes[i]["SAMPLE_NUMBER"];
            }
            else
                i++;
        }
    }

    this.computeSampleNumberBloodTechnicals = function () {
        var length = $scope.bloodTechnicals.length;
        var i = 0;
        var found = false;
        while (!found && i < length) {
            if ($scope.bloodTechnicals[i]["TEXT"] == $scope.dataToCollect.bloodTechnical.VALUE) {
                found = true;
                $scope.dataToCollect.SAMPLE_NUMBER = $scope.bloodTechnicals[i]["SAMPLE_NUMBER"];
            }
            else
                i++;
        }
    }

    this.setModel = function (AphinityModel) {
        $scope.sampleKitID = AphinityModel.getSampleKitID();
        $scope.sampleNumbers = AphinityModel.getSampleNumber();
        $scope.endTaxanes = AphinityModel.getEndTaxanes();
        $scope.bloodTechnicals = AphinityModel.getBloodTechnical();
    }
}