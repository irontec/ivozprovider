const {client} = require('nightwatch-cucumber');
const {defineSupportCode} = require('cucumber');
let scenarioTimeout = 30 * 1000;

defineSupportCode(({setDefaultTimeout}) => {
    setDefaultTimeout(scenarioTimeout);
});

defineSupportCode(({Given, Then, When}) => {
  var login = client.page.login();

  Given(/^I am on the Dashboard$/, goToDashboard);
  Given(/^I go to the admin page$/, goToAdminPage);
  When(/^I send valid admin credentials$/, sendValidAdminCredentials);
  When(/^I send invalid admin credentials$/, () => {
    return login.sendCredentials('invalidUser', 'invalidPass');
  });

  Then(/^I see a login error message$/, () => {
    return login.assertLoginError();
  });

  function goToDashboard(resolve) {

      client.url((currentUrl) => {
          if (currentUrl.value == client.launchUrl) {
            return client.execute(`
              $(".ui-tabs-nav .ui-icon-close").click();
              $("#footerbar a.subsection").trigger('mousedown').trigger('mouseup');
            `);
          } else {
            sendValidAdminCredentials(
                goToAdminPage()
            );
          }
          resolve(null, client);
      });

      resolve(null, client);
  }

  function goToAdminPage() {
      return client
          .execute(`
                localStorage.clear();
                sessionStorage.clear();
          `)
          .deleteCookies()
          .url(client.launchUrl)
          .acceptAlert();
  }

  function sendValidAdminCredentials() {
      return login
          .sendCredentials(
              client.globals.user,
              client.globals.password
          );
  }
});
