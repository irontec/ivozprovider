import apiSpec from '../../fixtures/apiSpec.json';
import TerminalCollection from '../../fixtures/Terminal/getCollection.json';
import ExtensionCollection from '../../fixtures/Extension/getCollection.json';
import FaxCollection from '../../fixtures/Fax/getCollection.json';
import ContactCollection from '../../fixtures/Contact/getCollection.json';
import ConditionalRouteCollection from '../../fixtures/ConditionalRoute/getCollection.json';
import QueueCollection from '../../fixtures/Queue/getCollection.json';
import IvrCollection from '../../fixtures/Ivr/getCollection.json';
import VoicemailCollection from '../../fixtures/Voicemail/getCollection.json';
import FriendCollection from '../../fixtures/Friend/getCollection.json';
import ConferenceRoomCollection from '../../fixtures/ConferenceRoom/getCollection.json';
import ExternalCallFilterCollection from '../../fixtures/ExternalCallFilter/getCollection.json';
import CalendarCollection from '../../fixtures/Calendar/getCollection.json';
import ScheduleCollection from '../../fixtures/Schedule/getCollection.json';
import MatchListCollection from '../../fixtures/MatchList/getCollection.json';
import RouteLockCollection from '../../fixtures/RouteLock/getCollection.json';
import PickUpGroupCollection from '../../fixtures/PickUpGroup/getCollection.json';
import OutgoingDdiRuleCollection from '../../fixtures/OutgoingDdiRule/getCollection.json';
import CallCsvSchedulerCollection from '../../fixtures/CallCsvScheduler/getCollection.json';
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

  cy.intercept('GET', '**/api/client/voicemails?*', {
    ...VoicemailCollection,
  }).as('getVoicemail');

  cy.intercept('GET', '**/api/client/friends?*', {
    ...FriendCollection,
  }).as('getFriend');

  cy.intercept('GET', '**/api/client/conference_rooms?*', {
    ...ConferenceRoomCollection,
  }).as('getConferenceRoom');

  cy.intercept('GET', '**/api/client/external_call_filters?*', {
    ...ExternalCallFilterCollection,
  }).as('getExternalCallFilter');

  cy.intercept('GET', '**/api/client/calendars?*', {
    ...CalendarCollection,
  }).as('getCalendar');

  cy.intercept('GET', '**/api/client/schedules?*', {
    ...ScheduleCollection,
  }).as('getSchedule');

  cy.intercept('GET', '**/api/client/match_lists?*', {
    ...MatchListCollection,
  }).as('getMatchList');

  cy.intercept('GET', '**/api/client/route_locks?*', {
    ...RouteLockCollection,
  }).as('getRouteLock');

  cy.intercept('GET', '**/api/client/pick_up_groups?*', {
    ...PickUpGroupCollection,
  }).as('getPickUpGroup');

  cy.intercept('GET', '**/api/client/outgoing_ddi_rules?*', {
    ...OutgoingDdiRuleCollection,
  }).as('getOutgoingDdiRule');

  cy.intercept('GET', '**/api/client/call_csv_schedulers?*', {
    ...CallCsvSchedulerCollection,
  }).as('getCallCsvScheduler');
});
