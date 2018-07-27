const {client} = require('nightwatch-cucumber');
const {Given, Then, When} = require('cucumber');
var edit = client.page.edit();

When(/^I fill out the form with "([^"]*)" data fixture$/, (fixture) => {
    return edit.fillOutFormByFixture(fixture);
});

When(/^I compare the form data with "([^"]*)" data fixture$/, (fixture) => {
    return edit.compareFormDataWithFixture(fixture);
});

When(/^I click on save button$/, () => {
  return edit.save();
});

Then(/^I can see confirmation dialog$/, () => {
  return edit.assertConfirmationDialog();
});

Then(/^I can see confirmation dialog within "([^"]*)" seconds or lower$/, (timeoutSeconds) => {
  return edit.assertConfirmationDialog(timeoutSeconds);
});

When(/^I click on close dialog button$/, () => {
  return edit.closeDialog();
});

When(/^I click on close button$/, () => {
  return edit.close();
});

