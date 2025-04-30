import { putMyPreferences } from './Preferences.tests';

describe('Preferences', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Preference');
    cy.before();

    cy.get('svg[data-testid="ManageAccountsIcon"]').first().click();
    cy.get('header').should('contain', 'My Preferences');
  });

  ///////////////////////
  // PUT
  ///////////////////////
  it('edit My Account', putMyPreferences);
});
