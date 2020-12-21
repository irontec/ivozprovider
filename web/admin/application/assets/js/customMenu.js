(function customOasisMenu() {

    if (!window.jQuery) {
        setTimeout(customOasisMenu,50);
        return;
    }
    
    var configParser = {
            raw : '',
            isMine : true,
            type : null,
            id : null,
            name : null,
            setRaw : function(r) {
                this.raw = r;
                this.isMine = true;
                this.id = null;
                this.type = null;
                this.subtype = null;
                this.name = null;
                return this;
            },
            process : function() {
                if (configParser.raw.match(/mine\:false/)) {
                    this.isMine = false;
                }
            },
            getType : function() {
                if (configParser.type === null) {
                    if (configParser.raw.match(/brand\:/)) {
                        configParser.type = 'brand';
                    } else if (configParser.raw.match(/company\:/)) {
                        configParser.type = 'company';
                    } else {
                        configParser.type = false;
                    }
                }
                return configParser.type;
            },
            getSubType : function() {
                if (configParser.subtype === null) {
                    var result = configParser.raw.match(/type\:([^|]+)/);
                    if (result) {
                        configParser.subtype = result[1];
                    }
                }
                return configParser.subtype;
            },
            getName : function() {
                if (configParser.name=== null) {
                    var result = configParser.raw.match(/name\:([^|\]]+)/);
                    if (result) {
                        configParser.name = result[1];
                    }
                }
                return configParser.name;
            },
            getId : function() {
                if (configParser.id === null) {
                    configParser.id = false;
                    
                    if (configParser.getType() == 'brand') {
                        var result = configParser.raw.match(/brand\:([^|]+)/);
                        if (result) {
                            configParser.id = result[1];
                        }
                    } else if (configParser.getType() == 'company') {
                        var result = configParser.raw.match(/company\:([^|]+)/);
                        if (result) {
                            configParser.id = result[1];
                        }
                    }
                    
                }
                return configParser.id;
            }
            
            
    };
    
    var entityChooser = {
            _preloadDialog : null,
            _showPreload : function() {
                this._preloadDialog = $("<div />").html('<i class="fa fa-spinner fa-spin"></i>').dialog({
                    resizable: false,
                    modal: true,
                    draggable: false,
                    stack: true,
                    width:'35%',
                    minHeigth:'250px',
                    dialogClass: 'loginDialog ',
                    closeOnEscape: false,
                });
            },
            _dialog : null,
            _selectorRequest : function(postData, callback, errorCallback) {
                $.klear.request({
                    file: "ExtraInfo",
                    type : 'command',
                    command :"initialData_command",
                    post: postData,
                    external:false
                }, callback, errorCallback);
            },
            dialogOpen : function(event, ui) {
                    var $_dialog = $(this);
                    $_dialog.css("overflow", "visible");
                   
                    var _loader = $(".loader",$_dialog);
                    _loader.css("display","none");
                   
                    var $inpBut = $("input:submit", $_dialog);
                    $inpBut.button();
                   
                    var $searchField = $("select",$(this));
                    
                    var searchRequest = $.klear.buildRequest({
                        file: 'ExtraInfo',
                        type : 'command',
                        command: 'searchEntity_command',
                        namespace: $searchField.data("type"), 
                        post: {}
                    });
                    
                    $searchField.selectBoxIt({
                        theme: "jqueryui",
                        autoWidth: true,
                        dynamicPositioning: false,
                        nativeMousedown: false
            });

                    $_dialog.on('submit','form',function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        $("select", $_dialog).attr("disabled","disabled");
                        $.klear.request({
                            file: 'ExtraInfo',
                            type : 'command',
                            command : 'setData_command',
                            post: {
                                entityType: $searchField.data('type'),
                                remoteId:  $searchField.val() 
                            },
                            external:false
                            }
                        , function(resp) {

                            $("#tabsList li")
                                .filter(function () {
                                    var controller = $(this).data('controller');
                                    return (controller == 'edit' || controller == 'new');
                                })
                                .klearModule("close", {forced: true});

                            $("#tabsList li")
                                .filter(function () {
                                    var controller = $(this).data('controller');
                                    return !controller || controller == 'list';
                                })
                                .klearModule('reDispatch');

                            $.klear.restart({}, false);
                            $_dialog.dialog("destroy").remove();

                        }, function(error) {
                            $_dialog.dialog("destroy").remove();
                            console.log("ERROR", error);
                        });

                    });
            },
            buildDialog : function($h2) {
                
                this._showPreload();    
                this._selectorRequest(
                        {
                            "entityType": $h2.data("type"),
                            "curId": $h2.data("remoteId")
                        },
                        function(response) {
                            
                            entityChooser._preloadDialog.dialog("destroy").remove();
                            
                            entityChooser._dialog = $("<div />").html(response.body).dialog({
                                    resizable: false,
                                    modal: true,
                                    draggable: false,
                                    stack: false,
                                    title: response.title,
                                    width:'35%',
                                    dialogClass: 'loginDialog clipDialog',
                                    closeOnEscape: true,
                                    open : entityChooser.dialogOpen
                            });
                        },
                        function(response) {
                            entityChooser._preloadDialog.dialog("destroy").remove();
                            console.log("ERROR", response);
                            
                            //ERROR!
                        });
                
                
            }
    };
    
    
    var handlerChangerClick = function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        if ($(this).parent().prop("tagName") == "H2") {
            var $metaTag = $(this).parent("h2:eq(0)");
        } else {
            var $metaTag = $(this).parent("legend:eq(0)").parent("fieldset:eq(0)");
        }
        
        entityChooser.buildDialog($metaTag);

    };
    
    var decorateSection = function($acItem, config) {
        $acItem.data("type", config.getType());
        $acItem.data("subtype", config.getSubType());
        $acItem.data("remoteId", config.getId());
        
        if ($acItem.prop("tagName") == "H2") {
            var $content = $acItem.next("div");
        } else {
            var $content = $acItem.children("ul");
        }
        
        if (!config.getId()) {
            $("a.subsection", $content).removeClass("subsection").addClass("forbidden");
            var icon = 'exclamation';
            var buttonTitle = 'Debes seleccionar una entidad';
        } else {
            $("a.forbidden", $content).addClass("subsection").removeClass("forbidden");
            var icon = 'key-go';
            var entity = 'Entidad';
            if (config.getType() == 'company') {
                entity = 'Empresa';
                if (config.getSubType() == 'vpbx') {
                    icon = 'building';
                } else if (config.getSubType() == 'retail') {
                    icon = 'basket';
                } else if (config.getSubType() == 'wholesale') {
                    icon = 'cart';
                } else if (config.getSubType() == 'residential') {
                    icon = 'house';
                }
            } else if (config.getType() == 'brand') {
               icon = 'world';
               entity = 'Marca';
            }
            
            var buttonTitle = entity + ' seleccionada (' +config.getName()+ ')';
        }
        
        var $button = $('<span class="ui-silk inline ui-silk-'+icon+' changeMenuStatus" title="'+buttonTitle+'"></span>');
        $button.on('click', handlerChangerClick);
        
        if ($acItem.prop("tagName") == "H2") {
            $acItem.append($button);
        } else {
            $acItem.children("legend").append($button);
        }
        $button.tooltip();
        
    };
    
    $("body").on("click","a.forbidden",function(e) {
        e.preventDefault();
        e.stopPropagation();
    });
    
    $(document).on('kDashboardLoaded', function(){
        $dashBoardTab = $('#tabs-Dashboard');
        $("fieldset", $dashBoardTab).each(function() {
            var meta = $(this).data("meta")
            if (meta) {
                configParser.setRaw(meta).process(); 
                if (configParser.isMine === false) {
                    decorateSection($(this), configParser);
                }

            }
        });
    });
    
    $(document).on('kMenuLoaded',function() {

        $("#sidebar h2").each(function() {
            var meta = $(this).data("meta")
            if (meta) {

                configParser.setRaw(meta).process(); 
                if (configParser.isMine === false) {
                    decorateSection($(this), configParser);
                }

            }
        });
        
    });
    
})();
