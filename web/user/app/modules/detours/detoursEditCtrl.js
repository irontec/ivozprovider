'use strict';

angular
    .module('Detours')
    .controller('DetoursEditController', function(
        $scope,
        appConfig,
        $http,
        $q,
        $stateParams,
        ngProgress
    ) {
    
    ngProgress.color('blue');
    ngProgress.start();
    $scope.loading = true;
    var detourId = $stateParams.detourId;
    
    $scope.formDisabled = true;
    $scope.formAction = false;
    $scope.success = false;
    $scope.error = false;

    $scope.extensions = [];
    $scope.countries = [];
    $scope.voicemails = [];

    $scope.callForwardTypeNoAnswer = true;
    $scope.numberValueShow = true;
    $scope.extensionShow = true;
    $scope.voicemailShow = true;

    $http.get(
        appConfig.urlRest + 'my/company_voicemails',
        {headers: {accept: 'application/json'}}
    ).then(function(voicemails) {
        $scope.voicemails = voicemails.data;

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

        var cfwPromise = $http.get(
            appConfig.urlRest + 'call_forward_settings/' + detourId,
            {headers: {accept: 'application/json'}}
        ).then(function(detour) {

            detour.data.enabled = detour.data.enabled
                ? '1'
                : '0';

            $scope.detour = detour.data;
        });

        $q.all([extensionPromise, cfwPromise, countryPromise]).then(function () {
            $scope.formDisabled = false;
            $scope.loading = false;
            ngProgress.complete();
        });

    });
    
    $scope.save = function() {
        
        $scope.success = false;
        $scope.error = false;
        $scope.formAction = true;

        var data = {
          "callForwardType": $scope.detour.callForwardType,
          "callTypeFilter": $scope.detour.callTypeFilter,
          "enabled": $scope.detour.enabled,
          "extension": $scope.detour.extension ? $scope.detour.extension.id : null,
          "id": $scope.detour.id,
          "noAnswerTimeout": $scope.detour.noAnswerTimeout,
          "numberCountry": $scope.detour.numberCountry ? $scope.detour.numberCountry.id : null,
          "numberValue": $scope.detour.numberValue,
          "targetType": $scope.detour.targetType,
          "user": $scope.detour.user ? $scope.detour.user.id : null,
          "voicemail": $scope.detour.voicemail ? $scope.detour.voicemail.id : null,
        };

        ngProgress.start();
        $http.put(
            appConfig.urlRest + 'call_forward_settings/' + detourId,
            data,
            {headers: {accept: 'application/json'}}
        ).then(
            UpdateSuccessHandler,
            UpdateErrorHandler
        );

        function UpdateSuccessHandler (result) {

            if (result.status >= 400) {
                $scope.formAction = true;
                $scope.error = true;
                $scope.errorMessage = result.data.detail;
                $scope.formAction = false;
            } else {
                $scope.success = true;
                $scope.formAction = false;
            }

            ngProgress.complete();
        }

        function UpdateErrorHandler (result) {
            $scope.formAction = true;
            $scope.error = true;
            $scope.errorMessage = result.data.error;
            $scope.formAction = false;
        };
    };

    $scope.$watch('detour.callForwardType', function(type) {
        if (type === 'noAnswer') {
            $scope.callForwardTypeNoAnswer = true;
        } else {
            $scope.callForwardTypeNoAnswer = false;
        }
    });

    $scope.$watch('detour.targetType', function(type) {

        switch (type) {
            case 'extension':
                $scope.extensionShow = true;
                $scope.numberValueShow = false;
                $scope.voicemailShow = false;
                break;

            case 'voicemail':
                $scope.voicemailShow = true;
                $scope.extensionShow = false;
                $scope.numberValueShow = false;
                break;

            case 'number':
                $scope.voicemailShow = false;
                $scope.numberValueShow = true;
                $scope.extensionShow = false;
                break;

            default:
                $scope.voicemailShow = false;
                $scope.numberValueShow = false;
                $scope.extensionShow = false;

                if ($scope.detour) {
                    $scope.detour.targetType = null;
                }
                break;
        }
    });
});
