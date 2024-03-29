import apiSpec from '../../fixtures/apiSpec.json';
import UserCollection from '../../fixtures/Users/getCollection.json';

Cypress.Commands.add('prepareGenericPactInterceptors', (pactContextName) => {
  cy.setupPact(
    `brand-consumer-${pactContextName}`,
    `brand-provider-${pactContextName}`
  );

  cy.intercept('GET', '**/api/brand/docs.json', {
    body: apiSpec,
    headers: {
      'content-type': 'application/json; charset=utf-8',
    },
  }).as('getApiSpec');

  cy.intercept('GET', '**/api/brand/users?*', {
    ...UserCollection,
  }).as('getUsers');
});
