const {client} = require('nightwatch-cucumber');
const {defineSupportCode} = require('cucumber');

defineSupportCode(({ After }) => {
    After(() => client.execute(`
      localStorage.clear();
      sessionStorage.clear();
    `).deleteCookies().refresh());
});
