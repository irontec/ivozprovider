import BannedAddresses from '../../../../fixtures/Provider/BannedAddress/getCollection.json';

describe('in Administrator', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('vpbx-client-banned-addresses');

    cy.before('');
    cy.contains('Clients').click();
    cy.contains('Virtual PBXs').click();

    cy.get('header').should('contain', 'Virtual PBXs');
    cy.get('td button svg[data-testid="MoreHorizIcon"]').eq(3).click();
    cy.get('li.MuiMenuItem-root').contains('Banned IP addresses').click();
    cy.get('header').should('contain', 'Banned IP addresses');

    cy.get('table').should('contain', BannedAddresses.body[0].ip);
  });

  it('edit disabled', () => {
    cy.get('[data-testid="EditIcon"]').should('not.be.enabled');
  });

  it('delete disabled', () => {
    cy.get('[data-testid="DeleteIcon"]').should('not.be.enabled');
  });
});
