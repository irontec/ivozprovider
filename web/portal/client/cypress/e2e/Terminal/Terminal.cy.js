import TerminalCollection from '../../fixtures/Terminal/getCollection.json';
import newTerminal from '../../fixtures/Terminal/post.json';
import TerminalItem from '../../fixtures/Terminal/getItem.json';
import editTerminal from '../../fixtures/Terminal/put.json';

describe('in Terminal', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('Terminal');
    cy.before();

    cy.contains('Terminal').click();

    cy.get('h3').should('contain', 'List of Terminales');

    cy.get('table').should('contain', TerminalCollection.body[0].name);
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Terminal', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/client/terminals*',
        response: newTerminal.response,
        matchingRules: newTerminal.matchingRules,
      },
      'createTerminal'
    );

    cy.get('[aria-label=Add]').click();

    cy.fillTheForm(newTerminal.request);

    cy.get('h3').should('contain', 'List of Terminales');

    cy.usePactWait('createTerminal')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Terminal', () => {
    cy.intercept('GET', '**/api/client/terminals/1', {
      ...TerminalItem,
    }).as('getTerminal-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/client/terminals/${editTerminal.response.body.id}`,
        response: editTerminal.response,
      },
      'editTerminal'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    cy.fillTheForm(editTerminal.request);

    cy.contains('List of Terminales');

    cy.usePactWait(['editTerminal'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Terminal', () => {
    cy.intercept('DELETE', '**/api/client/terminals/*', {
      statusCode: 204,
    }).as('deleteTerminal');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Terminales');

    cy.usePactWait(['deleteTerminal'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
