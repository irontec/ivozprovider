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
        appConfig
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
        
        Restangular.all('calls').getList(params, headers).then(function(calls) {
            
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
        return {
            //content: [{a: 1, b: 2}, {c:3, d:4}],
            promise: $http.get(appConfig.urlRest + 'calls', {params: paramsCsv}),
            title: 'llamadas.csv'
        };
        
    };
    
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