import apiSpec from '../../fixtures/apiSpec.json';
import TrustedCollection from '../../fixtures/Kam/Trusted/getCollection.json';
import UsersAddressesCollection from '../../fixtures/Kam/UsersAddresses/getCollection.json';
import ActiveCallsItem from '../../fixtures/My/ActiveCalls/getActiveCalls.json';
import DashboardItem from '../../fixtures/My/Dashboard/getDashboard.json';
import ProfileItem from '../../fixtures/My/Profile/getProfile.json';
import ThemeItem from '../../fixtures/My/Theme/getTheme.json';
import AdministratorCollection from '../../fixtures/Provider/Administrator/getCollection.json';
import ApplicationServerSetsCollection from '../../fixtures/Provider/ApplicationServerSets/getCollection.json';
import BannedAddressesCollection from '../../fixtures/Provider/BannedAddress/getCollection.json';
import BillableCallsCollection from '../../fixtures/Provider/BillableCalls/getCollection.json';
import CarriersCollection from '../../fixtures/Provider/Carriers/getCollection.json';
import CarrierServerCollection from '../../fixtures/Provider/CarrierServer/getCollection.json';
import CodecsCollection from '../../fixtures/Provider/Codecs/getCollection.json';
import CompaniesCollection from '../../fixtures/Provider/Companies/getCollection.json';
import CorporationsCollection from '../../fixtures/Provider/Corporations/getCollection.json';
import CountriesCollection from '../../fixtures/Provider/Countries/getCollection.json';
import CurrenciesCollection from '../../fixtures/Provider/Currencies/getCollection.json';
import DdiProvidersCollection from '../../fixtures/Provider/DdiProviders/getCollection.json';
import DdiProvidersAddressesCollection from '../../fixtures/Provider/DdiProviders/getProviderAddressesCollection.json';
import DdiProvidersRegistrationsCollection from '../../fixtures/Provider/DdiProviders/getProviderRegistrationsCollection.json';
import DdisCollection from '../../fixtures/Provider/Ddis/getCollection.json';
import FeaturesCollection from '../../fixtures/Provider/Features/getCollection.json';
import LanguagesCollection from '../../fixtures/Provider/Languages/getCollection.json';
import MediaRelaySetsColection from '../../fixtures/Provider/MediaRelaySets/getCollection.json';
import NotificationTemplateContentsCollection from '../../fixtures/Provider/NotificationTemplateContents/getCollection.json';
import NotificationTemplatesCollection from '../../fixtures/Provider/NotificationTemplates/getCollection.json';
import OutgoingDdiRulesCollection from '../../fixtures/Provider/OutgoingDdiRules/getCollection.json';
import ProxyTrunksCollection from '../../fixtures/Provider/ProxyTrunks/getCollection.json';
import RatingPlanGroupCollection from '../../fixtures/Provider/RatingPlanGroup/getCollections.json';
import RatingProfilesCollection from '../../fixtures/Provider/RatingProfile/getCollection.json';
import RoutingTagsCollection from '../../fixtures/Provider/RoutingTags/getCollection.json';
import TimezonesCollection from '../../fixtures/Provider/Timezones/getCollection.json';
import TransformationRuleSetsCollection from '../../fixtures/Provider/TransformationRuleSets/getCollection.json';
import WebPortalCollection from '../../fixtures/Provider/WebPortals/getCollection.json';
import UserCollection from '../../fixtures/Users/getCollection.json';

Cypress.Commands.add(
  'prepareGenericPactInterceptors',
  (pactContextName, dropProfileFeatures) => {
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

    cy.intercept('GET', '**/api/brand/companies?*', {
      ...CompaniesCollection,
    }).as('getCompanies');

    cy.intercept('GET', '**/api/brand/billable_calls?*', {
      ...BillableCallsCollection,
    }).as('getBillableCalls');

    cy.intercept('GET', '**/api/brand/carriers?*', {
      ...CarriersCollection,
    }).as('getCarriers');

    cy.intercept('GET', '**/api/brand/carrier_servers?*', {
      ...CarrierServerCollection,
    }).as('getCarriersServer');

    cy.intercept('GET', '**/api/brand/ddi_providers?*', {
      ...DdiProvidersCollection,
    }).as('getDdiProviders');

    cy.intercept('GET', '**/api/brand/ddi_provider_addresses?*', {
      ...DdiProvidersAddressesCollection,
    }).as('getDdiProvidersAddresses');

    cy.intercept('GET', '**/api/brand/ddi_provider_registrations?*', {
      ...DdiProvidersRegistrationsCollection,
    }).as('getDdiProvidersRegistrations');

    cy.intercept('GET', '**/api/brand/ddis?*', {
      ...DdisCollection,
    }).as('getDdis');

    cy.intercept('GET', '**/api/brand/codecs?*', {
      ...CodecsCollection,
    }).as('getCodecs');

    cy.intercept('GET', '**/api/brand/corporations?*', {
      ...CorporationsCollection,
    }).as('getCorporations');

    cy.intercept('GET', '**/api/brand/countries?*', {
      ...CountriesCollection,
    }).as('getCountries');

    cy.intercept('GET', '**/api/brand/currencies?*', {
      ...CurrenciesCollection,
    }).as('getCurrencies');

    cy.intercept('GET', '**/api/brand/features?*', {
      ...FeaturesCollection,
    }).as('getFeatures');

    cy.intercept('GET', '**/api/brand/languages?*', {
      ...LanguagesCollection,
    }).as('getLanguages');

    cy.intercept('GET', '**/api/brand/notification_template_contents?*', {
      ...NotificationTemplateContentsCollection,
    }).as('getNotificationTemplateContents');

    cy.intercept('GET', '**/api/brand/notification_templates?*', {
      ...NotificationTemplatesCollection,
    }).as('getNotificationTemplates');

    cy.intercept('GET', '**/api/brand/outgoing_ddi_rules?*', {
      ...OutgoingDdiRulesCollection,
    }).as('getOutgoingDdiRules');

    cy.intercept('GET', '**/api/brand/routing_tags?*', {
      ...RoutingTagsCollection,
    }).as('getRoutingTags');

    cy.intercept('GET', '**/api/brand/timezones?*', {
      ...TimezonesCollection,
    }).as('getTimezones');

    cy.intercept('GET', '**/api/brand/transformation_rule_sets?*', {
      ...TransformationRuleSetsCollection,
    }).as('getTransformationRuleSets');

    cy.intercept('GET', '**/api/brand/my/theme', {
      ...ThemeItem,
    }).as('getMyTheme');

    if (dropProfileFeatures && dropProfileFeatures.length > 0) {
      ProfileItem.body.features = [
        ...ProfileItem.body.features.filter(
          (feature) => !dropProfileFeatures.includes(feature)
        ),
      ];
    }

    cy.intercept('GET', '**/api/brand/my/profile', { ...ProfileItem }).as(
      'getMyProfile'
    );

    cy.intercept('GET', '**/api/brand/my/dashboard', { ...DashboardItem }).as(
      'getMyDashboard'
    );
    cy.intercept('GET', '**/api/brand/my/active_calls', {
      ...ActiveCallsItem,
    }).as('getMyActiveCalls');

    cy.intercept('GET', '**/api/brand/web_portals?*', {
      ...WebPortalCollection,
    }).as('getWebPortals');

    cy.intercept('GET', '**/api/brand/administrators?*', {
      ...AdministratorCollection,
    }).as('getAdministrator');

    cy.intercept('GET', '**/api/brand/application_server_sets?*', {
      ...ApplicationServerSetsCollection,
    }).as('getApplicationServerSets');

    cy.intercept('GET', '**/api/brand/media_relay_sets?*', {
      ...MediaRelaySetsColection,
    }).as('getMediaRelaySets');

    cy.intercept('GET', '**/api/brand/proxy_trunks?*', {
      ...ProxyTrunksCollection,
    }).as('getProxyTrunks');

    cy.intercept('GET', '**/api/brand/users_addresses?*', {
      ...UsersAddressesCollection,
    }).as('getUserAddresses');

    cy.intercept('GET', '**/api/brand/banned_address?*', {
      ...BannedAddressesCollection,
    }).as('getBannedAddresses');

    cy.intercept('GET', '**/api/brand/rating_profiles?*', {
      ...RatingProfilesCollection,
    }).as('getRatingProfiles');

    cy.intercept('GET', '**/api/brand/rating_plan_groups?*', {
      ...RatingPlanGroupCollection,
    }).as('getRatingPlanGroups');

    cy.intercept('GET', '**/api/brand/trusteds?*', {
      ...TrustedCollection,
    }).as('getTrusteds');
  }
);
