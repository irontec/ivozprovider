import AdministratorItem from '../../fixtures/Provider/Administrator/getItem.json';
import newAdministrator from '../../fixtures/Provider/Administrator/post.json';
import editAdministrator from '../../fixtures/Provider/Administrator/put.json';

export const postAdministrator = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/administrators*',
      response: newAdministrator.response,
      matchingRules: newAdministrator.matchingRules,
    },
    'createAdministrator'
  );

  cy.get('[aria-label=Add]').click();

  const { ...rest } = newAdministrator.request;
  delete rest.active;
  delete rest.canImpersonate;
  delete rest.company;

  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', "Client's Administrators");

  cy.usePactWait('createAdministrator')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putAdministrator = () => {
  cy.intercept('GET', '**/api/brand/administrators/7', {
    ...AdministratorItem,
  }).as('getAdministrator-7');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/administrators/${editAdministrator.response.body.id}`,
      response: editAdministrator.response,
    },
    'editAdministrator'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  const { ...rest } = editAdministrator.request;
  delete rest.canImpersonate;
  delete rest.company;

  cy.fillTheForm({ ...rest });

  cy.get('header').should('contain', "Client's Administrators");

  cy.usePactWait(['editAdministrator'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const putActiveAdministratorEmptyPassword = () => {
  cy.intercept('GET', '**/api/brand/administrators/7', {
    ...AdministratorItem,
  }).as('getAdministrator-7');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/brand/administrators/${editAdministrator.response.body.id}`,
      response: editAdministrator.response,
    },
    'editAdministrator'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  const { ...rest } = editAdministrator.request;
  delete rest.canImpersonate;
  delete rest.company;

  rest.active = true;
  rest.pass = ' ';
  cy.fillTheForm({ ...rest });

  cy.get('div[role="alert"]')
    .find('ul li')
    .invoke('text')
    .then((errorText) => {
      cy.log('Error message:', errorText);
      expect(errorText).to.equal(
        'Password: Password cannot be empty in an active user'
      );
    });
};

export const deleteAdministrator = () => {
  cy.intercept('DELETE', '**/api/brand/administrators/*', {
    statusCode: 204,
  }).as('deleteAdministrator');

  cy.get('td button svg[data-testid="MoreHorizIcon"]').first().click();
  cy.get('li.MuiMenuItem-root').contains('Delete').click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', "Client's Administrators");

  cy.usePactWait(['deleteAdministrator'])
    .its('response.statusCode')
    .should('eq', 204);
};
