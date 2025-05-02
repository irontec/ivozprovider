import RetailAccountsCollection from '../../fixtures/Provider/RetailAccounts/getCollection.json';
import RetailAccountItem from '../../fixtures/Provider/RetailAccounts/getItem.json';
import newRetailAccount from '../../fixtures/Provider/RetailAccounts/post.json';
import editRetailAccount from '../../fixtures/Provider/RetailAccounts/put.json';

describe('in RetailAccounts', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('RetailAccount');
    cy.before();

    cy.get('svg[data-testid="RoomPreferencesIcon"]').first().click();
    cy.contains('Retail Accounts').click();

    cy.get('header').should('contain', 'Retail Accounts');

    cy.get('table').should('contain', RetailAccountsCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add RetailAccount', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/brand/retail_accounts*',
        response: newRetailAccount.response,
        matchingRules: newRetailAccount.matchingRules,
      },
      'createRetailAccount'
    );

    cy.get('[aria-label=Add]').click();

    const { ...rest } = newRetailAccount.request;

    delete rest.ddiIn;
    delete rest.t38Passthrough;

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Retail Accounts');

    cy.usePactWait(['createRetailAccount'])
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit a RetailAccount', () => {
    cy.usePactIntercept(
      {
        method: 'GET',
        url: '**/api/brand/retail_accounts/1',
        response: { ...RetailAccountItem },
      },
      'getRetailAccount-1'
    );

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/brand/retail_accounts/${editRetailAccount.response.body.id}`,
        response: editRetailAccount.response,
      },
      'editRetailAccount'
    );

    cy.get('svg[data-testid="EditIcon"]').eq(4).click();

    const { ...rest } = editRetailAccount.request;

    delete rest.ddiIn;
    delete rest.t38Passthrough;
    delete rest.proxyUser;

    if (rest.directConnectivity === 'no') {
      delete rest.transport;
    }

    cy.fillTheForm(rest);

    cy.get('header').should('contain', 'Retail Accounts');

    cy.usePactWait(['editRetailAccount'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete RetailAccount', () => {
    cy.intercept('DELETE', '**/api/brand/retail_accounts/1', {
      statusCode: 204,
    }).as('deleteRetailAccount');

    cy.get('td button > svg[data-testid="DeleteIcon"]').eq(4).click();

    cy.contains('Remove element');

    cy.get('div.MuiDialog-container button')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Retail Accounts');

    cy.usePactWait(['deleteRetailAccount'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
