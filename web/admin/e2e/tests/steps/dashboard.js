const {client} = require('nightwatch-cucumber');
const {defineSupportCode} = require('cucumber');
var dashboard = client.page.dashboard();

defineSupportCode(({Given, Then, When}) => {

  Given(/^I am logged in$/, () => {
    var dashboard = client.page.dashboard();
    return dashboard.assertLoggedIn();
  });

  When(/^I click on "([^"]*)" CTA$/, (entity) => {
    return dashboard.clickOnCta(entity);
  });

  When(/^I click on brand emulation button$/, () => {
    return dashboard.clickOnBrandEmulatorButton();
  });

  When(/^I emulate the brand at position "([^"]*)"$/, (position) => {
    return dashboard.selectEmulatedEntity(position);
  });

  When(/^I click on company emulation button$/, () => {
    return dashboard.clickOnCompanyEmulatorButton();
  });

  When(/^I emulate the company at position "([^"]*)"$/, (position) => {
    return dashboard.selectEmulatedEntity(position);
  });
});
