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

            var $template = $.tmpl(
                this.options.data.template,
                this.options.data,
                $.klearmatrix.template.helper
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

                var _callid =
                    "callid-"
                    + data['Call-ID'].replace('@', '-').replace(/\./gi, '_');

                if ($("#" + _callid, self._tab).length > 0) {
                    var _tr = $("#" + _callid, self._tab);

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
                    var _tr = _trBase
                        .clone()
                        .attr('id',_callid)
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

                var operator = data.CarrierName
                    ? data.CarrierName
                    : data.DdiProviderName;

                $(".time",_tr).data('time', data.Time);
                $(".event",_tr).html(
                    self._icons.events[data.Event]
                );
                $(".direction",_tr).html(
                    self._icons.directions[data.Direction]
                );


                $(".brand",_tr).html(data.BrandName);
                $(".operator",_tr).html(operator);
                $(".company",_tr).html(data.CompanyName);

                $(".caller",_tr).html(data.Caller);
                $(".callee",_tr).html(data.Callee);

                //Users
                $(".owner",_tr).html(data.OwnerName);
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
                $("tr.loading",self._tab).show();
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
        }
    });

    $.widget.bridge("rt", $.custom.rt);

})(jQuery);
