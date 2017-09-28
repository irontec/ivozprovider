const {client} = require('nightwatch-cucumber');
const {defineSupportCode} = require('cucumber');
let scenarioTimeout = 30 * 1000;

defineSupportCode(({setDefaultTimeout}) => {
    setDefaultTimeout(scenarioTimeout);
});

defineSupportCode(({Given, Then, When}) => {
  var login = client.page.login();

  Given(/^I go to the admin page$/, () => {
    return client
      .url(client.launchUrl)
      .acceptAlert();
  });

  When(/^I send valid admin credentials$/, () => {
    return login
      .sendCredentials(
        client.globals.user,
        client.globals.password
      );
  });

  When(/^I send invalid admin credentials$/, () => {
    return login.sendCredentials('invalidUser', 'invalidPass');
  });

  Then(/^I see a login error message$/, () => {
    return login.assertLoginError();
  });

});
