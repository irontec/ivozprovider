import apiSpec from '../../fixtures/apiSpec.json';
import TerminalManufacturerCollection from '../../fixtures/TerminalManufacturer/getCollection.json';
import InvoiceTemplateCollection from '../../fixtures/InvoiceTemplate/getCollection.json';
import AdministratorCollection from '../../fixtures/Administrator/getCollection.json';
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

  cy.intercept('GET', '**/api/platform/terminal_manufacturers?*', {
    ...TerminalManufacturerCollection,
  }).as('getTerminalManufacturer');

  cy.intercept('GET', '**/api/platform/invoice_templates?*', {
    ...InvoiceTemplateCollection,
  }).as('getInvoiceTemplate');

  cy.intercept('GET', '**/api/platform/administrators?*', {
    ...AdministratorCollection,
  }).as('getAdministrator');
});
