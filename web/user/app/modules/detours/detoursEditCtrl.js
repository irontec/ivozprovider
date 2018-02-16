'use strict';

angular
    .module('Detours')
    .controller('DetoursEditController', function(
        $scope,
        appConfig,
        $http,
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
    
    $scope.callForwardTypeNoAnswer = true;
    $scope.numberValueShow = true;
    $scope.extensionShow = true;
    $scope.voiceMailUserShow = true;

    $http.get(
        appConfig.urlRest + 'my/company_voicemails',
        {headers: {accept: 'application/json'}}
    ).then(function(users) {
        $scope.users = users.data;

        for (var idx in $scope.users) {
            $scope.users[idx].fullName = $scope.users[idx].name + " " + $scope.users[idx].lastname;
        }

        $http.get(
            appConfig.urlRest + 'my/company_extensions',
            {headers: {accept: 'application/json'}}
        ).then(function(extensions) {
            $scope.extensions = extensions.data;
            $http.get(
                appConfig.urlRest + 'call_forward_settings/' + detourId,
                {headers: {accept: 'application/json'}}
            ).then(function(detour) {
                $scope.detour = detour.data;
                $scope.formDisabled = false;
                $scope.loading = false;
                ngProgress.complete();
            });
        });
    });
    
    $scope.save = function() {
        
        $scope.success = false;
        $scope.error = false;
        $scope.formAction = true;
        
        ngProgress.start();
        $http.put(
            appConfig.urlRest + 'call_forward_settings/' + detourId,
            $scope.detour,
            {headers: {accept: 'application/json'}}
        ).then(
            UpdateSuccessHandler,
            UpdateErrorHandler
        );

        function UpdateSuccessHandler (result) {

            if (result.status === 404) {
                $scope.formAction = true;
                $scope.error = true;
                $scope.errorMessage = result.data.error;
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
                $scope.voiceMailUserShow = false;
                break;

            case 'voicemail':
                $scope.voiceMailUserShow = true;
                $scope.extensionShow = false;
                $scope.numberValueShow = false;
                break;

            case 'number':
                $scope.voiceMailUserShow = false;
                $scope.numberValueShow = true;
                $scope.extensionShow = false;
                break;

            default:
                break;
        }
    });
});