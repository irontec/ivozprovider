import CallForwardSettingItem from '../../fixtures/CallForwardSetting/getItem.json';
import newCallForwardSetting from '../../fixtures/CallForwardSetting/post.json';
import editCallForwardSetting from '../../fixtures/CallForwardSetting/put.json';

export const postCallForwardSetting = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/client/call_forward_settings*',
      response: newCallForwardSetting.response,
      matchingRules: newCallForwardSetting.matchingRules,
    },
    'createCallForwardSetting'
  );

  cy.get('[aria-label=Add]').click();

  const {
    callTypeFilter,
    callForwardType,
    targetType,
    numberValue,
    friend,
    extension,
    voicemail,
    enabled,
    ddi,
  } = newCallForwardSetting.request;
  cy.fillTheForm({
    callTypeFilter,
    callForwardType,
    targetType,
    numberValue,
    friend,
    extension,
    voicemail,
    enabled,
    ddi,
  });

  cy.get('header').should('contain', 'Call forward settings');

  cy.usePactWait('createCallForwardSetting')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putCallForwardSetting = () => {
  cy.intercept('GET', '**/api/client/call_forward_settings/1', {
    ...CallForwardSettingItem,
  }).as('getCallForwardSetting-1');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/client/call_forward_settings/${editCallForwardSetting.response.body.id}`,
      response: editCallForwardSetting.response,
    },
    'editCallForwardSetting'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  const { enabled, callTypeFilter, ddi, callForwardType } =
    editCallForwardSetting.request;
  cy.fillTheForm({
    enabled,
    callTypeFilter,
    ddi,
    callForwardType,
  });

  cy.get('header').contains('Call forward settings');

  cy.usePactWait(['editCallForwardSetting'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteCallForwardSetting = () => {
  cy.intercept('DELETE', '**/api/client/call_forward_settings/*', {
    statusCode: 204,
  }).as('deleteCallForwardSetting');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Call forward settings');

  cy.usePactWait(['deleteCallForwardSetting'])
    .its('response.statusCode')
    .should('eq', 204);
};
