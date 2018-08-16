const {client} = require('nightwatch-cucumber');
const {Given, Then, When} = require('cucumber');
var list = client.page.list();

Then(/^I am on "([^"]*)" list$/, (entity) => {
  return list.assertVisibleList(entity);
});

Then(/^I am on "([^"]*)" subscreen list$/, (name) => {
  return list.assertVisibleSubscreenList(name);
});

Then(/^I can see at least one row$/, () => {
  return list.assertNotEmpty();
});

When(/^I select element at position "([^"]*)"$/, (position) => {
    return list.selectElementAtPosition(position);
});

When(/^I click on "([^"]*)" first elements edit button$/, (entity) => {
  return list.clickOnFirstEditButton(entity);
});

When(/^I click on "([^"]*)" last elements edit button$/, (entity) => {
    return list.clickOnLastEditButton(entity);
});

When(/^I click on "([^"]*)" first elements delete button$/, (entity) => {
  return list.clickOnFirstDeleteButton(entity);
});

When(/^I click on "([^"]*)" delete button in the footer$/, (entity) => {
    return list.clickOnFooterDeleteButton(entity);
});

When(/^I click on "([^"]*)" first elements view button$/, (entity) => {
  return list.clickOnFirstViewButton(entity);
});

When(/^I click on "([^"]*)" first elements "([^"]*)" button$/, (entity, subscreen) => {
  return list.clickOnFirstListButton(subscreen);
});

When(/^I click on add button$/, () => {
  return list.clickOnAddButton();
});

