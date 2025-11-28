import FaxInOutCollection from '../../../fixtures/FaxInOut/getCollection.json';
import FaxInOutItem from '../../../fixtures/FaxInOut/getItem.json';

describe('Fax In', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Fax-Incomingfaxfiles');
    cy.before();

    cy.contains('Faxes').click();

    cy.get('header').should('contain', 'Faxes');

    cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
    cy.get('li.MuiMenuItem-root').contains('Incoming faxfiles').click();

    cy.get('table').should('contain', FaxInOutCollection.body[0].id);
  });

  ///////////////////////////////
  // GET
  ///////////////////////////////
  it('get Fax In Detail', () => {
    cy.intercept('GET', '**/api/user/faxes_in_outs/1', {
      ...FaxInOutItem,
    }).as('getFaxIn-1');

    cy.get('svg[data-testid="PanoramaIcon"]').first().click();
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Fax Int', () => {
    cy.intercept('DELETE', '**/api/user/faxes_in_outs/*', {
      statusCode: 204,
    }).as('deleteFaxIn');

    cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('[role="dialog"]')
      .filter(':visible')
      .contains('Yes, delete it')
      .click();

    cy.get('header').should('contain', 'Faxes');

    cy.usePactWait(['deleteFaxIn'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
