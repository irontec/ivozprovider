const {client} = require('nightwatch-cucumber');
const {defineSupportCode} = require('cucumber');
var edit = client.page.edit();

defineSupportCode(({Given, Then, When}) => {
  Then(/^I click on save button$/, () => {
    return edit.save();
  });

  Then(/^I can see confirmation dialog$/, () => {
    return edit.assertConfirmationDialog();
  });

  Then(/^I can see confirmation dialog within "([^"]*)" seconds or lower$/, (timeoutSeconds) => {
    return edit.assertConfirmationDialog(timeoutSeconds);
  });

  Then(/^I click on close dialog button$/, () => {
    return edit.closeDialog();
  });

  Then(/^I click on close button$/, () => {
    return edit.close();
  });
});
