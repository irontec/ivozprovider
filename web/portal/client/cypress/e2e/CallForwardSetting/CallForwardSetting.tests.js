import CallForwardSettingItem from '../../fixtures/CallForwardSetting/getItem.json';
import newCallForwardSetting from '../../fixtures/CallForwardSetting/post.json';
import editCallForwardSetting from '../../fixtures/CallForwardSetting/put.json';
import { CLIENT_TYPE } from '../../support/commands/prepareGenericPactInterceptors';

export const CALL_FORWARD_TYPE = {
  inconditional: 'inconditional',
  noAnswer: 'noAnswer',
  busy: 'busy',
  userNotRegistered: 'userNotRegistered',
};

export const postCallForwardSetting = (
  options = { clientType: CLIENT_TYPE.Vpbx }
) => {
  const { clientType } = options;
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

  const { ...rest } = newCallForwardSetting.request;

  delete rest.user;

  if (clientType === CLIENT_TYPE.Retail) {
    delete rest.callTypeFilter;
  }

  if (
    rest.callForwardType === CALL_FORWARD_TYPE.inconditional ||
    rest.callForwardType === CALL_FORWARD_TYPE.busy ||
    rest.callForwardType === CALL_FORWARD_TYPE.userNotRegistered
  ) {
    delete rest.noAnswerTimeout;
  }

  if (clientType !== CLIENT_TYPE.Vpbx) {
    delete rest.extension;
  }

  if (
    clientType !== CLIENT_TYPE.Vpbx &&
    clientType !== CLIENT_TYPE.Residential
  ) {
    delete rest.voicemail;
  }

  if (clientType !== CLIENT_TYPE.Retail) {
    delete rest.cfwToRetailAccount;
  }

  cy.fillTheForm({
    ...rest,
  });

  cy.get('header').should('contain', 'Call forward settings');

  cy.usePactWait('createCallForwardSetting')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putCallForwardSetting = (
  options = { clientType: CLIENT_TYPE.Vpbx }
) => {
  const { clientType } = options;
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

  const { ...rest } = editCallForwardSetting.request;
  delete rest.user;

  if (clientType === CLIENT_TYPE.Retail) {
    delete rest.callTypeFilter;
  }

  if (
    rest.callForwardType === CALL_FORWARD_TYPE.inconditional ||
    rest.callForwardType === CALL_FORWARD_TYPE.busy ||
    rest.callForwardType === CALL_FORWARD_TYPE.userNotRegistered
  ) {
    delete rest.noAnswerTimeout;
  }

  if (clientType !== CLIENT_TYPE.Vpbx) {
    delete rest.extension;
  }

  if (
    clientType !== CLIENT_TYPE.Vpbx &&
    clientType !== CLIENT_TYPE.Residential
  ) {
    delete rest.voicemail;
  }

  if (clientType !== CLIENT_TYPE.Retail) {
    delete rest.cfwToRetailAccount;
  }

  cy.fillTheForm({
    ...rest,
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
