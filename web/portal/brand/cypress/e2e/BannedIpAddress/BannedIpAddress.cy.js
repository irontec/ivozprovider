import BannedAddressCollection from '../../fixtures/Provider/BannedAddress/getCollection.json';

describe('in Banned Address', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Banned-Addresses');
    cy.before();

    cy.get('svg[data-testid="LocalLibraryIcon"]').first().click();
    cy.contains('Banned IP addresses').click();

    cy.get('header').should('contain', 'Banned IP addresses');

    cy.get('table').should('contain', BannedAddressCollection.body[0].ip);
  });

  it('edit disabled', () => {
    cy.get('[data-testid="EditIcon"]').should('not.be.enabled');
  });

  it('delete disabled', () => {
    cy.get('[data-testid="DeleteIcon"]').should('not.be.enabled');
  });
});
