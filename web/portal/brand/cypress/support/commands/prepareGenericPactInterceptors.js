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
import BrandServiceCollection from '../../fixtures/Provider/BrandService/getCollection.json';
import CarriersCollection from '../../fixtures/Provider/Carriers/getCollection.json';
import CarrierServerCollection from '../../fixtures/Provider/CarrierServer/getCollection.json';
import CodecsCollection from '../../fixtures/Provider/Codecs/getCollection.json';
import CompaniesCollection from '../../fixtures/Provider/Companies/getCollection.json';
import CompaniesUnassignedCollection from '../../fixtures/Provider/Companies/getUnassignedCollection.json';
import CorporationsCollection from '../../fixtures/Provider/Corporations/getCollection.json';
import CountriesCollection from '../../fixtures/Provider/Countries/getCollection.json';
import CurrenciesCollection from '../../fixtures/Provider/Currencies/getCollection.json';
import DdiProvidersCollection from '../../fixtures/Provider/DdiProviders/getCollection.json';
import DdiProvidersAddressesCollection from '../../fixtures/Provider/DdiProviders/getProviderAddressesCollection.json';
import DdiProvidersRegistrationsCollection from '../../fixtures/Provider/DdiProviders/getProviderRegistrationsCollection.json';
import DdisCollection from '../../fixtures/Provider/Ddis/getCollection.json';
import DomainsCollection from '../../fixtures/Provider/Domains/getCollection.json';
import ExtensionsCollection from '../../fixtures/Provider/Extension/getCollection.json';
import FeaturesCollection from '../../fixtures/Provider/Features/getCollection.json';
import FixedCostsCollection from '../../fixtures/Provider/FixedCosts/getCollection.json';
import FixedCostsRelInvoiceCollection from '../../fixtures/Provider/FixedCostsRelInvoice/getCollection.json';
import FriendsCollection from '../../fixtures/Provider/Friends/getCollection.json';
import InvoiceNumberSequenceCollection from '../../fixtures/Provider/InvoiceNumberSequence/getCollection.json';
import InvoiceSchedulerCollection from '../../fixtures/Provider/InvoiceScheduler/getCollection.json';
import InvoiceTemplateCollection from '../../fixtures/Provider/InvoiceTemplate/getCollection.json';
import InvoiceCollection from '../../fixtures/Provider/Invoicing/getCollection.json';
import LanguagesCollection from '../../fixtures/Provider/Languages/getCollection.json';
import LocationsCollection from '../../fixtures/Provider/Location/getCollection.json';
import MatchListsCollection from '../../fixtures/Provider/MatchList/getCollection.json';
import MatchListPatternsCollection from '../../fixtures/Provider/MatchListPattern/getCollection.json';
import MediaRelaySetsColection from '../../fixtures/Provider/MediaRelaySets/getCollection.json';
import MusicOnHoldCollection from '../../fixtures/Provider/MusicOnHold/getCollection.json';
import NotificationTemplateContentsCollection from '../../fixtures/Provider/NotificationTemplateContents/getCollection.json';
import NotificationTemplatesCollection from '../../fixtures/Provider/NotificationTemplates/getCollection.json';
import OutgoingDdiRulesCollection from '../../fixtures/Provider/OutgoingDdiRules/getCollection.json';
import OutgoingRoutingCollection from '../../fixtures/Provider/OutgoingRoutings/getCollection.json';
import ProxyTrunksCollection from '../../fixtures/Provider/ProxyTrunks/getCollection.json';
import ProxyUsersCollection from '../../fixtures/Provider/ProxyUsers/getCollection.json';
import RatingPlanGroupCollection from '../../fixtures/Provider/RatingPlanGroups/getCollections.json';
import RatingProfilesCollection from '../../fixtures/Provider/RatingProfile/getCollection.json';
import ResidentialDevicesCollection from '../../fixtures/Provider/ResidentialDevices/getCollection.json';
import RetailAccountsCollection from '../../fixtures/Provider/RetailAccounts/getCollection.json';
import RoutingPatternGroupsCollection from '../../fixtures/Provider/RoutingPatternGroups/getCollection.json';
import RoutingPatternsCollection from '../../fixtures/Provider/RoutingPatterns/getCollection.json';
import RoutingTagsCollection from '../../fixtures/Provider/RoutingTags/getCollection.json';
import ServiceCollection from '../../fixtures/Provider/Service/getCollection.json';
import ServiceUnassignedCollection from '../../fixtures/Provider/Service/getUnassignedServicesCollection.json';
import SpecialNumbersCollection from '../../fixtures/Provider/SpecialNumber/getCollection.json';
import TerminalsCollection from '../../fixtures/Provider/Terminal/getCollection.json';
import TimezonesCollection from '../../fixtures/Provider/Timezones/getCollection.json';
import TransformationRuleCollection from '../../fixtures/Provider/TransformationRule/getCollection.json';
import TransformationRuleSetsCollection from '../../fixtures/Provider/TransformationRuleSets/getCollection.json';
import UserCollection from '../../fixtures/Provider/Users/getCollection.json';
import WebPortalCollection from '../../fixtures/Provider/WebPortals/getCollection.json';

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

    cy.intercept('GET', '**/api/brand/invoices?*', {
      ...InvoiceCollection,
    }).as('getInvoices');

    cy.intercept('GET', '**/api/brand/invoice_templates?*', {
      ...InvoiceTemplateCollection,
    }).as('getInvoiceTemplate');

    cy.intercept('GET', '**/api/brand/invoice_schedulers?*', {
      ...InvoiceSchedulerCollection,
    }).as('getInvoiceScheduler');

    cy.intercept('GET', '**/api/brand/invoice_number_sequences?*', {
      ...InvoiceNumberSequenceCollection,
    }).as('getInvoiceNumberSequence');

    cy.intercept('GET', '**/api/brand/fixed_costs?*', {
      ...FixedCostsCollection,
    }).as('getFixedCosts');

    cy.intercept('GET', '**/api/brand/fixed_costs_rel_invoices?*', {
      ...FixedCostsRelInvoiceCollection,
    }).as('getFixedCostsRelInvoice');

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

    cy.intercept('GET', '**/api/brand/transformation_rules?*', {
      ...TransformationRuleCollection,
    }).as('getTransformationRule');

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

    const ipfilter = [];
    const antibruteforce = [];
    BannedAddressesCollection.body.forEach((address) => {
      if (address.blocker === 'ipfilter') {
        ipfilter.push(address);

        return;
      }

      antibruteforce.push(address);
    });

    cy.intercept('GET', '**/api/brand/banned_addresses?blocker=ipfilter*', {
      ...BannedAddressesCollection,
      body: ipfilter,
    }).as('getBannedAddressesIpFilter');

    cy.intercept(
      'GET',
      '**/api/brand/banned_addresses?blocker=antibruteforce*',
      {
        ...BannedAddressesCollection,
        body: antibruteforce,
      }
    ).as('getBannedAddressesAntiBruteForce');

    cy.intercept('GET', '**/api/brand/rating_profiles?*', {
      ...RatingProfilesCollection,
    }).as('getRatingProfiles');

    cy.intercept('GET', '**/api/brand/rating_plan_groups?*', {
      ...RatingPlanGroupCollection,
    }).as('getRatingPlanGroups');

    cy.intercept('GET', '**/api/brand/trusteds?*', {
      ...TrustedCollection,
    }).as('getTrusteds');

    cy.intercept('GET', '**/api/brand/outgoing_routing?*', {
      ...OutgoingRoutingCollection,
    }).as('getOutgoingRoutings');

    cy.intercept('GET', '**/api/brand/routing_pattern_groups?*', {
      ...RoutingPatternGroupsCollection,
    }).as('getRoutingPatternGroups');

    cy.intercept('GET', '**/api/brand/routing_patterns?*', {
      ...RoutingPatternsCollection,
    }).as('getRoutingPatterns');
    cy.intercept('GET', '**/api/brand/residential_devices?*', {
      ...ResidentialDevicesCollection,
    }).as('getResidentialDevices');

    cy.intercept('GET', '**/api/brand/domains?*', {
      ...DomainsCollection,
    }).as('getDomains');

    cy.intercept('GET', '**/api/brand/proxy_users?*', {
      ...ProxyUsersCollection,
    }).as('getProxyUsers');

    cy.intercept('GET', '**/api/brand/retail_accounts?*', {
      ...RetailAccountsCollection,
    }).as('getRetailAccounts');

    cy.intercept('GET', '**/api/brand/friends?*', {
      ...FriendsCollection,
    }).as('getFriends');

    cy.intercept('GET', '**/api/brand/companies/corporate/unassigned*', {
      ...CompaniesUnassignedCollection,
    }).as('getCompaniesUnassigned');

    cy.intercept('GET', '**/api/brand/terminals*', {
      ...TerminalsCollection,
    }).as('getTerminals');

    cy.intercept('GET', '**/api/brand/locations*', {
      ...LocationsCollection,
    }).as('getLocations');

    cy.intercept('GET', '**/api/brand/extensions*', {
      ...ExtensionsCollection,
    }).as('getExtensions');

    cy.intercept('GET', '**/api/brand/special_numbers?*', {
      ...SpecialNumbersCollection,
    }).as('getSpecialNumbers');

    cy.intercept('GET', '**/api/brand/music_on_holds?*', {
      ...MusicOnHoldCollection,
    }).as('getMusicsOnHold');

    cy.intercept('GET', '**/api/brand/brand_services?*', {
      ...BrandServiceCollection,
    }).as('getSpecialNumbers');

    cy.intercept('GET', '**/api/brand/services?*', {
      ...ServiceCollection,
    }).as('getService');

    cy.intercept('GET', '**/api/brand/services/unassigned?*', {
      ...ServiceUnassignedCollection,
    }).as('getServiceUnassigned');

    cy.intercept('GET', '**/api/brand/match_lists?*', {
      ...MatchListsCollection,
    }).as('getMatchListsCollection');

    cy.intercept('GET', '**/api/brand/match_list_patterns?*', {
      ...MatchListPatternsCollection,
    }).as('getMatchListPatterns');
  }
);
