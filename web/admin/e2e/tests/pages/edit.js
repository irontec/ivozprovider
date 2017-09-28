'use strict';

function edit () {

  this.save = save;
  this.fillOutFormByFixture = fillOutFormByFixture;
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

  function fillOutFormByFixture(fixture) {

      let fs = require('fs');
      let path = require('path');
      let filePath = path.join(
          __dirname,
          `../dataFixtures/${fixture}.json`
      );

      let formData = JSON.parse(
          fs.readFileSync(filePath, 'utf8')
      );
      return this
        .waitForElementVisible('@save', 5000)
        .jqueryFillOutForm(formData);
  }

  function assertConfirmationDialog(timeoutSeconds) {

    let timeoutMilliseconds;
    if (timeoutSeconds) {
        timeoutMilliseconds = timeoutSeconds * 1000;
    }

    return this
      .waitForElementVisible('@dialog', timeoutMilliseconds);
  }

  function closeDialog() {
    return this
      .waitForElementVisible('@closeDialog', 5000)
      .waitForElementVisible('@secondaryButton', 500)
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
    secondaryButton: {
      selector: 'div.ui-dialog-buttonset button:nth-child(2)'
    },
    close: {
      selector: currentTab + 'div.generalOptionsToolbar a.closeTab'
    },
    save: {
      selector: currentTab + 'div.generalOptionsToolbar a.action'
    }
  }
};
