const {client} = require('nightwatch-cucumber');
const {defineSupportCode} = require('cucumber');
var list = client.page.list();

defineSupportCode(({Given, Then, When}) => {
  Then(/^I am on "([^"]*)" list$/, (entity) => {
    return list.assertVisibleList(entity);
  });

  Then(/^I am on "([^"]*)" subscreen list$/, (name) => {
    return list.assertVisibleSubscreenList(name);
  });

  Then(/^I can see at least one row$/, () => {
    return list.assertNotEmpty();
  });

  Then(/^I click on "([^"]*)" first elements edit button$/, (entity) => {
    return list.clickOnFirstEditButton(entity);
  });

  Then(/^I click on "([^"]*)" first elements delete button$/, (entity) => {
    return list.clickOnFirstDeleteButton(entity);
  });

  Then(/^I click on "([^"]*)" first elements view button$/, (entity) => {
    return list.clickOnFirstViewButton(entity);
  });

  Then(/^I click on "([^"]*)" first elements "([^"]*)" button$/, (entity, subscreen) => {
    return list.clickOnFirstListButton(subscreen);
  });

  Then(/^I click on add button$/, () => {
    return list.clickOnAddButton();
  });
});
