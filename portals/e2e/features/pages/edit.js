'use strict';

function edit () {

  this.save = save;
  this.assertConfirmationDialog = assertConfirmationDialog;
  this.close = close;
  this.closeDialog = closeDialog;

  function save() {
    return this
      .waitForElementVisible('@save', 5000)
      .jqueryTrigger(
        this.elements.save.selector,
        'click',
        (success) => {
          this.assert.ok(
            success.match,
            success.selector + ' not found'
          );
        }
      );
  }

  function assertConfirmationDialog() {
    return this
      .waitForElementVisible('@dialog');
  }

  function closeDialog() {
    return this
      .waitForElementVisible('@closeDialog', 5000)
      .jqueryTrigger(
        this.elements.closeDialog.selector,
        'click',
        (success) => {
          this.assert.ok(
            success.match,
            success.selector + ' not found'
          );
        }
      );
  }

  function close() {
    return this
      .waitForElementVisible('@close', 5000)
      .jqueryTrigger(
        this.elements.close.selector,
        'click',
        (success) => {
          this.assert.ok(
            success.match,
            success.selector + ' not found'
          );
        }
      );
  }
};

const currentTab = 'div.ui-tabs-panel:not(.ui-tabs-hide) ';
module.exports = {
  commands: [new edit()],
  elements: {
    dialog: {
      selector: 'div.ui-dialog-buttonset'
    },
    closeDialog: {
      selector: 'div.ui-dialog-buttonset button:first-child'
    },
    close: {
      selector: currentTab + 'div.generalOptionsToolbar a.closeTab'
    },
    save: {
      selector: currentTab + 'div.generalOptionsToolbar a.action'
    }
  }
};
