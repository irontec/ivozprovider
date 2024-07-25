describe('in Language', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Language');
    cy.before();

    cy.get('.title').should('contain', 'Client information');
    cy.get('header button svg[data-testid="SettingsOutlinedIcon"]').click();
  });

  ///////////////////////
  // Modify Spanish Language
  ///////////////////////
  it('can modify Spanish Language', () => {
    cy.get('#mui-component-select-language').click();
    cy.get(`li[data-value=es-ES]`).click();
    cy.get('.title').should('contain', 'Información del cliente');
  });

  ///////////////////////
  // Modify Catalan Language
  ///////////////////////
  it('can modify Catalan Language', () => {
    cy.get('#mui-component-select-language').click();
    cy.get(`li[data-value=ca-ES]`).click();
    cy.get('.title').should('contain', 'Informació del client');
  });

  ///////////////////////
  // Modify Italian Language
  ///////////////////////
  it('can modify Italian Language', () => {
    cy.get('#mui-component-select-language').click();
    cy.get(`li[data-value=it-IT]`).click();
    cy.get('.title').should('contain', 'Informazioni sul cliente');
  });
});
