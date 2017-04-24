'use strict';

function dashboard () {

  this.openAccordionMenu = openAccordionMenu;
  this.clickOnCta = clickOnCta;
  this.clickOnBrandEmulatorButton = clickOnBrandEmulatorButton;
  this.assertLoggedIn = assertLoggedIn;
  this.logout = logout;
  this.selectBrand = selectBrand;

  function openAccordionMenu(position) {
    var accordionMenu = this.elements.accordionMenuHeader.selector;
    var position = ':eq('+ (position - 1) +')';
    return this
      .jqueryTrigger(
        accordionMenu + position,
        'click',
        (success) => {
          this.assert.ok(
            success.match,
            success.selector + ' not found'
          );
        }
      )
      .waitForElementVisible('@activeAccordionContent');
  }

  function clickOnCta(entity) {

    var context = 'div.klearMatrixDashboard';
    var jqSelector = context + ' #target-' + entity + 'List';

    return this
      .click('@dashboardCta')
      .waitForElementVisible('@dashboardElements')
      .jqueryTrigger(
        jqSelector,
        ['mousedown', 'mouseup'],
        (success) => {
          this.assert.ok(
            success.match,
            success.selector + ' not found'
          );
        }
      )
      .waitForElementVisible('#tabs-' + entity + 'List');
  }

  function clickOnBrandEmulatorButton() {
    return this
      .waitForElementVisible('@brandEmulatorBtn')
      .jqueryTrigger(
        this.elements.brandEmulatorBtn.selector,
        'click',
        (success) => {
          this.assert.ok(
            success.match,
            success.selector + ' not found'
          );
        }
      )
      .waitForElementVisible('@dialogSubmitBtn');
  }

  function selectBrand(position) {
    var nthChild = ':nth-child('+ position +')';

    return this
      .waitForElementVisible('@brandSelectorCombo')
      .click('@brandSelectorCombo')
      .click(this.elements.brandSelectorOptions.selector + nthChild)
      .click('@dialogSubmitBtn')
      .waitForElementVisible('@loadingPanel', 2000)
      .verify.elementNotPresent('@loadingPanel')
      .api.pause(500);
  }

  function assertLoggedIn () {
    return this
      .waitForElementVisible('@logoutBtn')
      .waitForElementVisible('@dashboardElements');
  }

  function logout () {
    return this
      .click('@logoutBtn');
  }
};

module.exports = {
  commands: [new dashboard()],
  elements: {
    accordionMenuHeader: { selector: 'h2.ui-accordion-header' },
    activeAccordionContent: { selector: 'div.ui-accordion-content-active a' },
    dashboardCta: { selector: '#target-Dashboard' },
    dashboard: { selector: '#tabs-Dashboard' },
    dashboardElements:  { selector: 'div.klearMatrixDashboard fieldset' },
    dialog: { selector: 'div.ui-dialog' },
    dialogSubmitBtn: { selector: 'div.ui-dialog input[type=submit]' },
    logoutBtn: { selector: '#headerToolsbar span.ui-icon-power' },
    brandEmulatorBtn: { selector: 'fieldset:nth-child(2) legend span' },
    brandSelectorCombo: { selector: '#entitySelectSelectBoxIt' },
    brandSelectorOptions: { selector: 'div.ui-dialog ul li' },
    companyEmulatorBtn: { selector: 'fieldset:nth-child(3) legend span' },
    loadingPanel: { selector: 'div.loadingPanel' }
  }
};
