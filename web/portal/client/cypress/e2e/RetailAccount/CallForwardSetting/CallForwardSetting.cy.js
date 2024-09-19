import CallForwardSettingCollection from '../../../fixtures/CallForwardSetting/getCollection.json';
import CallForwardSettingItem from '../../../fixtures/CallForwardSetting/getItem.json';
import newCallForwardSetting from '../../../fixtures/CallForwardSetting/post.json';
import editCallForwardSetting from '../../../fixtures/CallForwardSetting/put.json';

describe('Retail Accounts CallForwardSetting', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Retail-Accounts-CallForwardSetting');
    cy.before();

    cy.contains('Retail Accounts').click();

    cy.get('header').should('contain', 'Retail Accounts');

    cy.get('svg[data-testid="PhoneForwardedIcon"]').first().click();

    cy.get('table').should(
      'contain',
      CallForwardSettingCollection.body[0].numberValue
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add CallForwardSetting', () => {
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
      targetType,
      numberValue,
      friend,
      extension,
      voicemail,
      enabled,
      ddi,
    } = newCallForwardSetting.request;
    cy.fillTheForm({
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
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit CallForwardSetting', () => {
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

    const { enabled, ddi, callForwardType } = editCallForwardSetting.request;
    cy.fillTheForm({
      enabled,
      ddi,
      callForwardType,
    });

    cy.get('header').contains('Call forward settings');

    cy.usePactWait(['editCallForwardSetting'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete CallForwardSetting', () => {
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
  });
});
