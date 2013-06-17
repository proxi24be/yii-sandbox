NewSample.service('PatientModel', function () {

    this.getListOfPatient = function () {
        var valueToReturn = undefined;

        $.ajax({
            url: myConfig.angularUrl + "/biotracking/patient/getListOfPatient",
            dataType: "json",
            async: false
        }).done(function (data) {
                valueToReturn = data;
            });

        return valueToReturn;
    }

});

NewSample.service('VisitModel', function () {

    this.getListOfVisit = function (patientID) {
        var valueToReturn = undefined;

        $.ajax({
            url: myConfig.baseUrl + "/biotracking/patient/getListOfVisit",
            data: "patientID=" + patientID,
            dataType: "json",
            async: false
        }).done(function (data) {
                valueToReturn = data;
            });

        return valueToReturn;
    }

});

NewSample.service('SampleTypeModel', function () {

    this.getListOfSampleType = function (patientID, visitID) {
        var valueToReturn = undefined;

        $.ajax({
            url: myConfig.baseUrl + "/biotracking/sampleType/getListOfSampleType",
            data: "patientID=" + patientID + "&visitID=" + visitID,
            dataType: "json",
            async: false
        }).done(function (data) {
                valueToReturn = data;
            });

        return valueToReturn;
    }

});

NewSample.service('GenericStudyModel', function () {
    // We could as well use some ajax query to retrieve information from the database
    this.getConditioning = function () {
        return [
            { "CONDITIONING": "PARAFFIN EMBEDDED" },
            { "CONDITIONING": "FROZEN" }
        ]
    };

    this.getLaterality = function () {
        return [
            { "LATERALITY": "LEFT" },
            { "LATERALITY": "RIGHT" }
        ]
    };
});

// study specific
NewSample.service('AphinityModel', function ($http) {

    this.getSampleNumber = function () {
        var valueToReturn = "";
        $.ajax({
            url: myConfig.baseUrl + "/biotracking/aphinity/getSampleNumber",
            dataType: "json",
            async: false
        }).done(function (data) {
                valueToReturn = data;
            });

        return valueToReturn;
    };

    this.getSampleKitID = function () {
        var valueToReturn = "";
        $.ajax({
            url: myConfig.baseUrl + "/biotracking/aphinity/getSampleKitID",
            dataType: "json",
            async: false
        }).done(function (data) {
                valueToReturn = data;
            });

        return valueToReturn;
    };

    this.getEndTaxanes = function () {
        return [
            { "CYCLE_TIMEPOINT": "TARGETED TREATMENT CYCLE 4 (week 10)", "SAMPLE_NUMBER": "953" },
            { "CYCLE_TIMEPOINT": "TARGETED TREATMENT CYCLE 5 (week 13)", "SAMPLE_NUMBER": "954" },
            { "CYCLE_TIMEPOINT": "TARGETED TREATMENT CYCLE 7 (week 19)", "SAMPLE_NUMBER": "955" }
        ]
    };

    this.getBloodTechnical = function () {
        return [
            { "BLOOD_TECHNICAL": "CLINICAL GENOTYPING", "SAMPLE_NUMBER": "999" },
            { "BLOOD_TECHNICAL": "CIRCULATING BIOMARKERS", "SAMPLE_NUMBER": "801" },
        ]
    };
});


NewSample.service('NewSampleValidationModel', function () {

    this.getValidationStatus = function (dataToCollect) {
        var valueToReturn = undefined;

        $.ajax({
            url: myConfig.angularUrl + "/biotracking/biosample/validationNewSample",
            dataType: "json",
            data: dataToCollect,
            async: false,
            type: "POST",
        }).done(function (result) {
                valueToReturn = result.status;
            });

        return valueToReturn;
    }

});