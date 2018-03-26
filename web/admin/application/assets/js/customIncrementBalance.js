;(function load($) {

    if (!$.klear.checkDeps(['$.klearmatrix.genericdialog'],load)) {
        return;
    }

    var __namespace__ = "custom.IncrementBalance";
    $.custom = $.custom || {};

    $.widget("custom.IncrementBalance", $.klearmatrix.genericdialog,  {
        options: {
            data : null,
            moduleName: 'IncrementBalance'
        },
        _create: function() {

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

        _init: function() {

            var self = this;

            $(this.element).moduleDialog("setAsLoading");
            $(this.element).moduleDialog("option", "buttons", this._getButtons());
            $(this.element).moduleDialog("updateContent",this._getDialogContent(),function() {
                self._registerBaseEvents();
                self._registerFieldsEvents();
                self._checkValidality();
            });

            $(this.element).moduleDialog("updateTitle", this._getTitle());

            var options = this._getOptions();
            $.each(options, function(optionName, value) {
                $(self.element).moduleDialog("option", optionName, value);
            });

            $(self.options.parent).klearModule("option","dispatchOptions");
        },

        _checkValidality: function () {

            var self = this;
            var sendButtons = $("#tabs-CompanyBalancesList button");
            if (sendButtons.length < 2) {
                return;
            }

            var sendButton = $(sendButtons.get(0));
            self._disableSubmitButton(sendButton);

            $('input#amount:visible').on('keyup', function (e) {
                if (!e.target.checkValidity()) {
                    self._addErrorStatus($(e.target));
                    return self._disableSubmitButton(sendButton);
                }

                var inputFld = $(e.target);
                if (inputFld.val() < inputFld.attr("min")) {
                    self._addErrorStatus($(e.target));
                    return self._disableSubmitButton(sendButton);
                }

                if (inputFld.val() > inputFld.attr("max")) {
                    self._addErrorStatus($(e.target));
                    return self._disableSubmitButton(sendButton);
                }

                self._removeErrorStatus($(e.target));
                self._enableSubmitButton(sendButton);
            });
        },

        _addErrorStatus: function (target) {
            target.addClass('ui-state-error');
        },
        _removeErrorStatus: function (target) {
            target.removeClass('ui-state-error');
        } ,

        _enableSubmitButton: function(button) {
            button
                .removeAttr("disabled")
                .css("opacity", 1);
        },
        _disableSubmitButton: function(button) {
            button
                .attr("disabled", "disabled")
                .css("opacity", 0.5);
        }
    });

    $.widget.bridge("customIncrementBalance", $.custom.IncrementBalance);

})(jQuery);