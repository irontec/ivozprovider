const {client} = require('nightwatch-cucumber');
const {Given, Then, When, defineSupportCode} = require('cucumber');
let scenarioTimeout = 30 * 1000;

defineSupportCode(({setDefaultTimeout}) => {
    setDefaultTimeout(scenarioTimeout);
});

var login = client.page.login();

Given(/^I am on the Dashboard$/, goToDashboard);
Given(/^I go to the admin page$/, goToAdminPage.bind(this, client.launchUrl));
Given(
    /^I go to the brand admin page$/,
    goToAdminPage.bind(
        this,
        client.globals.brand.portal
    )
);
Given(
    /^I go to the client admin page$/,
    goToAdminPage.bind(
        this,
        client.globals.client.portal
    )
);
When(
    /^I send valid admin credentials$/,
    sendValidAdminCredentials.bind(
        this,
        client.globals.user,
        client.globals.password
    )
);
When(
    /^I send valid brand admin credentials$/,
    sendValidAdminCredentials.bind(
        this,
        client.globals.brand.user,
        client.globals.brand.password
    )
);
When(
    /^I send valid client admin credentials$/,
    sendValidAdminCredentials.bind(
        this,
        client.globals.client.user,
        client.globals.client.password
    )
);
When(/^I send invalid admin credentials$/, () => {
return login.sendCredentials('invalidUser', 'invalidPass');
});

Then(/^I see a login error message$/, () => {
return login.assertLoginError();
});

function goToDashboard(resolve) {

  client.url((currentUrl) => {
    if (currentUrl.value == client.launchUrl) {
        return client
            .execute(`
              $(".ui-tabs-nav .ui-icon-close").click();
              $("a.ui-dialog-titlebar-close").click();
              $("#footerbar a.subsection").trigger('mousedown').trigger('mouseup');
              setTimeout( () => { $("#tabsList").css("margin-left", 0); }, 50 );
            `).waitForElementVisible('.ui-tabs-nav .ui-icon-close', 5000);
    }

    goToAdminPage(client.launchUrl);
    sendValidAdminCredentials(
        client.globals.user,
        client.globals.password
    );
    resolve(null, client);
  });

  resolve(null, client);
}

/**
 * @param string url
 */
function goToAdminPage(url) {

  return client
      .execute(`
            localStorage.clear();
            sessionStorage.clear();
      `)
      .deleteCookies()
      .url(url)
      .acceptAlert();
}

function sendValidAdminCredentials(user, password) {

  return login
      .sendCredentials(
          user,
          password
      );
}

