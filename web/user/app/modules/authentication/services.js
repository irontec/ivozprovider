'use strict';

angular
    .module('Authentication')
    .provider('AuthenticationConfig', function() {

        var provider = {}

        /**
         * Type authentication
         */
        provider.type = '';
        provider.myStatusUrl = '';
        provider.authUrl = '';

        provider.setAuthType = function(type) {
            return provider.type = type;
        };

        provider.getAuthType = function() {
            return provider.type;
        };

        /**
         * Url check valid auth
         */
        provider.setMyStatusUrl = function(url) {
            return provider.myStatusUrl = url;
        };

        provider.getMyStatusUrl = function() {
            return provider.myStatusUrl;
        };

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

angular
    .module('Authentication')
    .factory('Authentication', Authentication);

    Authentication.$inject = ['$http', 'AuthenticationConfig', 'Token', '$q'];
    function Authentication($http, AuthenticationConfig, Token, $q) {
        return new AuthenticationService($http, AuthenticationConfig, Token, $q);
    }

    function AuthenticationService($http, AuthenticationConfig, Token, $q) {

        this.Login = Login;
        this.ClearCredentials = ClearCredentials;

        ///////////////////////////////////////
        //
        ///////////////////////////////////////
        var authUrl = AuthenticationConfig.getAuthUrl();
        var myStatusUrl = AuthenticationConfig.getMyStatusUrl();

        function requestToken (email, password) {

            return $http({
                method: 'POST',
                url: authUrl,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                transformRequest: function(obj) {
                    var str = [];
                    for(var p in obj)
                        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
                    return str.join("&");
                },
                data: {
                    'email': email,
                    'password': password
                }
            });
        }

        function Login(email, password, callback) {

            var deferred = $q.defer();

            function erorrHandler() {
                deferred.reject();
            }

            requestToken(email, password).then(function (response) {
                if (!response.data.token) {
                  throw "Token request error";
                }

                SetCredentials('Bearer', response.data.token);
                return $http.get(myStatusUrl);
            }).then(function (response) {
                if (response.status !== 200) {
                    throw "MyStatus request error";
                }
                deferred.resolve(response.data);
            }).catch(function (response) {
                deferred.reject(response);
            });

            return deferred.promise;
        };

        function SetCredentials(authType, token) {
            Token(authType, token);
        };

        function ClearCredentials() {

            localStorage.clear();
            $http.defaults.headers.common.Authorization = '';
        };
    }
