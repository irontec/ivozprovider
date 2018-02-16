'use strict';

angular
    .module('Authentication')
    .factory('httpRequestInterceptor', function (Token) {
        return {
            request: function (config) {

                var authType = localStorage.getItem('auth-type');

                if (authType !== null) {

                    // var auth = Token(authType, null, null);
                    var auth = authType + ' ' + localStorage.getItem('auth-token');
                    var authDate = localStorage.getItem('date-' + authType);

                    config.headers['Authorization'] = auth;
                    config.headers['Request-Date'] = authDate;

                }

                return config;

            }
        };
    }).factory('httpResponseInterceptor', function($location) {

        return {
            response: function(response) {
                return response;
            },
            responseError: function(response) {
                if (response.status === 401) {
                    $location.path('/login');
                }
                return response;
            }
        };
    });
