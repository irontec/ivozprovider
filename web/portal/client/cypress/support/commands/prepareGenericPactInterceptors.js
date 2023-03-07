import apiSpec from '../../fixtures/apiSpec.json';
import TerminalCollection from '../../fixtures/Terminal/getCollection.json';
import ExtensionCollection from '../../fixtures/Extension/getCollection.json';
import FaxCollection from '../../fixtures/Fax/getCollection.json';
import ContactCollection from '../../fixtures/Contact/getCollection.json';
import ConditionalRouteCollection from '../../fixtures/ConditionalRoute/getCollection.json';
import QueueCollection from '../../fixtures/Queue/getCollection.json';
import IvrCollection from '../../fixtures/Ivr/getCollection.json';
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

  cy.intercept('GET', '**/api/client/faxes?*', {
    ...FaxCollection,
  }).as('getFax');

  cy.intercept('GET', '**/api/client/contacts?*', {
    ...ContactCollection,
  }).as('getContact');

  cy.intercept('GET', '**/api/client/conditional_routes?*', {
    ...ConditionalRouteCollection,
  }).as('getConditionalRoute');

  cy.intercept('GET', '**/api/client/queues?*', {
    ...QueueCollection,
  }).as('getQueue');

  cy.intercept('GET', '**/api/client/ivrs?*', {
    ...IvrCollection,
  }).as('getIvr');
});
