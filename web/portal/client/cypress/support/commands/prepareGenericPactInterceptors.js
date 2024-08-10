import apiSpec from '../../fixtures/apiSpec.json';
import CalendarCollection from '../../fixtures/Calendar/getCollection.json';
import CallAclCollection from '../../fixtures/CallAcl/getCollection.json';
import CallCsvSchedulerCollection from '../../fixtures/CallCsvScheduler/getCollection.json';
import CallForwardSettingCollection from '../../fixtures/CallForwardSetting/getCollection.json';
import CompanyServiceCollection from '../../fixtures/CompanyService/getCollection.json';
import ConditionalRouteCollection from '../../fixtures/ConditionalRoute/getCollection.json';
import ConferenceRoomCollection from '../../fixtures/ConferenceRoom/getCollection.json';
import ContactCollection from '../../fixtures/Contact/getCollection.json';
import CorporateUnassignedCollection from '../../fixtures/Corporate/getUnassignedCollection.json';
import CountryCollection from '../../fixtures/Country/getCollection.json';
import DdiCollection from '../../fixtures/Ddi/getCollection.json';
import DomainCollection from '../../fixtures/Domain/getCollection.json';
import ExtensionCollection from '../../fixtures/Extension/getCollection.json';
import ExtensionUnassignedCollection from '../../fixtures/Extension/getUnassignedCollection.json';
import ExternalCallFilterCollection from '../../fixtures/ExternalCallFilter/getCollection.json';
import FaxCollection from '../../fixtures/Fax/getCollection.json';
import FriendCollection from '../../fixtures/Friend/getCollection.json';
import HuntGroupCollection from '../../fixtures/HuntGroup/getCollection.json';
import HuntGroupMemberByHuntGroupCollection from '../../fixtures/HuntGroupMember/getCollection.json';
import HuntGroupMemberByUserCollection from '../../fixtures/Users/getHuntGroupMemebersCollection.json'
import IvrCollection from '../../fixtures/Ivr/getCollection.json';
import LanguageCollection from '../../fixtures/Language/getCollection.json';
import LocationCollection from '../../fixtures/Location/getCollection.json';
import LocutionCollection from '../../fixtures/Locution/getCollection.json';
import MatchListCollection from '../../fixtures/MatchList/getCollection.json';
import MusicOnHoldCollection from '../../fixtures/MusicOnHold/getCollection.json';
import ActiveCallsItem from '../../fixtures/My/ActiveCalls/getActiveCalls.json';
import DashboardItem from '../../fixtures/My/Dashboard/getDashboard.json';
import ProfileItem from '../../fixtures/My/Profile/getProfile.json';
import ThemeItem from '../../fixtures/My/Theme/getTheme.json';
import OutgoingDdiRuleCollection from '../../fixtures/OutgoingDdiRule/getCollection.json';
import PickUpGroupCollection from '../../fixtures/PickUpGroup/getCollection.json';
import QueueCollection from '../../fixtures/Queue/getCollection.json';
import RecordingCollection from '../../fixtures/Recording/getCollection.json';
import ResidentialDeviceCollection from '../../fixtures/ResidentialDevice/getCollection.json';
import RetailAccountCollection from '../../fixtures/RetailAccount/getCollection.json';
import RouteLockCollection from '../../fixtures/RouteLock/getCollection.json';
import ScheduleCollection from '../../fixtures/Schedule/getCollection.json';
import ServiceCollection from '../../fixtures/Service/getCollection.json';
import ServiceUnassignedCollection from '../../fixtures/Service/getUnassignedCollection.json';
import TerminalCollection from '../../fixtures/Terminal/getCollection.json';
import TerminalUnassignedCollection from '../../fixtures/Terminal/getUnassignedCollection.json';
import TerminalModelCollection from '../../fixtures/TerminalModel/getCollection.json';
import TimezoneCollection from '../../fixtures/TimeZone/getCollection.json';
import TransformationRuleSetCollection from '../../fixtures/TransformationRuleSet/getCollection.json';
import UserCollection from '../../fixtures/Users/getCollection.json';
import VoicemailCollection from '../../fixtures/Voicemail/getCollection.json';

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

  cy.intercept('GET', '**/api/client/terminals/unassigned?*', {
    ...TerminalUnassignedCollection,
  }).as('getTerminalUnassigned');

  cy.intercept('GET', '**/api/client/services/unassigned?*', {
    ...ServiceUnassignedCollection,
  }).as('getServiceUnassigned');

  cy.intercept('GET', '**/api/client/extensions?*', {
    ...ExtensionCollection,
  }).as('getExtension');

  cy.intercept('GET', '**/api/client/extensions/unassigned?*', {
    ...ExtensionUnassignedCollection,
  }).as('getUnassignedExtensions');

  cy.intercept('GET', '**/api/client/companies/corporate/unassigned?*', {
    ...CorporateUnassignedCollection,
  }).as('getUnassignedCorporates');

  cy.intercept('GET', '**/api/client/retail_accounts?*', {
    ...RetailAccountCollection,
  }).as('getRetailAccounts');

  cy.intercept('GET', '**/api/client/residential_devices?*', {
    ...ResidentialDeviceCollection,
  }).as('getResidentialDevices');

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

  cy.intercept('GET', '**/api/client/music_on_holds?*', {
    ...MusicOnHoldCollection,
  }).as('getMusicOnHold');

  cy.intercept('GET', '**/api/client/call_acls?*', {
    ...CallAclCollection,
  }).as('getCallAcl');

  cy.intercept('GET', '**/api/client/locations?*', {
    ...LocationCollection,
  }).as('getLocation');

  cy.intercept('GET', '**/api/client/locutions?*', {
    ...LocutionCollection,
  }).as('getLocution');

  cy.intercept('GET', '**/api/client/hunt_groups?*', {
    ...HuntGroupCollection,
  }).as('getHuntGroup');

  cy.intercept('GET', '**/api/client/call_forward_settings?*', {
    ...CallForwardSettingCollection,
  }).as('getCallForwardSetting');

  cy.intercept('GET', '**/api/client/hunt_group_members?huntGroup*', {
    ...HuntGroupMemberByHuntGroupCollection,
  }).as('getHuntGroupMemberByHuntGroup');

  cy.intercept('GET', '**/api/client/hunt_group_members?user*', {
    ...HuntGroupMemberByUserCollection,
  }).as('getHuntGroupMemberByUser');

  cy.intercept('GET', '**/api/client/company_services?*', {
    ...CompanyServiceCollection,
  }).as('getCompanyService');

  cy.intercept('GET', '**/api/client/services?*', {
    ...ServiceCollection,
  }).as('getService');

  cy.intercept('GET', '**/api/client/my/theme', {
    ...ThemeItem,
  }).as('getMyTheme');

  cy.intercept('GET', '**/api/client/my/profile', { ...ProfileItem }).as(
    'getMyProfile'
  );

  cy.intercept('GET', '**/api/client/my/dashboard', { ...DashboardItem }).as(
    'getMyDashboard'
  );

  cy.intercept('GET', '**/api/client/my/active_calls', {
    ...ActiveCallsItem,
  }).as('getMyActiveCalls');

  cy.intercept('GET', '**/api/client/languages?*', {
    ...LanguageCollection,
  }).as('getLanguage');

  cy.intercept('GET', '**/api/client/timezones?*', {
    ...TimezoneCollection,
  }).as('getTimezone');

  cy.intercept('GET', '**/api/client/transformation_rule_sets?*', {
    ...TransformationRuleSetCollection,
  }).as('getTransformationRuleSet');

  cy.intercept('GET', '**/api/client/ddis?*', {
    ...DdiCollection,
  }).as('getDdi');

  cy.intercept('GET', '**/api/client/domains?*', {
    ...DomainCollection,
  }).as('getDomain');

  cy.intercept('GET', '**/api/client/terminal_models?*', {
    ...TerminalModelCollection,
  }).as('getTerminalModel');

  cy.intercept('GET', '**/api/client/countries?*', {
    ...CountryCollection,
  }).as('getCountry');

  cy.intercept('GET', '**/api/client/recordings?*', {
    ...RecordingCollection,
  }).as('getRecording');

});
