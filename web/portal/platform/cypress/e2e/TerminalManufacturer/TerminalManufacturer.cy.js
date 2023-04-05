import TerminalManufacturerCollection from '../../fixtures/TerminalManufacturer/getCollection.json';
import newTerminalManufacturer from '../../fixtures/TerminalManufacturer/post.json';
import TerminalManufacturerItem from '../../fixtures/TerminalManufacturer/getItem.json';
import editTerminalManufacturer from '../../fixtures/TerminalManufacturer/put.json';

describe('in Terminal Manufacturer', () => {
  beforeEach(() => {
    cy.prepareGenericPactInterceptors('TerminalManufacturer');
    cy.before();

    cy.contains('Terminal Manufacturer').click();

    cy.get('h3').should('contain', 'List of Terminal Manufacturer');

    cy.get('table').should(
      'contain',
      TerminalManufacturerCollection.body[0].name
    );
  });

  ///////////////////////
  // POST
  ///////////////////////
  it('add Terminal Manufacturer', () => {
    cy.usePactIntercept(
      {
        method: 'POST',
        url: '**/api/platform/terminal_manufacturers*',
        response: newTerminalManufacturer.response,
        matchingRules: newTerminalManufacturer.matchingRules,
      },
      'createTerminalManufacturer'
    );

    cy.get('[aria-label=Add]').click();

    cy.fillTheForm(newTerminalManufacturer.request);

    cy.get('h3').should('contain', 'List of Terminal Manufacturer');

    cy.usePactWait('createTerminalManufacturer')
      .its('response.statusCode')
      .should('eq', 201);
  });

  ///////////////////////////////
  // PUT
  ///////////////////////////////
  it('edit Terminal Manufacturer', () => {
    cy.intercept('GET', '**/api/platform/terminal_manufacturers/1', {
      ...TerminalManufacturerItem,
    }).as('getTerminalManufacturer-1');

    cy.usePactIntercept(
      {
        method: 'PUT',
        url: `**/api/platform/terminal_manufacturers/${editTerminalManufacturer.response.body.id}`,
        response: editTerminalManufacturer.response,
      },
      'editTerminalManufacturer'
    );

    cy.get('svg[data-testid="EditIcon"]').first().click();

    cy.fillTheForm(editTerminalManufacturer.request);

    cy.contains('List of Terminal Manufacturer');

    cy.usePactWait(['editTerminalManufacturer'])
      .its('response.statusCode')
      .should('eq', 200);
  });

  ///////////////////////
  // DELETE
  ///////////////////////
  it('delete Terminal Manufacturer', () => {
    cy.intercept('DELETE', '**/api/platform/terminal_manufacturers/*', {
      statusCode: 204,
    }).as('deleteTerminalManufacturer');

    cy.get('td > a > svg[data-testid="DeleteIcon"]').first().click();

    cy.contains('Remove element');
    cy.get('div[role=dialog] button')
      .filter(':visible')
      .contains('Delete')
      .click();

    cy.get('h3').should('contain', 'List of Terminal Manufacturer');

    cy.usePactWait(['deleteTerminalManufacturer'])
      .its('response.statusCode')
      .should('eq', 204);
  });
});
