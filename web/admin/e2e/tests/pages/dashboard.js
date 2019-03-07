'use strict';

function dashboard () {

  this.clickOnCta = clickOnCta;
  this.clickOnBrandEmulatorButton = clickOnBrandEmulatorButton;
  this.clickOnCompanyEmulatorButton = clickOnCompanyEmulatorButton;
  this.assertLoggedIn = assertLoggedIn;
  this.logout = logout;
  this.selectEmulatedEntity = selectEmulatedEntity;

  function clickOnCta(entity) {

    var context = 'div.klearMatrixDashboard';
    var jqSelector = context + ' #target-' + entity + 'List';

    return this
      .waitForElementVisible('@dashboardCta')
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
      .waitForElementVisible('@brandEmulatorBtn', 10000)
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

  function selectEmulatedEntity(position) {
    var nthChild = ':nth-child('+ position +')';

    this
      .waitForElementVisible('@emulatorSelectorCombo')
      .click('@emulatorSelectorCombo')
      .click(this.elements.emulatorSelectorOptions.selector + nthChild)
      .click('@dialogSubmitBtn');

    this.api.pause(200);
    this.waitForElementNotPresent('@loadingPanel');
    this.api.pause(50);

    return this;
  }

  function clickOnCompanyEmulatorButton() {
    return this
      .waitForElementVisible('@companyEmulatorBtn')
      .jqueryTrigger(
        this.elements.companyEmulatorBtn.selector,
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
    companyEmulatorBtn: { selector: 'fieldset:nth-child(3) legend span' },
    emulatorSelectorCombo: { selector: '#entitySelectSelectBoxIt' },
    emulatorSelectorOptions: { selector: 'div.ui-dialog ul li' },
    loadingPanel: { selector: 'div.loadingPanel' }
  }
};
