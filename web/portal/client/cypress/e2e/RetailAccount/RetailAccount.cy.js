import RetailAccountCollection from '../../fixtures/RetailAccount/getCollection.json';
import RetailAccountItem from '../../fixtures/RetailAccount/getItem.json';
import editRetailAccount from '../../fixtures/RetailAccount/put.json';
import { CLIENT_TYPE } from '../../support/commands/prepareGenericPactInterceptors';

describe('Retail Account', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Retail-Accounts', {
      clientType: CLIENT_TYPE.Retail,
    });
    cy.before();

    cy.contains('Retail Accounts').click();

    cy.get('header').should('contain', 'Retail Accounts');

    cy.get('table').should('contain', RetailAccountCollection.body[0].name);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Retail Account', () => {
    cy.intercept('GET', '**/api/client/retail_accounts/1', {
      ...RetailAccountItem,
    }).as('getRetailAccount-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/retail_accounts/${editRetailAccount.response.body.id}`,
        response: editRetailAccount.response,
      },
      'editRetailAccount'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { description, transformationRuleSet, outgoingDdi } =
      editRetailAccount.request;
    cy.fillTheForm({
      description,
      transformationRuleSet,
      outgoingDdi,
    });

    cy.contains('Retail Accounts');

    cy.usePactWait(['editRetailAccount'])
      .its('response.statusCode')
      .should('eq', 200);
  });
});
