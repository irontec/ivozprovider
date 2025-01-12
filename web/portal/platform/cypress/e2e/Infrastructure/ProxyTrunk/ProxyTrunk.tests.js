import newProxyUser from '../../../fixtures/ProxyUser/post.json';
import editProxyTrunk from '../../../fixtures/ProxyUser/put.json';

export const postProxyTrunk = () => {
  cy.usePactIntercept(
    {
      method: 'POST',
      url: '**/api/platform/proxy_trunks*',
      response: newProxyUser.response,
      matchingRules: newProxyUser.matchingRules,
    },
    'createProxyUser'
  );

  cy.get('[aria-label=Add]').click();

  cy.fillTheForm(newProxyUser.request);

  cy.get('header').should('contain', 'Proxies Trunk');

  cy.usePactWait('createProxyUser')
    .its('response.statusCode')
    .should('eq', 201);
};

export const putProxyTrunk = () => {
  cy.intercept('GET', '**/api/platform/proxy_trunks/2', {
    ...editProxyTrunk,
  }).as('getProxyTrunk-2');

  cy.usePactIntercept(
    {
      method: 'PUT',
      url: `**/api/platform/proxy_trunks/${editProxyTrunk.response.body.id}`,
      response: editProxyTrunk.response,
    },
    'editProxyTrunk'
  );

  cy.get('svg[data-testid="EditIcon"]').first().click();

  cy.fillTheForm(editProxyTrunk.request);
  cy.get('header').should('contain', 'Proxies Trunk');

  cy.usePactWait(['editProxyTrunk'])
    .its('response.statusCode')
    .should('eq', 200);
};

export const deleteteProxyTrunk = () => {
  cy.intercept('DELETE', '**/api/platform/proxy_trunks/*', {
    statusCode: 204,
  }).as('deleteInvoiceTemplate');

  cy.get('td button > svg[data-testid="DeleteIcon"]').first().click();

  cy.contains('Remove element');
  cy.get('div.MuiDialog-container button')
    .filter(':visible')
    .contains('Yes, delete it')
    .click();

  cy.get('header').should('contain', 'Proxies Trunk');

  cy.usePactWait(['deleteInvoiceTemplate'])
    .its('response.statusCode')
    .should('eq', 204);
};
