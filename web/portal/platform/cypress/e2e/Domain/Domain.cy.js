import DomainsCollection from '../../fixtures/Provider/Domain/getCollection.json';

describe('in Domains', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Domains');
    cy.before();

    cy.get('svg[data-testid="SipIcon"]').first().click();

    cy.get('header').should('contain', 'SIP domains');

    cy.get('table').should('contain', DomainsCollection.body[0].domain);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('cannot edit SIP domains', () => {
    cy.get('.actions-cell')
      .find('span')
      .eq(0)
      .within(() => {
        cy.get('button').should('be.disabled');
      });
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('cannot delete SIP domains', () => {
    cy.get('.actions-cell')
      .find('span')
      .eq(1)
      .within(() => {
        cy.get('button').should('be.disabled');
      });
  });
});
