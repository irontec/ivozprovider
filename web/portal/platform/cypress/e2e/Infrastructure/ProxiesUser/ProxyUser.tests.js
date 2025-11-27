import newProxyUser from '../../../fixtures/ProxyUser/post.json';
import editProxyUser from '../../../fixtures/ProxyUser/put.json';

export const postProxyUser = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/platform/proxy_users*',
      response: newProxyUser.response,
      matchingRules: newProxyUser.matchingRules,
    },
    'createProxyUser'
  );

  cy.get('[aria-label=Add]').click();

  cy.fillTheForm(newProxyUser.request);

  cy.get('header').should('contain', 'Proxies User');

  cy.usePactWait('createProxyUser')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putProxyUser = () => {
  cy.intercept('GET', '**/api/platform/proxy_users/2', {
    ...editProxyUser,
  }).as('getInvoiceTemplate-2');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/platform/proxy_users/${editProxyUser.response.body.id}`,
      response: editProxyUser.response,
    },
    'editProxyUser'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  cy.fillTheForm(editProxyUser.request);
  cy.get('header').should('contain', 'Proxies User');

  cy.usePactWait(['editProxyUser'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteProxyUser = () => {
  cy.intercept('DELETE', '**/api/platform/proxy_users/*', {
    statusCode: 204,
  }).as('deleteInvoiceTemplate');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('[role="dialog"]')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Proxies User');

  cy.usePactWait(['deleteInvoiceTemplate'])
    .its('response.statusCode')
    .should('eq', 204);
};
