import LocutionCollection from '../../fixtures/Locution/getCollection.json';
import newLocution from '../../fixtures/Locution/post.json';
import LocutionItem from '../../fixtures/Locution/getItem.json';
import editLocution from '../../fixtures/Locution/put.json';

describe('in Locution', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Locution');
    cy.before();

    cy.contains('Locuciones').click();

    cy.get('h3').should('contain', 'List of Locuciones');

    cy.get('table').should('contain', LocutionCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Locution', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/locutions*',
        response: newLocution.response,
        matchingRules: newLocution.matchingRules,
      },
      'createLocution'
    );

    cy.get('[aria-label=Add]').click();

    const { name } = newLocution.request;
    cy.fillTheForm({
      name,
    });

    cy.get('h3').should('contain', 'List of Locuciones');

    cy.usePactWait('createLocution')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Locution', () => {
    cy.intercept('GET', '**/api/client/locutions/1', {
      ...LocutionItem,
    }).as('getLocution-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/locutions/${editLocution.response.body.id}`,
        response: editLocution.response,
      },
      'editLocution'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    const { name, status } = editLocution.request;
    cy.fillTheForm({
      name,
      status,
    });

    cy.contains('List of Locuciones');

    cy.usePactWait(['editLocution'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Locution', () => {
    cy.intercept('DELETE', '**/api/client/locutions/*', {
      statusCode: 204,
    }).as('deleteLocution');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Locuciones');

    cy.usePactWait(['deleteLocution'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
