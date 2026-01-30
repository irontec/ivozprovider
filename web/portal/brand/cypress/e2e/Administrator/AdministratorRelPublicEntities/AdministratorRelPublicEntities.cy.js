import AdministratorRelPublicEntitiesCollection from '../../../fixtures/Provider/AdministratorRelPublicEntities/getCollection.json';

describe('in Administrator RelPublic Entities', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Administrator-relPublic-entities');
    cy.before();

    cy.get('svg[data-testid="BusinessIcon"]').click();
    cy.contains('Virtual PBXs').click();
    cy.get('td button svg[data-testid="MoreHorizIcon"]').eq(1).click();
    cy.get('li.MuiMenuItem-root')
      .contains(/^Client's Administrators$/)
      .click();
    cy.get('header').should('contain', "Client's Administrators");

    cy.get('td button svg[data-testid="MoreHorizIcon"]').eq(0).click();
    cy.get('li.MuiMenuItem-root')
      .contains('Administrator access privileges')
      .click();
    cy.get('header').should('contain', 'Administrator access privileges');

    cy.get('thead tr th').first().find('input[type="checkbox"]').click();

    cy.get('table').should(
      'contain',
      AdministratorRelPublicEntitiesCollection.body[0].publicEntity.iden
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('post Grant Write Access', () => {
    cy.intercept('POST', '**/api/brand/administrators/7/grant_all', {
      statusCode: 200,
    }).as('postAdminGrantAll');

    cy.get('svg[data-testid="MoreHorizIcon"]').eq(0).click();
    cy.get('li.MuiMenuItem-root').contains('Grant Write Access').click();

    cy.get('[role="dialog"]').filter(':visible').contains('Accept').click();

    cy.get('header').should('contain', 'Administrator access privileges');

    cy.usePactWait(['postAdminGrantAll'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('post Grant Read Only Access', () => {
    cy.intercept('POST', '**/api/brand/administrators/7/grant_read_only', {
      statusCode: 200,
    }).as('postAdminGrantReadOnly');

    cy.get('svg[data-testid="MoreHorizIcon"]').eq(0).click();
    cy.get('li.MuiMenuItem-root').contains('Grant Read Only Access').click();

    cy.get('[role="dialog"]').filter(':visible').contains('Accept').click();

    cy.get('header').should('contain', 'Administrator access privileges');

    cy.usePactWait(['postAdminGrantReadOnly'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('post Revoke Access', () => {
    cy.intercept('POST', '**/api/brand/administrators/7/revoke_all', {
      statusCode: 200,
    }).as('postAdminRevokeAccess');

    cy.get('svg[data-testid="MoreHorizIcon"]').eq(0).click();
    cy.get('li.MuiMenuItem-root').contains('Revoke Access').click();

    cy.get('[role="dialog"]').filter(':visible').contains('Accept').click();

    cy.get('header').should('contain', 'Administrator access privileges');

    cy.usePactWait(['postAdminRevokeAccess'])
      .its('response.statusCode')
      .should('eq', 200);
  });
});
