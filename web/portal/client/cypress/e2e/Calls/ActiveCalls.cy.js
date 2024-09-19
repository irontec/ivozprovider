describe('UsersCdr', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('ActiveCalls');
    cy.before();

    cy.contains('Calls').click();
    cy.contains('Active call').click();

    cy.get('header').should('contain', 'Active call');
  });

  it('loads', () => {
    cy.get('body').should('contain', 'Loading');
  });
});
