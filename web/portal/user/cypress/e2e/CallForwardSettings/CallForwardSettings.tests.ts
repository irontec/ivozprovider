import CallForwardSettingItem from '../../fixtures/CallForwardSetting/getItem.json';
import newCallForwardSetting from '../../fixtures/CallForwardSetting/post.json';
import editCallForwardSetting from '../../fixtures/CallForwardSetting/put.json';

export const postCallForwardSetting = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/user/my/call_forward_settings*',
      response: newCallForwardSetting.response,
      matchingRules: newCallForwardSetting.matchingRules,
    },
    'createCallForwardSetting'
  );

  cy.get('[aria-label=Add]').click();

  const { enabled, callTypeFilter, callForwardType, numberCountry } =
    newCallForwardSetting.request;
  cy.fillTheForm({
    enabled,
    callTypeFilter,
    callForwardType,
    numberCountry,
  });

  cy.get('header').should('contain', 'Call forward settings');

  cy.usePactWait('createCallForwardSetting')
    .its('response.statusCode')
    .should('eq', 201);
};
export const putCallForwardSetting = () => {
  cy.intercept('GET', '**/api/user/call_forward_settings/1', {
    ...CallForwardSettingItem,
  }).as('getCallForwardSetting-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/user/call_forward_settings/${editCallForwardSetting.response.body.id}`,
      response: editCallForwardSetting.response,
    },
    'editCallForwardSetting'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  const { enabled, callTypeFilter, callForwardType } =
    editCallForwardSetting.request;
  cy.fillTheForm({
    enabled,
    callTypeFilter,
    callForwardType,
  });

  cy.get('header').contains('Call forward settings');

  cy.usePactWait(['editCallForwardSetting'])
    .its('response.statusCode')
    .should('eq', 200);
};
export const deleteCallForwardSetting = () => {
  cy.intercept('DELETE', '**/api/user/call_forward_settings/*', {
    statusCode: 204,
  }).as('deleteCallForwardSetting');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Call forward settings');

  cy.usePactWait(['deleteCallForwardSetting'])
    .its('response.statusCode')
    .should('eq', 204);
};
