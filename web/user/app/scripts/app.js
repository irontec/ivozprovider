'use strict';

/**
 * @ngdoc overview
 * @name oasisNewWebappApp
 * @description
 * # oasisNewWebappApp
 *
 * Main module of the application.
 */

angular.module('CommonViews', []);
angular.module('Authentication', []);

angular.module('Index', []);
angular.module('Calls', []);
angular.module('Detours', []);

angular.module('Account', []);
angular.module('Preferences', []);

var moduleDependencies = [
    'ngAnimate',
    'ngResource',
    'ngSanitize',
    'ngTouch',
    'restangular',
    'ui.router',
    'ngDialog',
    'pascalprecht.translate',
    'ngProgress',
    'brantwills.paging',
    '720kb.datepicker',
    'CommonViews',
    'Authentication',
    'Index',
    'Calls',
    'Detours',
    'Account',
    'Preferences',
    'ja.qr'
];

angular
    .module('oasisPortals', moduleDependencies)
    .config(configureApp)
    .run(init)
    .constant('appConfig', retrieveConstants())
    .provider('configGlobal', function(appConfig) {

        this.$get = function($http, $rootScope) {

            var service = {};
            service.RunConfig = function() {

                return $http.get(appConfig.urlRest + 'my/web_theme').success(function(data) {
                    $rootScope.theme = data.theme;
                    $rootScope.logo = data.logo;
                    $rootScope.portalTitle = data.name
                        ? data.name
                        : 'Ivoz Provider (Artemis)';
                });
            };

            return service;
        };
    });

    function retrieveConstants() {
        var location = window.location;
        return {
            'urlRest': 'https://' + location.hostname + '/api/user/'
        };
    }

    function configureApp (
        $stateProvider,
        $urlRouterProvider,
        RestangularProvider,
        $httpProvider,
        AuthenticationConfigProvider,
        $translateProvider,
        appConfig
    ) {
        $httpProvider.interceptors.push('httpRequestInterceptor');
        $httpProvider.interceptors.push('httpResponseInterceptor');

        AuthenticationConfigProvider.setAuthType('Bearer');
        AuthenticationConfigProvider.setMyStatusUrl(appConfig.urlRest + 'my/status');
        AuthenticationConfigProvider.setAuthUrl(appConfig.urlRest + 'user_login');

        RestangularProvider.setBaseUrl(appConfig.urlRest);
        RestangularProvider.setFullResponse(true);

        RestangularProvider.addResponseInterceptor(function(data, operation, what, url, response/*, deferred*/) {

            var extractedData;
            if (operation === "getList") {
                if (response.status > 400 && response.status < 500) {
                    extractedData = [data];
                } else {
                    extractedData = data;
                }
            } else {
                extractedData = data;
            }
            return extractedData;
        });

        $urlRouterProvider.otherwise('/');

        $stateProvider
            .state('login', {
                url: '/login',
                templateUrl: 'views/login.html',
                controller: 'LoginCtrl'
            })
            .state('app', {
                abstract: true,
                views: {
                    'header': {
                        templateUrl: 'views/commonView/header.html',
                        controller: 'HeaderCtrl'
                    },
                    'footer': {
                        templateUrl: 'views/commonView/footer.html',
                        controller: 'FooterCtrl'
                    },
                    'content': {
                        template: '<ui-view/>'
                    }
                }
            })
            .state('app.index', {
                url: '/',
                templateUrl: 'views/index/index.html',
                controller: 'IndexCtrl'
            })
            .state('app.calls', {
                url: '/calls',
                templateUrl: 'views/calls/calls.html',
                controller: 'CallsCtrl'
            }).state('app.detours', {
                url: '/detours',
                templateUrl: 'views/detours/detours.html',
                controller: 'DetoursCtrl'
            }).state('app.detoursEdit', {
                url: '/detours/{detourId}',
                templateUrl: 'views/detours/edit.html',
                controller: 'DetoursEditController'
            }).state('app.detoursNew', {
                url: '/detour',
                templateUrl: 'views/detours/new.html',
                controller: 'DetoursNewController'
            }).state('app.account', {
                url: '/account',
                templateUrl: 'views/account/account.html',
                controller: 'AccountCtrl'
            }).state('app.preferences', {
                url: '/preferences',
                templateUrl: 'views/preferences/preferences.html',
                controller: 'PreferencesCtrl'
            });

        $translateProvider
            .useStaticFilesLoader({
                prefix: 'languages/locale-',
                suffix: '.json'
            })
            .registerAvailableLanguageKeys(['en', 'es'])
            .useSanitizeValueStrategy('escaped');

        var userLanguage = localStorage.getItem('language');
        if (userLanguage) {
            $translateProvider.preferredLanguage(userLanguage);
        } else {
            $translateProvider.determinePreferredLanguage();
        }
    }

    function init($rootScope, $location, configGlobal, $state) {
        $rootScope.showMenu = false;

        $rootScope.theme = 'default';
        configGlobal.RunConfig();

        $rootScope.$on('$locationChangeStart', function () {

            configGlobal.RunConfig();
            var type = localStorage.getItem('auth-type');

            if ($location.path() !== '/login' && localStorage.getItem('auth-token') === null) {
                $location.path('/login');
            }

            $rootScope.showMenu = true;
            $rootScope.$state = $state;
        });
    }
