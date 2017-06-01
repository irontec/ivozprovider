const {client} = require('nightwatch-cucumber');
const {defineSupportCode} = require('cucumber');
var dashboard = client.page.dashboard();

defineSupportCode(({Given, Then, When}) => {

  Then(/^I am logged in$/, () => {
    var dashboard = client.page.dashboard();
    return dashboard.assertLoggedIn();
  });

  Then(/^I click on "([^"]*)" CTA$/, (entity) => {
    return dashboard.clickOnCta(entity);
  });

  Then(/^I click on brand emulation button$/, () => {
    return dashboard.clickOnBrandEmulatorButton();
  });

  Then(/^I emulate the brand at position "([^"]*)"$/, (position) => {
    return dashboard.selectBrand(position);
  });

  Then(/^I click on accordion menu number "([^"]*)"$/, (position) => {
    return dashboard.openAccordionMenu(position);
  });
});
