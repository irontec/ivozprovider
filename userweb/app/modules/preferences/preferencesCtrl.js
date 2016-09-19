'use strict';

angular
    .module('Preferences')
    .controller('PreferencesCtrl', function (
        $scope, 
        $timeout,
        $state,
        ngProgress,
        Restangular
    ) {
    
    ngProgress.color('blue');
    ngProgress.start();
    $scope.loading = true;
    $scope.user = {};
    $scope.timeZones = [];
    $scope.assistants = {};
    $scope.bossAssistantActive = false;
    $scope.temp = {};
    
    Restangular.all('time-zones').getList().then(function(response) {
        for (var i = 0; i < response.data.length; i++) {
            $scope.timeZones[i] = {
                'id' : response.data[i].id,
                'tz' : response.data[i].tz
            };
        }
        Restangular.all('users').getList().then(function(response) {
            $scope.assistants = response.data;
            Restangular.all('users').get(1).then(function(response) {
                $scope.user = response.data;
                $scope.user.formType = 'preferences';

                for (var i = 0; i < $scope.timeZones.length; i++) {
                    if ($scope.timeZones[i].id == $scope.user.timezoneId) {
                        $scope.user.timezoneSelect = $scope.timeZones[i];
                        break;
                    }
                }

                $scope.user.doNotDisturb = String($scope.user.doNotDisturb);
                $scope.user.callWaiting = String($scope.user.callWaiting);

                $scope.loading = false;
                ngProgress.complete();
            });
        });
    });
    
    $scope.$watch('user.bossAssistantId', function(data) {
        if (data === 'null' || data === null) {
            $scope.bossAssistantActive = false;
        } else {
            $scope.bossAssistantActive = true;
        }
    });
    
    $scope.save = function() {
        $scope.success = false;
        $scope.error = false;
        $scope.formAction = true;
        
        if ($scope.user.bossAssistantId === 'null') {
            $scope.user.bossAssistantId = null;
        }
        
        ngProgress.start();
        $scope.user.put().then(function(response) {
            
            if (response.status > 400) {

                $scope.formAction = true;
                $scope.error = true;
                
                var errorMessage = response.statusText;
                if (response.data.error !== undefined) {
                    errorMessage = response.data.error;
                }
                $scope.errorMessage = errorMessage;
                $scope.formAction = false;
                
            } else {
                
                $scope.success = true;
                $state.go('app.preferences');
                
            }
            
            ngProgress.complete();
        }, function(response) {
            $scope.formAction = true;
            $scope.error = true;
            $scope.errorMessage = response.data.error;
            $scope.formAction = false;
            ngProgress.complete();
        });
    };
    
});