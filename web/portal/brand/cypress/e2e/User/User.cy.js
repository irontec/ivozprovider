import UsersCollection from '../../fixtures/Provider/Users/getCollection.json';

describe('in Users', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Users');
    cy.before();

    cy.get('svg[data-testid="LocalLibraryIcon"]').first().click();
    cy.contains('Users').click();

    cy.get('header').should('contain', 'Users');

    cy.get('table').should('contain', UsersCollection.body[0].name);
  });

  it('cannot interact with users', () => {
    cy.get('svg[data-testid="EditIcon"]')
      .first()
      .parent('button')
      .should('be.disabled');

    cy.get('svg[data-testid="DeleteIcon"]')
      .first()
      .parent('button')
      .should('be.disabled');
  });
});
