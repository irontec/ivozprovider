'use strict';

function login () {

  this.sendCredentials = sendCredentials;
  this.assertLoginError = assertLoginError;

  function sendCredentials (username, password) {
    return this
      .waitForElementVisible('@usernameFld')
      .setValue('@usernameFld', username)
      .setValue('@passwordFld', password)
      .click('@submitBtn');
  }

  function assertLoginError() {
    return this.waitForElementVisible('@loginErrorMsg')
  }
};

module.exports = {
  commands: [new login()],
  elements: {
    usernameFld: { selector: '#username' },
    passwordFld: { selector: '#password' },
    submitBtn: { selector: 'input[type=submit]' },
    loginErrorMsg: { selector: 'div.loginError' }
  }
};
