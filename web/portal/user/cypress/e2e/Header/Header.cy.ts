describe('Header Avatar Menu', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Header');
    cy.before();
  });

  const openAvatarMenu = () => {
    cy.get('.account').first().click();
  };

  it('shows About and Logout options', () => {
    openAvatarMenu();
    cy.contains('About').should('be.visible');
    cy.contains('Logout').should('be.visible');
  });

  it('does not show QR code when gsQRCode is false', () => {
    openAvatarMenu();
    cy.get('canvas').should('not.exist');
  });

  it('opens About dialog on click', () => {
    openAvatarMenu();
    cy.contains('About').click();
    cy.get('[role="dialog"]').should('be.visible');
    cy.get('[role="dialog"]').contains('Version').should('be.visible');
  });

  it('closes About dialog on Accept', () => {
    openAvatarMenu();
    cy.contains('About').click();
    cy.contains('Accept').click();
    cy.get('[role="dialog"]').should('not.exist');
  });
});
