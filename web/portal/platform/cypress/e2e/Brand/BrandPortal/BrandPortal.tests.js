import newWebPortal from '../../../fixtures/Provider/WebPortal/post.json';
import editWebPortal from '../../../fixtures/Provider/WebPortal/put.json';

export const postBrandPortal = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/platform/web_portals*',
      response: newWebPortal.response,
      matchingRules: newWebPortal.matchingRules,
    },
    'createWebPortals'
  );

  cy.get('[aria-label=Add]').click();

  cy.get('header').should('contain', 'Brand Portals');

  cy.fillTheForm(newWebPortal.request);

  cy.usePactWait(['createWebPortals'])
    .its('response.statusCode')
    .should('eq', 201);
};

export const putBrandPortal = () => {
  cy.usePactIntercept(
    {
      method: 'PUT',
      url: '**/api/platform/web_portals/2*',
      response: editWebPortal.response,
      matchingRules: editWebPortal.matchingRules,
    },
    'editWebPortals'
  );

  cy.usePactIntercept(
    {
      method: 'GET',
      url: `**/api/platform/web_portals/2`,
      response: editWebPortal.response,
    },
    'getWebPortals-2'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  cy.get('header').should('contain', 'Brand Portals');

  cy.fillTheForm(editWebPortal.request);

  cy.usePactWait(['editWebPortals'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteBrandPortal = () => {
  cy.intercept('DELETE', '**/api/platform/web_portals/*', {
    statusCode: 204,
  }).as('deleteClients');

  cy.get('td svg[data-testid="DeleteIcon"]').first().click();
  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();
};
