'use strict';

angular
    .module('Detours')
    .controller('DetoursNewController', function(
        $scope, 
        $rootScope,
        appConfig,
        $http,
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
    
    $scope.callForwardTypeNoAnswer = false;
    $scope.numberValueShow = false;
    $scope.extensionShow = false;
    $scope.voiceMailUserShow = false;

    $http.get(
        appConfig.urlRest + 'my/profile',
        {headers: {accept: 'application/json'}}
    ).then(function(users) {
        $scope.users = users.data;
        $http.get(
            appConfig.urlRest + 'my/company_extensions',
            {headers: {accept: 'application/json'}}
        ).then(function(extensions) {
            $scope.extensions = extensions.data;
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
                $scope.detour.voiceMailUserId = '';
                $scope.voiceMailUserShow = false;
                
                $scope.detour.extensionId = '';
                $scope.extensionShow = true;
                break;
                
            case 'voicemail':
                $scope.detour.extensionId = '';
                $scope.extensionShow = false;
                $scope.detour.numberValue = '';
                $scope.numberValueShow = false;
                
                $scope.detour.voiceMailUserId = '';
                $scope.voiceMailUserShow = true;
                break;
                
            case 'number':
                $scope.detour.numberValue = '';
                $scope.numberValueShow = true;
                $scope.detour.extensionId = '';
                $scope.extensionShow = false;
                
                $scope.detour.voiceMailUserId = '';
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