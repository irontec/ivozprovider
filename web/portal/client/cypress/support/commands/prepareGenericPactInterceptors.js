import apiSpec from '../../fixtures/apiSpec.json';
import TerminalCollection from '../../fixtures/Terminal/getCollection.json';
import ExtensionCollection from '../../fixtures/Extension/getCollection.json';
import UserCollection from '../../fixtures/Users/getCollection.json';

Cypress.Commands.add('prepareGenericPactInterceptors', (pactContextName) => {
  cy.setupPact(
    `client-consumer-${pactContextName}`,
    `client-provider-${pactContextName}`
  );

  cy.intercept('GET', '**/api/client/docs.json', {
    body: apiSpec,
    headers: {
      'content-type': 'application/json; charset=utf-8',
    },
  }).as('getApiSpec');

  cy.intercept('GET', '**/api/client/users?*', {
    ...UserCollection,
  }).as('getUsers');

  cy.intercept('GET', '**/api/client/terminals?*', {
    ...TerminalCollection,
  }).as('getTerminal');

  cy.intercept('GET', '**/api/client/extensions?*', {
    ...ExtensionCollection,
  }).as('getExtension');
});
