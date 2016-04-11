'use strict';

angular
    .module('Detours')
    .controller('DetoursCtrl', function (
        $scope, 
        ngProgress,
        Restangular
    ) {
    
    ngProgress.color('blue');
    ngProgress.start();
    $scope.loading = true;
    
    $scope.callsFSCount = 0;
    
    Restangular.all('call-forward-settings').getList().then(function(result) {
        $scope.callsFS = result.data;
        $scope.callsFSCount = $scope.callsFS.length;
        ngProgress.complete();
        $scope.loading = false;
    }, function() {
        ngProgress.complete();
        $scope.loading = false;
    });
    
    $scope.detourDestini = function(detour) {
        var type = detour.targetType;
        var resutl;
        if (type === 'number') {
            resutl = detour.numberValue;
        } else if (type === 'extension') {
            resutl = detour.extension;
        } else if (type === 'voicemail') {
            resutl = detour.voiceMailUser;
        } else {
            resutl = '';
        }
        
        return resutl;
    };
    
    $scope.deleteDetour = function(item) {
        item.remove().then(function() {
            var index = $scope.callsFS.indexOf(item);
            $scope.callsFS.splice(index, 1);
            $scope.callsFSCount = $scope.callsFS.length;
        });
    };
    
});