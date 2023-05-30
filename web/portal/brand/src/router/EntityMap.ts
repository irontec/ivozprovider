import { EntityAclType } from '@irontec/ivoz-ui';
import routeMapParser, {
  RouteMap,
  RouteMapItem,
} from '@irontec/ivoz-ui/router/routeMapParser';
import _ from '@irontec/ivoz-ui/services/translations/translate';

import entities from '../entities';
import {
  ClientFeatures,
  ClientTypes,
} from '../entities/Company/ClientFeatures';
import { AboutMe } from '../store/clientSession/aboutMe';

type isAccessibleType = (aboutMe: AboutMe) => boolean;
type aclOverrideType = (aboutMe: AboutMe) => EntityAclType;
export type ExtendedRouteMapItem = RouteMapItem & {
  isAccessible?: isAccessibleType;
  aclOverride?: aclOverrideType;
  children?: Array<ExtendedRouteMapItem>;
};
export type ExtendedRouteMap = RouteMap<ExtendedRouteMapItem>;

const denyAllAcl = {
  read: false,
  detail: false,
  create: false,
  update: false,
  delete: false,
};

const getEntityMap = (): ExtendedRouteMap => {
  const map: ExtendedRouteMap = [
    {
      label: _('Clients'),
      children: [
        {
          entity: entities.VirtualPbx,
          isAccessible: (aboutMe) =>
            aboutMe.features.includes(ClientTypes.vpbx),
          filterValues: {
            type: ClientTypes.vpbx,
          },
          children: [
            {
              entity: entities.UsersAddress,
              filterBy: 'company',
            },
            {
              entity: entities.BannedAddress,
              filterBy: 'company',
              filterValues: {
                blocker: 'ipfilter',
              },
            },
            {
              entity: entities.Administrator,
              filterBy: 'company',
              children: [
                {
                  entity: entities.AdministratorRelPublicEntity,
                  filterBy: 'administrator',
                },
              ],
            },
            {
              entity: entities.RatingProfile,
              filterBy: 'company',
              isAccessible: (aboutMe) => {
                return aboutMe.features.includes(ClientFeatures.billing);
              },
            },
            ...Object.values(entities.VirtualPbx.customActions),
          ],
        },
        {
          entity: entities.Residential,
          isAccessible: (aboutMe) =>
            aboutMe.features.includes(ClientTypes.residential),
          filterValues: {
            type: ClientTypes.residential,
          },
          children: [
            {
              entity: entities.UsersAddress,
              filterBy: 'company',
            },
            {
              entity: entities.Administrator,
              filterBy: 'company',
              children: [
                {
                  entity: entities.AdministratorRelPublicEntity,
                  filterBy: 'administrator',
                },
              ],
            },
            {
              entity: entities.RatingProfile,
              filterBy: 'company',
            },
            ...Object.values(entities.Residential.customActions),
          ],
        },
        {
          entity: entities.Retail,
          isAccessible: (aboutMe) =>
            aboutMe.features.includes(ClientTypes.retail),
          filterValues: {
            type: ClientTypes.retail,
          },
          fixedValues: {
            domainUsers: '__null__',
          },
          children: [
            {
              entity: entities.UsersAddress,
              filterBy: 'company',
            },
            {
              entity: entities.Administrator,
              filterBy: 'company',
              children: [
                {
                  entity: entities.AdministratorRelPublicEntity,
                  filterBy: 'administrator',
                },
              ],
            },
            {
              entity: {
                ...entities.RatingProfile,
                columns: ['activationTime', 'routingTag', 'ratingPlanGroup'],
              },
              filterBy: 'company',
            },
            ...Object.values(entities.Retail.customActions),
          ],
        },
        {
          entity: entities.Wholesale,
          isAccessible: (aboutMe) =>
            aboutMe.features.includes(ClientTypes.wholesale),
          filterValues: {
            type: ClientTypes.wholesale,
          },
          fixedValues: {
            domainUsers: '__null__',
          },
          children: [
            {
              entity: entities.Trusted,
              filterBy: 'company',
            },
            {
              entity: entities.Administrator,
              filterBy: 'company',
              children: [
                {
                  entity: entities.AdministratorRelPublicEntity,
                  filterBy: 'administrator',
                },
              ],
            },
            {
              entity: {
                ...entities.RatingProfile,
                columns: ['activationTime', 'routingTag', 'ratingPlanGroup'],
              },
              filterBy: 'company',
            },
            ...Object.values(entities.Wholesale.customActions),
          ],
        },
      ],
    },
    {
      label: _('Providers'),
      children: [
        {
          entity: entities.Carrier,
          children: [
            {
              entity: entities.CarrierServer,
              filterBy: 'carrier',
            },
            {
              entity: entities.RatingProfile,
              filterBy: 'carrier',
              isAccessible: (aboutMe) => aboutMe.features.includes('billing'),
            },
            {
              entity: entities.BalanceMovement,
              filterBy: 'carrier',
              isAccessible: (aboutMe) => aboutMe.features.includes('billing'),
            },
            {
              entity: entities.BalanceNotification,
              filterBy: 'carrier',
              isAccessible: (aboutMe) => aboutMe.features.includes('billing'),
            },
            {
              entity: entities.BillableCall,
              filterBy: 'carrier',
            },
          ],
        },
        {
          entity: entities.DdiProvider,
          children: [
            {
              entity: entities.DdiProviderAddress,
              filterBy: 'ddiProvider',
            },
            {
              entity: entities.DdiProviderRegistration,
              filterBy: 'ddiProvider',
            },
            {
              entity: {
                ...entities.Ddi,
              },
              filterBy: 'ddiProvider',
            },
            {
              entity: entities.BillableCall,
              filterBy: 'ddiProvider',
            },
          ],
        },
        {
          entity: {
            ...entities.Ddi,
          },
          children: [
            {
              entity: entities.BillableCall,
              filterBy: 'carrier',
            },
          ],
        },
      ],
    },
    {
      label: _('Routing'),
      children: [
        {
          entity: entities.OutgoingRouting,
        },
        {
          entity: entities.RoutingPattern,
        },
        {
          entity: entities.RoutingPatternGroup,
        },
        {
          entity: entities.RoutingTag,
        },
      ],
    },
    {
      label: _('Billing'),
      children: [
        {
          entity: entities.RatingPlanGroup,
          isAccessible: (aboutMe) => aboutMe.features.includes('billing'),
          children: [
            {
              entity: entities.RatingPlan,
              filterBy: 'ratingPlanGroup',
            },
          ],
        },
        {
          entity: entities.DestinationRateGroup,
          isAccessible: (aboutMe) => aboutMe.features.includes('billing'),
          children: [
            {
              entity: entities.DestinationRate,
              filterBy: 'destinationRateGroup',
            },
            //@TODO import rates
          ],
        },
        {
          entity: entities.Destination,
          isAccessible: (aboutMe) => aboutMe.features.includes('billing'),
        },
        {
          entity: entities.CompanyBalances,
          isAccessible: (aboutMe) => aboutMe.features.includes('billing'),
          filterValues: {
            'billingMethod[exact]': ['prepaid', 'pseudoprepaid'],
          },
          children: [
            {
              entity: entities.BalanceMovement,
              filterBy: 'company',
            },
            {
              entity: entities.BalanceNotification,
              filterBy: 'company',
            },
            //@TODO BalanceOperations
          ],
        },
        {
          entity: entities.CompanyCurrentDayUsage,
          isAccessible: (aboutMe) => aboutMe.features.includes('billing'),
        },
      ],
    },
    {
      label: _('Invoice', { count: 1 }),
      children: [
        {
          entity: entities.Invoice,
          isAccessible: (aboutMe) => aboutMe.features.includes('invoices'),
          children: [
            {
              entity: entities.FixedCostsRelInvoice,
              filterBy: 'invoice',
            },
            {
              entity: entities.BillableCall,
              filterBy: 'invoice',
            },
            //@TODO generate invoice
          ],
        },
        {
          entity: entities.InvoiceScheduler,
          isAccessible: (aboutMe) => aboutMe.features.includes('invoices'),
          children: [
            {
              entity: entities.FixedCostsRelInvoiceScheduler,
              filterBy: 'invoiceScheduler',
            },
            {
              entity: entities.Invoice,
              filterBy: 'scheduler',
              children: [
                {
                  entity: entities.FixedCostsRelInvoice,
                  filterBy: 'invoice',
                },
                {
                  entity: entities.BillableCall,
                  filterBy: 'invoice',
                },
                //@TODO generate invoice
              ],
            },
          ],
        },
        {
          entity: entities.InvoiceNumberSequence,
          isAccessible: (aboutMe) => aboutMe.features.includes('invoices'),
        },
        {
          entity: entities.FixedCost,
          isAccessible: (aboutMe) => aboutMe.features.includes('invoices'),
        },
        {
          entity: entities.InvoiceTemplate,
          isAccessible: (aboutMe) => aboutMe.features.includes('invoices'),
          children: [
            //@TODO template testing
          ],
        },
      ],
    },
    {
      label: _('Calls'),
      children: [
        {
          entity: entities.ActiveCalls,
        },
        {
          entity: entities.BillableCall,
          children: [
            //@TODO rerate call
          ],
        },
        {
          entity: entities.CallCsvScheduler,
          children: [
            {
              entity: entities.CallCsvReport,
              filterBy: 'callCsvScheduler',
            },
          ],
        },
      ],
    },
    {
      label: _('Settings'),
      children: [
        {
          entity: entities.WebPortal,
        },
        {
          entity: entities.SpecialNumber,
        },
        {
          entity: entities.TransformationRuleSet,
          children: [
            {
              entity: entities.CallerInTransformation,
              filterBy: 'transformationRuleSet',
              filterValues: {
                type: 'callerin',
              },
            },
            {
              entity: entities.CalleeInTransformation,
              filterBy: 'transformationRuleSet',
              filterValues: {
                type: 'calleein',
              },
            },
            {
              entity: entities.CallerOutTransformation,
              filterBy: 'transformationRuleSet',
              filterValues: {
                type: 'callerout',
              },
            },
            {
              entity: entities.CalleeOutTransformation,
              filterBy: 'transformationRuleSet',
              filterValues: {
                type: 'calleeout',
              },
            },
          ],
        },
        {
          entity: entities.NotificationTemplate,
          children: [
            {
              entity: entities.NotificationTemplateContent,
              filterBy: 'notificationTemplate',
            },
          ],
        },
        {
          entity: entities.MusicOnHold,
        },
        {
          entity: entities.BrandService,
        },
        {
          entity: entities.MatchList,
          children: [
            {
              entity: entities.MatchListPattern,
              filterBy: 'matchList',
            },
          ],
        },
      ],
    },
    {
      label: _('Client configurations'),
      children: [
        {
          entity: entities.ResidentialDevice,
          isAccessible: (aboutMe) =>
            aboutMe.features.includes(ClientTypes.residential),
        },
        {
          entity: entities.RetailAccount,
          isAccessible: (aboutMe) =>
            aboutMe.features.includes(ClientTypes.retail),
        },
        {
          entity: entities.Corporation,
        },
      ],
    },
    {
      label: _('Views'),
      children: [
        {
          entity: {
            ...entities.User,
            acl: {
              ...denyAllAcl,
              read: true,
            },
          },
          isAccessible: (aboutMe) =>
            aboutMe.features.includes(ClientTypes.vpbx),
        },
        {
          entity: {
            ...entities.BannedAddress,
            acl: {
              ...denyAllAcl,
              read: true,
            },
          },
          filterValues: {
            blocker: 'ipfilter',
          },
        },
        {
          entity: {
            ...entities.BannedAddressBruteForce,
            acl: {
              ...denyAllAcl,
              read: true,
            },
          },
          filterValues: {
            blocker: 'antibruteforce',
          },
        },
      ],
    },
  ];

  return routeMapParser<ExtendedRouteMapItem>(map);
};

export default getEntityMap;
