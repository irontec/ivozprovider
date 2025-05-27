import newWebPortal from '../../../fixtures/Provider/WebPortals/post.json';
import editWebPortal from '../../../fixtures/Provider/WebPortals/put.json';

export const postWebPortal = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/brand/web_portals*',
      response: newWebPortal.response,
      matchingRules: newWebPortal.matchingRules,
    },
    'createWebPortals'
  );

  cy.get('[aria-label=Add]').click();

  cy.get('header').should('contain', 'Administration Portals');

  cy.fillTheForm(newWebPortal.request);

  cy.usePactWait(['createWebPortals'])
    .its('response.statusCode')
    .should('eq', 201);
};

export const putWebPortal = () => {
  cy.usePactIntercept(
    {
      method: 'PUT',
      url: '**/api/brand/web_portals/3*',
      response: editWebPortal.response,
      matchingRules: editWebPortal.matchingRules,
    },
    'editWebPortals'
  );

  cy.usePactIntercept(
    {
      method: 'GET',
      url: `**/api/brand/web_portals/3`,
      response: editWebPortal.response,
    },
    'getWebPortals-3'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  cy.get('header').should('contain', 'Administration Portals');

  cy.fillTheForm(editWebPortal.request);

  cy.usePactWait(['editWebPortals'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteWebPortal = () => {
  cy.intercept('DELETE', '**/api/brand/web_portals/*', {
    statusCode: 204,
  }).as('deleteClients');

  cy.get('td svg[data-testid="DeleteIcon"]').first().click();
  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();
};
