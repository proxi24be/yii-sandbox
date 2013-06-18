/**
 * Created with JetBrains PhpStorm.
 * User: bluenight
 * Date: 6/12/13
 * Time: 4:52 PM
 */

SetupPrototype.service('GenericModel',
    function(){

        var url = myConfig.baseUrl + '/administration/admCRUD';

        this.read = function($http, model)
        // Model is a string.
        {
            // This test is used for not breaking code.
            if (typeof model.model == 'undefined')
                return $http.get(url + '/read?model=' + model);
            else
            {
                // New way to do.
                var param = '';
                for (var prop in model)
                    param = param + prop + '=' + model[prop] + '&'
                return $http.get(url + '/read?'+ param);
            }
        }

        this.create = function($http, model)
        // Model is an object.
        {
            return $http.post(url + '/create', model);
        }

        this.update = function($http, model)
        // Model is an object
        {
            return $http.post(url + '/update', model);
        }
    });
