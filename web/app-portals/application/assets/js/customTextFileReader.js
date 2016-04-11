;(function load($) {

    if (!$.klear.checkDeps(['$.klearmatrix.genericdialog'],load)) {
        return;
    }

    var __namespace__ = "custom.TextFileReader";
    $.custom = $.custom || {};

    $.widget("custom.TextFileReader", $.klearmatrix.genericdialog,  {
        options: {
            data : null,
            moduleName: 'TextFileReader'
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
                self._initFileSelector();
            });

            $(this.element).moduleDialog("updateTitle", this._getTitle());
            
            var options = this._getOptions();
            $.each(options, function(optionName, value) {
                $(self.element).moduleDialog("option", optionName, value);
            });

            var _parentDispatchOptions = $(self.options.parent).klearModule("option","dispatchOptions");
        },
        _initFileSelector : function() {
            var self = this;
            var $textarea = $(self.options.caller).parents(".container:eq(0)").find("textarea");
            $("input[type=file]",$(this.element)).on('change', function(evt){
                //Retrieve the first (and only!) File from the FileList object
                var f = evt.target.files[0]; 
                if (f) {
                  var r = new FileReader();
                  r.onload = function(e) { 
                      var contents = e.target.result;
                      $textarea.val(contents).trigger("contentUpdate");
                  }
                  r.readAsText(f);
                  window.close();
                } else { 
                  alert("Failed to load file");
                }
                $(self.element).moduleDialog("close");
            })
        
        }
    });

    $.widget.bridge("customTextFileReader", $.custom.TextFileReader);

})(jQuery);