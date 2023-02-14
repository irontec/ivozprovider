import apiSpec from '../../fixtures/apiSpec.json';
import CarrierCollection from '../../fixtures/Carrier/getCollection.json';
import DdiCollection from '../../fixtures/Ddi/getCollection.json';
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

  cy.intercept('GET', '**/api/brand/my/profile', {
    body: { restricted: false, acls: [] },
    headers: {
      'content-type': 'application/json; charset=utf-8',
    },
  }).as('getProfile');

  cy.intercept('GET', '**/api/brand/carriers?*', {
    ...CarrierCollection,
  }).as('getCarrier');

  cy.intercept('GET', '**/api/brand/users?*', {
    ...UserCollection,
  }).as('getUsers');

  cy.intercept('GET', '**/api/brand/ddis?*', {
    ...DdiCollection,
  }).as('getDdi');
});
