import TerminalManufacturerItem from '../../fixtures/TerminalManufacturer/getItem.json';
import newTerminalManufacturer from '../../fixtures/TerminalManufacturer/post.json';
import editTerminalManufacturer from '../../fixtures/TerminalManufacturer/put.json';

export const postTerminalManufacturer = () => {
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

  cy.get('header').should('contain', 'Terminal Manufacturers');

  cy.usePactWait('createTerminalManufacturer')
    .its('response.statusCode')
    .should('eq', 201);
};
export const putTerminalManufacturer = () => {
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

  cy.get('header').should('contain', 'Terminal Manufacturers');

  cy.usePactWait(['editTerminalManufacturer'])
    .its('response.statusCode')
    .should('eq', 200);
};
export const deleteTerminalManufacturer = () => {
  cy.intercept('DELETE', '**/api/platform/terminal_manufacturers/*', {
    statusCode: 204,
  }).as('deleteTerminalManufacturer');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Terminal Manufacturers');

  cy.usePactWait(['deleteTerminalManufacturer'])
    .its('response.statusCode')
    .should('eq', 204);
};
