angular
    .module('oasisPortals')
    .factory('$blob', function() {
        
        return {
            csvToURL: function(content) {
                
                var blob;
                blob = new Blob([content], {type: 'text/csv;charset=utf-8;'});
                return (window.URL || window.webkitURL).createObjectURL(blob);
                
            },
            sanitizeCSVName: function(name) {
                if (/^[A-Za-z0-9]+\.csv$/.test(name)) {
                    return name;
                }
                if (/^[A-Za-z0-9]+/.test(name)) {
                    return name + ".csv";
                }
                throw new Error("Invalid title fo CSV file : " + name);
            },
            revoke: function(url) {
                return (window.URL || window.webkitURL).revokeObjectURL(url);
            }
        };
        
    }).factory('$click', function() {
        
        return {
            on: function(element) {
                var e = document.createEvent("MouseEvent");
                e.initMouseEvent("click", false, true, window, 0, 0, 0, 0, 0, false, false, false, false, 0, null);
                element.dispatchEvent(e);
            }
        };
        
    }).directive('downloadCsv', function($parse, $click, $blob, $log, $timeout) {
        
        return {
            compile: function($element, attr) {
                
                var fn = $parse(attr.downloadCsv);
                
                return function(scope, element, attr) {
                    
                    element.on('click', function(event) {
                        
                        var a_href, content, title, url, _ref, promise;
                        _ref = fn(scope), content = _ref.content, title = _ref.title, promise = _ref.promise;
                        
                        if (!(title != null)) {
                            $log.warn("Invalid title in download-csv : ", title);
                            return;
                        }
                        
                        var finish = function(contentCsv) {
                            
                            title = $blob.sanitizeCSVName(title);
                            url = $blob.csvToURL(contentCsv);
                            
                            element.append("<a download=\"" + title + "\" href=\"" + url + "\"></a>");
                            a_href = element.find('a')[0];
                            
                            $click.on(a_href);
                            $timeout(function() {$blob.revoke(url);});
                            
                            element[0].removeChild(a_href);
                            
                        };
                        
                        if (content === undefined && promise === undefined) {
                            $log.warn("Invalid content or promise in download-csv");
                            return;
                        }
                        
                        if (content !== undefined) {
                            
                            var csvContent = '';
                            content.forEach(function (infoArray, index) {
                                
                                if (typeof infoArray == 'object') {
                                    var dataString;
                                    var arr = Object.keys(infoArray).map(function (key) {return infoArray[key]});
                                } else {
                                    var arr = infoArray;
                                }
                                
                                dataString = arr.join(';');
                                csvContent += index < content.length ? dataString + '\n' : dataString;
                                
                            });
                            
                            finish(csvContent);
                            
                        } else {
                            
                            promise.then(function(data) {
                                
                                var content = data.data;
                                var csvContent = '';
                                
                                content.forEach(function (infoArray, index) {
                                    
                                    if (typeof infoArray == 'object') {
                                        var dataString;
                                        var arr = Object.keys(infoArray).map(function (key) {return infoArray[key]});
                                    } else {
                                        var arr = infoArray;
                                    }
                                    
                                    dataString = arr.join(';');
                                    csvContent += index < content.length ? dataString + '\n' : dataString;
                                    
                                });
                                
                                finish(csvContent);
                                
                            });
                            
                        }
                        
                    });
                };
            }
        };
    });