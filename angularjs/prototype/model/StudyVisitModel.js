/**
 * Created with JetBrains PhpStorm.
 * User: bluenight
 * Date: 6/10/13
 * Time: 1:02 PM
 */

SetupPrototype.service('StudyVisitModel',
    function(){

        var url = myConfig.baseUrl + '/biotracking/AdmStudyVisit';

        this.readFreeVisit = function($http, study)
        {
            return $http.get(url + '/showFreeVisit?studyID=' + study.ID);
        };

        this.readAttachedVisit = function($http, study)
        {
            return $http.get(url + '/showVisit?studyID=' + study.ID);
        };
});
