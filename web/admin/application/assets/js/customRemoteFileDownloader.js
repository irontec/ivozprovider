;(function load($) {

    if (!$.klear.checkDeps(['$.klearmatrix.genericdialog'],load)) {
        return;
    }

    var __namespace__ = "custom.RemoteFileDownloader";
    $.custom = $.custom || {};

    $.widget("custom.RemoteFileDownloader", $.klearmatrix.genericdialog,  {
        options: {
            data : null,
            moduleName: 'RemoteFileDownloader'
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
                self._initDownload();
            });

            $(this.element).moduleDialog("updateTitle", this._getTitle());

            var options = this._getOptions();
            $.each(options, function(optionName, value) {
                $(self.element).moduleDialog("option", optionName, value);
            });

            var _parentDispatchOptions = $(self.options.parent).klearModule("option","dispatchOptions");
        },
        _initDownload: function() {

            var self = this;
            var target = $('a[data-href]', self.element).data('href');
            let response;

            fetch(target)
                .then((resp) => {

                    response = resp;
                    if (resp.status >= 400) {
                        console.error('response', resp);
                        throw 'There was an error';
                    }

                    return resp.blob();
                })
                .then((blob) => {

                    const contentDisposition = response.headers.get('Content-Disposition');
                    const [, fileName] = contentDisposition.split('=');

                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');

                    a.style.display = 'none';
                    a.href = url;
                    // the filename you want
                    a.download = fileName;
                    document.body.appendChild(a);
                    a.click();
                    window.URL.revokeObjectURL(url);

                    $(self.element).html(
                        'File properly downloaded'
                    );

                    setTimeout(
                        () => {
                            const dialog = $(self.element).parents('div.ui-dialog');
                            $('button', dialog).click();
                        },
                        3000
                    );
                })
                .catch((error) => {
                    $(self.element).html(
                        `There was an &nbsp;<strong style="color:red">error&nbsp;${response.status}</strong>`
                    );
                });
        }
    });

    $.widget.bridge("customRemoteFileDownloader", $.custom.RemoteFileDownloader);

})(jQuery);
