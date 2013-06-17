var SetupPrototype = angular.module('SetupPrototype',[]);

var SetupPrototypeConfig = function($routeProvider){
    $routeProvider
        .when('/', {
            templateUrl : myConfig.angularUrl + '/angularjs/prototype/view/default.html'
        })
        .when("/study",{
            controller : 'StudyController',
            templateUrl : myConfig.angularUrl + '/angularjs/prototype/view/edit_study.html'
        })
        .when('/visit', {
           controller : 'VisitController',
           templateUrl : myConfig.angularUrl + '/angularjs/prototype/view/edit_visit.html'
        })
        .when('/sample', {
           controller : 'SampleController',
           templateUrl : myConfig.angularUrl + '/angularjs/prototype/view/edit_sample.html'
        })
        .when('/form', {
           controller : 'FormController',
           templateUrl : myConfig.angularUrl + '/angularjs/prototype/view/edit_form.html'
        });
};

SetupPrototype.config(SetupPrototypeConfig);
