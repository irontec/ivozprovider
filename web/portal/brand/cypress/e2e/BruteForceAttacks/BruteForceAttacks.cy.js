import BannedAddressCollection from '../../fixtures/Provider/BannedAddress/getCollection.json';

describe('in Brute force attacks', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Brute-force-attacks');
    cy.before();

    cy.get('svg[data-testid="RecentActorsIcon"]').first().click();
    cy.contains('Brute-force attacks').click();

    cy.get('header').should('contain', 'Brute-force attacks');

    cy.get('table').should('contain', BannedAddressCollection.body[1].ip);
  });

  it('edit disabled', () => {
    cy.get('[data-testid="EditIcon"]').should('not.be.enabled');
  });

  it('delete disabled', () => {
    cy.get('[data-testid="DeleteIcon"]').should('not.be.enabled');
  });
});
