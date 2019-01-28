'use strict';

angular
    .module('Detours')
    .controller('DetoursNewController', function(
        $scope, 
        $rootScope,
        appConfig,
        $http,
        $q,
        ngProgress
    ) {

    ngProgress.color('blue');
    ngProgress.start();
    $scope.loading = true;
    $scope.formAction = false;
    $scope.success = false;
    $scope.error = false;
    $scope.detour = {
        noAnswerTimeout: 0
    };

    $scope.extensions = [];
    $scope.countries = [];

    $scope.callForwardTypeNoAnswer = false;
    $scope.numberValueShow = false;
    $scope.extensionShow = false;
    $scope.voiceMailUserShow = false;

    $http.get(
        appConfig.urlRest + 'my/company_voicemails',
        {headers: {accept: 'application/json'}}
    ).then(function(users) {
        $scope.users = users.data;

        for (var idx in $scope.users) {
            $scope.users[idx].fullName = $scope.users[idx].name + " " + $scope.users[idx].lastname;
        }

        var extensionPromise = $http.get(
            appConfig.urlRest + 'my/company_extensions',
            {headers: {accept: 'application/json'}}
        ).then(function(extensions) {
            $scope.extensions = extensions.data;
        });

        var countryPromise = $http.get(
            appConfig.urlRest + 'countries?_pagination=false&' +  $.param({_order: {'name.es': 'asc'}}),
            {headers: {accept: 'application/json'}}
        ).then(function(countries) {
            for (var idx in countries.data) {
                var item = countries.data[idx];
                $scope.countries.push({
                    id: item.id,
                    name: item.name.es + " (" + item.countryCode + ")"
                });
            }
        });

        var companyCountryPromise = $http.get(
            appConfig.urlRest + 'my/company_country',
            {headers: {accept: 'application/json'}}
        ).then(function(country) {
            $scope.detour.numberCountry= country.data.id;
        });

        $q.all([companyCountryPromise, countryPromise, extensionPromise]).then(function () {
            $scope.loading = false;
            ngProgress.complete();
        });
    });

    $scope.$watch('detour.callForwardType', function(type) {

        if (type === 'noAnswer') {
            $scope.callForwardTypeNoAnswer = true;
        } else {
            $scope.callForwardTypeNoAnswer = false;
            $scope.detour.noAnswerTimeout = 0;
        }
    });

    $scope.$watch('detour.targetType', function(type) {
        
        switch (type) {
            case 'extension':
                $scope.detour.numberValue = '';
                $scope.numberValueShow = false;
                $scope.detour.voiceMailUser = null;
                $scope.voiceMailUserShow = false;
                $scope.detour.extension = null;
                $scope.extensionShow = true;
                break;

            case 'voicemail':
                $scope.detour.extension = null;
                $scope.extensionShow = false;
                $scope.detour.numberValue = '';
                $scope.numberValueShow = false;

                $scope.detour.voiceMailUser = null;
                $scope.voiceMailUserShow = true;
                break;

            case 'number':
                $scope.detour.numberValue = '';
                $scope.numberValueShow = true;
                $scope.detour.extension = null;
                $scope.extensionShow = false;
                
                $scope.detour.voiceMailUser = null;
                $scope.voiceMailUserShow = false;
                break;
        }
    });

    $scope.create = function() {

        $scope.success = false;
        $scope.error = false;
        $scope.formAction = true;

        ngProgress.start();
        $http.post(
            appConfig.urlRest + 'my/call_forward_settings',
            $scope.detour,
            {headers: {accept: 'application/json'}}
        ).then(
            SuccessHandler,
            ErrorHandler
        );

        function SuccessHandler(resutl) {
            if (resutl.status >= 400) {
                ErrorHandler(resutl);
            } else {
                $scope.success = true;
            }
            ngProgress.complete();
        }

        function ErrorHandler(resutl) {
            $scope.formAction = true;
            $scope.error = true;
            $scope.errorMessage = resutl.data.detail;
            $scope.formAction = false;
        }
    };
});
