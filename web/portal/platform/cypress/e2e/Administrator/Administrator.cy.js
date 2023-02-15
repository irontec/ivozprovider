import AdministratorCollection from '../../fixtures/Administrator/getCollection.json';
import newAdministrator from '../../fixtures/Administrator/post.json';
import AdministratorItem from '../../fixtures/Administrator/getItem.json';
import editAdministrator from '../../fixtures/Administrator/put.json';

describe('in Administrator', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Administrator');
    cy.before();

    cy.contains('Administrador').click();

    cy.get('h3').should('contain', 'List of Administrador');

    cy.get('table').should('contain', AdministratorCollection.body[0].username);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Administrator', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/platform/administrators*',
        response: newAdministrator.response,
        matchingRules: newAdministrator.matchingRules,
      },
      'createAdministrator'
    );

    cy.get('[aria-label=Add]').click();

    cy.fillTheForm(newAdministrator.request);

    cy.get('h3').should('contain', 'List of Administrador');

    cy.usePactWait('createAdministrator')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Administrator', () => {
    cy.intercept('GET', '**/api/platform/administrators/1', {
      ...AdministratorItem,
    }).as('getAdministrator-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/platform/administrators/${editAdministrator.response.body.id}`,
        response: editAdministrator.response,
      },
      'editAdministrator'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    cy.fillTheForm(editAdministrator.request);

    cy.contains('List of Administrador');

    cy.usePactWait(['editAdministrator'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Administrator', () => {
    cy.intercept('DELETE', '**/api/platform/administrators/*', {
      statusCode: 204,
    }).as('deleteAdministrator');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Administrador');

    cy.usePactWait(['deleteAdministrator'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
