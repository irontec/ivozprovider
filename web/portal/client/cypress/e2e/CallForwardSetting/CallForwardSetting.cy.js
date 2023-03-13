import CallForwardSettingCollection from '../../fixtures/CallForwardSetting/getCollection.json';
import newCallForwardSetting from '../../fixtures/CallForwardSetting/post.json';
import CallForwardSettingItem from '../../fixtures/CallForwardSetting/getItem.json';
import editCallForwardSetting from '../../fixtures/CallForwardSetting/put.json';

describe('in CallForwardSetting', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('CallForwardSetting');
    cy.before();

    cy.contains('Usuarios').click();

    cy.get('h3').should('contain', 'List of Usuarios');

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

    const { enabled, callTypeFilter, ddi, callForwardType } =
      newCallForwardSetting.request;
    cy.fillTheForm({
      enabled,
      callTypeFilter,
      ddi,
      callForwardType,
    });

    cy.get('h3').should('contain', 'List of Opciones de desvío');

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

    const { enabled, callTypeFilter, ddi, callForwardType } =
      editCallForwardSetting.request;
    cy.fillTheForm({
      enabled,
      callTypeFilter,
      ddi,
      callForwardType,
    });

    cy.contains('List of Opciones de desvío');

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

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Opciones de desvío');

    cy.usePactWait(['deleteCallForwardSetting'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
