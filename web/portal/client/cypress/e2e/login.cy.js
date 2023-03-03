import user from '../fixtures/Users/userLogin.json';
import wrongUser from '../fixtures/Users/userWrongLogin.json';

describe('client', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('login');

    cy.visit(Cypress.env('APP_DOMAIN'));
  });

  it('logout and login fails with wrong password', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/admin_login',
        response: wrongUser.response,
        matchingRules: wrongUser.matchingRules,
      },
      'wrongUserLogin'
    );

    cy.get('h2').should('contain', 'Login');

    cy.get('input[name=username]')
      .first()
      .type(wrongUser.request.body.username);
    cy.get('input[name=password]').last().type(wrongUser.request.body.password);
    cy.contains('Sign In').click();

    cy.contains('Invalid credentials');

    cy.usePactWait(['wrongUserLogin'])
      .its('response.statusCode')
      .should('eq', 401);
  });

  it('login', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/admin_login',
        response: user.response,
        matchingRules: user.matchingRules,
      },
      'userLogin'
    );

    cy.get('h2').should('contain', 'Login');

    cy.get('input[name=username]').first().type(user.request.body.username);
    cy.get('input[name=password]').last().type(user.request.body.password);
    cy.contains('Sign In').click();

    cy.usePactWait(['userLogin']).its('response.statusCode').should('eq', 200);
  });
});
