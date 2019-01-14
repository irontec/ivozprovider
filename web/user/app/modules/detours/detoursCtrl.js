'use strict';

angular
    .module('Detours')
    .controller('DetoursCtrl', function (
        $scope, 
        ngProgress,
        appConfig,
        $http
    ) {

    ngProgress.color('blue');
    ngProgress.start();
    $scope.loading = true;

    $scope.callsFSCount = 0;

    $http.get(
        appConfig.urlRest + 'my/call_forward_settings',
        {headers: {accept: 'application/json'}}
    ).then(function(result) {
        $scope.callsFS = result.data;
        $scope.callsFSCount = $scope.callsFS.length;
        ngProgress.complete();
        $scope.loading = false;
    }, function() {
        ngProgress.complete();
        $scope.loading = false;
    });

    $scope.detourTarget = function(detour) {
        var type = detour.targetType;
        var result;
        if (type === 'number') {
            result =
                detour.numberCountry.countryCode
                + detour.numberValue;
        } else if (type === 'extension') {
            result = detour.extension.number;
        } else if (type === 'voicemail') {
            result = detour.voiceMailUser.name;
        } else {
            result = '';
        }

        return result;
    };
    
    $scope.deleteDetour = function(item) {

        $http.delete(
            appConfig.urlRest + 'call_forward_settings/' + item.id,
            {headers: {accept: 'application/json'}}
        ).then(function() {
            var index = $scope.callsFS.indexOf(item);
            $scope.callsFS.splice(index, 1);
            $scope.callsFSCount = $scope.callsFS.length;
        });
    };
    
});
