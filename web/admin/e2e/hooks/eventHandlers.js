const {client} = require('nightwatch-cucumber');
const {defineSupportCode} = require('cucumber');

defineSupportCode(({After}) => {
  After((scenario, callback) => {
    var dashboard = client.page.dashboard().logout();
    setTimeout(() => { callback() }, 1);
  });
});
