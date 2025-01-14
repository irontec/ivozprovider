import FaxCollection from '../../fixtures/Fax/getCollection.json';
import FaxItem from '../../fixtures/Fax/getItem.json';

describe('Fax', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Fax');
    cy.before();

    cy.contains('Faxes').click();

    cy.get('header').should('contain', 'Faxes');

    cy.get('table').should('contain', FaxCollection.body[0].name);
  });

  ///////////////////////////////
  // GET
  ///////////////////////////////
  it('get Fax Detail', () => {
    cy.intercept('GET', '**/api/user/my/faxes/1', {
      ...FaxItem,
    }).as('getFaxIn-1');

    cy.get('svg[data-testid="OutboundIcon"]').first().click();
  });
});
