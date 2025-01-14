import UsersCdrsCollection from '../../fixtures/UsersCdrs/getCollection.json';

describe('UsersCdr', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('UsersCdrs');
    cy.before();

    cy.contains('Calls').click();
    cy.contains('Call registries').click();

    cy.get('header').should('contain', 'Call registries');
    cy.get('table > tbody').should(
      'contain',
      UsersCdrsCollection.body[0].callee
    );
  });

  it('Download', () => {
    cy.intercept('GET', '**/api/client/users_cdrs?_pagination=false', {
      ...UsersCdrsCollection,
    }).as('getUsersCdrsCsv');

    cy.get('svg[data-testid="CloudDownloadIcon"]').click();

    cy.usePactWait(['getUsersCdrsCsv'])
      .its('response.statusCode')
      .should('eq', 200);
  });
});
