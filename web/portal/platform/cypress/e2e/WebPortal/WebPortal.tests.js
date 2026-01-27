import WebPortalstItem from '../../fixtures/Provider/WebPortal/getItem.json';
import newWebPortals from '../../fixtures/Provider/WebPortal/post.json';
import editWebPortals from '../../fixtures/Provider/WebPortal/put.json';

export const postWebPortals = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/platform/web_portals*',
      response: newWebPortals.response,
      matchingRules: newWebPortals.matchingRules,
    },
    'createNewPortals'
  );

  cy.get('[aria-label=Add]').click();

  cy.fillTheForm(newWebPortals.request);

  cy.get('header').should('contain', 'Platform portals');

  cy.usePactWait('createNewPortals')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putWebPortals = () => {
  cy.intercept('GET', '**/api/platform/web_portals/2', {
    ...WebPortalstItem,
  }).as('getWebPortals-2');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/platform/web_portals/${editWebPortals.response.body.id}`,
      response: editWebPortals.response,
    },
    'editWebPortals'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  const { ...rest } = editWebPortals.request;
  delete rest.color;
  delete rest.logo;

  cy.fillTheForm(rest);

  cy.get('header').should('contain', 'Platform portals');

  cy.usePactWait(['editWebPortals'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteWebPortals = () => {
  cy.intercept('DELETE', '**/api/platform/web_portals/*', {
    statusCode: 204,
  }).as('deleteWebPortals');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Platform portals');

  cy.usePactWait(['deleteWebPortals'])
    .its('response.statusCode')
    .should('eq', 204);
};
