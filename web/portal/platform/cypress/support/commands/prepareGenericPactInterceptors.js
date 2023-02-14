import apiSpec from '../../fixtures/apiSpec.json';
import UserCollection from '../../fixtures/Users/getCollection.json';

Cypress.Commands.add('prepareGenericPactInterceptors', (pactContextName) => {
  cy.setupPact(
    `platform-consumer-${pactContextName}`,
    `platform-provider-${pactContextName}`
  );

  cy.intercept('GET', '**/api/platform/docs.json', {
    body: apiSpec,
    headers: {
      'content-type': 'application/json; charset=utf-8',
    },
  }).as('getApiSpec');

  cy.intercept('GET', '**/api/platform/users?*', {
    ...UserCollection,
  }).as('getUsers');
});
