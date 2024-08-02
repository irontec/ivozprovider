import { putMyAccount } from './Account.tests';

describe('Account', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Account');
    cy.before();

    cy.get('svg[data-testid="AccountCircleIcon"]').first().click();
    cy.get('header').should('contain', 'My Account');
  });

  ///////////////////////
  // PUT
  ///////////////////////
  it('edit My Account', putMyAccount);
});
