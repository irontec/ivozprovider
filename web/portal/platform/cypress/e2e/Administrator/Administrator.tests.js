import AdministratorItem from '../../fixtures/Administrator/getItem.json';
import newAdministrator from '../../fixtures/Administrator/post.json';
import editAdministrator from '../../fixtures/Administrator/put.json';

export const postAdministrator = () => {
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

  const { ...rest } = newAdministrator.request;
  delete rest.active;
  delete rest.canImpersonate;

  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', 'Main operators');

  cy.usePactWait('createAdministrator')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putAdministrator = () => {
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

  const { ...rest } = editAdministrator.request;
  delete rest.canImpersonate;

  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', 'Main operators');

  cy.usePactWait(['editAdministrator'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteAdministrator = () => {
  cy.intercept('DELETE', '**/api/platform/administrators/*', {
    statusCode: 204,
  }).as('deleteAdministrator');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Main operators');

  cy.usePactWait(['deleteAdministrator'])
    .its('response.statusCode')
    .should('eq', 204);
};
