import BannedAddressesCollection from '../../fixtures/Provider/BannedAddress/getCollection.json';

describe('in Banned Addresses', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('BannedAddresses');
    cy.before();

    cy.get('svg[data-testid="RemoveModeratorIcon"]').first().click();

    cy.get('header').should('contain', 'Antiflood banned IPs');

    cy.get('table').should('contain', BannedAddressesCollection.body[0].ip);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('cannot edit Banned addresses', () => {
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
  it('cannot delete Banned addresses', () => {
    cy.get('.actions-cell')
      .find('span')
      .eq(1)
      .within(() => {
        cy.get('button').should('be.disabled');
      });
  });
});
