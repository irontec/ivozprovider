/**
 */
export const assertNoUsersImportAction = () => {
  cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').should('exist');
  cy.get('li.MuiMenuItem-root').contains('Import users').should('not.exist');
};
