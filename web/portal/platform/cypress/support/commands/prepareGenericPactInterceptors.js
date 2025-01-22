import AdministratorCollection from '../../fixtures/Administrator/getCollection.json';
import AdministratorRelPublicEntitiesCollection from '../../fixtures/AdministratorRelPublicEntities/getCollection.json';
import apiSpec from '../../fixtures/apiSpec.json';
import ApplicationServer from '../../fixtures/ApplicationServer/getCollection.json';
import ApplicationServerSet from '../../fixtures/ApplicationServerSets/getCollection.json';
import CountriesCollection from '../../fixtures/Countries/getCollection.json';
import CurrenciesCollection from '../../fixtures/Currencies/getCollection.json';
import InvoiceTemplateCollection from '../../fixtures/InvoiceTemplate/getCollection.json';
import LanguagesCollection from '../../fixtures/Language/getCollection.json';
import MediaRelaySetsCollection from '../../fixtures/MediaRelaySets/getCollection.json';
import ActiveCallsItem from '../../fixtures/My/ActiveCalls/getActiveCalls.json';
import DashboardItem from '../../fixtures/My/Dashboard/getDashboard.json';
import ProfileItem from '../../fixtures/My/Profile/getProfile.json';
import ThemeItem from '../../fixtures/My/Theme/getTheme.json';
import NotificationTemplatesCollection from '../../fixtures/NotificationTemplate/getCollection.json';
import NotificationTemplatesContentCollection from '../../fixtures/NotificationTemplateContent/getCollection.json';
import BannedAddressCollection from '../../fixtures/Provider/BannedAddress/getCollection.json';
import BrandCollection from '../../fixtures/Provider/Brand/getCollection.json';
import BrandOperatorCollection from '../../fixtures/Provider/BrandOperator/getCollection.json';
import CurrencyCollection from '../../fixtures/Provider/Currency/getCollection.json';
import DomainCollection from '../../fixtures/Provider/Domain/getCollection.json';
import FeatureCollection from '../../fixtures/Provider/Feature/getCollection.json';
import LanguageCollection from '../../fixtures/Provider/Language/getCollection.json';
import MediaRelaySetCollection from '../../fixtures/Provider/MediaRelaySet/getCollection.json';
import ProxyTrunkCollection from '../../fixtures/Provider/ProxyTrunk/getCollection.json';
import WebPortal from '../../fixtures/Provider/WebPortal/getCollection.json';
import ProxyUserCollection from '../../fixtures/ProxyUser/getCollection.json';
import PublicEntitiesCollection from '../../fixtures/PublicEntities/getCollection.json';
import RtpengineCollection from '../../fixtures/Rtpengine/getCollection.json';
import ServicesCollection from '../../fixtures/Services/getCollection.json';
import SpecialNumbersCollection from '../../fixtures/SpecialNumber/getCollection.json';
import TerminalManufacturerCollection from '../../fixtures/TerminalManufacturer/getCollection.json';
import TimezonesCollection from '../../fixtures/Timezones/getTimezones.json';
import UserCollection from '../../fixtures/Users/getCollection.json';

Cypress.Commands.add(
  'prepareGenericPactInterceptors',
  (pactContextName, options = { queryFilters: { brand: false } }) => {
    const { queryFilters } = options;
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

    if (queryFilters?.brand) {
      cy.intercept('GET', '**/api/platform/administrators?brand*', {
        ...BrandOperatorCollection,
      }).as('getBrandOperator');
    } else {
      cy.intercept('GET', '**/api/platform/administrators?*', {
        ...AdministratorCollection,
      }).as('getAdministrator');
    }

    cy.intercept('GET', '**/api/platform/administrator_rel_public_entities?*', {
      ...AdministratorRelPublicEntitiesCollection,
    }).as('getAdministratorRelPublicEntities');

    cy.intercept('GET', '**/api/platform/services?*', {
      ...ServicesCollection,
    }).as('getServices');

    cy.intercept('GET', '**/api/platform/currencies?*', {
      ...CurrenciesCollection,
    }).as('getCurrencies');

    cy.intercept('GET', '**/api/platform/notification_templates?*', {
      ...NotificationTemplatesCollection,
    }).as('getNotificationTemplates');

    cy.intercept('GET', '**/api/platform/notification_template_contents?*', {
      ...NotificationTemplatesContentCollection,
    }).as('getNotificationTemplateContents');

    cy.intercept('GET', '**/api/platform/languages?*', {
      ...LanguagesCollection,
    }).as('getLanguages');

    cy.intercept('GET', '**/api/platform/special_numbers?*', {
      ...SpecialNumbersCollection,
    }).as('getSpecialNumbers');

    cy.intercept('GET', '**/api/platform/countries?*', {
      ...CountriesCollection,
    }).as('getCountries');

    cy.intercept('GET', '**/api/platform/my/theme', {
      ...ThemeItem,
    }).as('getMyTheme');

    cy.intercept('GET', '**/api/platform/my/profile', { ...ProfileItem }).as(
      'getMyProfile'
    );

    cy.intercept('GET', '**/api/platform/my/dashboard', {
      ...DashboardItem,
    }).as('getMyDashboard');

    cy.intercept('GET', '**/api/platform/my/active_calls', {
      ...ActiveCallsItem,
    }).as('getMyActiveCalls');

    cy.intercept('GET', '**/api/platform/public_entities?*', {
      ...PublicEntitiesCollection,
    }).as('getPublicEntities');

    cy.intercept('GET', '**/api/platform/my/theme', {
      ...ThemeItem,
    }).as('getMyTheme');

    cy.intercept('GET', '**/api/platform/my/profile', { ...ProfileItem }).as(
      'getMyProfile'
    );

    cy.intercept('GET', '**/api/platform/my/dashboard', {
      ...DashboardItem,
    }).as('getMyDashboard');

    cy.intercept('GET', '**/api/platform/timezones*', {
      ...TimezonesCollection,
    }).as('getTimezones');

    cy.intercept('GET', '**/api/platform/my/active_calls', {
      ...ActiveCallsItem,
    }).as('getMyActiveCalls');

    cy.intercept('GET', '**/api/platform/web_portals*', {
      ...WebPortal,
    }).as('getWebPortals');

    cy.intercept('GET', '**/api/platform/application_server_sets*', {
      ...ApplicationServerSet,
    }).as('getApplicationServerSets');

    cy.intercept('GET', '**/api/platform/proxy_users*', {
      ...ProxyUserCollection,
    }).as('getProxyUser');

    cy.intercept('GET', '**/api/platform/media_relay_sets*', {
      ...MediaRelaySetsCollection,
    }).as('getMediaRelaySets');

    cy.intercept('GET', '**/api/platform/rtpengines*', {
      ...RtpengineCollection,
    }).as('getRtpengine');

    cy.intercept('GET', '**/api/platform/application_servers*', {
      ...ApplicationServer,
    }).as('getApplicationServers');

    cy.intercept('GET', '**/api/platform/brands*', {
      ...BrandCollection,
    }).as('getBrands');

    cy.intercept('GET', '**/api/platform/proxy_trunks*', {
      ...ProxyTrunkCollection,
    }).as('getProxyTrunks');

    cy.intercept('GET', '**/api/platform/media_relay_sets*', {
      ...MediaRelaySetCollection,
    }).as('getMediaRelaySets');

    cy.intercept('GET', '**/api/platform/features*', {
      ...FeatureCollection,
    }).as('getFeatures');

    cy.intercept('GET', '**/api/platform/languages*', {
      ...LanguageCollection,
    }).as('getLanguages');

    cy.intercept('GET', '**/api/platform/currencies*', {
      ...CurrencyCollection,
    }).as('getCurrencies');

    cy.intercept('GET', '**/api/platform/domains*', {
      ...DomainCollection,
    }).as('getDomains');

    cy.intercept('GET', '**/api/platform/banned_addresses*', {
      ...BannedAddressCollection,
    }).as('getDomains');
  }
);
