'use strict';

angular
    .module('Detours')
    .controller('DetoursNewController', function(
        $scope, 
        $rootScope, 
        Restangular, 
        ngProgress
    ) {
        
    ngProgress.color('blue');
    ngProgress.start();
    $scope.loading = true;
    $scope.formAction = false;
    $scope.success = false;
    $scope.error = false;
    $scope.detour = {};
    
    $scope.callForwardTypeNoAnswer = false;
    $scope.numberValueShow = false;
    $scope.extensionShow = false;
    $scope.voiceMailUserShow = false;
    
    Restangular.all('users').getList().then(function(users) {
        $scope.users = users.data;
        Restangular.all('extensions').getList().then(function(extensions) {
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
            $scope.detour.noAnswerTimeout = '';
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
        
        var callForwardSettings = Restangular.all('call-forward-settings');
        
        ngProgress.start();
        callForwardSettings.post($scope.detour).then(function(resutl) {
            
            if (resutl.status === 404) {
                
                $scope.formAction = true;
                $scope.error = true;
                $scope.errorMessage = resutl.data.error;
                $scope.formAction = false;
                
            } else {
                
                $scope.success = true;
                
            }
            
            ngProgress.complete();
        }, function(resutl) {
            
            $scope.formAction = true;
            $scope.error = true;
            $scope.errorMessage = resutl.data.error;
            $scope.formAction = false;
            
        });
        
    };
    
});