/**
 * Created with JetBrains PhpStorm.
 * User: bluenight
 * Date: 6/17/13
 * Time: 11:29 AM
 * To change this template use File | Settings | File Templates.
 */

SetupPrototype.service('VisitSampleModel',
    function()
    {
        var url = myConfig.baseUrl + '/biotracking/AdmVisitSample';

        this.readAttachedSample = function ($http, study, visitID)
        {
            if (typeof visitID == 'undefined')
                return $http.get(url + '/readAttachedSample?studyID=' + study.ID);
            else
                return $http.get(url + '/readAttachedSample?studyID=' + study.ID + '&visitID='+visitID);
        }
    });
