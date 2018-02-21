'use strict';

angular
    .module('Detours')
    .controller('DetoursEditController', function(
        $scope,
        Restangular,
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
    
    Restangular.all('users').getList({detour: detourId}).then(function(users) {
        $scope.users = users.data;
        Restangular.all('extensions').getList().then(function(extensions) {
            $scope.extensions = extensions.data;
            Restangular.all('call-forward-settings').get(detourId).then(function(detour) {
                $scope.detour = detour.data;

                detour.data.enabled = '' + detour.data.enabled;

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
        $scope.detour.put().then(function(result) {
            
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
        }, function(result) {
            $scope.formAction = true;
            $scope.error = true;
            $scope.errorMessage = result.data.error;
            $scope.formAction = false;
        });
        
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
