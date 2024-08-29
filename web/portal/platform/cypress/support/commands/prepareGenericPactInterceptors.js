import AdministratorCollection from '../../fixtures/Administrator/getCollection.json';
import apiSpec from '../../fixtures/apiSpec.json';
import InvoiceTemplateCollection from '../../fixtures/InvoiceTemplate/getCollection.json';
import ActiveCallsItem from '../../fixtures/My/ActiveCalls/getActiveCalls.json';
import DashboardItem from '../../fixtures/My/Dashboard/getDashboard.json';
import ProfileItem from '../../fixtures/My/Profile/getProfile.json';
import ThemeItem from '../../fixtures/My/Theme/getTheme.json';
import TerminalManufacturerCollection from '../../fixtures/TerminalManufacturer/getCollection.json';
import TimezonesItem from '../../fixtures/Timezones/getTimezones.json';
import UserCollection from '../../fixtures/Users/getCollection.json';
import WebPortal from '../../fixtures/WebPortal/getCollection.json';

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

  cy.intercept('GET', '**/api/platform/my/theme', {
    ...ThemeItem,
  }).as('getMyTheme');
  cy.intercept('GET', '**/api/platform/my/profile', { ...ProfileItem }).as(
    'getMyProfile'
  );
  cy.intercept('GET', '**/api/platform/my/dashboard', { ...DashboardItem }).as(
    'getMyDashboard'
  );
  cy.intercept('GET', '**/api/platform/timezones*', { ...TimezonesItem }).as(
    'getTimezones'
  );
  cy.intercept('GET', '**/api/platform/my/active_calls', {
    ...ActiveCallsItem,
  }).as('getMyActiveCalls');

  cy.intercept('GET', '**/api/platform/web_portals*', {
    ...WebPortal,
  }).as('getWebPortals');
});
