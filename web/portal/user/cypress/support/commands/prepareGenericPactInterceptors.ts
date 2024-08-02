import apiSpec from '../../fixtures/apiSpec.json';
import CompanyExtensionsCollection from '../../fixtures/CompanyExtensions/getCollection.json';
import CountryCollection from '../../fixtures/Country/getCollection.json';
import MyCallForwardSettings from '../../fixtures/My/Calls/getCallForwardSettings.json';
import MyCallHistory from '../../fixtures/My/Calls/getCallHistory.json';
import MyLastMonthCalls from '../../fixtures/My/Calls/getLastMonthCalls.json';
import MyDashboard from '../../fixtures/My/Dashboard/getDashboard.json';
import MyProfile from '../../fixtures/My/Profile/getProfile.json';
import MyStatus from '../../fixtures/My/Status/getStatus.json';
import MyTheme from '../../fixtures/My/Theme/getTheme.json';
import Timezones from '../../fixtures/Timezones/getCollection.json';
import VoicemailCollection from '../../fixtures/Voicemail/getCollection.json';

Cypress.Commands.add('prepareGenericPactInterceptors', (pactContextName) => {
  cy.setupPact(
    `user-consumer-${pactContextName}`,
    `user-provider-${pactContextName}`
  );

  cy.intercept('GET', '**/api/user/docs.json', {
    body: apiSpec,
    headers: {
      'content-type': 'application/json; charset=utf-8',
    },
  }).as('getApiSpec');

  cy.intercept('GET', '**/api/user/my/status*', {
    ...MyStatus,
  }).as('getMyStatus');

  cy.intercept('GET', '**/api/user/my/theme*', {
    ...MyTheme,
  }).as('getMyTheme');

  cy.intercept('GET', '**/api/user/my/dashboard*', {
    ...MyDashboard,
  }).as('getMyDashboard');

  cy.intercept('GET', '**/api/user/my/profile*', {
    ...MyProfile,
  }).as('getMyProfile');

  cy.intercept('GET', '**/api/user/my/last_month_calls*', {
    ...MyLastMonthCalls,
  }).as('getMyLastMonthCalls');

  cy.intercept('GET', '**/api/user/my/call_history*', {
    ...MyCallHistory,
  }).as('getMyLastMonthCalls');

  cy.intercept('GET', '**/api/user/my/call_forward_settings*', {
    ...MyCallForwardSettings,
  }).as('getMyCallForwardSettings');

  cy.intercept('GET', '**/api/user/timezones?*', {
    ...Timezones,
  }).as('getTimezones');

  cy.intercept('GET', '**/api/user/countries?*', {
    ...CountryCollection,
  }).as('getCountry');

  cy.intercept('GET', '**/api/user/my/voicemails?*', {
    ...VoicemailCollection,
  }).as('getVoicemail');

  cy.intercept('GET', '**/api/user/my/company_extensions?*', {
    ...CompanyExtensionsCollection,
  }).as('getCompanyExtensions');
});
