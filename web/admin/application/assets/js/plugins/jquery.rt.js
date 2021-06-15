;(function load($) {

    if (!$.klear.checkDeps(["$.klearmatrix.module","$.klearmatrix.template.helper"],load)) { return;}
    $.custom = $.custom || {};

    var __namespace__ = "custom.rt";

    $.widget("custom.rt", $.klearmatrix.module,  {
        options: {
            moduleName: 'rt'
        },
        socket: null,
        _create: function(){

            if (!this.instances) {
                $.extend($.custom[this.options.moduleName], {
                    instances: []
                });
            }
            $.custom[this.options.moduleName].instances.push(this.element);

        },
        _getOtherInstances: function() {

            var element = this.element;

            return $.grep($.custom[this.options.moduleName].instances, function(el){
                return el !== element;
            });
        },
        destroy: function() {

            if (this.socket) {
                this.socket.close();
            }

            // remove this instance from $.custom.mywidget.instances
            var element = this.element,
                position = $.inArray(element, $.custom[this.options.moduleName].instances);

            // if this instance was found, splice it off
            if(position > -1){
                $.custom[this.options.moduleName].instances.splice(position, 1);
            }

            // call the original destroy method since we overwrote it
            $.Widget.prototype.destroy.call( this );
        },
        _setOption : function(key, value) {
            $.Widget.prototype._setOption.apply(this,arguments)
        },
        _init: function() {

            var filters = $.tmpl(
                'rt-filters',
                this.options.data,
                $.klearmatrix.template.helper
            );

            this.options.data.filterForm = filters.html();

            var $template = this._loadTemplate(
                this.options.data.template
            );

            $(this.element.klearModule("getPanel")).append($template);

            this._initPlugin();
            this._registerBaseEvents();
        },
        _icons : {
            events: {
                "Trying": '<span title="Call Setup" class="ui-silk inline ui-silk-disconnect"></span>',
                "Proceeding": '<span title="Proceeding" class="ui-silk inline ui-silk-connect"></span>',
                "Early": '<span title="Ringing" class="ui-silk inline ui-silk-bell"></span>',
                "Confirmed": '<span title="In call" class="ui-silk inline ui-silk-user-comment"></span>',
                "Terminated": '<span title="In call" class="ui-silk inline ui-silk-stop"></span>'
            },
            directions: {
                "outbound": '<span title="Outbound" class="ui-silk inline ui-silk-red-arrow"></span>',
                "inbound": '<span title="Inbound" class="ui-silk inline ui-silk-green-arrow"></span>'
            }
        },
        _curConnection : 0,
        _connectStr : [],
        _sock : false,
        _tab : false,
        _initPlugin: function() {

            var self = this;
            var $context = $(this.element.klearModule("getPanel"));

            $(this.element).on("reDispatch", function () {
                if (self.socket) {
                    self.socket.close();
                }
            });

            this._connectionData =  {
                protocol : 'wss',
                host : document.location.hostname,
                port: null,
                resource : false
            };

            this._tab = $("table tbody", $context);
            var _trBase = $(".RtTmpl",this._tab).clone();

            this._tab.on('insertData',function(e,data) {

                $("tr.loading",self._tab).hide();

                var _id = data['ID'];
                if ($("#" + _id, self._tab).length > 0) {
                    var _tr = $("#" + _id, self._tab);

                    if (data.Event === 'UpdateCLID') {
                        $(".party",_tr).html(data.Party);
                    } else if (self._icons.events[data.Event]) {

                        $(".event",_tr).html(
                            self._icons.events[data.Event]
                        );

                        if (data.Event === 'Confirmed') {
                            $(".time",_tr).data('time', data.Time);
                        }

                        if (data.Event === 'Terminated') {
                            self._hideRow(_tr);
                        }
                    }

                    return;

                } else if (Object.keys(data).length > 3 && data.Event !== 'Terminated') {

                    var _callid = data['Call-ID'].replace('@', '-').replace(/\./gi, '_');

                    var _tr = _trBase
                        .clone()
                        .attr('id',_id)
                        .data('callid', _callid)
                        .addClass('info')
                        .show();

                    _tr.appendTo(self._tab);
                    $(this).trigger("emptyness");
                } else {
                    console.log(
                        "Ignore update for unknown call",
                        data.Event
                    );

                    return;
                }

                var operator = data.Carrier
                    ? data.Carrier
                    : data.DdiProvider;

                $(".time",_tr).data('time', data.Time);
                $(".event",_tr).html(
                    self._icons.events[data.Event]
                );
                $(".direction",_tr).html(
                    self._icons.directions[data.Direction]
                );
                $(".copyCallId",_tr).on('click', function () {
                    self.copyTextToClipboard(data['ID']);
                });

                $(".brand",_tr).html(data.Brand);
                $(".operator",_tr).html(operator);
                $(".company",_tr).html(data.Company);

                $(".caller",_tr).html(data.Caller);
                $(".callee",_tr).html(data.Callee);

                //Users
                $(".owner",_tr).html(data.Owner);
                $(".party",_tr).html(data.Party);
            });

            this._tab.on('clear',function(e,data) {
                $(".info",self._tab).remove();
                $("tr.loading",self._tab).show();
            });

            this._tab.on('error',function(e,data) {
                $("tr.feedback",self._tab).hide();
                $("tr.error",self._tab).show();
            });

            this._tab.on('ready',function(e,data) {
                $("tr.connecting",self._tab).hide();
                $("tr.none",self._tab).show();
            });

            this._tab.on('emptyness', function() {
                if ($("tr.info",$(this)).length == 0) {
                    $("tr.none",$(this)).show();
                } else {
                    $("tr.none",$(this)).hide();
                }
            });
            this._connect.apply(this);

            var timeReresh = function () {
                var timestamps = $("tr.info:not(.terminated) .time", self._tab);

                $("#callNum", self._tab.parent()).html(
                    '' + timestamps.length
                );

                var now = (new Date()).getTime() / 1000;

                timestamps.each(function() {
                    var item = $(this);
                    var seconds = Math.max(
                        parseInt(now - parseInt(item.data('time'), 10), 10),
                        0
                    );

                    var hours = parseInt(seconds / 60 / 60);
                    var minutes = parseInt(seconds / 60);

                    minutes -= hours * 60;
                    seconds -= (hours * 60 * 60) + (minutes * 60);

                    hours = hours > 0
                        ? hours + 'h '
                        : ''

                    minutes = minutes > 0
                        ? minutes + 'm '
                        : '';

                    item.html(
                        hours + minutes + seconds + 's'
                    );
                });

                setTimeout(timeReresh, 1000);
            };
            timeReresh();

            this._initFilterForm();
        },
        _initFilterForm: function () {

            var self = this.element;
            var _self = this;
            var panel = this.element.klearModule("getPanel");
            var $applyFilters = $("input[name=applyFilters]", panel);

            $(".klearMatrixFiltering span.addTerm", panel).on('click', function (e, noNewValue) {

                e.preventDefault();
                e.stopPropagation();

                var $holder = $(this).parents(".klearMatrixFiltering");
                var $_term = $("input.term", $holder);
                var $_field = $("select[name=searchField]", $holder);

                var _dispatchOptions = $(self).klearModule("option", "dispatchOptions");

                var fieldName = $_field.val();

                _dispatchOptions.post = _dispatchOptions.post || {};
                _dispatchOptions.post.searchFields = _dispatchOptions.post.searchFields || {};
                _dispatchOptions.post.searchOps = _dispatchOptions.post.searchOps || {};

                _dispatchOptions.post.searchFields[fieldName] = _dispatchOptions.post.searchFields[fieldName] || [];
                _dispatchOptions.post.searchOps[fieldName] = _dispatchOptions.post.searchOps[fieldName] || [];

                if (noNewValue !== true) {

                    if ((($_term.data('autocomplete')) && (!$_term.data('idItem')) ) ||
                        ($_term.val() == '')) {

                        $(this).parents(".filterItem:eq(0)").effect("shake", {times: 3}, 60);
                        return;
                    }

                    $_term.attr("disabled", "disabled");
                    $_field.attr("disabled", "disabled");

                    var isDatePicker = $_term.hasClass('hasDatepicker');
                    if (isDatePicker) {
                        var currentFormat = $_term.datepicker("option", 'dateFormat');
                        $_term.datepicker("option", 'dateFormat', 'yy-mm-dd');
                    }
                    var _newVal = ($_term.data('autocomplete')) ? $_term.data('idItem') : $_term.val();
                    if (isDatePicker) {
                        $_term.datepicker("option", 'dateFormat', currentFormat);
                    }

                    _dispatchOptions.post.searchFields[fieldName].push(_newVal);

                    var _searchOp = 'eq';
                    if ($("select[name=searchOption]", $holder).parent("span").is(":visible")) {
                        _searchOp = $("select[name=searchOption]", $holder).val();
                    }

                    _dispatchOptions.post.searchOps[fieldName].push(_searchOp);

                }

                _dispatchOptions.post.searchAddModifier = $("input[name=addFilters]:checked", panel).length;

                if ($applyFilters.length > 0) {
                    _dispatchOptions.post.applySearchFilters = ( $applyFilters.is(':checked') ) ? 1 : 0;
                } else {
                    _dispatchOptions.post.applySearchFilters = 1;
                }
                _dispatchOptions.post.page = 1;

                $(self)
                    .klearModule("option", "dispatchOptions", _dispatchOptions)
                    .klearModule("reDispatch");
            });

            $(".klearMatrixFiltering", panel).on('keydown', 'input.term', function (e) {

                if (e.keyCode == 13) {
                    // Wait for select event to happed (autocomplete)
                    var $target = $(this);
                    setTimeout(function () {
                        $("span.addTerm", $target.parents(".klearMatrixFiltering")).trigger("click");
                    }, 10);
                    e.preventDefault();
                    e.stopPropagation();
                }
            });

            $(".klearMatrixFiltering input[name=addFilters]", panel).on('change', function (e) {

                if ($(".klearMatrixFiltering .filteredFields .field", panel).length <= 1) {
                    return;
                }

                $("span.addTerm", panel).trigger("click", true);
            });

            $applyFilters.on('change', function (e) {
                e.stopPropagation();
                e.preventDefault();
                $("span.addTerm", panel).trigger("click", true);
            });

            $(".klearMatrixFiltering .filteredFields", panel).on('click', '.ui-silk-cancel', function (e) {

                var fieldName = $(this).parents("span.field:eq(0)").data("field");
                var idxToRemove = $(this).data("idx");
                var _dispatchOptions = $(self).klearModule("option", "dispatchOptions");

                if (!_dispatchOptions.post.searchFields[fieldName]) {
                    return;
                }
                _dispatchOptions.post.searchFields[fieldName].splice(idxToRemove, 1);
                _dispatchOptions.post.searchOps[fieldName].splice(idxToRemove, 1);
                _dispatchOptions.post.page = 1;

                $(self)
                    .klearModule("option", "dispatchOptions", _dispatchOptions)
                    .klearModule("reDispatch");

            });

            $(".klearMatrixFilteringForm", panel).form();

            var currentPlugin = false;
            var originalSearchField = $(".klearMatrixFiltering input.term", panel).clone();

            $(".klearMatrixFiltering select[name=searchField]", panel).on('manualchange.searchValues', function (e, manual) {

                var column = $.klearmatrix.template.helper.getColumn(_self.options.data.columns, $(this).val());

                var availableValues = {};
                var $container = $(".klearMatrixFiltering", panel);
                var searchField = $("input.term", $container);
                var searchOption = $("span.searchOption", $container);

                if (false !== currentPlugin) {

                    searchField[currentPlugin]("destroy");
                    currentPlugin = false;
                }

                var _newField = originalSearchField.clone();
                searchField = searchField.replaceWith(_newField);
                searchField = _newField;

                column.search = column.search || {};

                //TODO: Determinar cuando mostrar el searchOption (=/</>) desde el controlador
                if (column.config && column.config['plugin'] && column.config['plugin'].match(/date|time/g)) {
                    column.search.options = true;
                }

                if (column.search.options) {
                    searchOption.show();
                } else {
                    searchOption.hide();
                }

                $container.find("span.infoShow").remove();
                $container.find("div.infoDiv").remove();

                if (column.search.info) {
                    $("<span />")
                        .attr("class", "infoShow ui-silk ui-silk-help inline")
                        .prependTo($(".filterItem", $container))
                        .on('click', function (e) {
                            if ($('div.infoDiv').is(':visible')) {
                                $('div.infoDiv').slideUp('fast');
                            } else {
                                $('div.infoDiv').slideDown('fast');
                            }
                        });

                    $("<div>" + column.search.info + "</div>")
                        .attr("class", "infoDiv hidden")
                        .prependTo($(".filterItem", $container));
                }

                switch (true) {
                    // un select!
                    case  (column.type == 'select'):
                    case  (column.type == 'multiselect'):
                        var _availableValues = $.klearmatrix.template.helper.getValuesFromSelectColumn(column);

                        var sourcedata = [];
                        $.each(_availableValues, function (i, val) {
                            sourcedata.push({label: val, id: i});
                        });

                        searchField.autocomplete({
                            minLength: 0,
                            source: sourcedata,
                            select: function (event, ui) {
                                searchField.val(ui.item.label);
                                searchField.data('idItem', ui.item.id);
                                return false;
                            }
                        }).data("autocomplete")._renderItem = function (ul, item) {
                            return $("<li></li>")
                                .data("item.autocomplete", item)
                                .append("<a>" + item.label + "</a>")
                                .appendTo(ul);
                        };
                        currentPlugin = 'autocomplete';

                        break;

                    // TODO, hacer que esta configuración venga de serie en column.search
                    case (column.config && typeof column.config['plugin'] == 'string'):
                        var _pluginName = column.config['plugin'];
                        currentPlugin = _pluginName;
                        var _settings = column.config['settings'] || {};
                        searchField[_pluginName](_settings);
                        break;

                    case (column.search.plugin && typeof column.search.plugin == 'string'):
                        var _pluginName = column.config['plugin'];
                        currentPlugin = column.search.plugin;
                        var _settings = column.search.settings || {};
                        searchField[column.search.plugin](_settings);
                        break;
                    default:

                        break;
                }

                if (manual !== true && !$(searchField).hasClass("hasDatepicker")) {
                    searchField.focus();
                }

            }).trigger('manualchange.searchValues', true);

            $(".klearMatrixFiltering select[name=searchField]", panel).trigger("manualchange");

            var $filteredFields = $(".klearMatrixFiltering .filteredFields", panel);
            $(".klearMatrixFiltering .title", panel).on('click', function (e, i) {

                var $searchForm = $(this).parents("form:eq(0)");
                var target = ".filterItem";

                if ($applyFilters.is(':checked') == false
                    && $filteredFields.find('.field').length > 0) {

                    target = ".filteredFields";

                }

                if ($searchForm.hasClass("not-loaded")) {
                    $(target, $searchForm).slideDown(function () {
                        $searchForm.removeClass("not-loaded");
                    });
                } else {
                    $(target, $searchForm).slideUp(function () {
                        $searchForm.addClass("not-loaded");
                    });
                }
            });

            if ($applyFilters.is(':checked') == false
                && $filteredFields.find('.field').length > 0) {

                $filteredFields.css('opacity', '0.5');
                $filteredFields.unbind('click');
                $('.preconfiguredFilters, .filterItem', panel).hide();

                $(".klearMatrixFilteringForm:eq(0)", panel).addClass('not-loaded');
            }
        },
        _hideRow: function(_tr) {
            var self = this;
            _tr.addClass("terminated");
            setTimeout(
                function () {
                    _tr.animate({heigth:'0px',opacity:'0'},1200,function() {
                        $(this).remove();
                        self._tab.trigger("emptyness");
                    });
                },
                3000
            )

        },
        _connect : function() {

            if (!this._connectionData) {
                //TODO catch & drop
                throw 'Unable to connect to RT Server';
                return;
            }

            var url = this._buildConnectionString(this._connectionData);

            try {
                this.socket = this._initWs(url);
            } catch(e) {
                // TODO Handle Connect exceptions
            }
        },
        _initWs (url) {
            var self = this;
            var socket = new WebSocket(url);
            var data = this.options.data;
            var retries = 0;
            var maxRetries = 5;

            function register() {

                let payload = {
                    register: data.channel,
                    auth: data.secret
                };

                socket.send(
                    JSON.stringify(payload)
                );
            }

            socket.onopen = function(e) {

                $("tr.connecting",self._tab).show();
            };

            socket.onmessage = function(event) {

                var payload = event.data;
                switch (payload) {
                    case 'Challenge':

                        if (retries >= maxRetries) {
                            console.error("Unable to register");
                            socket.close();
                        } else if (retries === 0) {

                            retries++;
                            register();

                        } else {
                            setTimeout(
                                function () {
                                    retries++;
                                    register();
                                },
                                1000
                            );
                        }

                        break;

                    case 'Subscribing':
                        self
                            ._tab
                            .trigger('ready');

                        break;

                    default:

                        self._tab.trigger('insertData', JSON.parse(payload));
                }
            };

            socket.onclose = function(event) {
                if (event.wasClean) {
                    console.log(`[ws close] Connection closed cleanly, code=${event.code} reason=${event.reason}`);
                } else {
                    // e.g. server process killed or network down
                    // event.code is usually 1006 in this case
                    console.log('[ws close] Connection died');

                    self
                        ._tab
                        .trigger('error');
                }
            };

            socket.onerror = function(error) {
                self
                    ._tab
                    .trigger('error');
                console.log(`[ws error] ${error.message}`);
            };

            return socket;
        },
        _buildConnectionString : function(data) {

            var port = data.port
                ? ':' + data.port
                : '';

            var response =
                data.protocol
                + '://'
                + data.host
                + port
                + '/wss';

            return response;
        },
        copyTextToClipboard: function (text) {
          if (!navigator.clipboard) {
            return;
          }
          navigator.clipboard.writeText(text).then(function() {
            console.log('Call id copied: ' + text);
          }, function(err) {
            console.error('Could not copy text', err);
          });
        }
    });

    $.widget.bridge("rt", $.custom.rt);

})(jQuery);
