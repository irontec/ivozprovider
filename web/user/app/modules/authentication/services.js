'use strict';

angular
    .module('Authentication')
    .factory('Authentication', Authentication);
            
    Authentication.$inject = ['$http', 'AuthenticationConfig', 'Token'];
    function Authentication($http, AuthenticationConfig, Token) {
        
        var authType = AuthenticationConfig.getAuthType();
        var authUrl = AuthenticationConfig.getAuthUrl();
        
        var service = {};

        service.Login = function (username, password, callback) {

            service.SetCredentials(username, password);
            
            $http
                .post(authUrl, {})
                .success(function (response) {
                    callback(response);
                })
                .error(function (response) {
                    callback(response);
                });

        };

        service.SetCredentials = function (username, password) {
            Token(authType, username, password)
        };

        service.ClearCredentials = function () {
            
            localStorage.clear();
            
            $http.defaults.headers.common.Authorization = '';
            
        };

        return service;
        
    }
    
    angular
    .module('Authentication')
    .provider('AuthenticationConfig', function() {
        
        var provider = {}
        
        /**
         * Type authentication
         */
        provider.type = 'Basic';
        
        provider.setAuthType = function(type) {
            return provider.type = type;
        };
        
        provider.getAuthType = function() {
            return provider.type;
        };
        
        /**
         * Url check valid auth
         */
        provider.url = '/auth/';
        
        provider.setAuthUrl = function(url) {
            return provider.url = url;
        };
        
        provider.getAuthUrl = function() {
            return provider.url;
        };
        
        provider.$get = function() {
            return provider;
        }
        
        return provider;
        
    });