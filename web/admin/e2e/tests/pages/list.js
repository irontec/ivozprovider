'use strict';

function list () {

  this.selectElementAtPosition = selectElementAtPosition;
  this.clickOnFirstEditButton = clickOnFirstEditButton;
  this.clickOnLastEditButton = clickOnLastEditButton;
  this.clickOnFirstDeleteButton = clickOnFirstDeleteButton;
  this.clickOnFooterDeleteButton = clickOnFooterDeleteButton;
  this.clickOnFirstViewButton = clickOnFirstViewButton;
  this.clickOnFirstListButton = clickOnFirstListButton;
  this.clickOnAddButton = clickOnAddButton;
  this.assertVisibleList = assertVisibleList;
  this.assertVisibleSubscreenList = assertVisibleSubscreenList;
  this.assertNotEmpty = assertNotEmpty;

  function clickOnOptionButton(jqSelector, customEvent) {
    return this
      .jqueryTrigger(
        jqSelector,
        customEvent || 'click',
        (success) => {
          this.assert.ok(
            success.match,
            success.selector + ' not found'
          );
        }
      );
  }

  function sanitizeEntityName(entity) {
    return entity[0].toLowerCase() + entity.substring(1);
  }

  /**
   * @param int position starting from 1
   * @returns void
   */
  function selectElementAtPosition (position) {
      position--;
      var jqSelector = 'td.multiItem:visible input:eq('+ position +')';

      return clickOnOptionButton.call(
          this,
          jqSelector,
          ['mousedown', 'mouseup']
      );
  }

  function clickOnFirstEditButton(entity) {
    entity = sanitizeEntityName(entity);
    var jqSelector = 'a[data-screen='+ entity +'Edit_screen]:visible:eq(0)';

    return clickOnOptionButton.call(
      this,
      jqSelector,
      ['mousedown', 'mouseup']
    );
  }


  function clickOnFirstEditButton(entity) {
    entity = sanitizeEntityName(entity);
    var jqSelector = 'a[data-screen='+ entity +'Edit_screen]:visible:eq(0)';

    return clickOnOptionButton.call(
        this,
        jqSelector,
        ['mousedown', 'mouseup']
    );
  }

    function clickOnLastEditButton(entity) {
        entity = sanitizeEntityName(entity);
        var jqSelector = 'a[data-screen='+ entity +'Edit_screen]:visible:last';

        return clickOnOptionButton.call(
            this,
            jqSelector,
            ['mousedown', 'mouseup']
        );
    }


  function clickOnFirstViewButton(entity) {
    entity = sanitizeEntityName(entity);
    var jqSelector = 'a[data-screen='+ entity +'View_screen]:visible:eq(0)';

    return clickOnOptionButton.call(
      this,
      jqSelector,
      ['mousedown', 'mouseup']
    );
  }

  function clickOnFirstListButton(entity) {
    entity = sanitizeEntityName(entity);
    var jqSelector = 'a[data-screen='+ entity +'List_screen]:visible:eq(0)';

    return clickOnOptionButton.call(
      this,
      jqSelector,
      ['mousedown', 'mouseup']
    );
  }

  function clickOnFooterDeleteButton(entity) {
      entity = sanitizeEntityName(entity);
      var jqSelector = 'div.generalOptionsToolbar a[data-dialog='+ entity +'Del_dialog]:visible:eq(0)';
      return clickOnOptionButton.call(this, jqSelector);
  }

  function clickOnFirstDeleteButton(entity) {
    entity = sanitizeEntityName(entity);
    var jqSelector = 'a[data-dialog='+ entity +'Del_dialog]:visible:eq(0)';
    return clickOnOptionButton.call(this, jqSelector);
  }

  function clickOnAddButton() {
    return this
      .waitForElementVisible('@addBtn', 5000)
      .jqueryTrigger(
        this.elements.addBtn.selector,
        ['mousedown', 'mouseup'],
        (success) => {
          this.assert.ok(
            success.match,
            success.selector + ' not found'
          );
        }
      );
  }

  function assertVisibleList(entity) {
    return this
      .waitForElementVisible('#tabs-'+ entity +'List', 10000)
      .waitForElementVisible('@caption', 5000);
  }

  function assertVisibleSubscreenList(name) {
    var jqSelector = 'div.ui-tabs-panel[id^=tabs-'+ name +'List_screen_]';

    return this
      .waitForElementVisible('@caption', 5000)
      .jqueryCount(
        jqSelector,
        (response) => {
          this.assert.ok(
            response.count > 0,
            response.selector + ' not found'
          );
        }
      );
  }

  function assertNotEmpty() {
    return this
      .waitForElementVisible('@rows', 8000)
      .jqueryCount(
        'table.kMatrix tr:visible',
        (response) => {
          this.assert.ok(
            response.count > 1,
            response.selector + ' not found'
          );
        }
      );
  }
};

const currentTab = 'div.ui-tabs-panel:not(.ui-tabs-hide) ';
module.exports = {
  commands: [new list()],
  elements: {
    caption: { selector: currentTab + 'table.kMatrix caption' },
    rows: { selector: currentTab + 'table.kMatrix tr' },
    addBtn: { selector: currentTab + 'div.generalOptionsToolbar a.screen:first-of-type' },
  }
};
