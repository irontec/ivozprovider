'use strict';

angular
    .module('Calls')
    .controller('CallsCtrl', function (
        $scope,
        Restangular, 
        ngDialog, 
        $translate, 
        ngProgress,
        $http, 
        appConfig,
        $q
    ) {
    
    $scope.formData = {};
    
    ngProgress.color('blue');
    ngProgress.start();
    $scope.loading = true;
    
    $scope.page = 1;
    $scope.pageSize = 10;
    
    $scope.callsParams = {
        order: '',
        search: {},
        csv: false
    };
    
    var loadCalls = function (page) {
        ngProgress.start();
        
        var params = $scope.callsParams;
        params.csv = false;
        
        var headers;
        if (page === undefined) {
            headers = {page: 0};
        } else {
            headers = {page: page};
        }

        $http.get(
            appConfig.urlRest + 'my/call_history',
            {headers: {accept: 'application/json'}}
        ).then(function(calls) {
            if (calls.status > 400) {
                $scope.totalItems = 0;
                $scope.calls = {};
            } else {
                $scope.totalItems = calls.headers('totalitems');
                $scope.calls = calls.data;
            }

            ngProgress.complete();
            $scope.loading = false;
        }, function() {
            ngProgress.complete();
            $scope.loading = false;
        });
        
    };
    
    loadCalls();
    
    $scope.callsOrder = function(newOrder) {
        
        if (newOrder + ' DESC' === $scope.callsParams.order) {
            
            $scope.callsParams.order = newOrder + ' ASC';
        } else {
            
            $scope.callsParams.order = newOrder + ' DESC';
        }
        
        loadCalls();
    };

    $scope.DoCtrlPagingAct = function(text, page) {
        loadCalls(page);
    };

    $scope.clickToOpen = function(item) {
        $scope.ngDialogData = item;
        ngDialog.open({
            template: 'views/calls/call-dialog.html',
            scope: $scope
        });
    };

    $scope.getCallsToCsv = function() {
        var paramsCsv = $scope.callsParams;
        paramsCsv.csv = true;

        var defered = $q.defer();
        var promise = defered.promise;

        $http
            .get(appConfig.urlRest + 'calls', {params: paramsCsv})
            .then(function (data) {
                data.data = filterCsvData(data.data);
                defered.resolve(data);
            });

        return {
            //content: [{a: 1, b: 2}, {c:3, d:4}],
            promise: promise,
            title: 'llamadas.csv'
        };
    };

    function filterCsvData(data) {

        for(var idx in data) {
            data[idx] = {
                date: data[idx].calldate,
                src: data[idx].aParty,
                dst: data[idx].bParty,
                duration: data[idx].duration,
                type: data[idx].type,
                subtype: data[idx].subtype
            }
        }

        return data;
    }
    
    $scope.dateNow = moment().format('YYYY/MM/DD');
    
    $scope.viewForm = false;
    $scope.showForm = function() {
        $scope.viewForm = !$scope.viewForm;
    };
    
    $scope.search = function() {
        $scope.page = 1;
        $scope.callsParams.search = $scope.formData;
        loadCalls();
    };
    
    $scope.reset = function() {
        $scope.formData = {};
        $scope.callsParams.search = $scope.formData;
        loadCalls();
    };
    
    $scope.getFormatDate = function(date) {
        return moment(date).format('DD-MM-YYYY HH:mm:ss');
    };
    
    $scope.getDuration = function(time) {
        return parseInt(time) + ' s';
    };
    
});